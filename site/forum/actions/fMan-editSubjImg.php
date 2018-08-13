<?php

//$appRJ->response['result'].= 'editSubjimh here';
//exit;

$editImg['result'] = false;
$editImg['data'] = null;

//if(isset($_POST['cat_id']) and $_POST['cat_id']!=null){
$Subj_rd = new recordDefault("subjects_dt", "subject_id");
$Subj_rd->result['subject_id']=$_POST['subj_id'];
if($Subj_rd->copyOne()){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Subj_rd->result['subjImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/".$Subj_rd->result['subjImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/preview/".$Subj_rd->result['subjImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Subj_rd->result['subjImg']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.
                $Subj_rd->result['subject_id']."/".$Subj_rd->result['subjImg'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/".$Subj_rd->result['subjImg'],
                    $_SERVER["DOCUMENT_ROOT"].FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/preview/".$Subj_rd->result['subjImg'], 400, 400);
                /*<--create preview*/
                if($Subj_rd->updateOne()){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".FORUM_SUBJ_IMG_PAPH.$Subj_rd->result['subject_id']."/preview/".$Subj_rd->result['subjImg']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "неправильный subject_id 2";
}

$appRJ->response['format']='json';
$appRJ->response['result'].= $editImg;