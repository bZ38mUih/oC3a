<?php

define(GL_CATEG_IMG_PAPH, "/data/gallery/categs/");
define(GL_ALBUM_IMG_PAPH, "/data/gallery/albums/");

if ($_POST['setLike'] and $_POST['setLike']!=null){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/setPhotoLike.php");
}
elseif(isset($_GET['writeComment']) and $_GET['writeComment']=='true'){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/writeComments.php");
}
elseif(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    if(strtolower($appRJ->server['reqUri_expl'][2])=="glmanager"){
        if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/glManagerController.php");
        }else{
            $h1='требуется авторизация';
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/signIn/views/defaultView.php");
        }
    }
    elseif(strtolower($appRJ->server['reqUri_expl'][2])=="albums"){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/gallery/views/albumsView.php");
    }
    elseif(strtolower($appRJ->server['reqUri_expl'][2])=="category"){
        if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/gallery/views/categoryView.php");
        }else{
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/gallery/views/categoriesView.php");
        }
    }
    else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/gallery/views/albumView.php");
    }
}
else{
    require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/defaultView.php");
}