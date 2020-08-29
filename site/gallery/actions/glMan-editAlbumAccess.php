<?php
$albErr=null;

$Alb_rd = array("table" => "galleryAlb_dt", "field_id" => "album_id");

$Alb_rd['result']['album_id']=$_GET['alb_id'];
if($Alb_rd = $DB->copyOne($Alb_rd)){

    if(isset($_POST['readRule']) and $_POST['readRule']!=null){
        $Alb_rd['result']['readRule'] = $_POST['readRule'];
    }

    if(isset($_POST['writeRule']) and $_POST['writeRule']!=null){
        $Alb_rd['result']['writeRule'] = $_POST['writeRule'];
    }

    if($DB->updateOne($Alb_rd)){
        $albErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editAlbumAccess.php");
    }else{
        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa-edit";
    }

}else{
    $editImg['data'] = "неправильный alb_id";
}