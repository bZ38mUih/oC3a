<?php
$delImg['result'] = false;
$delImg['data'] = null;
$Subj_rd = new recordDefault("forumSubj_dt", "fs_id");
$Subj_rd['result']['fs_id']=$_GET['delSubjImg'];
if($Subj_rd->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/".$Subj_rd['result']['sImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/preview/".$Subj_rd['result']['sImg']);
    $Subj_rd['result']['sImg']=null;
    if($Subj_rd->updateOne()){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса fs_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;