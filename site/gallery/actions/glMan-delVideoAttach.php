<?php
$glVideo = new recordDefault("galleryVideo_dt", "video_id");
$glVideo->result['video_id']=$_POST['video_id'];
//if($glVideo->copyOne()){
    /*
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glVideo->result['album_id']."/photoAttach/".
        $glPhoto->result['photoLink']);
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glVideo->result['album_id']."/photoAttach/preview/".
        $glVideo->result['photoLink']);*/
    if($glVideo->removeOne()){
        $appRJ->response['result'].= "<div class='results success'>deleted SUCCESS</div>";
    }else{
        $appRJ->response['result'].= "<div class='results fail'>deleted FAIL</div>";
    }
/*
}else{
    $appRJ->response['result'].= "<div class='results fail'>неправильные параметры запроса album_id</div>";
}
*/