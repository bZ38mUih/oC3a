<?php

if($_POST){
    $refBlock['err']=null;
    if($_SESSION['user_id']){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/blog/actions/postNewComment.php");
    }else{
        $appRJ->errors['access']['description']="комментирование запрещено неавторизированным пользователям";
    }
}elseif ($_GET['likeVal']){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/blog/actions/setArtCmLike.php");
    $appRJ->response['format']='ajax';
    $slCm_qry="select * from artComments_dt WHERE artCm_id=".$_GET['artCm_id'];
    $slCm_res=$DB->doQuery($slCm_qry);
    $slCm_row=$DB->doFetchRow($slCm_res);
    $tmpCm=null;
    include ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artCmLikes.php");
    $appRJ->response['result']=$tmpCm;
}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/blog/views/defaultView.php");
}