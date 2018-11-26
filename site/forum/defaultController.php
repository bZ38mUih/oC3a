<?php

define(F_CAT_IMG, "/data/forum/categs/");
define(F_SUBJ_IMG, "/data/forum/subjects/");

$curPage=1;
$fOptPN=10;
$fComView='tree';
$fComSort="ASC";
if($_GET['page'] and $_GET['page']!=null){
    $curPage=$_GET['page'];
}
if($_COOKIE['fOptPN'] and $_COOKIE['fOptPN']!=null){
    $fOptPN=$_COOKIE['fOptPN'];
}
if($_COOKIE['fComView'] and $_COOKIE['fComView']=='tree'){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/actions/printFComTree_func.php");

}else{
    $fComView="list";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/actions/printFComList.php");
}
if($_COOKIE['fComSort'] and $_COOKIE['fComSort']!=null){
    $fComSort=$_COOKIE['fComSort'];
}



if(!$_SESSION['user_id']){
    $appRJ->errors['stab']['description']="Форум временно на реконструкции";
    $appRJ->throwErr();
}
if(isset($appRJ->server['reqUri_expl'][2]) and strtolower($appRJ->server['reqUri_expl'][2])=="forummanager"){
    if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/fManController.php");
    }else{
        $appRJ->errors['access']['description']='Доступ к управлению форумом запрещен';
    }
}elseif($_POST){
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
                        $refBlock= printFComments(null, $_POST['fs_id'], $DB, 0, $curPage, $fOptPN, $fComSort);
                        if($refBlock['cntTotal']>0){
                            $refBlock['text']="<h3>Коментарии</h3>".$refBlock['text'];
                        }
                        $subjComms_query="select count(fc_id) as subjComm from forumComments_dt ".
                            "where fs_id=".$newCm->result['fs_id']." and fc_pid is null";
                        $subjAnsw_query="select count(fc_id) as subjAnsw from forumComments_dt ".
                            "where fs_id='".$newCm->result['fs_id']."' and fc_pid is not null";
                        $subjComms_res=$DB->doQuery($subjComms_query);
                        $subjAnsw_res=$DB->doQuery($subjAnsw_query);
                        $subjComms_row=$DB->doFetchRow($subjComms_res);
                        $subjAnsw_row=$DB->doFetchRow($subjAnsw_res);
                        $refBlock['subjComm']=$subjComms_row['subjComm'];
                        $refBlock['subjAnsw']=$subjAnsw_row['subjAnsw'];
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
}else{
    $subj_qry="select * from forumSubj_dt where sAlias='".$appRJ->server['reqUri_expl'][2]."'";
    $subj_res=$DB->doQuery($subj_qry);
    if(mysql_num_rows($subj_res)===1){
        $subj_row=$DB->doFetchRow($subj_res);
        $subjComms_query="select count(fc_id) as subjComm from forumComments_dt ".
            "where fs_id=".$subj_row['fs_id']." and fc_pid is null";
        $subjAnsw_query="select count(fc_id) as subjAnsw from forumComments_dt ".
            "where fs_id='".$subj_row['fs_id']."' and fc_pid is not null";
        $subjComms_res=$DB->doQuery($subjComms_query);
        $subjAnsw_res=$DB->doQuery($subjAnsw_query);
        $subjComms_row=$DB->doFetchRow($subjComms_res);
        $subjAnsw_row=$DB->doFetchRow($subjAnsw_res);
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/subjectView.php");
    }else{
        $appRJ->errors['404']['description']="темы '".$appRJ->server['reqUri_expl'][2]."' не существует";
    }
}
