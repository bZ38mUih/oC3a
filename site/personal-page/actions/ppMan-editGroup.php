<?php

$grErr=null;
$catSelect=null;
if(isset($_GET['group_id']) and $_GET['group_id']!=null){
    //require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
    $Gr_rd = new recordDefault("usersGroups_dt", "group_id");
    $Gr_rd['result']['group_id']=$_GET['group_id'];
    if($Gr_rd->copyOne()){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/personal-page/views/ppMan-editGroup.php");
    }else{
        $appRJ->response['result'].= "неправильные параметры запроса group_id";
        exit;
    }
}else{
    $appRJ->response['result'].= "zzz";
    exit;
}