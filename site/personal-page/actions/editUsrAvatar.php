<?php
$editImg['result'] = false;
$editImg['data'] = null;
$Acc_rd = array("table" => "accounts_dt", "field_id" => "account_id");
$Acc_rd['result']['account_id']=$_POST['avatar_id'];
if($Acc_rd = $DB->copyOne($Acc_rd)){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd['result']['account_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd['result']['account_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd['result']['account_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd['result']['account_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Acc_rd['result']['photoLink']){
                unlink ($_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd['result']['account_id']."/".$Acc_rd['result']['photoLink']);
                unlink ($_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd['result']['account_id']."/preview/".$Acc_rd['result']['albumImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Acc_rd['result']['photoLink']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.
                $Acc_rd['result']['account_id']."/".$Acc_rd['result']['photoLink'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd['result']['account_id']."/".$Acc_rd['result']['photoLink'],
                    $_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd['result']['account_id']."/preview/".$Acc_rd['result']['photoLink'], 150, 150);
                /*<--create preview*/
                if($DB->updateOne($Acc_rd)){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".PP_USR_IMG_PAPH.$Acc_rd['result']['account_id']."/preview/".$Acc_rd['result']['photoLink']."'>";
                    $_SESSION['photoLink'] = "/data/users/".$Acc_rd['result']['account_id']."/preview/".$Acc_rd['result']['photoLink'];
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
$appRJ->response['result'] = $editImg;