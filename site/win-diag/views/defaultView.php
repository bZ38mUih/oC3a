<?php
$h1 ="Диагностика Windows - Анализ";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Проверка процессов и служб windows'/>".
    "<title>Win-diag</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-diag/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/win-diag/js/win-diag.js'></script>".
    "<link rel='stylesheet' href='/site/win-diag/css/wd-analisyst.css' type='text/css' media='screen, projection'/>".
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
    "<div class='contentBlock-wrap'>";
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-diag/views/diagMenu.php");
$appRJ->response['result'].= "<form class='diagSl'>".
    "<div class='input-line'><label>Загрузите json-файл</label>".
    "<input type='file' onchange='loadDiagFile()' accept='application/JSON'></div>".
    "<div class='input-line'><label>или воспользуйтесь поиском</label><input type='text' value='%'>".
    "<input type='button' value='Поиск' onclick='searchDiag()'></div>".
    "</form>".
    "<div class='wdSearch'></div>";
$appRJ->response['result'].= "<div class='diagResults'>";
if($wdList_rd->copyOne()){
    $wdEnv_qry="select * from wdEnv_dt where wd_id=".$wdList_rd->result['wd_id'];
    $wdHw_qry="select * from wdHw_dt where wd_id=".$wdList_rd->result['wd_id'];
    $wdProc_qry="select * from wdProc_dt where wd_id=".$wdList_rd->result['wd_id']." order by pName";
    $wdSrv_qry="select * from wdSrv_dt WHERE wd_id=".$wdList_rd->result['wd_id']." order by sSTName, sName";
    $appRJ->response['result'].="<div class='diag-info'><h3>Diag-info</h3>".
        "<div class='dgr-line'><span class='fName'>wd_id</span><span class='fVal'>".$wdList_rd->result['wd_id']."</span></div>".
        "<div class='dgr-line'><span class='fName'>wdTag</span><span class='fVal'>".$wdList_rd->result['wdTag']."</span> </div>".
        "<div class='dgr-line'><span class='fName'>diagDate</span><span class='fVal'>".$wdList_rd->result['diagDate']."</span> </div>".
        "</div>";
    $wdEnv_res=$DB->doQuery($wdEnv_qry);
    if(mysql_num_rows($wdEnv_res)>0){
        $appRJ->response['result'].="<div class='diag-info'><h3>EnvVars</h3>";
        while ($wdEnv_row=$DB->doFetchRow($wdEnv_res)){
            $appRJ->response['result'].=
                "<div class='dgr-line'><span class='fName'>".$wdEnv_row['vName'].
                "</span><span class='fVal'>".$wdEnv_row['vVal']."</span></div>";
        }
        $appRJ->response['result'].="</div>";
    }
    $wdHw_res=$DB->doQuery($wdHw_qry);
    if(mysql_num_rows($wdHw_res)>0){
        $appRJ->response['result'].="<div class='diag-info'><h3>Hardware</h3>";
        while ($wdHw_row=$DB->doFetchRow($wdHw_res)){
            $dwManHw=null;
            $appRJ->response['result'].=
                "<div class='dgr-line'><span class='fName'>".$wdHw_row['paramName']."</span><a class='fVal'>";
            if ($wdHw_row['paramName'] != "RAM") {
                //$appRJ->response['result'] .= "<a href='/win-diag/hardware?hwList_id=" . $wdHw_row['paramVal'] . "'>" .
                //$appRJ->response['result'] .= "<a href='/win-diag/hardware/" . $wdHw_row['paramVal'] . "'>" .
                if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){

                    $dwManHw="<div class='dgr-line'><span class='fName'> </span><a class='fVal'>".
                        "<a href='/win-diag/wdMan/hardware/" . urlencode($wdHw_row['paramVal']) . "'>" .
                        "Edit</a></div>";
                }
                $appRJ->response['result'] .= "<a href='/win-diag/hardware/" . urlencode($wdHw_row['paramVal']) . "'>" .
                    $wdHw_row['paramVal'] . "</a></div>".$dwManHw;

            } else {
                $appRJ->response['result'] .= "<span class='fVal'>" . $wdHw_row['paramVal'] . "</a></div>";
            }
        }
        $appRJ->response['result'].="</div>";
    }
    $wdProc_res=$DB->doQuery($wdProc_qry);
    if(mysql_num_rows($wdProc_res)>0){
        $appRJ->response['result'].="<div class='diag-info'><h3>Process</h3>".

            "<div class='dgr-line top'><span class='fName'>Процессов:</span>".
            "<span class='fVal'>".mysql_num_rows($wdProc_res)."</span> </div>";
        $appRJ->response['result'].=
            "<div class='dgr-line caption'><div class='p-name'>p-name</div>".
            "<div class='p-pid'>PID</div><div class='p-res'>Result</div></div>";
        while ($wdProc_row=$DB->doFetchRow($wdProc_res)){
            $appRJ->response['result'].=
                "<div class='dgr-line'><div class='p-name'>".
                "<a href='/win-diag/process?pList_id=".$wdProc_row['pList_id']."'>".$wdProc_row['pName']."</a>".
                "</div><div class='p-pid'>".$wdProc_row['PID']."</div><div class='p-res'>-</div></div>";
        }
        $appRJ->response['result'].="</div>";
    }
    $wdSrv_res=$DB->doQuery($wdSrv_qry);
    if(mysql_num_rows($wdSrv_res)>0){
        $appRJ->response['result'].="<div class='diag-info'><h3>Services</h3>".
            "<div class='dgr-line top'><span class='fName'>Служб:</span>".
            "<span class='fVal'>".mysql_num_rows($wdSrv_res)."</span> </div>";
        $appRJ->response['result'].=
            "<div class='dgr-line caption'><div class='s-name'>s-name</div>".
            "<div class='sd-name'>sSTName</div><div class='s-res'>Result</div></div>";

        while ($wdSrv_row=$DB->doFetchRow($wdSrv_res)){
            $appRJ->response['result'].=
                "<div class='dgr-line'><div class='s-name'>".$wdSrv_row['sName'].
                "</div><div class='sd-name'>".$wdSrv_row['sSTName']."</div><div class='s-res'>-</div></div>";
        }
        $appRJ->response['result'].="</div>";
    }
}else{
    if(isset($wdList_rd->result['wd_id'])){
        $appRJ->response['result'].="invalid wd_id";
    }
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div></div></div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";