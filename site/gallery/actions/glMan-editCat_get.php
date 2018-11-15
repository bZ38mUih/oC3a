<?php
$catErr=null;
$catSelectOptions=null;
if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
    $Cat_rd = new recordDefault("galleryMenu_dt", "glCat_id");
    $Cat_rd->result['glCat_id']=$_GET['cat_id'];
    if($Cat_rd->copyOne()){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-editCat.php");
    }else{
        $appRJ->errors['request']['description']="неправильные параметры запроса cat_id";
    }
}else{
    $appRJ->errors['request']['description']="неправильные параметры запроса null cat_id";
}