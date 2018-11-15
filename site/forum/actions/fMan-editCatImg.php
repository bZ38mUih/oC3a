<?php
$editImg['result'] = false;
$editImg['data'] = null;
$Cat_rd = new recordDefault("forumMenu_dt", "fm_id");
$Cat_rd->result['fm_id']=$_POST['fm_id'];
if($Cat_rd->copyOne()){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd->result['fm_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd->result['fm_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd->result['fm_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd->result['fm_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Cat_rd->result['mImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd->result['fm_id']."/".$Cat_rd->result['mImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd->result['fm_id']."/preview/".$Cat_rd->result['mImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Cat_rd->result['mImg']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.
                $Cat_rd->result['fm_id']."/".$Cat_rd->result['mImg'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd->result['fm_id']."/".$Cat_rd->result['mImg'],
                    $_SERVER["DOCUMENT_ROOT"].F_CAT_IMG.$Cat_rd->result['fm_id']."/preview/".$Cat_rd->result['mImg'], 150, 150);
                /*<--create preview*/
                if($Cat_rd->updateOne()){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".F_CAT_IMG.$Cat_rd->result['fm_id']."/preview/".$Cat_rd->result['mImg']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "неправильный fm_id 2";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;