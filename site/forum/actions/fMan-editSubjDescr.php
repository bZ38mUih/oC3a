<?php
$Subj_rd = new recordDefault("forumSubj_dt", "fs_id");
$sdRes=false;
if(isset($_POST['fs_id']) and $_POST['fs_id']!=null){
    $Subj_rd->result['fs_id']=$_POST['fs_id'];
    if($Subj_rd->copyOne()){
        if(isset($_POST['longDescr'])){
            $Subj_rd->result['longDescr']=$_POST['longDescr'];
            if($Subj_rd->updateOne()){
                $sdRes=true;
            }else{
                $sdRes="ошибка Subj_rd updateOne";
            }
        }else{
            $sdRes='отсутствует параметр longDescr';
        }
    }else{
        $sdRes= "неправильные параметры запроса fs_id";
        //exit;
    }
}else{
    $sdRes="недопустимы параметр fs_id";
}
$appRJ->response['result']=$sdRes;