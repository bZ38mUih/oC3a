<?php
//require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
$glPhoto = array("table" => "galleryPhotos_dt", "field_id" => "photo_id");
$glPhoto['result']['photo_id'] = $_POST['photo_id'];
if($glPhoto = $DB->copyOne($glPhoto)){
    if(isset($_POST['attachName'])){
        $glPhoto['result']['photoName']=$_POST['attachName'];
    }

    if(isset($_POST['attachDescr'])){
        $glPhoto['result']['photoDescr']=$_POST['attachDescr'];
    }

    if(isset($_POST['attachDate'])){
        $glPhoto['result']['uploadDate']=$_POST['attachDate'];
    }

    if(isset($_POST['attachTransf'])){
        $glPhoto['result']['transPhoto']=$_POST['attachTransf'];
    }

    if(isset($_POST['attachFlag']) and $_POST['attachFlag']=='true'){
        $glPhoto['result']['activeFlag']=true;
    }else{
        $glPhoto['result']['activeFlag']=false;
    }

    if($DB->updateOne($glPhoto)){
        foreach($glPhoto['result'] as $key=>$value){
            $itemsCount_row[$key]=$value;
        }
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-photoAttachItem.php");
    }else{
        $appRJ->response['result'].= "fail";
    }


}else{
    $appRJ->response['result'].= "неправильные параметры запроса photo_id";
}

