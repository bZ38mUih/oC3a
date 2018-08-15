<?php

if($_POST){
    if(isset($_POST['flagField']) and $_POST['flagField']=='newCat'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/downloads/actions/newCat.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='newFile'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/downloads/actions/newFile.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editCat') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/editCat_post.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editFile') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/editFile_post.php");
    }elseif (isset($_POST['cat_id']) and $_POST['cat_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/dwlMan-editCatImg.php");
    }elseif (isset($_POST['file_id']) and $_POST['file_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/dwlMan-editFileImg.php");
    }elseif (isset($_POST['addNewLink']) and $_POST['addNewLink']=='yyy'){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/newLink.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/refList.php");
    }
    else{

    }
}elseif (isset($_GET['delFileImg']) and $_GET['delFileImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/delFileImg.php");
}elseif (isset($_GET['delCatImg']) and $_GET['delCatImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/delCatImg.php");
}elseif (isset($_GET['delRef']) and $_GET['delRef']!=null){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/delLink.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/refList.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="newService"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/services/views/srvMan-newService.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editcat"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/editCat_get.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editfile"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/editFile_get.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="files"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/downloads/views/filesView.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newfile"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/newFile.php");
}else{
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-dflt.php");
}