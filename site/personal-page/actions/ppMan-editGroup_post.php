<?php
$Gr_rd = new recordDefault("usersGroups_dt", "group_id");
if(isset($_GET['group_id']) and $_GET['group_id']!=null){

    $Gr_rd->result['group_id'] = $_GET['group_id'];
    $Gr_rd->copyOne();

    if(isset($_POST['groupAlias']) and $_POST['groupAlias']!=null){
        $Gr_rd->result['groupAlias']=htmlspecialchars($_POST['groupAlias']);
    }else{
        $grErr['groupAlias']='недопустимый alias';
    }
    if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
        $Gr_rd->result['activeFlag']=true;
    }else{
        $Gr_rd->result['activeFlag']=false;
    }
}else{
    $grErr['group_id']='недопустимое group_id';
}
if(isset($grErr)){
    $grErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ppMan-editGroup.php");
}else{
    if($Gr_rd->updateOne()){
        $grErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ppMan-editGroup.php");
    }else{

        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa-edit";
    }
}