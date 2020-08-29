<?php
$catErr=null;
$catSelectOptions=null;
if(isset($_GET['fm_id']) and $_GET['fm_id']!=null){
    $Cat_rd = array("table" => "forumMenu_dt", "field_id" => "fm_id");
    $Cat_rd['result']['fm_id']=$_GET['fm_id'];
    if($Cat_rd->copyOne()){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/forum/views/fMan-edtCat.php");
    }else{
        $appRJ->errors['request']['description']="неправильные параметры запроса fm_id";
    }
}else{
    $appRJ->errors['request']['description']="неправильные параметры запроса null fm_id";
}