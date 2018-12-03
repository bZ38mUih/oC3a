<?php
//$likeFc_id;


$countLikes_query="select count(likeStatus) as likeCnt from forumCmLike_dt WHERE fc_id=".$likeFc_id.
    " and likeStatus is true";
$countDisLikes_query="select count(likeStatus) as likeCnt from forumCmLike_dt WHERE fc_id=".$likeFc_id.
    " and likeStatus is false";
if($_SESSION['user_id']){

}else{
    "<div class='com-like'><img src='/source/img/like-btn.png' onclick='setLike(".'"'.$slCm_row['fc_id'].'", "likePlus"'.")'><span class='likePlus'>+0</span>".
    "<img src='/source/img/dislike-btn.jpg' onclick='setLike(".'"'.$slCm_row['fc_id'].'", "likeMinus"'.")'><span class='likeMinus'>-0</span></div>";

}
$youLikes_query="select likeStatus from forumCmLike_dt WHERE fc_id=".$likeFc_id.
    " and user_id=".$_SESSION['user_id'];
$countLikes_res=$DB->doQuery($countLikes_query);
$countDisLikes_res=$DB->doQuery($countDisLikes_query);
$youLikes_res=$DB->doQuery($youLikes_query);

/*
*/