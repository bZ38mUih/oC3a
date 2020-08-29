<?php
$catErr=null;
$catSelectOptions=null;
if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
    $Cat_rd = array("tabel" => "dwlCat_dt", "field_id" => "dwlCat_id");
    $Cat_rd['result']['dwlCat_id']=$_GET['cat_id'];
    if($Cat_rd->copyOne()){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/downloads/views/editCat.php");
    }else{
        $appRJ->response['result'].= "неправильные параметры запроса cat_id";
    }
}else{
    $appRJ->response['result'].= "zzz";
}
