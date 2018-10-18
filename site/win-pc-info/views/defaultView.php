<?php
$h1 ="Windows PC Info";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Проверка процессов и служб windows'/>";
if($_GET['wd_id']){
    $appRJ->response['result'].="<meta name='robots' content='noindex'>";
}
$appRJ->response['result'].="<title>Win-pc-info</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/win-pc-info/js/wi-loadDFile.js'></script>" .
    "<script src='/site/win-pc-info/js/wi-form.js'></script>" .
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-menu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-form.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/js/goTop.js'></script>".
    "<script src='/site/signIn/js/extAuth.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
$appRJ->response['result'].="<div class='modal signIn'><div class='overlay'></div><div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div></div>".
    "<div class='modal-left'></div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap lrp-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wi-form.php");
$appRJ->response['result'].="<div class='wiSearch'>";
if(!$_GET['wd_id']){
    $appRJ->response['result'].="<h4>Список диаг-файлов:</h4>";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/searchDFile.php");
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "<div class='wi-results ta-left'>";
if($wdList_rd->copyOne()){
    $wdEnv_qry="select wdEnv_dt.vName as vName1, wdEnv_dt.vVal AS vVal1, wdEnv_dt.envList_id, wdEnvList_dt.vDescr ".
        "from wdEnv_dt LEFT JOIN wdEnvList_dt ON wdEnv_dt.vName=wdEnvList_dt.vName and wdEnv_dt.vVal=wdEnvList_dt.vVal ".
        "where wdEnv_dt.wd_id=".$wdList_rd->result['wd_id'];
    $wdHw_qry="select wdHw_dt.paramName as paramName1, wdHw_dt.paramVal as paramVal1, wdHw_dt.hwList_id, wdHwList_dt.hwDescr ".
        "from wdHw_dt LEFT JOIN wdHwList_dt ON wdHw_dt.paramName=wdHwList_dt.paramName and ".
        "wdHw_dt.paramVal=wdHwList_dt.paramVal ".
        "where wdHw_dt.wd_id=".$wdList_rd->result['wd_id'];
    $wdProc_qry="select * from wdProc_dt where wd_id=".$wdList_rd->result['wd_id']." order by pName";
    $wdSrv_qry="select * from wdSrv_dt WHERE wd_id=".$wdList_rd->result['wd_id']." order by sSTName, sName";
    $appRJ->response['result'].="<div class='wi-block'><h3>Инфо:</h3>".
        "<div class='line btMg2'><span class='fName'>wd_id:</span><span class='fVal'>".$wdList_rd->result['wd_id'].
        "</span></div><div class='line btMg2'><span class='fName'>wdTag:</span><span class='fVal'>".
        $wdList_rd->result['wdTag']."</span> </div><div class='line btMg2'><span class='fName'>diagDate:</span>".
        "<span class='fVal'>".$wdList_rd->result['diagDate']."</span></div></div>";
    $wdEnv_res=$DB->doQuery($wdEnv_qry);
    if(mysql_num_rows($wdEnv_res)>0){
        $appRJ->response['result'].="<div class='wi-block'><h3>перОкруж</h3>";
        while ($wdEnv_row=$DB->doFetchRow($wdEnv_res)){
            $dwManEnv=null;
            if($wdEnv_row['vName1']!='MachineName' and $wdEnv_row['vName1']!='UserName'){
                $appRJ->response['result'].=
                    "<div class='line btMg2'><span class='fName'>".$wdEnv_row['vName1'].
                    ":</span>";
                if($wdEnv_row['vDescr']){
                    $appRJ->response['result'].="<a href='/win-pc-info/environment?envList_id=".
                        $wdEnv_row['envList_id']."' title='подробнее'>";
                }else{
                    $appRJ->response['result'].="<a href='#' onclick='return false;' class='deactive' title='описание отсутствует'>";
                }
                $appRJ->response['result'].=$wdEnv_row['vVal1']."</a></div>";
                if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                    $dwManEnv="<div class='line btMg2'><span class='fName'> </span>".
                        "<a href='/win-pc-info/wiMan/environment/".$wdEnv_row['vName1']."/". urlencode($wdEnv_row['vVal1']) . "' class='editP'>" .
                        "<img src='/source/img/edit-icon.png'> - Edit</a></div>";
                }
            }else{
                $appRJ->response['result'].=
                    "<div class='line btMg2'><span class='fName'>".$wdEnv_row['vName1'].
                    ":</span><span class='fVal'>".$wdEnv_row['vVal1']."</span></div>";
            }
            $appRJ->response['result'].=$dwManEnv;
        }
        $appRJ->response['result'].="</div>";
    }
    $wdHw_res=$DB->doQuery($wdHw_qry);
    if(mysql_num_rows($wdHw_res)>0){
        $appRJ->response['result'].="<div class='wi-block'><h3>Аппаратура</h3>";
        while ($wdHw_row=$DB->doFetchRow($wdHw_res)){
            $dwManHw=null;
            $appRJ->response['result'].=
                "<div class='line btMg2'><span class='fName'>".$wdHw_row['paramName1']."</span>";
            if ($wdHw_row['paramName1'] != "RAM") {
                if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                    $dwManHw="<div class='line btMg2'><span class='fName'> </span>".
                        "<a href='/win-pc-info/wiMan/hardware/".$wdHw_row['paramName1']."/".
                        urlencode($wdHw_row['paramVal1']) . "' class='editP'>" .
                        "<img src='/source/img/edit-icon.png'> - Edit</a></div>";
                }
                if($wdHw_row['hwDescr']){
                    $appRJ->response['result'] .= "<a href='/win-pc-info/hardware?hwList_id=". urlencode($wdHw_row['hwList_id']) .
                        "' title='подробнее'>" .
                        $wdHw_row['paramVal1'];
                }else{
                    $appRJ->response['result'] .= "<a href='#' onclick='return false;' class='deactive' title='описание отсутствует'>" .
                        $wdHw_row['paramVal1'];
                }
                $appRJ->response['result'] .="</a></div>".$dwManHw;
            } else {
                $appRJ->response['result'] .= "<span class='fVal'>" . $wdHw_row['paramVal1'] . "</span></div>";
            }
        }
        $appRJ->response['result'].="</div>";
    }
    $wdProc_res=$DB->doQuery($wdProc_qry);
    if(mysql_num_rows($wdProc_res)>0){
        $appRJ->response['result'].="<div class='wi-block '><h3>Процессы</h3>".
            "<div class='line btMg1'><span class='fName'>Процессов:</span>".
            "<span class='fVal'>".mysql_num_rows($wdProc_res)."</span> </div>";
        $appRJ->response['result'].=
            "<div class='wi-table'><div class='line caption'><div class='td-40'>p-name</div>".
            "<div class='td-20'>PID</div><div class='td-30'>Result</div></div>";
        while ($wdProc_row=$DB->doFetchRow($wdProc_res)){
            $appRJ->response['result'].=
                "<div class='line'><div class='td-40'>".
                "<a href='/win-pc-info/process?pList_id=".$wdProc_row['pList_id']."'>".$wdProc_row['pName']."</a>".
                "</div><div class='td-20'><span>".$wdProc_row['PID']."</span></div><div class='td-30'><span>-</span>".
                "</div></div>";
        }
        $appRJ->response['result'].="</div></div>";
    }
    $wdSrv_res=$DB->doQuery($wdSrv_qry);
    if(mysql_num_rows($wdSrv_res)>0){
        $appRJ->response['result'].="<div class='wi-block'><h3>Службы</h3>".
            "<div class='line btMg1'><span class='fName'>Служб:</span>".
            "<span class='fVal'>".mysql_num_rows($wdSrv_res)."</span> </div>".
            "<div class='line caption'><div class='td-35'>s-name</div>".
            "<div class='td-35'>sSTName</div><div class='td-20'>Result</div></div>";
        while ($wdSrv_row=$DB->doFetchRow($wdSrv_res)){
            $appRJ->response['result'].=
                "<div class='line'><div class='td-35'>".$wdSrv_row['sName'].
                "</div><div class='td-35'>".$wdSrv_row['sSTName']."</div><div class='td-20'>-</div></div>";
        }
        $appRJ->response['result'].="</div>";
    }
}else{
    if(isset($wdList_rd->result['wd_id'])){
        $appRJ->response['result'].="invalid wd_id";
    }
}
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";