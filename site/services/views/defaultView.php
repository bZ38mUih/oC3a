<?php
$h1 ="Услуги программиста";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Заказ услуг программиста в г. Иваново. Создание и продвижение сайтов, web-программирование.'/>".
    "<title>Услуги программиста</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/services/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/services/js/services.js'></script>".
    "<link rel='stylesheet' href='/site/status/css/statBlock.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/status/css/statBlock.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/status/css/status.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "<link rel='stylesheet' href='/site/services/css/slider.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/status/js/status.js'></script>".
    " <script src='/source/js/jssor.slider-28.0.0.min.js' type='text/javascript'></script>".
    "<script src='/site/services/js/slider.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
$appRJ->response['result'].="<div class='introduce'>
<p>В современное время с помошью програмирования и сетевых технологий решается широкий круг задач, как:</p>
<ul>
<li>Безграничный доступ через интернет к информации на вашем сайте</li>
<li>Заказ товаров или услуг и получение онлайн оплаты</li>
<li>Привлечение заинтрересованных лиц через поиск или рекламу</li>
<li>Оптимизация бизнес процессов с помощью crm-систем</li>
<li>Построение систем мониторинга, контроля и управления типа 'умный дом' и т. п.</li>
</ul>
<p>Если для реализации ваших задач вам нужны специалисты с хорошими заниями, опытом и ответсвенный подход, тогда 
могу предложить вам свои услуги.</p>
</div>";
$appRJ->response['result'].="<div class='stat-block ".$actStat['stName']."'>".
    "<span class='status'>".$actStat['alias']."</span><div class='stat-block-img'>".
    "<img src='/site/status/img/logo-".$actStat['stName'].".png'></div><div class='stat-block-txt'>".$actStat['descr']."</div></div>".
    "<div class='stat-descr'>".$actStat['detail']."</div></div>";


$appRJ->response['result'].="</div></div>";

$appRJ->response['result'].= "<div class='contentBlock-frame dark'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once ($_SERVER["DOCUMENT_ROOT"] . "/site/services/views/banner.php");
$appRJ->response['result'].="</div></div></div>";
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
$srv_qry="select * from srvCat_dt WHERE catActive is TRUE ORDER BY srvCat_id";
$srv_res=$DB->query($srv_qry);
if(mysql_num_rows($srv_res)>0){
    while($srv_row = $srv_res->fetch(PDO::FETCH_ASSOC))){
        $cards_qry="select * from srvCards_dt WHERE srvCat_id=".$srv_row['srvCat_id'];
        $cards_res=$DB->query($cards_qry);
        if(mysql_num_rows($cards_res)>0){
            $appRJ->response['result'].= "<div class='srv-frame ".$srv_row['catAlias']."'><h2>".$srv_row['catName']."</h2>";
            while ($cards_row = $cards_res->fetch(PDO::FETCH_ASSOC)){
                $appRJ->response['result'].="<div class='srv-ln' id='srv".$cards_row['card_id']."'>".
                    "<div class='srv-capt'><span class='before'></span><span>".$cards_row['cardName'].
                    "</span><span class='after'></span></div>".
                    "<div class='srv-img'><img src='".SRV_CARD_IMG_PAPH.$cards_row['card_id']."/preview/".
                    $cards_row['cardImg']."'></div>".
                    "<div class='srv-txt'>".
                    "<div class='srv-cntrl'>".
                    "<span class='srv-price'>от ".$cards_row['cardPrice']." руб.</span>".
                    "<span class='addBucket ";
                if(!$_SESSION["bucket"]["prod"][$cards_row['card_id']]){
                    $appRJ->response['result'].="active";
                }
                $appRJ->response['result'].="' onclick='addBucket(".$cards_row['card_id'].")'><img src='/site/services/img/bucket.png'>Заказать</span>".
                    "<span class='rmBucket ";
                if($_SESSION["bucket"]["prod"][$cards_row['card_id']]){
                    $appRJ->response['result'].="active";
                }
                $appRJ->response['result'].="' onclick='rmBucket(".$cards_row['card_id'].")'><img src='/source/img/drop-icon.png'>Отменить</span>".
                    "<a class='toOrder ";
                if($_SESSION["bucket"]["prod"][$cards_row['card_id']]){
                    $appRJ->response['result'].="active";
                }
                $appRJ->response['result'].="' href='/services/mkOrder'><img src='/site/siteHeader/img/handsShake-color.png'>Оформить</a>".
                    "</div><div class='srv-descr'>".$cards_row['shortDescr']."</div>".
                    "<div class='detail'><a href='/services/detail/".$cards_row['cardAlias']."'>подробнее</a></div>".
                    "</div></div>";
            }
        }
    }
}else{
    $appRJ->response['result'].= "there is no active services";
}

$appRJ->response['result'].=
    "<div class='stat-descr'><b>Примечание:</b> расценки указаны приблизительно, стоимость работ определяется после составления тех. 
задания и может отличатся от указанных выше.</div>".
    "</div>";
$appRJ->response['result'].="</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/status/views/contactsBlock.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";