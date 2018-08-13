<?php

$subjErr=null;

$Subj_rd = new recordDefault("subjects_dt", "subject_id");

if(isset($_POST['subjName']) and $_POST['subjName']!=null){
    //$catName_err =
    $Subj_rd->result['subjName']=htmlspecialchars($_POST['subjName']);
}else{
    $subjErr['subjName']='недопустимое название темы';
}

if(isset($_POST['subjAlias']) and $_POST['subjAlias']!=null){
    $Subj_rd->result['subjAlias']=htmlspecialchars($_POST['subjAlias']);
}else{
    $subjErr['subjAlias']='недопустимый alias';
}
if(isset($_POST['metaDescr'])){
    $Subj_rd->result['metaDescr']=htmlspecialchars($_POST['metaDescr']);
}else{
    $Subj_rd->result['metaDescr']=null;
}


if(isset($_POST['subjCat_id'])){

    if($_POST['subjCat_id'] == 'none'){
        $Subj_rd->result['subjCat_id']=null;
    }else{
        $Subj_rd->result['subjCat_id']=$_POST['subjCat_id'];
    }
}else{
    //$catErr['cat_id']='select';
}
if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
    $Subj_rd->result['activeFlag']=true;
}else{
    $Subj_rd->result['activeFlag']=false;
}

$Subj_rd->result['dateOfCr'].= date_format($appRJ->date['curDate'], 'Y-m-d H:i:s').'</br>';
$Subj_rd->result['user_id'].= $_SESSION['user_id'];

//$appRJ->response['result'].= "111<br>";
if(isset($subjErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-newSubject.php");
}else{
    //$appRJ->response['result'].= "222<br>";
    if($Subj_rd->putOne()){
        //$appRJ->response['result'].= "333<br>";
        //header("Location: ".)
        $page = "Location: /forum/forumManager/editSubject/?subj_id=".$Subj_rd->result['subject_id'];
        header($page);
        //$appRJ->response['result'].= $page;
    }else{
        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa";
    }

    //$appRJ->response['result'].= 'all right';
    //exit;
}