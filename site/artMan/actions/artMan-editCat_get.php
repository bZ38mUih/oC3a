<?php
$catErr=null;
$catSelectOptions=null;
if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
    $Cat_rd = new recordDefault("artCat_dt", "artCat_id");
    $Cat_rd['result']['artCat_id']=$_GET['cat_id'];
    if($Cat_rd->copyOne()){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/artMan/views/artMan-editCat.php");
    }else{
        $appRJ->errors['request']['description']= "неправильные параметры запроса cat_id";
    }
}else{
    $appRJ->errors['request']['description']= "отсутствует параметр cat_id";
}