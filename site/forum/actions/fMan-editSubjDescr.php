<?php
$Subj_rd = new recordDefault("subjects_dt", "subject_id");

if(isset($_GET['subj_id']) and $_GET['subj_id']!=null){
    $Subj_rd->result['subject_id']=$_GET['subj_id'];
    if($Subj_rd->copyOne()){
        if(isset($_POST['subjDescr'])){
            $Descr_rd = new recordDefault('subjectsDescr_dt', 'subject_id');
            $Descr_rd->result['subject_id']=$Subj_rd->result['subject_id'];
            if($Descr_rd->copyOne()){
                $Descr_rd->result['subjectDescr'] = $_POST['subjDescr'];
                if($Descr_rd->updateOne()){
                    $subjErr['common']=true;
                }
            }else{
                $Descr_rd->result['subjectDescr'] = $_POST['subjDescr'];
                if($Descr_rd->putOne()){
                    $subjErr['common']=true;
                }
            }
        }else{
            $subjErr['subjDescr']='отсутствует параметр subjDescr';
        }
    }else{
        $appRJ->response['result'].= "неправильные параметры запроса subj_id";
        exit;
    }
}else{
    $appRJ->response['result'].= "zzz";
    exit;
}

require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-editSubjDescr.php");