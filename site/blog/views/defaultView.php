<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/actions/printList.php");
$h1 ="it-Блог";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Блог на темы web и net разработки и компьютерых технологий.'/>".
    "<title>it-Блог</title>".
    "<link rel='SHORTCUT ICON' href='/site/blog/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/gallery/css/mainView.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/blog/js/blog-ajax.js'></script>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    //"<link rel='stylesheet' href='/site/css/listView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/blog/css/blog.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "<script src='/site/js/social-block.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='contentBlock-wrap'><div class='list-frame'>";

$appRJ->response['result'].= $createBlogMenu_txt;

$appRJ->response['result'].= "<div class='art-list-frame'><div class = 'art-list-wrap'>".$art_page.
    "</div>"."<div class='pagination'>".$btn_pre.$page_list.$btn_nex."</div>".$pl_text."</div>";

$appRJ->response['result'].= "</div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";