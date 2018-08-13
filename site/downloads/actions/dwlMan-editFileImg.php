<?php
$editFile['result'] = false;
$editFile['data'] = null;

$File_rd = new recordDefault("dwlFiles_dt", "dwlFile_id");
$File_rd->result['dwlFile_id']=$_POST['file_id'];
if($File_rd->copyOne()){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($File_rd->result['fileImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id']."/".$File_rd->result['fileImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id']."/preview/".$File_rd->result['fileImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $File_rd->result['fileImg']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.
                $File_rd->result['dwlFile_id']."/".$File_rd->result['fileImg'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id']."/".$File_rd->result['fileImg'],
                    $_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id']."/preview/".$File_rd->result['fileImg'], 300, 300);
                /*<--create preview*/
                if($File_rd->updateOne()){
                    $editFile['result'] = true;
                    $editFile['data'] = "<img src='".DWL_FILES_IMG_PAPH.$File_rd->result['dwlFile_id']."/preview/".$File_rd->result['fileImg']."'>";
                }
            } else {
                $editFile['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editFile['data'] = "неправильный cat_id 2";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $editFile;