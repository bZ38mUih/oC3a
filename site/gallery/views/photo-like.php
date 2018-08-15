<?php
$photoLikeTxt=null;
$photoLikeTxt.="<a onclick='setPhotoLike(".$photoPrint_row['photo_id'].")'>";
$photoLikeTxt.="<span class='like'>".$add_txt."</span>";
$photoLikeTxt.="<img src='/source/img/like.png'>";
$photoLikeTxt.="<span class='like_qty'>";
$photoLikeTxt.=" (";
if($photoPrint_row['likeQty']){
    $photoLikeTxt.=$photoPrint_row['likeQty'];
}else{
    $photoLikeTxt.="0";
}
$photoLikeTxt.=")";
$photoLikeTxt.="</span>";

$photoLikeTxt.="</a>";