<?php
$h1 ="Аппаратура";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Сведения об аппаратуре'/>".
    "<title>Hardware</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    //"<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/win-pc-info/js/wdSearch.js'></script>".
    "<link rel='stylesheet' href='/site/win-pc-info/css/wiSearch.css' type='text/css' media='screen, projection'/>" .
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-hwInfo.css' type='text/css' media='screen, projection'/>".
    //"<script src='/site/js/goTop.js'></script>".
    //"<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='lrp-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiSearchMenu.php");
$appRJ->response['result'].="<div class='wdSearchRes'></div>";
$appRJ->response['result'].=$wdInfo;
//$appRJ->response['result'].=""
$appRJ->response['result'].= "</div></div></div></div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";





//$test_id=13;
/*hwList-->
$difHw_qry="select wdHw_dt.paramName, wdHw_dt.paramVal from wdHw_dt ".
    "LEFT JOIN wdHwList_dt ON wdHw_dt.paramName=wdHwList_dt.paramName and wdHw_dt.paramVal=wdHwList_dt.paramVal ".
    "WHERE wdHw_dt.wd_id=".$test_id." and wdHwList_dt.paramName is null and wdHwList_dt.paramVal is null ".
    "order by wdHw_dt.paramName, wdHw_dt.paramVal";
if($difHw_res=$DB->doQuery($difHw_qry)){
    if(mysql_num_rows($difHw_res)>0){
        $appRJ->response['result'].="Записей: ".mysql_num_rows($difHw_res)."<br><br>";
        while($difHw_row=$DB->doFetchRow($difHw_res)){
            //$appRJ->response['result'].="pName1=".$difProc_row['pName']." | pName2=".$difProc_row['pName2']."<br>";
            $appRJ->response['result'].="newParamName=".$difHw_row['paramName']." | newParamVal=".$difHw_row['paramVal']."<br>";
        }
    }else{
        $appRJ->response['result'].="no new hardware";
    }
}else{
    $appRJ->response['result'].="query fail";
}

$appRJ->response['result'].="insersion in wdHwList_dt:<br>";
$insertHwList_qry="insert into wdHwList_dt(paramName, paramVal) ".$difHw_qry;
if($DB->doQuery($insertHwList_qry)){
    $appRJ->response['result'].="insertions WELL<br>";
}else{
    $appRJ->response['result'].="insertions FAIL-3<br>";
    $appRJ->response['result'].=$difHw_qry;
}

hwList--<*/



/*
print_r($_GET);
echo "<hr>";
if(isset($appRJ->server['reqUri_expl'][3])){
    echo "uri-3=".urldecode($appRJ->server['reqUri_expl'][3]);
}else{
    echo "uri-3 not set";
}
exit;
*/