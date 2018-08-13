<?php
$editImg['result'] = false;
$editImg['data'] = null;

//if(isset($_POST['cat_id']) and $_POST['cat_id']!=null){
$Gr_rd = new recordDefault("usersGroups_dt", "group_id");
$Gr_rd->result['group_id']=$_POST['group_id'];
if($Gr_rd->copyOne()){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Gr_rd->result['img']){
                unlink ($_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id']."/".$Gr_rd->result['img']);
                unlink ($_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id']."/preview/".$Gr_rd->result['img']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Gr_rd->result['img']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.
                $Gr_rd->result['group_id']."/".$Gr_rd->result['img'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id']."/".$Gr_rd->result['img'],
                    $_SERVER["DOCUMENT_ROOT"].PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id']."/preview/".$Gr_rd->result['img'], 300, 300);
                /*<--create preview*/
                if($Gr_rd->updateOne()){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".PP_USRGR_IMG_PAPH.$Gr_rd->result['group_id']."/preview/".$Gr_rd->result['img']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "неправильный group_id 2";
}
/*
}else{
$editImg['data'] = "неправильный cat_id";
}
*/
$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;