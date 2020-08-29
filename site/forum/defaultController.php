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
if(isset($appRJ->server['reqUri_expl'][2]) and strtolower($appRJ->server['reqUri_expl'][2])=="forummanager"){
    if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/fManController.php");
    }else{
        $appRJ->errors['access']['description']='Доступ к управлению форумом запрещен';
    }
}elseif($_POST){
    $refBlock['err']=null;
    if($_SESSION['user_id']){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/actions/postNewComment.php");
    }else{
        $appRJ->errors['access']['description']="комментирование запрещено неавторизированным пользователям";
    }
}elseif ($_GET['likeVal']){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/actions/setCmLike.php");
    $appRJ->response['format']='ajax';
    $slCm_qry="select * from forumComments_dt WHERE fc_id=".$_GET['fc_id'];
    $slCm_res=$DB->query($slCm_qry);
    $slCm_row = $slCm_res->fetch(PDO::FETCH_ASSOC);
    $tmpCm=null;
    include ($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/cmLikes.php");
    $appRJ->response['result']=$tmpCm;
}
elseif(!$appRJ->server['reqUri_expl'][2]){
    require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/views/defaultView.php");
}else{
    $subj_qry="select * from forumSubj_dt where sAlias='".$appRJ->server['reqUri_expl'][2]."'";
    $subj_res=$DB->query($subj_qry);
    if(mysql_num_rows($subj_res)===1){
        $subj_row = $subj_res->fetch(PDO::FETCH_ASSOC);
        $subjComms_query="select count(fc_id) as subjComm from forumComments_dt ".
            "where fs_id=".$subj_row['fs_id']." and fc_pid is null";
        $subjAnsw_query="select count(fc_id) as subjAnsw from forumComments_dt ".
            "where fs_id='".$subj_row['fs_id']."' and fc_pid is not null";
        $subjComms_res=$DB->query($subjComms_query);
        $subjAnsw_res=$DB->query($subjAnsw_query);
        $subjComms_row = $subjComms_res->fetch(PDO::FETCH_ASSOC);
        $subjAnsw_row = $subjAnsw_res->fetch(PDO::FETCH_ASSOC);
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/subjectView.php");
    }else{
        $appRJ->errors['404']['description']="темы '".$appRJ->server['reqUri_expl'][2]."' не существует";
    }
}
