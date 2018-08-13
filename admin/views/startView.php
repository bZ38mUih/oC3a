<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 05.01.2018
 * Time: 19:24
 */

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Управление сайтом' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Admin</title>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/css/startView.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/adminHeader/css/adminHeader.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/admin/adminHeader/js/adminHeader.js'></script>";

$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

$appRJ->response['result'].= "<div class='contentBlock-frame dark'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminHeader/views/adminHeader.php");

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<p><strong>Воспользуйтесь меню для начала работы</strong></p>";
$appRJ->response['result'].= "<div class='contentMenu'>";

foreach ($adminModules as $key=>$value){
    $printMenuItem_flag=false;
    if($adminModules[$key]['active']==true){
        if ($connResult){
            $printMenuItem_flag=true;
        }elseif($key=="server" or $key=="adminUsers"){
            $printMenuItem_flag=true;
        }elseif($key=='sql' and $DB->connectServer()){
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

            $appRJ->response['result'].= "</div>";
            $appRJ->response['result'].= "<div class='contentCell-text'>";
            $appRJ->response['result'].= "<a href='/admin/".$key."/'>".$adminModules[$key]['aliasMenu']."</a>";
            $appRJ->response['result'].= "<p>".$adminModules[$key]['altText']."</p>";
            $appRJ->response['result'].= "</div>";
            $appRJ->response['result'].= "</div>";
        }
    }
}

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");

$appRJ->response['result'].= "</body>";