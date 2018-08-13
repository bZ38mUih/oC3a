<?php

define(GL_CATEG_IMG_PAPH, "/data/gallery/categs/");
define(GL_ALBUM_IMG_PAPH, "/data/gallery/albums/");

if ($_POST['setLike'] and $_POST['setLike']!=null){
    $appRJ->response['format']='ajax';
    if($_SESSION['user_id']) {
        $add_txt = null;
        $slLike_txt1 = "select * from galleryLike_dt where user_id=" . $_SESSION['user_id'] . " and photo_id=" . $_POST['setLike'];
        $slLike_res1 = $DB->doQuery($slLike_txt1);
        $mkLike_txt = null;
        if (mysql_num_rows($slLike_res1) == 1) {
            $mkLike_txt = "delete from galleryLike_dt where user_id=" . $_SESSION['user_id'] .
                " and photo_id=" . $_POST['setLike'];
            $add_txt = "Вам не понравилось! (передумать ?) ";

        } else {
            $mkLike_txt = "insert into galleryLike_dt (photo_id, user_id) VALUES (" . $_POST['setLike'] . ", " . $_SESSION['user_id'] . ")";
            $add_txt = "Вам понравилось!";
        }
        $DB->doQuery($mkLike_txt);
    }else{
        $add_txt = "требуется авторизация";
    }
    $selectLikes_txt="select photo_id, COUNT(photo_id) as likeQty from galleryLike_dt where photo_id=".$_POST['setLike'];
    $selectLikes_res=$DB->doQuery($selectLikes_txt);
    $photoPrint_row=$DB->doFetchRow($selectLikes_res);
    if(!$photoPrint_row['photo_id']){
        $photoPrint_row['likeQty']=0;
        $photoPrint_row['photo_id']=$_POST['setLike'];
    }
    include ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/photo-like.php");
    $appRJ->response['result'].= $photoLikeTxt;
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