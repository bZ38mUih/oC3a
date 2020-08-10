<?php
$appRJ->response['result'].= "<div class='page-wrap'><div class='contentBlock-frame dark'>".
    "<div class='contentBlock-center'><div class='contentBlock-wrap'><header>".
    "<div class='adminMenu'><img src='/source/img/menu-icon.png'><div class='adminMenu-link-frame'>".
    "<div class='adminMenu-link'><a href='/admin/'";
if(!$adminModule){
    $appRJ->response['result'].= " class='disabled' ";
}
$appRJ->response['result'].= ">Админ</a></div>";
foreach ($adminModules as $key=>$value){
    $printMenuItem_flag = false;
    if($adminModules[$key]['active']==true) {
        $printMenuItem_flag = false;
        if ($connResult) {
            $printMenuItem_flag = true;
        } elseif ($key == "server" or $key == "adminUsers") {
            $printMenuItem_flag = true;
        } elseif ($key == 'sql' and $connResult) {
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
$appRJ->response['result'].= "<div class='adminMenu-link'><a href='/'>Сайт</a></div></div></div>".
    "<div class='avatar'>You are: ".$_SESSION['adminAlias']."</div><h1>";
if(!$adminModule){
    $appRJ->response['result'].= "Главная";
}else{
    $appRJ->response['result'].= $adminModules[$adminModule]['aliasMenu'];
}
$appRJ->response['result'].= "</h1><div class='btnPanel'>".
    "<a class='exit' href='?cmd=exit'><img src='/source/img/exit.png'></a></div></header></div></div></div>";