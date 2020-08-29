<?php

$catErr=null;

$Cat_rd = array("table" => "artCat_dt", "field_id" => "artCat_id");

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

if(isset($_POST['catDescr'])  and $_POST['catDescr']!=null ){
    $Cat_rd['result']['catDescr']=htmlspecialchars($_POST['catDescr']);
}else{
    $catErr['catDescr']='описание не задано';
}


if(isset($_POST['artCatPar_id'])){

    if($_POST['artCatPar_id'] == 'none'){
        $Cat_rd['result']['artCatPar_id']=null;
    }else{
        $Cat_rd['result']['artCatPar_id']=$_POST['artCatPar_id'];
    }
}else{

}
if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
    $Cat_rd['result']['activeFlag']=true;
}else{
    $Cat_rd['result']['activeFlag']=false;
}

if(isset($catErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/artMan/views/artMan-newCat.php");
}else{
    if($Cat_rd->putOne()){
        $page = "Location: /artMan/editCat/?cat_id=".$Cat_rd['result']['artCat_id'];
        header($page);
    }else{
        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa";
    }
}