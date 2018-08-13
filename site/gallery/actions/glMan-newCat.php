<?php

$catErr=null;

$Cat_rd = new recordDefault("galleryMenu_dt", "glCat_id");

if(isset($_POST['catName']) and $_POST['catName']!=null){
    //$catName_err =
    $Cat_rd->result['catName']=htmlspecialchars($_POST['catName']);
}else{
    $catErr['catName']='недопустимое название категории';
}

if(isset($_POST['catAlias']) and $_POST['catAlias']!=null){
    $Cat_rd->result['catAlias']=htmlspecialchars($_POST['catAlias']);
}else{
    $catErr['catAlias']='недопустимый alias';
}
if(isset($_POST['catDescr']) and $_POST['catDescr']!=null){
    $Cat_rd->result['catDescr']=htmlspecialchars($_POST['catDescr']);
}else{
    $catErr['catDescr']='недопустимое описание';
}

if(isset($_POST['glCat_parId'])){

    if($_POST['glCat_parId'] == 'none'){
        $Cat_rd->result['glCat_parId']=null;
    }else{
        $Cat_rd->result['glCat_parId']=$_POST['glCat_parId'];
    }
}else{

}
if(isset($_POST['catActive']) and $_POST['catActive']=='on'){
    $Cat_rd->result['catActive']=true;
}else{
    $Cat_rd->result['catActive']=false;
}

if(isset($catErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/gallery/views/glMan-newCat.php");
}else{
    if($Cat_rd->putOne()){
        $page = "Location: /gallery/glManager/editCat/?cat_id=".$Cat_rd->result['glCat_id'];
        header($page);
    }else{
        print_r($Cat_rd);
        print_r($DB->err);
        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa";
    }
}