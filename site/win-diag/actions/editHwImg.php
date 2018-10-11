<?php
$editImg['result'] = false;
$editImg['data'] = null;
$slHw_qry="select * from wdHwList_dt WHERE paramVal='".$paramVal."' and paramName='".$paramName."'";
$slHw_res=$DB->doQuery($slHw_qry);
if(mysql_num_rows($slHw_res)==1){
    $slHw_row=$DB->doFetchRow($slHw_res);
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName)) {
        mkdir($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName, 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($slHw_row['hwImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/".$slHw_row['hwImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/preview/".$slHw_row['hwImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.
                $paramName."/".$paramVal.".".$path_parts['extension'])) {
                //create preview-->
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/".$paramVal.".".$path_parts['extension'],
                    $_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/preview/".$paramVal.".".$path_parts['extension'], 150, 150);
                //--create preview
                $updateHw_qry="update wdHwList_dt set hwImg='".$paramVal.".".$path_parts['extension']."' WHERE paramVal='".$paramVal."' and paramName='".$paramName."'";
                if($DB->doQuery($updateHw_qry)){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".WD_HW_IMG.$paramName."/preview/".$paramVal.".".$path_parts['extension']."'>";
                    $_SESSION['photoLink'] = "/data/users/".$paramName."/preview/".$paramVal.".".$path_parts['extension'];
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "wrong paramName=".$paramName." | paramVal=".$paramVal;
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;