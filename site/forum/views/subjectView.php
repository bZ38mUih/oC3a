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
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/forum/css/subjView.css' type='text/css' media='screen, projection'/>".
    //"<link rel='stylesheet' href='/site/gallery/css/album-style.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    //"<script src='/site/gallery/js/album-view.js'></script>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='s-frame'>";
$appRJ->response['result'].="<div class='s-title'>".
    "<div class='s-title-cover'>";
if($subj_row['sImg']){
    $appRJ->response['result'].="<img src='".F_SUBJ_IMG.$subj_row['fs_id']."/preview/".$subj_row['sImg']."' alt='subj cover'>";
}

$appRJ->response['result'].="</div><div class='s-title-descr'><h2>".$subj_row['metaDescr']."</h2></div>".
    "<div class='dateLine'><span class='dateFld'>Создано: </span><span class='dateVal'>".$subj_row["dateOfCr"]."</span></div>";
if($subj_row['longDescr']){
    $appRJ->response['result'].="<div class='longDescr'>".$subj_row['longDescr']."</div>";
}
    //"</div>";

/*
    "<div class='alb-frame onAlbum'>".
    $albums_print.
    "</div>".
    "<div class='photo-frame'>".
    $albums_print_txt.
    "</div>";
$catFrame_txt=null;
$catFrame_flag=false;
$catFrame_txt.= "<div class='cat-frame'><span class='cap2'>Еще этой категории:</span>";
foreach($catArr as $key=>$value){
    if($key==$catId){
        $catFrame_txt.= "<a href='/gallery/category/".$value['catAlias']."' class='cat-line'>";

        $catFrame_txt.= "<div class='cat-img'>";
        if(file_exists($_SERVER['DOCUMENT_ROOT'].GL_CATEG_IMG_PAPH.$key."/preview/".$value['catImg'])){
            $catFrame_txt.= "<img src='".GL_CATEG_IMG_PAPH.$key."/preview/".$value['catImg']."'>";
        }else{
            $catFrame_txt.= "<img src='/data/default-img.png'>";
        }
        $catFrame_txt.= "</div>".
            "<div class='cat-descr'>".
            "<span class='flName'>&laquo;</span><span class=flVal>".
            $value['catName']."</span><span class='flName'>&raquo;</span>".
            "<span class=flVal>".$value['albCount']."</span><span class='flName'>альбом</span>".
            "<span class=flVal>".$value['photoCount']."</span><span class='flName'>фот</span>".
            "<span class='descrTxt'>".$value['catDescr']."</span>".
            "</div></a>";
        if($value['albCount']>1){
            $catFrame_flag=true;
        }
    }
}
$catFrame_txt.= "</div>";
if($catFrame_flag){
    $appRJ->response['result'].= $catFrame_txt;
}
*/
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";