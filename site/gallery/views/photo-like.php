<?php
$photoLikeTxt=null;
$photoLikeTxt.="<a ";
if($_SESSION['user_id']){
    $photoLikeTxt.="onclick='setPhotoLike(".$photoPrint_row['photo_id'].")'";
}
$photoLikeTxt.="><span class='like'>".$add_txt."</span><img src='/source/img/like.png'><span class='like_qty'> (";
if($photoPrint_row['likeQty']){
    $photoLikeTxt.=$photoPrint_row['likeQty'];
}else{
    $photoLikeTxt.="0";
}
$photoLikeTxt.=")</span></a>";