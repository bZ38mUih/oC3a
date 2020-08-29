<?php
$editImg['result'] = false;
$editImg['data'] = null;

//if(isset($_POST['cat_id']) and $_POST['cat_id']!=null){
$Subj_rd = new recordDefault("forumSubj_dt", "fs_id");
$Subj_rd['result']['fs_id']=$_POST['forumS_id'];
if($Subj_rd->copyOne()){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Subj_rd['result']['sImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/".$Subj_rd['result']['sImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/preview/".$Subj_rd['result']['sImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Subj_rd['result']['sImg']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.
                $Subj_rd['result']['fs_id']."/".$Subj_rd['result']['sImg'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/".$Subj_rd['result']['sImg'],
                    $_SERVER["DOCUMENT_ROOT"].F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/preview/".$Subj_rd['result']['sImg'], 150, 150);
                /*<--create preview*/
                if($Subj_rd->updateOne()){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".F_SUBJ_IMG.$Subj_rd['result']['fs_id']."/preview/".$Subj_rd['result']['sImg']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "неправильный fs_id 2";
}

$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;