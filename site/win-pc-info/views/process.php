<?php
$h1 ="Процессы";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Сведения об процессах'/>";
if($_GET['pList_id']){
    $appRJ->response['pList_id'].= "<meta name='robots' content='noindex'>";
}
$appRJ->response['result'].="<title>Process</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/win-pc-info/js/wi-form.js'></script>" .
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-menu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-form.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='lrp-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wi-form.php");
$appRJ->response['result'].="<div class='wiSearch'>";
if(!$_GET['hwList_id'] and !$appRJ->server['reqUri_expl'][3]){
    $appRJ->response['result'].="<h4>Список процессов:</h4>";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/searchProcess.php");
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "<div class='wi-results ta-left'>";
$appRJ->response['result'].=$wdInfo;
$appRJ->response['result'].= "</div></div></div></div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";





















/*processList-->
$difProc_qry="select distinct wdProc_dt.pName from wdProc_dt ".
    "LEFT JOIN wdProcList_dt ON wdProc_dt.pName=wdProcList_dt.pName ".
    "WHERE wdProc_dt.wd_id=".$test_id." and wdProcList_dt.pName is null order by wdProc_dt.pName";
if($difProc_res=$DB->doQuery($difProc_qry)){
    if(mysql_num_rows($difProc_res)>0){
        $appRJ->response['result'].="Записей: ".mysql_num_rows($difProc_res)."<br><br>";
        while($difProc_row=$DB->doFetchRow($difProc_res)){
            //$appRJ->response['result'].="pName1=".$difProc_row['pName']." | pName2=".$difProc_row['pName2']."<br>";
            $appRJ->response['result'].="newPName=".$difProc_row['pName']."<br>";
        }
    }else{
        $appRJ->response['result'].="now new pocess";
    }
}else{
    $appRJ->response['result'].="query fail";

}

$appRJ->response['result'].="insersion now:<br>";
$insertProc_qry="insert into wdProcList_dt(pName) ".$difProc_qry;
if($DB->doQuery($insertProc_qry)){
    $appRJ->response['result'].="insertions WELL<br>";
}else{
    $appRJ->response['result'].="insertions FAIL-2<br>";
    $appRJ->response['result'].=$insertProc_qry;
}
processList--<*/
/*processPID-->
$difProcPID_qry="select wdProc_dt.pName, wdProc_dt.PID from wdProc_dt ".
    "LEFT JOIN wdProcPID_dt ON wdProc_dt.pName=wdProcPID_dt.pName and wdProc_dt.PID=wdProcPID_dt.PID ".
    "WHERE wdProc_dt.wd_id=".$test_id." and wdProcPID_dt.pName is null and wdProcPID_dt.pName is null ".
    "order by wdProc_dt.pName, wdProc_dt.PID";
if($difProcPID_res=$DB->doQuery($difProcPID_qry)){
    if(mysql_num_rows($difProcPID_res)>0){
        $appRJ->response['result'].="Записей: ".mysql_num_rows($difProc_res)."<br><br>";
        while($difProcPID_row=$DB->doFetchRow($difProcPID_res)){
            //$appRJ->response['result'].="pName1=".$difProc_row['pName']." | pName2=".$difProc_row['pName2']."<br>";
            $appRJ->response['result'].="newPName=".$difProcPID_row['pName']." | newPID=".$difProcPID_row['PID']."<br>";
        }
    }else{
        $appRJ->response['result'].="now new pocess";
    }
}else{
    $appRJ->response['result'].="query fail";
}

$appRJ->response['result'].="insersion now:<br>";
$insertProcPID_qry="insert into wdProcPID_dt(pName, PID) ".$difProcPID_qry;
if($DB->doQuery($insertProcPID_qry)){
    $appRJ->response['result'].="insertions WELL<br>";
}else{
    $appRJ->response['result'].="insertions FAIL-3<br>";
    $appRJ->response['result'].=$insertProcPID_qry;
}
processPID--<*/
/*processPath-->
$difProcPath_qry="select DISTINCT wdProc_dt.pName, wdProc_dt.pPath from wdProc_dt ".
    "LEFT JOIN wdProcPath_dt ON wdProc_dt.pName=wdProcPath_dt.pName and wdProc_dt.pPath=wdProcPath_dt.pPath ".
    "WHERE wdProc_dt.wd_id=".$test_id." and wdProcPath_dt.pName is null and wdProcPath_dt.pPath is null ".
    "order by wdProc_dt.pName, wdProc_dt.pPath";
if($difProcPath_res=$DB->doQuery($difProcPath_qry)){
    if(mysql_num_rows($difProcPath_res)>0){
        $appRJ->response['result'].="Записей: ".mysql_num_rows($difProcPath_res)."<br><br>";
        while($difProcPath_row=$DB->doFetchRow($difProcPath_res)){
            //$appRJ->response['result'].="pName1=".$difProc_row['pName']." | pName2=".$difProc_row['pName2']."<br>";
            $appRJ->response['result'].="newPName=".$difProcPath_row['pName']." | newPath=".$difProcPath_row['pPath']."<br>";
        }
    }else{
        $appRJ->response['result'].="now new pocess path";
    }
}else{
    $appRJ->response['result'].="query difProcPath fail";
}

$appRJ->response['result'].="insersion difProcPath now:<br>";
$insertProcPath_qry="insert into wdProcPath_dt(pName, pPath) ".$difProcPath_qry;
if($DB->doQuery($insertProcPath_qry)){
    $appRJ->response['result'].="insertions WELL<br>";
}else{
    $appRJ->response['result'].="insertions FAIL-3<br>";
    $appRJ->response['result'].=$insertProcPath_qry;
}
processPath--<*/

//distinct wdProc_dt.pName from wdProc_dt LEFT JOIN wdProcList_dt ON wdProc_dt.pName=wdProcList_dt.pName WHERE wdProc_dt.wd_id=8 and wdProcList_dt.pName is null


/*
 * wdProc_dt.pName as pName1, wdProcList_dt.pName as pName2 from wdProc_dt LEFT JOIN wdProcList_dt ON wdProc_dt.pName=wdProcList_dt.pName WHERE wdProc_dt.wd_id=16
 */