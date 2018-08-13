<?php
$delImg['result'] = false;
$delImg['data'] = null;

//require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
$Subj_rd = new recordDefault("subjects_dt", "subject_id");
$Subj_rd->result['subject_id']=$_GET['delSubjImg'];
if($Subj_rd->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/".$Subj_rd->result['subjImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/preview/".$Subj_rd->result['subjImg']);
    $Subj_rd->result['subjImg']=null;
    if($Subj_rd->updateOne()){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса cat_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'].= $delImg;