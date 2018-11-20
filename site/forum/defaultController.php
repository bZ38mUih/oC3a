<?php

define(F_CAT_IMG, "/data/forum/categs/");
define(F_SUBJ_IMG, "/data/forum/subjects/");

if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
    if(!isset($appRJ->server['reqUri_expl'][2])){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/views/defaultView.php");
    }elseif(isset($appRJ->server['reqUri_expl'][2]) and strtolower($appRJ->server['reqUri_expl'][2])=="forummanager"){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/fManController.php");
    }else{
        $subj_qry="select * from forumSubj_dt where sAlias='".$appRJ->server['reqUri_expl'][2]."'";
        $subj_res=$DB->doQuery($subj_qry);
        if(mysql_num_rows($subj_res)===1){
            $subj_row=$DB->doFetchRow($subj_res);

        }else{
            $appRJ->errors['404']['description']="темы '".$appRJ->server['reqUri_expl'][2]."' не существует";
        }
    }
}else{
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
}