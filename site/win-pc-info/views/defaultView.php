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
    "<script src='/site/signIn/js/extAuth.js'></script>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>";
if($_SESSION['user_id']){
    $appRJ->response['result'].="<script src='/site/win-pc-info/js/wi-loadDFile.js'></script>";
}
$appRJ->response['result'].="<script src='/site/win-pc-info/js/wi-form.js'></script>" .
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap lrp-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wi-form.php");
$appRJ->response['result'].="<div class='wiSearch'>";
if(!$_GET['wd_id']){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/searchDFile.php");
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "<div class='wi-results ta-left'>";
if($wdList_rd->copyOne()){
    $wdEnv_qry="select wdEnv_dt.vName as vName1, wdEnv_dt.vVal AS vVal1, wdEnv_dt.envList_id, wdEnvList_dt.vDescr ".
        "from wdEnv_dt LEFT JOIN wdEnvList_dt ON wdEnv_dt.vName=wdEnvList_dt.vName and wdEnv_dt.vVal=wdEnvList_dt.vVal ".
        "where wdEnv_dt.wd_id=".$wdList_rd->result['wd_id'];
    $wdOS_qry="select wdOS_dt.osName as osName1, wdOS_dt.osVal AS osVal1, wdOS_dt.osList_id, wdOsList_dt.osDescr ".
        "from wdOS_dt LEFT JOIN wdOsList_dt ON wdOS_dt.osName=wdOsList_dt.osName and wdOS_dt.osVal=wdOsList_dt.osVal ".
        "where wdOS_dt.wd_id=".$wdList_rd->result['wd_id'];
    $wdHw_qry="select wdHw_dt.paramName as paramName1, wdHw_dt.paramVal as paramVal1, wdHw_dt.hwList_id, wdHwList_dt.hwDescr, wdHw_dt.hwNum ".
        "from wdHw_dt LEFT JOIN wdHwList_dt ON wdHw_dt.paramName=wdHwList_dt.paramName and ".
        "wdHw_dt.paramVal=wdHwList_dt.paramVal ".
        "where wdHw_dt.wd_id=".$wdList_rd->result['wd_id'];
    $wdProc_qry="select * from wdProc_dt LEFT JOIN wdProcList_dt ON wdProc_dt.pName=wdProcList_dt.pName where wdProc_dt.wd_id=".$wdList_rd->result['wd_id']." order by wdProc_dt.pName";
    $wdSrv_qry="select * from wdSrv_dt LEFT JOIN wdSrvList_dt ON wdSrv_dt.sName=wdSrvList_dt.sName WHERE wdSrv_dt.wd_id=".$wdList_rd->result['wd_id']." order by wdSrv_dt.sName";
    $appRJ->response['result'].="<div class='wi-block'><h3>Инфо:</h3>".
        "<div class='wi-table'><div class='line caption'><div class='td-48'>infoName</div><div class='td-48'>infoVal</div></div>".
        "<div class='line'><div class='td-48'>wd_id</div><div class='td-48'>".$wdList_rd->result['wd_id'].
        "</div></div><div class='line'><div class='td-48'>wdTag</div><div class='td-48'>".
        $wdList_rd->result['wdTag']."</div> </div><div class='line'><div class='td-48'>loadDate</div>".
        "<div class='td-48'>".$wdList_rd->result['diagDate']."</div></div></div></div>";
    $wdEnv_res=$DB->doQuery($wdEnv_qry);
    if(mysql_num_rows($wdEnv_res)>0){
        $appRJ->response['result'].="<div class='wi-block'><h3>Окружение</h3>".
        "<div class='wi-table'><div class='line caption'><div class='td-48'>envName</div><div class='td-48'>envVal</div></div>";
        while ($wdEnv_row=$DB->doFetchRow($wdEnv_res)){
            $appRJ->response['result'].="<div class='line'><div class='td-48'>".$wdEnv_row['vName1'].
                "</div><div class='td-48'>";
            if($wdEnv_row['vName1']!='MachineName' and $wdEnv_row['vName1']!='UserName'){
                if($wdEnv_row['vDescr']){
                    $appRJ->response['result'].="<a href='/handbook/win-environment/".$wdEnv_row['vName1']."/".urlencode($wdEnv_row['vVal1'])
                        ."' title='подробнее'>";
                }else{
                    $appRJ->response['result'].="<a href='#' onclick='return false;' class='deactive' title='описание отсутствует'>";
                }
                $appRJ->response['result'].=$wdEnv_row['vVal1']."</a>";
            }else{
                $appRJ->response['result'].=$wdEnv_row['vVal1'];
            }
            $appRJ->response['result'].="</div></div>";
        }
        $appRJ->response['result'].="</div></div>";
    }
    $wdOS_res=$DB->doQuery($wdOS_qry);
    if(mysql_num_rows($wdOS_res)>0){
        $appRJ->response['result'].="<div class='wi-block'><h3>OS</h3>".
            "<div class='wi-table'><div class='line caption'><div class='td-48'>osName</div><div class='td-48'>osVal</div></div>";
        while ($wdOS_row=$DB->doFetchRow($wdOS_res)){
            $appRJ->response['result'].="<div class='line'><div class='td-48'>".$wdOS_row['osName1'].
                "</div><div class='td-48'>";
            if($wdOS_row['osName1']!='Name') {
                if ($wdOS_row['osDescr']) {
                    $appRJ->response['result'] .= "<a href='/handbook/win-system-info/" .
                        $wdOS_row['osName1']."/".urlencode($wdOS_row['osVal1']) . "' title='подробнее'>";
                } else {
                    $appRJ->response['result'] .= "<a href='#' onclick='return false;' class='deactive' title='описание отсутствует'>";
                }
                $appRJ->response['result'] .= $wdOS_row['osVal1'] . "</a>";
            }else{
                $appRJ->response['result'] .= $wdOS_row['osVal1'];
            }

            $appRJ->response['result'].="</div></div>";
        }
        $appRJ->response['result'].="</div></div>";
    }
    $wdHw_res=$DB->doQuery($wdHw_qry);
    if(mysql_num_rows($wdHw_res)>0){
        $appRJ->response['result'].="<div class='wi-block'><h3>Аппаратура</h3>".
            "<div class='wi-table'><div class='line caption'><div class='td-48'>hwName</div><div class='td-48'>hwVal</div></div>";;
        while ($wdHw_row=$DB->doFetchRow($wdHw_res)){
            $hwNum=null;
            if($wdHw_row['hwNum']!="-"){
                $hwNum=" (".$wdHw_row['hwNum'].")";
            }
            $appRJ->response['result'].="<div class='line'><div class='td-48'>".$wdHw_row['paramName1'].$hwNum.
                "</div><div class='td-48'>";

            if ($wdHw_row['paramName1'] != "TotalVisibleMemorySize" and $wdHw_row['paramName1'] != "Adapter-Speed"
                and $wdHw_row['paramName1'] != "Disk-size" and $wdHw_row['paramVal1']!="-") {
                if($wdHw_row['hwDescr']){
                    $appRJ->response['result'] .= "<a href='/handbook/win-hardware/".$wdHw_row['paramName1']."/".
                        urlencode($wdHw_row['paramVal1']) .
                        "' title='подробнее'>".$wdHw_row['paramVal1'];
                }else{
                    $appRJ->response['result'] .= "<a href='#' onclick='return false;' class='deactive' title='описание отсутствует'>" .
                        $wdHw_row['paramVal1'];
                }
                $appRJ->response['result'] .="</a>";
            } else {
                $appRJ->response['result'] .=$wdHw_row['paramVal1'];
            }
            $appRJ->response['result'].="</div></div>";
        }
        $appRJ->response['result'].="</div></div>";
    }
    $wdProc_res=$DB->doQuery($wdProc_qry);
    if(mysql_num_rows($wdProc_res)>0){
        $appRJ->response['result'].="<div class='wi-block '><h3><span class='fName'>Процессы</span>".
            "<span class='fVal'>(".mysql_num_rows($wdProc_res).")</span></h3>";
        $appRJ->response['result'].=
            "<div class='wi-table'><div class='line caption'><div class='td-40'>pName</div>".
            "<div class='td-20'>PID</div><div class='td-30'>Path</div></div>";
        while ($wdProc_row=$DB->doFetchRow($wdProc_res)){
            $appRJ->response['result'].=
                "<div class='line'><div class='td-40'>";
            $appRJ->response['result'].="<div class='pCell-img'>";
            if($wdProc_row['pImg']){
                $appRJ->response['result'].="<img src='".WD_PROC_IMG.$wdProc_row['pImg']."'>";
            }else{
                $appRJ->response['result'].="<img src='/data/default-img.png'>";
            }
            $appRJ->response['result'].="</div><div class='pCell-name'>";
            if($wdProc_row['pDescr']){
                $appRJ->response['result'].="<a href='/handbook/win-process/".$wdProc_row['pName']."' title='подробнее'>";
            }else{
                $appRJ->response['result'].="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $appRJ->response['result'].=$wdProc_row['pName'];
            $appRJ->response['result'].="</a></div>";
            $appRJ->response['result'].= "</div><div class='td-20'><span>".$wdProc_row['PID']."</span></div><div class='td-30'>".
                $wdProc_row['pPath'].
                "</div></div>";
        }
        $appRJ->response['result'].="</div></div>";
    }
    $wdSrv_res=$DB->doQuery($wdSrv_qry);
    if(mysql_num_rows($wdSrv_res)>0){
        $appRJ->response['result'].="<div class='wi-block'><h3><span class='fName'>Службы</span>".
            "<span class='fVal'>(".mysql_num_rows($wdSrv_res).")</span></h3>".
            "<div class='wi-table'><div class='line caption'><div class='td-40'>sName</div>".
            "<div class='td-20'>sSTName</div><div class='td-30'>sPath</div></div>";
        while ($wdSrv_row=$DB->doFetchRow($wdSrv_res)){
            $appRJ->response['result'].=
                "<div class='line'><div class='td-40'>";

            $appRJ->response['result'].="<div class='pCell-img'>";
            if($wdSrv_row['sImg']){
                $appRJ->response['result'].="<img src='".WD_SRV_IMG.$wdSrv_row['sImg']."'>";
            }else{
                $appRJ->response['result'].="<img src='/data/default-img.png'>";
            }
            $appRJ->response['result'].="</div><div class='pCell-name'>";
            if($wdSrv_row['sDescr']){
                $appRJ->response['result'].="<a href='/handbook/win-services/".$wdSrv_row['sName']."' title='подробнее'>";
            }else{
                $appRJ->response['result'].="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $appRJ->response['result'].=$wdSrv_row['sName'];
            $appRJ->response['result'].="</a></div>";
            //$wdSrv_row['sName'].
            $appRJ->response['result'].="</div><div class='td-20'>".$wdSrv_row['sSTName']."</div><div class='td-30'>".$wdSrv_row['sPath']."</div></div>";
        }
        $appRJ->response['result'].="</div>";
    }
}else{
    if(isset($wdList_rd->result['wd_id'])){
        $appRJ->response['result'].="invalid wd_id";
    }
}
$appRJ->response['result'].= "</div></div>".
    "<div class='info-app ta-left'><p>Создать диагностический файл можно используя программу - утилиту ".
    "<a href='/downloads/file/win-pc-info'>win-pc-info</a></p><p>Описание сервиса можно прочитать по ссылке ".
    "<a href='/pc/win-pc-info'>/pc/win-pc-info</a></p></div>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";