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
elseif(isset($_GET['writeComment']) and $_GET['writeComment']=='true'){
    $appRJ->response['format']="ajax";
    $glComment = new recordDefault("galleryComments_dt", "comment_id");
    $glComment->result['photo_id']=$_GET['photo_id'];
    $glComment->result['user_id']=$_SESSION['user_id'];
    if($_GET['comPar_id']=="null"){
        $glComment->result['commentPar_id']=null;
    }else{
        $glComment->result['commentPar_id']=$_GET['comPar_id'];
    }

    $glComment->result['writeDate']=@date_format($appRJ->date['curDate'], 'Y-m-d H-m-s');
    //$glComment->result['writeDate']=$appRJ->date['curDate'];
    $glComment->result['commmentCont']=$_GET['comment'];
    if($glComment->putOne()){
        /*$appRJ->response['result'].="success | commmentCont=".$glComment->result['commmentCont']." | photo_id=".
            $glComment->result['photo_id'].
            "| user_id=".$glComment->result['user_id']." | commentPar_id=".$glComment->result['commentPar_id']." | ".
            "writeDate=".$glComment->result['writeDate'];*/
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/printComments.php");
        $printComments=prtPhCm($glComment->result['photo_id'] ,null, $DB);
        $appRJ->response['result'].=$printComments['text'];
    }else{
        $appRJ->response['result'].="fail | commmentCont=".$glComment->result['commmentCont']." | photo_id=".
            $glComment->result['photo_id'].
            "| user_id=".$glComment->result['user_id']." | commentPar_id=".$glComment->result['commentPar_id']." | ".
        "writeDate=".$glComment->result['writeDate'];
    }


    //print_r($_GET);
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