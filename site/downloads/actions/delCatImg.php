<?php

$delImg['result'] = false;
$delImg['data'] = null;

//require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
$Cat_rd = new recordDefault("dwlCat_dt", "dwlCat_id");
$Cat_rd['result']['dwlCat_id']=$_GET['delCatImg'];
if($Cat_rd->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].UPLOAD_IMG_PAPH.$Cat_rd['result']['dwlCat_id']."/".$Cat_rd['result']['catImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].UPLOAD_IMG_PAPH.$Cat_rd['result']['dwlCat_id']."/preview/".$Cat_rd['result']['catImg']);
    $Cat_rd['result']['catImg']=null;
    if($Cat_rd->updateOne()){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса cat_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;