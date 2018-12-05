<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/source/accessorial_class.php");
$Art_rd = new recordDefault("art_dt", "art_id");
$Art_rd->result['art_id'] = $_GET['art_id'];
$Art_rd->copyOne();
if(isset($_POST['artName']) and $_POST['artName']!=null){
    $Art_rd->result['artName']=htmlspecialchars($_POST['artName']);
}else{
    $artErr['artName']='недопустимое название статьи';
}
if(isset($_POST['artAlias']) and $_POST['artAlias']!=null){
    if($Art_rd->result['artAlias']!=htmlspecialchars($_POST['artAlias'])){
        $Art_rd->result['artAlias']=htmlspecialchars($_POST['artAlias']);
        if(!accessorialClass::checkDouble("art_dt", "artAlias", $Art_rd->result['artAlias'])){
            $artErr['artAlias']='недопустимый alias - double ';
        }
    }
}else{
    $artErr['artAlias']='недопустимый alias - null';
}
if(isset($_POST['artMeta']) and $_POST['artMeta']!=null){
    $Art_rd->result['artMeta']=$_POST['artMeta'];
}else{
    $Art_rd->result['artMeta']=null;
    $artErr['artMeta']='недопустимое описание';
}
$Art_rd->result['artCat_id']=$_POST['artCat_id'];
if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
    $Art_rd->result['activeFlag']=true;
}else{
    $Art_rd->result['activeFlag']=false;
}
if(isset($_POST['allowCm']) and $_POST['allowCm']=='on'){
    $Art_rd->result['allowCm']=true;
}else{
    $Art_rd->result['allowCm']=false;
}
if(isset($_POST['pubDate']) and $_POST['pubDate']!==null){
    $Art_rd->result['pubDate']=$_POST['pubDate'];
}else{
    $Art_rd->result['pubDate']=null;
}
if(isset($_POST['refreshDate']) and $_POST['refreshDate']!==null){
    $Art_rd->result['refreshDate']=$_POST['refreshDate'];
}else{
    $Art_rd->result['refreshDate']=null;
}
if($Art_rd->result['refreshDate']!=null and date($Art_rd->result['pubDate'])>date($Art_rd->result['refreshDate'])){
    $artErr['dateErr']='pubDate should be before refreshDate';
}
if(isset($artErr)){
    $artErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artMan-editArt.php");
}else{
    if($Art_rd->updateOne()){
        $artErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artMan-editArt.php");
    }else{
        $appRJ->errors['XXX']['description']='debug info: method -> updateOne; table -> art_dt';
    }
}