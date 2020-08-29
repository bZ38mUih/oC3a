<?php

$glVideo = array("table" => "galleryVideo_dt", "field_id" => "video_id");
$glVideo['result']['video_id'] = $_POST['video_id'];
if($glVideo = $DB->copyOne($glVideo)){
    if(isset($_POST['attachName'])){
        $glVideo['result']['videoName']=$_POST['attachName'];
    }

    if(isset($_POST['attachDescr'])){
        $glVideo['result']['videoDescr']=$_POST['attachDescr'];
    }

    if(isset($_POST['attachDate'])){
        $glVideo['result']['uploadDate']=$_POST['attachDate'];
    }

    if(isset($_POST['attachFlag']) and $_POST['attachFlag']=='true'){
        $glVideo['result']['activeFlag']=true;
    }else{
        $glVideo['result']['activeFlag']=false;
    }

    if($DB->updateOne($glVideo)){
        foreach($glVideo['result'] as $key=>$value){
            $itemsCount_row[$key]=$value;

        }
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-videoAttachItem.php");
    }else{
        $appRJ->response['result'].= "fail";
    }
}else{
    $appRJ->response['result'].= "неправильные параметры запроса photo_id";
}

