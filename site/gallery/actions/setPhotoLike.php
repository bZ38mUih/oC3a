<?php
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