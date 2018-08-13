<?php

$artErr=null;

$Art_rd = new recordDefault("art_dt", "art_id");

if(isset($_POST['artName']) and $_POST['artName']!=null){
    //$catName_err =
    $Art_rd->result['artName']=htmlspecialchars($_POST['artName']);
}else{
    $artErr['artName']='недопустимое название статьи';
}

if(isset($_POST['artAlias']) and $_POST['artAlias']!=null){
    $Art_rd->result['artAlias']=htmlspecialchars($_POST['artAlias']);
    if(!accessorialClass::checkDouble("art_dt", "artAlias", $Art_rd->result['artAlias'])){
        $artErr['artAlias']='недопустимый alias - double ';
    }

}else{
    $artErr['artAlias']='недопустимый alias - null';
}

if(isset($_POST['artMeta']) and $_POST['artMeta']!=null){
    $Art_rd->result['artMeta']=htmlspecialchars($_POST['artMeta']);
}else{
    $Art_rd->result['artMeta']=null;
    $artErr['artMeta']='недопустимое описание';
}

if(isset($_POST['artCat_id'])){

    if($_POST['glCat_id'] == 'none'){
        $Art_rd->result['artCat_id']=null;
    }else{
        $Art_rd->result['artCat_id']=$_POST['artCat_id'];
    }
}else{
    //$catErr['cat_id']='select';
}
if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
    $Art_rd->result['activeFlag']=true;
}else{
    $Art_rd->result['activeFlag']=false;
}

$Art_rd->result['pubDate'] = date_format($appRJ->date['curDate'], 'Y-m-d');

if(isset($artErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/artMan/views/artMan-newArt.php");
}else{
    if($Art_rd->putOne()){
        $page = "Location: /artMan/editArt/?art_id=".$Art_rd->result['art_id'];
        header($page);
    }else{
        $appRJ->errors['XXX']['description']='debug info: method -> putOne; table -> art_dt';
    }
}