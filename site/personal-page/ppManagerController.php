<?php
if($_POST){
    if(isset($_POST['flagField']) and $_POST['flagField']=='newGroup'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/personal-page/actions/ppMan-newGroup.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editGroup') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/personal-page/actions/ppMan-editGroup_post.php");
    }elseif(isset($_POST['group_id']) and $_POST['group_id']!==null) {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/personal-page/actions/ppMan-editGroupImg.php");
    }elseif (isset($_POST['editUsrGr_flag']) and $_POST['editUsrGr_flag']=='Yes'){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/actions/ppMan-prepareUsrGr.php");
        if($editUsrGrLog['result']!==false){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/personal-page/actions/ppMan-editUsrGroups.php");
        }
    }
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="groups"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ppMan-groups.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newgroup"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ppMan-newGroup.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editgroup"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/personal-page/actions/ppMan-editGroup.php");
}elseif (isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="notifications"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/personal-page/views/ppMan-ntfDefView.php");
}elseif (isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="edituser"){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/actions/ppMan-prepareUsrGr.php");
    if($editUsrGrLog['result']!==false){
        if($appRJ->server['reqUri_expl'][4]==null){
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/personal-page/views/ppMan-manDefView.php");
        }
        elseif ($appRJ->server['reqUri_expl'][4]== 'groups'){
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/personal-page/views/ppMan-usersGroups.php");
        }
        elseif ($appRJ->server['reqUri_expl'][4]== 'accounts'){
            $appRJ->response['result'].= "accounts here";
        }
    }else{
        $appRJ->response['result'].= $editUsrGrLog['log'];
    }
} else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ppMan-users.php");
}
