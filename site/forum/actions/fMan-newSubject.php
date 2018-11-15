<?php

$subjErr=null;

$Subj_rd = new recordDefault("forumSubj_dt", "fs_id");

if(isset($_POST['sName']) and $_POST['sName']!=null){
    $Subj_rd->result['sName']=htmlspecialchars($_POST['sName']);
}else{
    $subjErr['sName']='недопустимое название темы';
}

if(isset($_POST['sAlias']) and $_POST['sAlias']!=null){
    $Subj_rd->result['sAlias']=htmlspecialchars($_POST['sAlias']);
}else{
    $subjErr['sAlias']='недопустимый alias';
}
if(isset($_POST['metaDescr']) and $_POST['metaDescr']!=null){
    $Subj_rd->result['metaDescr']=htmlspecialchars($_POST['metaDescr']);
}else{
    $subjErr['metaDescr']='недопустимый metaDescr';
}

if(isset($_POST['fm_id'])){

    if($_POST['fm_id'] == 'none'){
        $Subj_rd->result['fm_id']=null;
    }else{
        $Subj_rd->result['fm_id']=$_POST['fm_id'];
    }
}else{

}
if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
    $Subj_rd->result['activeFlag']=true;
}else{
    $Subj_rd->result['activeFlag']=false;
}
if(isset($_POST['robIndex']) and $_POST['robIndex']=='on'){
    $Subj_rd->result['robIndex']=true;
}else{
    $Subj_rd->result['robIndex']=false;
}

$Subj_rd->result['dateOfCr'].= date_format($appRJ->date['curDate'], 'Y-m-d');
$Subj_rd->result['user_id'].= $_SESSION['user_id'];

if(isset($subjErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-newSubject.php");
}else{
    if($Subj_rd->putOne()){
        $page = "Location: /gallery/glManager/editAlbum/?alb_id=".$Subj_rd->result['album_id'];
        header($page);
    }else{
        $appRJ->errors["XXX"]["description"]="insert into forumSubj err";
    }
}