<?php
$appRJ->response['result'].= "<header>";

$appRJ->response['result'].= "<div class='adminMenu'>";
$appRJ->response['result'].= "<img src='/source/img/menu-icon.png'>";
$appRJ->response['result'].= "<div class='adminMenu-link-frame'>";
$appRJ->response['result'].= "<div class='adminMenu-link'>";
$appRJ->response['result'].= "<a href='/admin/'";
if(!$adminModule){
    $appRJ->response['result'].= " class='disabled' ";
}
$appRJ->response['result'].= ">Админ</a>";
$appRJ->response['result'].= "</div>";

foreach ($adminModules as $key=>$value){
    $printMenuItem_flag = false;
    if($adminModules[$key]['active']==true) {
        $printMenuItem_flag = false;
        if ($connResult) {
            $printMenuItem_flag = true;
        } elseif ($key == "server" or $key == "adminUsers") {
            $printMenuItem_flag = true;
        } elseif ($key == 'sql' and $DB->connectServer()) {
            $printMenuItem_flag = true;
        }
        if ($printMenuItem_flag) {
            $appRJ->response['result'].= "<div class='adminMenu-link'>";
            if ($adminModule == $key) {
                $appRJ->response['result'].= "<a href='javaScript: void(0)' class='disabled'>" . $adminModules[$key]['aliasMenu'] . "</a>";
            } else {
                $appRJ->response['result'].= "<a href='/admin/" . $key . "/'>" . $adminModules[$key]['aliasMenu'] . "</a>";
            }
            $appRJ->response['result'].= "</div>";
        }
    }
}
$appRJ->response['result'].= "<div class='adminMenu-link'>";
$appRJ->response['result'].= "<a href='/'>Сайт</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='avatar'>";
$appRJ->response['result'].= "You are: ".$_SESSION['adminAlias'];
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<h1>";
if(!$adminModule){
    $appRJ->response['result'].= "Главная";
}else{
    $appRJ->response['result'].= $adminModules[$adminModule]['aliasMenu'];
}
$appRJ->response['result'].= "</h1>";
$appRJ->response['result'].= "<div class='btnPanel'>";
$appRJ->response['result'].= "<a class='exit' href='?cmd=exit'><img src='/source/img/exit.png'></a>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</header>";