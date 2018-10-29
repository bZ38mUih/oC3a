<?php
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
    $h1 ="Окружение-all List";
    $App['views']['social-block']=false;
    $appRJ->response['result'].= "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
        "<meta name='description' content='Список окружения'/>".
        "<meta name='robots' content='noindex'>".
        "<title>Environment-all List</title>".
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
    $allEnv_qry="select * from wdEnvList_dt ORDER BY vName, vVal";
    $allEnv_res=$DB->doQuery($allEnv_qry);
    if(mysql_num_rows($allEnv_res)>0){
        $appRJ->response['result'].="<div class='wi-block'>";
        while ($allEnv_row=$DB->doFetchRow($allEnv_res)){
            $appRJ->response['result'].="<h3><div class='line ta-left'><span class='fName'>".$allEnv_row['vName'].": "."</span>".
                "<span class='fVal'>".$allEnv_row['vVal']."</span></div></h3><div class='wi-descr ta-left'>";
            if($allEnv_row['vDescr']){
                $appRJ->response['result'].=$allEnv_row['vDescr'];
            }else{
                $appRJ->response['result'].="описание не задано";
            }
            $appRJ->response['result'].="</div>";
            $appRJ->response['result'].="<div class='line ta-left'><a href='/win-pc-info/wiMan/environment/".$allEnv_row['vName']."/".
                urlencode($allEnv_row['vVal']) . "' class='editP'>" .
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