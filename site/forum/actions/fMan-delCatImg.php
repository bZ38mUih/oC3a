<?php
$delImg['result'] = false;
$delImg['data'] = null;
$Cat_rd = new recordDefault("forumMenu_dt", "fm_id");
$Cat_rd['result']['fm_id']=$_GET['delCatImg'];
if($Cat_rd->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd['result']['fm_id']."/".$Cat_rd['result']['mImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd['result']['fm_id']."/preview/".$Cat_rd['result']['mImg']);
    $Cat_rd['result']['mImg']=null;
    if($Cat_rd->updateOne()){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса fm_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;