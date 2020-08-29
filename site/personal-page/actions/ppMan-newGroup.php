<?php

$grErr=null;

$Gr_rd = array("table" => "usersGroups_dt", "field_id" => "group_id");

if(isset($_POST['groupAlias']) and $_POST['groupAlias']!=null){
    $Gr_rd['result']['groupAlias']=htmlspecialchars($_POST['groupAlias']);
}else{
    $grErr['groupAlias']='недопустимый alias';
}


if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
    $Gr_rd['result']['activeFlag']=true;
}else{
    $Gr_rd['result']['activeFlag']=false;
}
print_r($grErr);
if(isset($grErr)){

    require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ppMan-newGroup.php");
}else{
    if($Gr_rd->putOne()){
        $page = "Location: /personal-page/ppManager/editGroup/?group_id=".$Gr_rd['result']['group_id'];
        header($page);
    }else{
        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa";
    }
}