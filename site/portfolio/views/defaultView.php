<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/actions/printList.php");
$h1 ="Портфолио";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Портфолио: мои работы'/>".
    "<title>it-Блог</title>".
    "<link rel='SHORTCUT ICON' href='/site/portfolio/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/gallery/css/mainView.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/js/list-view.js'></script>".
    "<link rel='stylesheet' href='/site/css/listView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/blog/css/blog.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/js/social-block.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='contentBlock-wrap'><div class='list-frame'>";

$appRJ->response['result'].="<h2>Свежая работа</h2>";

$appRJ->response['result'].="<div class='art-header'><div class='art-header-descr'><a href='/gallery'>".
"Галерея</a><div>Альбомы фотографий на разные темы</div></div><div class='art-header-img'>".
    "<img src='/site/gallery/img/logo-big.png' id='shareImg'>".
    "</div></div>";

$appRJ->response['result'].="<h2>Все работы</h2>".
"<p>Не беспокойтесь, скоро выйдут и другие работы</p>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>".$prtLst['text']."</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";