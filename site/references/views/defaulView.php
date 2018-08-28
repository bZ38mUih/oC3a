<?php
$h1="Отзывы";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Напишите свой отзыв о моей работе. Мне важно ваше мнение.'/>".
    "<title>Отзывы</title>".
    "<link rel='SHORTCUT ICON' href='/site/references/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/references/css/references.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/references/js/ref.js'></script>".
    "<script src='/site/js/social-block.js'></script>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='ref-title'><div class='title-img'>".
    "<img src='/site/references/img/image.jpg'></div><div class='title-txt'>".
    "<span>Здесь вы можете написать свой отзыв о моей работе, высказать замечание или выразить благодарность, ".
    "поставить оценку</span>".
    "<strong>Ваше мнение много значит для меня</strong>".
    "</div></div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/references/views/ref-aprec.php");
$prtLst= prtCm(null, $DB);
$appRJ->response['result'].= "<div class='contentBlock-frame dark'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='ref-appr-stat'><div class='ref-stat'>".
    "<span class='total'>Всего:</span>".
    "<span class='fldName'><span class='fldVal'>".$prtLst['cntCom']."</span>отзыв.</span>".
    "<span class='fldName'><span class='fldVal'>".$apprRes['qty']."</span>оцен.</span>".
    "</div><div class='ref-apprec'>".$apprRes['content']."</div></div></div></div></div>".
    "<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='ref-frame'><div class='ref-block'>".$prtLst['text']."</div></div></div></div></div>".
    "<div class='modal signIn'><div class='overlay'></div><div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div></div>".
    "<div class='modal-left'></div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
$appRJ->response['result'].= "</body></html>";