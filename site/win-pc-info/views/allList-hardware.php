<?php
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
    $h1 ="Аппаратура-all List";
    $App['views']['social-block']=false;
    $appRJ->response['result'].= "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
        "<meta name='description' content='Список аппаратуры'/>".
        "<meta name='robots' content='noindex'>".
        "<title>Hardware-all List</title>".
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
    $allHw_qry="select * from wdHwList_dt ORDER BY paramName, paramVal";
    $allHw_res=$DB->doQuery($allHw_qry);
    if(mysql_num_rows($allHw_res)>0){
        $appRJ->response['result'].="<div class='wi-block'>";
        while ($allHw_row=$DB->doFetchRow($allHw_res)){
            $appRJ->response['result'].="<h3><div class='line ta-left'><span class='fName'>";
            if($allHw_row['hwImg']){
                $appRJ->response['result'].="<img src='".WD_HW_IMG.$allHw_row['paramName']."/preview/".$allHw_row['hwImg']."'>";
            }
            $appRJ->response['result'].="</span>".
                "<span class='fVal'>".$allHw_row['paramVal']."</span> </div></h3><div class='wi-descr ta-left'>";
            if($allHw_row['hwDescr']){
                $appRJ->response['result'].=$allHw_row['hwDescr'];
            }else{
                $appRJ->response['result'].="описание не задано";
            }
            $appRJ->response['result'].="</div>";
            $appRJ->response['result'].="<div class='line ta-left'><a href='/win-pc-info/wiMan/hardware/".$allHw_row['paramName']."/".
                urlencode($allHw_row['paramVal']) . "' class='editP'>" .
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