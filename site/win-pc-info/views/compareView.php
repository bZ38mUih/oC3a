<?php
$h1 ="Сравнение диаг-файлов";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Сравнение диаг-файлов'/>";
if($_GET['envList_id']){
    $appRJ->response['result'].= "<meta name='robots' content='noindex'>";
}
$appRJ->response['result'].= "<title>Compare</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/win-pc-info/js/wi-form.js'></script>" .
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-menu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-form.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/win-pc-info/css/test.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='lrp-wrap'>";
//21, 24
$wdCompLeft=21;
$wdCompRight=24;

//$slProcLeft_qry="select pName as pNameLeft, pPath AS pPathLeft from wdProc_dt as wdProcLeft WHERE wd_id=".$wdCompLeft;
$slProcLeft_qry="select DISTINCT pName as pNameLeft, pPath AS pPathLeft from wdProc_dt WHERE wd_id=".$wdCompLeft;
$slProcRight_qry="select DISTINCT pName as pNameRight, pPath AS pPathRight from wdProc_dt WHERE wd_id=".$wdCompRight;

$slDifProc_qry="select * from (".$slProcLeft_qry.") as wdProcLeft left join (".$slProcRight_qry.") as wdProcRight".
    " on wdProcLeft.pNameLeft = wdProcRight.pNameRight ".
    "and wdProcLeft.pPathLeft=wdProcRight.pPathRight ".
    "union select * from (".$slProcLeft_qry.") as wdProcLeft right join (".$slProcRight_qry.") as wdProcRight".
    " on wdProcLeft.pNameLeft = wdProcRight.pNameRight ".
    "and wdProcLeft.pPathLeft=wdProcRight.pPathRight order by pNameLeft, pNameRight";
//$slDifProc_qry=$slProcLeft_qry;
//$slDifProc_qry="select * from (".$slProcLeft_qry.") order by pNameLeft";

$slDifProc_res=$DB->doQuery($slDifProc_qry);
if(mysql_num_rows($slDifProc_res)>0){
    $appRJ->response['result'].="<div class='line'>rows=".mysql_num_rows($slDifProc_res)."</div>";
    while ($slDifProc_row=$DB->doFetchRow($slDifProc_res)){

        $appRJ->response['result'].="<div class='line'><div class='td-20'>".$slDifProc_row['pNameLeft']."</div>".
            "<div class='td-20'>".$slDifProc_row['pPathLeft']."</div><div class='td-20'>".$slDifProc_row['pNameRight']."</div>".
            "<div class='td-20'>".$slDifProc_row['pPathRight']."</div></div>";
    }
}

/*
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wi-form.php");
$appRJ->response['result'].="<div class='wiSearch'>";
if(!$_GET['envList_id'] and !$appRJ->server['reqUri_expl'][3]){
    $appRJ->response['result'].="<h4>Список окружения:</h4>";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/searchEnvir.php");
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "<div class='wi-results ta-left'>";
$appRJ->response['result'].=$wdInfo;
//$appRJ->response['result'].=""
*/
$appRJ->response['result'].= "</div></div></div></div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";