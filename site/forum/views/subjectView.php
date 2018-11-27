<?php
$h1 =$subj_row['sName'];
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='".$subj_row['metaDescr']."'/>";
if(!$subj_row['robIndex']){
    $appRJ->response['result'].= "<meta name='robots' content='noindex'>";
}
$appRJ->response['result'].= "<title>".$subj_row['sName']."</title>".
    "<link rel='SHORTCUT ICON' href='/site/forum/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/forum/css/subjView.css' type='text/css' media='screen, projection'/>".
    //"<link rel='stylesheet' href='/site/references/css/references.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/forum/js/fSubj.js'></script>".
    "<script src='/site/signIn/js/extAuth.js'></script>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>";
if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
    $appRJ->response['result'].= "<script src='/site/forum/js/rewriteCom.js'></script>";
}

    //"<script src='/site/gallery/js/album-view.js'></script>".
$appRJ->response['result'].= "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='s-frame'>";
$appRJ->response['result'].="<div class='s-title'>";
$appRJ->response['result'].="<div class='s-title-cover'>";
if($subj_row['sImg']){
    $appRJ->response['result'].="<img src='".F_SUBJ_IMG.$subj_row['fs_id']."/preview/".$subj_row['sImg']."' alt='subj cover'>";
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="<div class='s-title-descr'><h2>".$subj_row['metaDescr']."</h2></div>";
$appRJ->response['result'].="<div class='dateLine'><span class='dateFld'>Тема создана: </span><span class='dateVal'>".
    $subj_row["dateOfCr"]."</span></div>";
$appRJ->response['result'].="</div>";
if($subj_row['longDescr']){
    $appRJ->response['result'].="<div class='longDescr'>".$subj_row['longDescr']."</div>";
}
$prtForum= printFComments(null,$subj_row['fs_id'], $DB, 0, $curPage, $fOptPN, $fComSort);
if($prtForum['cntTotal']>0){
    $prtForum['text']="<h3>Коментарии</h3>".$prtForum['text'];
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";

$appRJ->response['result'].= "<div class='contentBlock-frame dark'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='s-frame'>";
$appRJ->response['result'].="<div class='fOptMenu ta-left'>";

$appRJ->response['result'].="<div class='info'>".
    "<span class='cmCnt'>Комментов: <span>";
$tmpAnsw=null;
$tmpCom=0;

if($fComView=='tree'){
    $appRJ->response['result'].=$subjComms_row['subjComm'];
    $tmpAnsw="<span class='answCnt'>Ответов:".
        "<span>".$subjAnsw_row['subjAnsw']."</span></span>";
    $tmpCom=$subjComms_row['subjComm'];
}else{
    $appRJ->response['result'].=($subjComms_row['subjComm']+$subjAnsw_row['subjAnsw']);
    $tmpCom=$subjComms_row['subjComm']+$subjAnsw_row['subjAnsw'];
}
$appRJ->response['result'].="</span></span>".$tmpAnsw."</div>".
    "<div class='fpNum'>Стр.";
$pNum=1;
while (($tmpCom-($pNum-1)*$fOptPN)>0){
    if($pNum>1){
        $appRJ->response['result'].=", ";
    }
    $appRJ->response['result'].="<a href='/forum/".$subj_row['sAlias']."?page=".$pNum."' ";
    if($pNum==$curPage){
        $appRJ->response['result'].="class='active'";
    }
    $appRJ->response['result'].=">".$pNum."</a>";
    $pNum++;
}
$appRJ->response['result'].="</div>";


$appRJ->response['result'].="<div class='options'>".
    "<label>Показывать по: <select id='fOptPN'>".
    "<option value='10' ";
if($fOptPN==10){
    $appRJ->response['result'].="selected";
}
$appRJ->response['result'].=">10</option>".
    "<option value='20' ";
if($fOptPN==20){
    $appRJ->response['result'].="selected";
}
$appRJ->response['result'].=">20</option>".
    "<option value='50' ";
if($fOptPN==50){
    $appRJ->response['result'].="selected";
}
$appRJ->response['result'].=">50</option>"."</select></label>".
    "<label>Вид: <select id='fComView'>".
    "<option value='tree' ";
if($fComView=='tree'){
    $appRJ->response['result'].="selected";
}
$appRJ->response['result'].=">Дерево</option>".
    "<option value='list' ";
if($fComView=='list'){
    $appRJ->response['result'].="selected";
}
$appRJ->response['result'].=">Список</option>".
    "</select></label>".
    "<label>Сортировка: <select id='fComSort'>".
    "<option value='ASC' ";
if($fComSort=='ASC'){
    $appRJ->response['result'].="selected";
}
$appRJ->response['result'].=">По возр. даты</option>".
    "<option value='DESC' ";
if($fComSort=='DESC'){
    $appRJ->response['result'].="selected";
}
$appRJ->response['result'].=">По убыв. даты</option>".
    "</select></label></div>".
    "</div>";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";
//$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='s-frame'>";

$appRJ->response['result'].="<div class='comments-block ta-left'>".$prtForum['text']."</div>";
$appRJ->response['result'].= "</div></div></div></div>";

/*
$appRJ->response['result'].= "</div></div></div></div>".
    "<div class='modal signIn'><div class='overlay'></div><div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div></div>".
    "<div class='modal-left'></div></div></div></div>";
*/
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";