<?php
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
    $h1 ="Процессы-all List";
    $App['views']['social-block']=false;
    $appRJ->response['result'].= "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
        "<meta name='description' content='Список процессов'/>".
        "<meta name='robots' content='noindex'>".
        "<title>Process-all List</title>".
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
    $allP_qry="select * from wdProcList_dt ORDER BY pName";
    $allP_res=$DB->query($allP_qry);
    if($allP_res->rowCount() > 0){
        $appRJ->response['result'].="<div class='wi-block'>";
        while ($allP_row = $allP_res->fetch(PDO::FETCH_ASSOC)){
            $appRJ->response['result'].="<h3><div class='line ta-left'><span class='fName'>";
            if($allP_row['pImg']){
                $appRJ->response['result'].="<img src='".WD_PROC_IMG.$allP_row['pImg']."'>";
            }
            $appRJ->response['result'].="</span>".
                "<span class='fVal'>".$allP_row['pName']."</span></div></h3><div class='wi-descr ta-left'>";
            if($allP_row['pDescr']){
                $appRJ->response['result'].=$allP_row['pDescr'];
            }else{
                $appRJ->response['result'].="описание не задано";
            }
            $appRJ->response['result'].="</div>";
            $appRJ->response['result'].="<div class='line ta-left'><a href='/win-pc-info/wiMan/process/".$allP_row['pName']."' class='editP'>" .
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