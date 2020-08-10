<?php
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Управление сайтом' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>Admin</title>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/admin/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/admin/css/startView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/admin/adminHeader/css/adminHeader.css' type='text/css' media='screen, projection'/>".
    "<script src='/admin/adminHeader/js/adminHeader.js'></script>".
    "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminHeader/views/adminHeader.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<p><strong>Воспользуйтесь меню для начала работы</strong></p><div class='contentMenu'>";
foreach ($adminModules as $key=>$value){
    $printMenuItem_flag=false;
    if($adminModules[$key]['active']==true){
        if ($connResult){
            $printMenuItem_flag=true;
        }elseif($key=="server" or $key=="adminUsers"){
            $printMenuItem_flag=true;
        }elseif($key=='sql' and $connResult){
            $printMenuItem_flag=true;
        }
        if($printMenuItem_flag){
            $appRJ->response['result'].= "<div class='contentCell'>";
            $appRJ->response['result'].= "<div class='contentCell-img'>";
            if(file_exists($_SERVER['DOCUMENT_ROOT']."/admin/".$key."/img/".$key."_logo.jpg")){
                $appRJ->response['result'].= "<img src='/admin/".$key."/img/".$key."_logo.jpg'>";
            }else{
                $appRJ->response['result'].= "<img src='/admin/".$key."/img/".$key."_logo.png'>";
            }
            $appRJ->response['result'].= "</div><div class='contentCell-text'>".
                "<a href='/admin/".$key."/'>".$adminModules[$key]['aliasMenu']."</a>".
                "<p>".$adminModules[$key]['altText']."</p></div></div>";
        }
    }
}
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");
$appRJ->response['result'].= "</body></html>";