<?php
$photoLikeTxt=null;

//if($_SESSION['user_id']){
    $photoLikeTxt.="<a onclick='setPhotoLike(".$photoPrint_row['photo_id'].")'>";
    //$photoLikeTxt.="<span class='like' onclick='setPhotoLike(".$photoPrint_row['photo_id'].")'>";
  //  if(isset($add_txt) and $add_txt!=null){
        $photoLikeTxt.="<span class='like'>".$add_txt."</span>";
    //}
//}else{
  //  $photoLikeTxt.="<a>";
//}
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