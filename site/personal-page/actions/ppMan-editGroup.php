<?php

$grErr=null;
$catSelect=null;
if(isset($_GET['group_id']) and $_GET['group_id']!=null){
    //require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
    $Gr_rd = array("table" => "usersGroups_dt", "field_id" => "group_id");
    $Gr_rd['result']['group_id']=$_GET['group_id'];
    if($Gr_rd = $DB->copyOne($Gr_rd)){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/personal-page/views/ppMan-editGroup.php");
    }else{
        $appRJ->response['result'].= "неправильные параметры запроса group_id";
        exit;
    }
}else{
    $appRJ->response['result'].= "zzz";
    exit;
}