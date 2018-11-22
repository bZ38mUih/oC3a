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
        "<img src='/site/diary/img/logo.png' alt='Diary-logo'></div><div class='modal-line-text'>".
        "<a href='/diary/' title='Diary'>Diary</a></div></div>";
}
/*<--Diary*/
/*personal-page-->*/
if($_SESSION['user_id']){
    $ntf_cnt=0;
    $ntf_qry="select count(ntfList_id) as ntfQty from ntfList_dt WHERE user_id=".$_SESSION['user_id']." and readDate is NULL";
    $ntf_res=$DB->doQuery($ntf_qry);
    if(mysql_num_rows($ntf_res)==1){
        $ntf_row=$DB->doFetchRow($ntf_res);
        $ntf_cnt=$ntf_row['ntfQty'];
    }
    $appRJ->response['result'].= "<div class='modal-line'>".
        "<div class='modal-line-img'>";
    if($_SESSION['photoLink']){
        $appRJ->response['result'].= "<img src='".$_SESSION['photoLink']."' alt='Avatar'>";
    }else{
        $appRJ->response['result'].= "<img src='/data/avatar-default.jpg' alt='Avatar-Default'>";
    }
    $appRJ->response['result'].= "</div><div class='modal-line-text'>".
        "<a href='/personal-page' title='Личный кабинет'>Личный кабинет</a><a href='?cmd=exit' class='exit'>Exit</a>";
    if($ntf_cnt>0){
        $appRJ->response['result'].= "<a href='/personal-page' class='ntf'>".
            "<img src='/site/siteHeader/img/ntf-icon.png' alt='Оповещения'><span>".$ntf_cnt."</span></a>";
    }
    $appRJ->response['result'].= "</div>".
        "</div>";
}else{
    $appRJ->response['result'].= "<div class='modal-line '><div class='modal-line-img'>".
        "<img src='/data/avatar-default.jpg' alt='Avatar-Default'></div><div class='modal-line-text guest'>".
        "<a href='#' style='cursor: default'>Вы: Гость.".
        " <span class='guest'>Вам могут быть недоступны некоторые ресурсы этого сайта</span> </a>".
        "</div></div>";
}
/*<--personal-page*/
/*ppManager-->*/
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/personal-page/img/logo.jpg' alt='ppMan-logo'></div>".
        "<div class='modal-line-text'>".
        "<a href='/personal-page/ppManager/' class='sub-lnk blue' title='ppManager'>ЛК-Менеджер</a>".
        "</div></div>";
}
/*<--ppManager*/
/*landing-->*/
if ($appRJ->server['reqUri_expl'][1] != null) {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/landing/img/favicon-64.png' alt='RJ-logo'>".
        "</div><div class='modal-line-text'><a href='/' title='Главная'>Главная</a></div></div>";
}
/*<--landing*/
/*artMan-->*/
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/artMan/img/logo.png' alt='artMan-logo'></div><div class='modal-line-text'>".
        "<a href='/artMan/' class='sub-lnk blue' title='artMan'>artMan</a></div></div>";
}
/*<--artMan*/
/*dev-->*/
$appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
    "<img src='/site/dev/img/logo.png' alt='dev-logo'></div>";
$dwlSign = "+";
$dwlStyle = "style='display: none'";
$appRJ->response['result'].= "<div class='modal-line-text'>";
if (strtolower($appRJ->server['reqUri_expl'][1]) == "dev") {
    $dwlSign = "-";
    $dwlStyle = null;
}
$appRJ->response['result'].= "<a href='/dev/' title='Блог о разработке'>Разработка</a> <span class='opnSubMenu'>" . $dwlSign .
    "</span> ". "<ul " . $dwlStyle . ">";
$devArts_qry = "select * from art_dt where artCat_id=3 and activeFlag is true ORDER BY pubDate DESC limit 4";
$devArts_res = $DB->doQuery($devArts_qry);
while ($devArts_row = $DB->doFetchRow($devArts_res)) {
    $appRJ->response['result'].= "<li><a href='/dev/" . $devArts_row['artAlias'] . "' class='sub-lnk light ";
    if ($appRJ->server['reqUri_expl'][2] == $devArts_row['artAlias']) {
        $appRJ->response['result'].= "active";
    }
    $appRJ->response['result'].= "' title='Читать статью'>" . $devArts_row['artName'] . "</a></li>";
}
$appRJ->response['result'].= "</ul></div></div>";
/*<--dev*/
/*pc-->*/
$appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
    "<img src='/site/pc/img/logo.png' alt='pc-logo'></div>";
$dwlSign = "+";
$dwlStyle = "style='display: none'";
$appRJ->response['result'].= "<div class='modal-line-text'>";
if (strtolower($appRJ->server['reqUri_expl'][1]) == "pc") {
    $dwlSign = "-";
    $dwlStyle = null;
}
$appRJ->response['result'].= "<a href='/pc/' title='Компьютеры и технологии'>Компьютеры и технологии</a> ".
    "<span class='opnSubMenu'>" . $dwlSign . "</span> "."<ul " . $dwlStyle . ">";
$devArts_qry = "select * from art_dt where artCat_id=1 and activeFlag is true ORDER BY pubDate DESC limit 4";
$devArts_res = $DB->doQuery($devArts_qry);
while ($devArts_row = $DB->doFetchRow($devArts_res)) {
    $appRJ->response['result'].= "<li><a href='/pc/" . $devArts_row['artAlias'] . "' class='sub-lnk light ";
    if ($appRJ->server['reqUri_expl'][2] == $devArts_row['artAlias']) {
        $appRJ->response['result'].= "active";
    }
    $appRJ->response['result'].= "' title='Читать статью'>" . $devArts_row['artName'] . "</a></li>";
}
$appRJ->response['result'].= "</ul></div></div>";
/*<--pc*/
/*handbook-->*/
$appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
    "<img src='/site/handbook/img/logo.png' alt='handbook-logo'></div>";
$dwlSign = "+";
$dwlStyle = "style='display: none'";
$appRJ->response['result'].= "<div class='modal-line-text'>";
if (strtolower($appRJ->server['reqUri_expl'][1]) == "handbook") {
    $dwlSign = "-";
    $dwlStyle = null;
}
$appRJ->response['result'].= "<a href='/handbook/' title='Систематизированная информация о компьютерных и технология'>Справочник</a> <span class='opnSubMenu'>" .
    $dwlSign . "</span> "."<ul " . $dwlStyle . ">";
$devArts_qry = "select * from art_dt where artCat_id=2 and activeFlag is true ORDER BY pubDate DESC limit 4";
$devArts_res = $DB->doQuery($devArts_qry);
while ($devArts_row = $DB->doFetchRow($devArts_res)) {
    $appRJ->response['result'].= "<li><a href='/handbook/" . $devArts_row['artAlias'] . "' class='sub-lnk light ";
    if ($appRJ->server['reqUri_expl'][2] == $devArts_row['artAlias']) {
        $appRJ->response['result'].= "active";
    }
    $appRJ->response['result'].= "' title='Смотреть в справочнике'>" . $devArts_row['artName'] . "</a></li>";
}
$appRJ->response['result'].= "</ul></div></div>";
/*<--handbook*/
/*downloads-->*/
$appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
    "<img src='/site/downloads/img/logo.png' alt='Загруки-logo'></div>";
$dwlSign = "+";
$dwlStyle = "style='display: none'";
$appRJ->response['result'].= "<div class='modal-line-text'>";
if (strtolower($appRJ->server['reqUri_expl'][1]) == "downloads") {
    $dwlSign = "-";
    $dwlStyle = null;
}
$appRJ->response['result'].= "<a href='/downloads/' title='Ссылки на загрузки программ'>Загрузки</a> ".
    "<span class='opnSubMenu'>" . $dwlSign . "</span> "."<ul " . $dwlStyle . ">";
$selectCat_query = "select * from dwlCat_dt WHERE dwlCatPar_id is null and catActive_flag is TRUE";
$selectCat_res = $DB->doQuery($selectCat_query);
while ($selectCat_row = $DB->doFetchRow($selectCat_res)) {
    $appRJ->response['result'].= "<li><a href='/downloads/" . $selectCat_row['catAlias'] . "' class='sub-lnk light ";
    if ($appRJ->server['reqUri_expl'][2] == $selectCat_row['catAlias']) {
        $appRJ->response['result'].= "active";
    }
    $appRJ->response['result'].= "' title='".$selectCat_row['catName']."'>" . $selectCat_row['catName'] . "</a></li>";
}
$appRJ->response['result'].= "<li><a href='" . "/downloads/list/" . "' class='sub-lnk gold ";
if ($appRJ->server['reqUri_expl'][2] == 'list') {
    $appRJ->response['result'].= "active";
}
$appRJ->response['result'].= "'>" . "Список загрузок" . "</a></li>";
if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "<li><a href='" . "/downloads/dwlManager/" . "' class='sub-lnk blue ";
    if (strtolower($appRJ->server['reqUri_expl'][2]) == 'dwlmanager') {
        $appRJ->response['result'].= "active";
    }
    $appRJ->response['result'].= "' title='Управление загрузками'>" . "Управление загрузками" . "</a></li>";
}
$appRJ->response['result'].= "</ul></div></div>";
/*<--downloads*/
/*gallery-->*/
$appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
    "<img src='/site/gallery/img/logo.png' alt='Галерея-logo'></div>";
$dwlSign = "+";
$dwlStyle = "style='display: none'";
$appRJ->response['result'].= "<div class='modal-line-text'>";
if (strtolower($appRJ->server['reqUri_expl'][1]) == "gallery") {
    $dwlSign = "-";
    $dwlStyle = null;
}
$appRJ->response['result'].= "<a href='/gallery/' title='Портфолио-Галерея фотографий на разные темы'>Галерея</a>".
    " <span class='opnSubMenu'>" .
    $dwlSign . "</span> "."<ul " . $dwlStyle . "><li><a href='" . "/gallery/albums/" . "' class='sub-lnk ";
if ($appRJ->server['reqUri_expl'][2] == 'albums') {
    $appRJ->response['result'].= "active";
}
$appRJ->response['result'].= "' title='Смотреть альбомы'>" . "Альбомы" . "</a></li><li><a href='/gallery/category/' class='sub-lnk ";
if ($appRJ->server['reqUri_expl'][2] == 'category') {
    $appRJ->response['result'].= "active";
}
$appRJ->response['result'].= "' title='Смотреть категории'>Категории</a></li>";
if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "<li><a href='" . "/gallery/glManager/" . "' class='sub-lnk blue ";
    if (strtolower($appRJ->server['reqUri_expl'][2]) == 'glmanager') {
        $appRJ->response['result'].= "active";
    }
    $appRJ->response['result'].= "' title='Управление галереей'>" . "Управление галереей" . "</a></li>";
}
$appRJ->response['result'].= "</ul></div></div>";
/*<--gallery*/
/*donate-->*/
if ($appRJ->server['reqUri_expl'][1] != 'donate') {
    $appRJ->response['result'] .= "<div class='modal-line'><div class='modal-line-img'>" .
        "<img src='/site/donate/img/logo.png' alt='Помошь-logo'></div>" .
        "<div class='modal-line-text'><a href='/donate' title='Пожертвования на развитие проекта'>Помощь проекту</a></div></div>";
}
/*<--donate*/
/*signIn-->*/
if($appRJ->server['reqUri_expl'][1]!='signIn'){
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/signIn/img/logo.png' alt='Регистрация-logo'></div>".
        "<div class='modal-line-text'><a href='/signIn' title='Авторизация'>Вход на сайт</a></div></div>";
}
/*<--singIn*/
$appRJ->response['result'].= "</div></div></div></div>";
?>