<?php
$artByAlias_qry="select art_dt.art_id, art_dt.artName, art_dt.artMeta, art_dt.artImg, art_dt.allowCm, artCat_dt.catAlias, ".
    "artCat_dt.catName, art_dt.pubDate, art_dt.refreshDate from art_dt ".
    "INNER JOIN artCat_dt ON art_dt.artCat_id = artCat_dt.artCat_id ".
    "WHERE art_dt.artAlias='".$appRJ->server['reqUri_expl'][2]."'".$andWhere;
$artByAlias_res=$DB->query($artByAlias_qry);
if($artByAlias_res->rowCount() !== 1){
    $appRJ->errors['404']['description']="такой статьи не существует";
    $appRJ->throwErr();
}
$artByAlias_row=$artByAlias_res->fetch(PDO::FETCH_ASSOC);
$h1 =$artByAlias_row['artName'];
$fndP=false;
$slArtP_qry="select * from artLinks_dt WHERE art_id=".$artByAlias_row['art_id']." and linkType='page'";
$slArtP_res=$DB->query($slArtP_qry);
if($slArtP_res->rowCount() == 1){
    $slArtP_row = $slArtP_res->fetch(PDO::FETCH_ASSOC);
    $fndP=true;
}
$slArtSt_qry="select * from artLinks_dt WHERE art_id=".$artByAlias_row['art_id']." and linkType='style'";
$slArtSt_res=$DB->query($slArtSt_qry);
if($slArtSt_res->rowCount() == 1){
    $slArtSt_row = $slArtSt_res->fetch(PDO::FETCH_ASSOC);
    $fndSt=true;
}
$slArtScr_qry="select * from artLinks_dt WHERE art_id=".$artByAlias_row['art_id']." and linkType='script'";
$slArtScr_res=$DB->query($slArtScr_qry);
if($slArtScr_res->rowCount() == 1){
    $slArtScr_row = $slArtScr_res->fetch(PDO::FETCH_ASSOC);
    $fndScr=true;
}
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='".$artByAlias_row['artMeta']."'/>".
    "<title>".$h1."</title>".
    //"<title>".$artByAlias_row['catName']."</title>".
    "<link rel='SHORTCUT ICON' href='/site/".$appRJ->server['reqUri_expl'][1]."/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
if($artByAlias_row['allowCm']){
    $appRJ->response['result'].="<link rel='stylesheet' href='/site/forum/css/comments-block.css' type='text/css' media='screen, projection'/>".

        "<script src='/source/js/jquery.cookie.js'></script>".
        "<script src='/site/artMan/js/artComments.js'></script>".
        "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
        "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
        "<script src='/site/signIn/js/extAuth.js'></script>".
        "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>";
}
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/signIn/css/authRefAnimate.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].="<link rel='stylesheet' href='/site/artMan/css/preview.css' type='text/css' media='screen, projection'/>";

if($fndSt){
    $appRJ->response['result'].= "<link rel='stylesheet' href='".ARTS_IMG_PAPH.$artByAlias_row['art_id']."/style/".$slArtSt_row['linkRef']."' type='text/css' media='screen, projection'/>";
}
if($fndScr){
    $appRJ->response['result'].= "<script src='".ARTS_IMG_PAPH.$artByAlias_row['art_id']."/script/".$slArtScr_row['linkRef']."'></script>";
}
$appRJ->response['result'].= "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "</head><body>";


require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='art-header'><div class='art-header-descr'><h2>".$artByAlias_row['artMeta']."</h2></div><div class='art-header-img'>".
    "<img src='".ARTS_IMG_PAPH.$artByAlias_row['art_id']."/preview/".$artByAlias_row['artImg']."' id='shareImg'>".
    "</div>";
if($artByAlias_row['pubDate']){
    $appRJ->response['result'].= "<div class='dateLine'><span class='dateFld'>Опубликовано:</span>".
        "<span class='dateVal'>".$artByAlias_row['pubDate']."</span></div>";
}
if($artByAlias_row['refreshDate']){
    $appRJ->response['result'].= "<div class='dateLine'><span class='dateFld'>Обновлено:</span>".
        "<span class='dateVal'>".$artByAlias_row['refreshDate']."</span></div>";
}
$appRJ->response['result'].= "</div><div class='art-content'>";
if($fndP){
    $appRJ->response['result'].=file_get_contents($_SERVER['DOCUMENT_ROOT'].ARTS_IMG_PAPH.$artByAlias_row['art_id'].
        "/page/".$slArtP_row['linkRef']);
}else{
    $appRJ->response['result'].='нет ченовика статьи';
}
$appRJ->response['result'].= "</div>";
if($artByAlias_row['allowCm']){
    $appRJ->response['result'].= "<div class='comments-block ta-left'>";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/actions/printArtComments.php");
    $prtForum= printArtComments(null,$artByAlias_row['art_id'], $DB, 0);
    if($prtForum['cntTotal']>0){
        $prtForum['text']="<h3><span class='cmCnt'>Комментарии: <span>".$prtForum['cntCom']."</span></span>".
            "<span class='answCnt'>Ответы: <span>".($prtForum['cntTotal']-$prtForum['cntCom'])."</span></span></h3>".$prtForum['text'];
    }
    $appRJ->response['result'].=$prtForum['text']."</div>";
}

$refList_text="select * from artRef_dt WHERE art_id='".$artByAlias_row['art_id']."' order by artRef_id DESC";
$refList_res=$DB->query($refList_text);
$refList_count = $refList_res->fetch(PDO::FETCH_ASSOC);
if($refList_count>0){
    $appRJ->response['result'].= "<div class='art-ref'><h5>Ссылки:</h5><ol>";
    while($refList_row=$DB->doFetchRow($refList_res)){
        $appRJ->response['result'].= "<li><a href='".$refList_row['refLink']."' title='".$refList_row['refLink']."' target='_blank'>".
            $refList_row['refText']."</a></li>";
    }
    $appRJ->response['result'].= "</ol></div>";
}
$appRJ->response['result'].= "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";