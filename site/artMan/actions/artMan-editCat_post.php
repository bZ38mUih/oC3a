<?php
$Cat_rd = array("table" => "artCat_dt", "field_id" => "artCat_id");
if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
    $Cat_rd['result']['artCat_id'] = $_GET['cat_id'];
    $Cat_rd->copyOne();
    if(isset($_POST['catName']) and $_POST['catName']!=null){
        $Cat_rd['result']['catName']=htmlspecialchars($_POST['catName']);
    }else{
        $catErr['catName']='недопустимое название категории';
    }
    if(isset($_POST['catAlias']) and $_POST['catAlias']!=null){
        $Cat_rd['result']['catAlias']=htmlspecialchars($_POST['catAlias']);
    }else{
        $catErr['catAlias']='недопустимый alias';
    }
    if(isset($_POST['catDescr']) and $_POST['catDescr']!=null){
        $Cat_rd['result']['catDescr']=$_POST['catDescr'];
    }else{
        $Cat_rd['result']['catDescr']=null;
        $catErr['catDescr']='недопустимое описание';
    }

    if(isset($_POST['artCatPar_id'])){

        if($_POST['artCatPar_id'] == 'none'){
            $Cat_rd['result']['artCatPar_id']=null;
        }else{
            $Cat_rd['result']['artCatPar_id']=$_POST['artCatPar_id'];
        }
    }

    if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
        $Cat_rd['result']['activeFlag']=true;
    }else{
        $Cat_rd['result']['activeFlag']=false;
    }
}else{
    $catErr['cat_id']='недопустимое cat_id';
}
if(isset($catErr)){
    $catErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artMan-editCat.php");
}else{
    if($Cat_rd->updateOne()){
        $catErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artMan-editCat.php");
    }else{
        $appRJ->errors['XXX']['description']='debug info: method -> updateOne; table -> artCat_dt';
    }
}