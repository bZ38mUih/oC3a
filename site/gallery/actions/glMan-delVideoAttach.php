<?php
$glVideo = array("table" => "galleryVideo_dt", "field_id" => "video_id");
$glVideo['result']['video_id'] = $_POST['video_id'];
if($DB->removeOne($glVideo)){
    $appRJ->response['result'].= "<div class='results success'>deleted SUCCESS</div>";
}else{
    $appRJ->response['result'].= "<div class='results fail'>deleted FAIL</div>";
}