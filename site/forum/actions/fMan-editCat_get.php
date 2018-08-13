<?php
$catErr=null;
$catSelectOptions=null;
if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
    //require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
    $Cat_rd = new recordDefault("subjectsMenu_dt", "subjCat_id");
    $Cat_rd->result['subjCat_id']=$_GET['cat_id'];
    if($Cat_rd->copyOne()){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/forum/views/fMan-edtCat.php");
    }else{
        $appRJ->response['result'].= "неправильные параметры запроса cat_id";
        exit;
    }
}else{
    $appRJ->response['result'].= "zzz";
    exit;
}