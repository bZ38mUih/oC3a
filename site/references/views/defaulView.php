<?php
$h1="Отзывы";
$App['views']['social-block']=true;

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Напишите свой отзыв о моей работе. Мне важно ваше мнение.' http-equiv='Content-Type' charset='charset=utf-8'>";

$appRJ->response['result'].= "<title>Отзывы</title>";

$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/references/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<script src='/source/js/jquery.cookie.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/references/css/references.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/references/js/ref.js'></script>";

$appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";

$appRJ->response['result'].= "<script src='/site/js/goTop.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";

$appRJ->response['result'].= "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>";

$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");


$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='ref-title'>";
$appRJ->response['result'].= "<div class='title-img'>";
$appRJ->response['result'].= "<img src='/site/references/img/image.jpg'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='title-txt'>";
$appRJ->response['result'].= "<span>Здесь вы можете написать свой отзыв о моей работе, высказать замечание или выразить благодарность, ".
    "поставить оценку</span>";
$appRJ->response['result'].= "<strong>Ваше мнение много значит для меня</strong>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/references/views/ref-aprec.php");
$prtLst= prtCm(null, $DB);

$appRJ->response['result'].= "<div class='contentBlock-frame dark'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<div class='ref-appr-stat'>";
$appRJ->response['result'].= "<div class='ref-stat'>";
$appRJ->response['result'].= "<span class='total'>Всего:</span>";
$appRJ->response['result'].= "<span class='fldName'><span class='fldVal'>".$prtLst['cntCom']."</span>отзыв.</span>";
$appRJ->response['result'].= "<span class='fldName'><span class='fldVal'>".$apprRes['qty']."</span>оцен.</span>";
$appRJ->response['result'].= "</div>";


$appRJ->response['result'].= "<div class='ref-apprec'>";

$appRJ->response['result'].= $apprRes['content'];

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<div class='ref-frame'>";
$appRJ->response['result'].= "<div class='ref-block'>";

$appRJ->response['result'].= $prtLst['text'];


$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";



$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='modal signIn'>";
$appRJ->response['result'].= "<div class='overlay'></div>";
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";

$appRJ->response['result'].= "<div class='modal-right'>";
$appRJ->response['result'].= "<div class='modal-close'></div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='modal-left'>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";


require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";