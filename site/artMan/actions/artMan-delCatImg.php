<?php
$delImg['result'] = false;
$delImg['data'] = null;

$Cat_rd = array("table" => "artCat_dt", "field_id" => "artCat_id");
$Cat_rd['result']['artCat_id']=$_GET['delCatImg'];
if($Cat_rd = $DB->copyOne($Cat_rd)){
    unlink ($_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/".$Cat_rd['result']['catImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/preview/".$Cat_rd['result']['catImg']);
    $Cat_rd['result']['catImg']=null;
    if($DB->updateOne($Cat_rd)){
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