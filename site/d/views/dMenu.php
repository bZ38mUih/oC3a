<?php
$appRJ->response['result'].= "<div class='modal menu'><div class='overlay'></div><div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div>".
    "</div><div class='modal-left'>";
/*Admin-->*/
if(isset($_SESSION['groups']['root']) and $_SESSION['groups']['root']>10) {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/admin/img/admin_logo.jpg' alt='Admin-logo'></div><div class='modal-line-text'>".
        "<a href='/admin/' title='Admin'>Admin</a></div></div>";
}
/*<--Admin*/
/*Diary-->*/
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/d/img/logo.png' alt='Diary-logo'></div><div class='modal-line-text'>".
        "<a href='/d/' title='Diary'>Diary</a></div></div>";

    foreach ($dType as $key=>$val){
        $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
            "<img src='/site/d/img/".$val."-menu.png' alt='d-logo'></div>";
        $dwlSign = "+";
        $dwlStyle = "style='display: none'";
        $appRJ->response['result'].= "<div class='modal-line-text'>";
        if ($diary_rd->result['diaryType'] == $val or strtolower($appRJ->server['reqUri_expl'][2])==$val) {
            $dwlSign = "-";
            $dwlStyle = null;
        }
        $appRJ->response['result'].= "<a href='/d/".$val."' title='".$val."'>".$val."</a> <span class='opnSubMenu'>" . $dwlSign .
            "</span> ". "<ul " . $dwlStyle . ">";

        $appRJ->response['result'].= "<li><a href='/d/newDiary?diaryType=".$val;
        $appRJ->response['result'].="' class='sub-lnk light ";
        if ($appRJ->server['reqUri_expl'][2] == "newDiary" and
            ($diary_rd->result['diaryType'] == $val or strtolower($appRJ->server['reqUri_expl'][2])==$val)) {
            $appRJ->response['result'].= "active";
        }
        $appRJ->response['result'].= "' title='look up'>newDiary</a></li>";

        $appRJ->response['result'].= "<li><a href='/d/".$val."/lastNote";
        $appRJ->response['result'].="' class='sub-lnk light ";
        if ($appRJ->server['reqUri_expl'][3] == "lastNote" and
            ($diary_rd->result['diaryType'] == $val or strtolower($appRJ->server['reqUri_expl'][2])==$val)) {
            $appRJ->response['result'].= "active";
        }
        $appRJ->response['result'].= "' title='look up'>lastNote</a></li>";

        $appRJ->response['result'].= "</div></ul></div>";
    }

    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/source/img/sync-icon.png' alt='Diary-sync'></div><div class='modal-line-text'>".
        "<a href='/d/sync' title='Diary-sync'>Sync diary</a></div></div>";
}
/*<--Diary*/
/*landing-->*/
if ($appRJ->server['reqUri_expl'][1] != null) {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/landing/img/favicon-64.png' alt='RJ-logo'>".
        "</div><div class='modal-line-text'><a href='/' title='Главная'>Главная</a></div></div>";
}
/*<--landing*/
/*signIn-->*/
if($appRJ->server['reqUri_expl'][1]!='signIn'){
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/signIn/img/logo.png' alt='Регистрация-logo'></div>".
        "<div class='modal-line-text'><a href='/signIn' title='Авторизация'>Вход на сайт</a></div></div>";
}
/*<--singIn*/
$appRJ->response['result'].= "</div></div></div></div>";
?>