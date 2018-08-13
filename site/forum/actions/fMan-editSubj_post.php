<?php

$Subj_rd = new recordDefault("subjects_dt", "subject_id");
if(isset($_GET['subj_id']) and $_GET['subj_id']!=null){
    $Subj_rd->result['subject_id'] = $_GET['subj_id'];
    $Subj_rd->copyOne();
    if(isset($_POST['subjName']) and $_POST['subjName']!=null){
        $Subj_rd->result['subjName']=htmlspecialchars($_POST['subjName']);
    }else{
        $subjErr['subjName']='недопустимое название темы';
    }
    if(isset($_POST['subjAlias']) and $_POST['subjAlias']!=null){
        $Subj_rd->result['subjAlias']=htmlspecialchars($_POST['subjAlias']);
    }else{
        $subjErr['subjAlias']='недопустимый alias';
    }
    $Subj_rd->result['metaDescr']=$_POST['metaDescr'];
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

    if(isset($_POST['dateOfCr']) and $_POST['dateOfCr']!=null){
        $Subj_rd->result['dateOfCr']=$_POST['dateOfCr'];
    }else{
        $subjErr['dateOfCr']='неправильная дата';
    }
    //exit;
}else{
    $subjErr['subj_id']='недопустимое subj_id';
}
if(isset($subjErr)){
    $subjErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-editSubj.php");
}else{
    if($Subj_rd->updateOne()){
        $subjErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-editSubj.php");
    }else{

        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa-edit";
    }
}