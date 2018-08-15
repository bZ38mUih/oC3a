<?php
$artByAlias_qry="select art_dt.art_id, art_dt.artName, art_dt.artMeta, art_dt.artImg, artCat_dt.catAlias, ".
    "artCat_dt.catName, art_dt.pubDate, art_dt.refreshDate from art_dt ".
    "INNER JOIN artCat_dt ON art_dt.artCat_id = artCat_dt.artCat_id ".
    "WHERE art_dt.artAlias='".$appRJ->server['reqUri_expl'][2]."'";
$artByAlias_res=$DB->doQuery($artByAlias_qry);
if(mysql_num_rows($artByAlias_res)!==1){
    $appRJ->errors['404']['description']="такой статьи не существует";
    $appRJ->throwErr();
}
$artByAlias_row=$DB->doFetchRow($artByAlias_res);
$h1 =$artByAlias_row['artName'];
$fndP=false;
$slArtP_qry="select * from artLinks_dt WHERE art_id=".$artByAlias_row['art_id']." and linkType='page'";
$slArtP_res=$DB->doQuery($slArtP_qry);
if(mysql_num_rows($slArtP_res)==1){
    $slArtP_row=$DB->doFetchRow($slArtP_res);
    $fndP=true;
}
$slArtSt_qry="select * from artLinks_dt WHERE art_id=".$artByAlias_row['art_id']." and linkType='style'";
$slArtSt_res=$DB->doQuery($slArtSt_qry);
if(mysql_num_rows($slArtSt_res)==1){
    $slArtSt_row=$DB->doFetchRow($slArtSt_res);
    $fndSt=true;
}
$slArtScr_qry="select * from artLinks_dt WHERE art_id=".$artByAlias_row['art_id']." and linkType='script'";
$slArtScr_res=$DB->doQuery($slArtScr_qry);
if(mysql_num_rows($slArtScr_res)==1){
    $slArtScr_row=$DB->doFetchRow($slArtScr_res);
    $fndScr=true;
}
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='".$artByAlias_row['artMeta']."' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>".$artByAlias_row['catName']."</title>".
    "<link rel='SHORTCUT ICON' href='/site/".$artByAlias_row['catAlias']."/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/artMan/css/preview.css' type='text/css' media='screen, projection'/>";
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
    "<div class='art-header'><div class='art-header-img'>".
    "<img src='".ARTS_IMG_PAPH.$artByAlias_row['art_id']."/preview/".$artByAlias_row['artImg']."' id='shareImg'>".
    "</div><div class='art-header-descr'><h2>".$artByAlias_row['artMeta']."</h2></div>";
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
$refList_text="select * from artRef_dt WHERE art_id='".$artByAlias_row['art_id']."' order by artRef_id DESC";
$refList_res=$DB->doQuery($refList_text);
$refList_count=mysql_num_rows($refList_res);
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