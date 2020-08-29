<?php

$albErr=null;

$Alb_rd = array("table" => "galleryAlb_dt", "field_id" => "album_id");

if(isset($_POST['albumName']) and $_POST['albumName']!=null){
    $Alb_rd['result']['albumName']=htmlspecialchars($_POST['albumName']);
}else{
    $albErr['albumName']='недопустимое название альбома';
}

if(isset($_POST['albumAlias']) and $_POST['albumAlias']!=null){
    $Alb_rd['result']['albumAlias']=htmlspecialchars($_POST['albumAlias']);
}else{
    $albErr['albumAlias']='недопустимый alias';
}
if(isset($_POST['metaDescr'])){
    $Alb_rd['result']['metaDescr']=htmlspecialchars($_POST['metaDescr']);
}else{
    $Alb_rd['result']['metaDescr']=null;
}

if(isset($_POST['glCat_id'])){

    if($_POST['glCat_id'] == 'none'){
        $Alb_rd['result']['glCat_id']=null;
    }else{
        $Alb_rd['result']['glCat_id']=$_POST['glCat_id'];
    }
}else{

}
if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
    $Alb_rd['result']['activeFlag']=true;
}else{
    $Alb_rd['result']['activeFlag']=false;
}

$Alb_rd['result']['dateOfCr'].= date_format($appRJ->date['curDate'], 'Y-m-d');
$Alb_rd['result']['user_id'].= $_SESSION['user_id'];

if(isset($albErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/gallery/views/glMan-newAlbum.php");
}else{
    if($Alb_rd = $DB->putOne($Alb_rd)){
        $page = "Location: /gallery/glManager/editAlbum/?alb_id=".$DB->lastInsertId();
        header($page);
    }else{
        $appRJ->errors["XXX"]["description"]="insert into galleryAlb err";
    }
}