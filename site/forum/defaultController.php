<?php

define(F_CAT_IMG, "/data/forum/categs/");
define(F_SUBJ_IMG, "/data/forum/subjects/");
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/actions/printFComments_func.php");

if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
    if($_POST){
        $refBlock['err']=null;
        if($_SESSION['user_id']){
            if(isset($_POST['fc_pid'])){
                if($_POST['fCm'] and $_POST['fCm']!=null){
                    if(isset($_POST['fs_id']) and $_POST['fs_id']!=null){
                        $newCm = new recordDefault('forumComments_dt', 'fc_id');
                        $newCm->result['user_id']=$_SESSION['user_id'];
                        $newCm->result['fs_id']=$_POST['fs_id'];
                        $newCm->result['commmentCont']=$_POST['fCm'];
                        $newCm->result['writeDate']=@date_format($appRJ->date['curDate'], 'Y-m-d H-m-s');
                        $newCm->result['activeFlag']=true;
                        if($_POST['fc_pid'] and $_POST['fc_pid']!=null){
                            $newCm->result['fc_pid']=$_POST['fc_pid'];
                        }else{
                            $newCm->result['fc_pid']=null;
                        }
                        if($newCm->putOne()){
                            $refBlock= printFComments(null, $_POST['fs_id'], $DB);
                        }else{
                            $refBlock['err']= "ошибка: метод putOne".$newCm->result['commmentCont'];
                        }
                    }else{
                        $refBlock['err']= "неправильный fs_id";
                    }
                }else{
                    $refBlock['err']= "вы ничего не написали";
                }
            }else{
                $refBlock['err']= "неправильный fc_id";
            }
            $appRJ->response['format']='json';
            $appRJ->response['result']= $refBlock;
        }else{
            $appRJ->errors['access']['description']="добавление отзыва запрещено неавторизированным пользователям";
        }
    }elseif(!$appRJ->server['reqUri_expl'][2]){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/views/defaultView.php");
    }elseif(isset($appRJ->server['reqUri_expl'][2]) and strtolower($appRJ->server['reqUri_expl'][2])=="forummanager"){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/fManController.php");
    }else{

        $subj_qry="select * from forumSubj_dt where sAlias='".$appRJ->server['reqUri_expl'][2]."'";
        $subj_res=$DB->doQuery($subj_qry);
        if(mysql_num_rows($subj_res)===1){
            $subj_row=$DB->doFetchRow($subj_res);
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/subjectView.php");
        }else{
            $appRJ->errors['404']['description']="темы '".$appRJ->server['reqUri_expl'][2]."' не существует";
        }
    }
}else{
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
}