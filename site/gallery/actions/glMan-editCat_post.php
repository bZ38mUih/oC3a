<?php

$Cat_rd = new recordDefault("galleryMenu_dt", "glCat_id");
if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
    $Cat_rd->result['glCat_id'] = $_GET['cat_id'];
    $Cat_rd->copyOne();
    if(isset($_POST['catName']) and $_POST['catName']!=null){
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
    //$Cat_rd->result['catDescr']=;
    if(isset($_POST['glCat_parId'])){

        if($_POST['glCat_parId'] == 'none'){
            $Cat_rd->result['glCat_parId']=null;
        }else{
            $Cat_rd->result['glCat_parId']=$_POST['glCat_parId'];
        }
    }else{
        //$catErr['cat_id']='select';
    }
    if(isset($_POST['catActive']) and $_POST['catActive']=='on'){
        $Cat_rd->result['catActive']=true;
    }else{
        $Cat_rd->result['catActive']=false;
    }
    if(isset($_POST['catIndex']) and $_POST['catIndex']=='on'){
        $Cat_rd->result['catIndex']=true;
    }else{
        $Cat_rd->result['catIndex']=false;
    }
    //exit;
}else{
    $catErr['glCat_id']='недопустимое cat_id';
}
if(isset($catErr)){
    $catErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editCat.php");
}else{
    if($Cat_rd->updateOne()){
        $catErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editCat.php");
    }else{

        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa-edit";
    }
}