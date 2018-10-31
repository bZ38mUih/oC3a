<?php
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
    $h1 ="Службы-all List";
    $App['views']['social-block']=false;
    $appRJ->response['result'].= "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
        "<meta name='description' content='Список служб'/>".
        "<meta name='robots' content='noindex'>".
        "<title>Services-all List</title>".
        "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
        "<script src='/source/js/jquery-3.2.1.js'></script>".
        "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
        "<script src='/site/siteHeader/js/modalHeader.js'></script>".
        "<link rel='stylesheet' href='/site/win-pc-info/css/wi-default.css' type='text/css' media='screen, projection'/>".
        "<script src='/site/js/goTop.js'></script>".
        "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
        "</head><body>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
    $appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
        "<div class='contentBlock-wrap'><div class='lrp-wrap'>";
    $allS_qry="select * from wdSrvList_dt ORDER BY sName";
    $allS_res=$DB->doQuery($allS_qry);
    if(mysql_num_rows($allS_res)>0){
        $appRJ->response['result'].="<div class='wi-block'>";
        while ($allS_row=$DB->doFetchRow($allS_res)){
            $appRJ->response['result'].="<h3><div class='line ta-left'><span class='fName'>";
            if($allS_row['sImg']){
                $appRJ->response['result'].="<img src='".WD_SRV_IMG.$allS_row['sImg']."'>";
            }
            $appRJ->response['result'].="</span>".
                "<span class='fVal'>".$allS_row['sName']."</span></div></h3><div class='wi-descr ta-left'>";
            if($allS_row['sDescr']){
                $appRJ->response['result'].=$allS_row['sDescr'];
            }else{
                $appRJ->response['result'].="описание не задано";
            }
            $appRJ->response['result'].="</div>";
            $appRJ->response['result'].="<div class='line ta-left'><a href='/win-pc-info/wiMan/services/".urlencode($allS_row['sName'])."' class='editP'>" .
                "<img src='/source/img/edit-icon.png'> - Edit</a></div>";
        }
    }
    $appRJ->response['result'].= "</div></div></div></div>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
    $appRJ->response['result'].= "</body></html>";
}else{
    $appRJ->errors['access']['description']="у вас нет прав доступа";
}