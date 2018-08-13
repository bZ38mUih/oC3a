<?php
$putFile_dest=$_POST['dest'];
$oldFName=null;
$ArtLk_rd = new recordDefault("artLinks_dt", "artLink_id");
$ArtLk_rd->result['art_id']=$_GET['art_id'];
$ArtLk_rd->result['linkType']=$putFile_dest;

if (!file_exists($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$ArtLk_rd->result['art_id']."/".$putFile_dest)) {
    mkdir($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$ArtLk_rd->result['art_id']."/".$putFile_dest, 0777, true);
}
$slLink_qry="select artLink_id, linkRef from artLinks_dt where linkType='".$putFile_dest."' and art_id=".$ArtLk_rd->result['art_id'];
$slLink_res=$DB->doQuery($slLink_qry);
if(mysql_num_rows($slLink_res)==1){
    //$linkExtFlag=true;
    $slLink_row=$DB->doFetchRow($slLink_res);
    $ArtLk_rd->result['artLink_id']=$slLink_row['artLink_id'];
    $oldFName=$slLink_row['linkRef'];
}
foreach ($_FILES as $file){
    if($oldFName){
        unlink ($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$ArtLk_rd->result['art_id']."/".$putFile_dest
            ."/".$oldFName);
    }
    $path_parts = pathinfo(basename($file['name']));
    $ArtLk_rd->result['linkRef']=$path_parts['filename'].".".$path_parts['extension'];
    //$Art_rd->result['artImg']=uniqid().".".$path_parts['extension'];
    if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.
        $ArtLk_rd->result['art_id']."/".$putFile_dest."/".$ArtLk_rd->result['linkRef'])) {

        if($ArtLk_rd->result['artLink_id']){
            $ArtLk_rd->updateOne();
        }else{
            $ArtLk_rd->putOne();
        }

    } else {
        $appRJ->response['result'] = "Возможная атака с помощью файловой загрузки!\n";
    }
}
$appRJ->response['format']='ajax';
$appRJ->response['result'] = "<a href='".ARTS_IMG_PAPH.$_GET['art_id']."/".$putFile_dest."/".$ArtLk_rd->result['linkRef'].
    "' target='_blank'>".$ArtLk_rd->result['linkRef']."</a>";