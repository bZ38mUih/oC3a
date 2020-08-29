<?php
$wereCond=null;
if($adType=='all'){
    if($adSaler!='all'){
        $wereCond="WHERE prodSaler='".$adSaler."'";
    }
}else{
    $wereCond="WHERE adType='".$adType."' ";
    if($adSaler!='all'){
        $wereCond.="and prodSaler='".$adSaler."' ";
    }
}
$adCount_qry="select count(*) as adCount from parseAdList_dt ".$wereCond;
$adCount_res=$DB->query($adCount_qry);
$adCount_row = $adCount_res->fetch(PDO::FETCH_ASSOC);

$pagesText=null;
$pNum=1;
while ($adCount_row['adCount']-($pNum-1)*$volP>0){
    if($pNum>5){break;}
    $pagesText.= "<a href='?page=".$pNum."' ";
    if($curPage==$pNum){
        $pagesText.="class='active'";
    }
    $pagesText.=">".$pNum."</a>, ";
    $pNum++;
}

$pagesText=substr($pagesText, 0, strlen($pagesText)-2);
if($pNum>1){
    $pagesText="Стр. ".$pagesText;
}else{
    $pagesText="Стр. - ";
}
if($pNum>5){$pagesText.=" ...";}
$parseRes=null;
$parseList_text="select * from parseAdList_dt ".$wereCond." ORDER BY adDate DESC limit ".($curPage-1)*$volP.", ".$volP;
$parseList_res=$DB->query($parseList_text);
if($parseList_res->rowCount() > 0){
    $adCountTmp=0;
    while($parseList_row = $parseList_res->fetch(PDO::FETCH_ASSOC)){
        $adCountTmp++;
        $parseRes.="<div class='line ad'><div class='content-wrap'> ".
            "<div class='ad_ref'><a href='https://avito.ru/".$parseList_row['prodRef']."' target='_blank'>".$adCountTmp."</a></div>".
            "<div class='prodName'>".$parseList_row['prodName']."</div>".
            "<div class='prodSaler'>".$parseList_row['prodSaler']."</div>".
            "<div class='prodPrice'>".$parseList_row['prodPrice']."</div></div>".
            "<div class='adInfo'><span>Компания: ";
        if($parseList_row['prodComp']){
            $parseRes.=$parseList_row['prodComp'];
        }else{
            $parseRes.=" - ";
        }
        $parseRes.="</span>".
            "<span>Доска: ".$parseList_row['adType']."</span>".
            "<span>Распарсил: ".$parseList_row['adDate']."</span>".
            //"<span>Коммент: ".$parseList_row['comment']."</span>
            "</div>".
            "<div class='control-wrap'><span>Содержание</span></div>".
            "<div class='prodDescr'>".$parseList_row['prodDescr']."</div>".
            "</div></div>";
    }
}
$logRes=null;
$adLog_qry="select * from parseAdLog_dt order by logDate DESC";
$adLog_res=$DB->query($adLog_qry);
$adLog_row = $adLog_res->fetch(PDO::FETCH_ASSOC);


$h1 ="Парсинг объявлений";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Парсинг объявлений на примере avito.ru'/>".
    "<title>Парсинг объявлений</title>".
    "<link rel='SHORTCUT ICON' href='/site/parse-ad/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";

if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    //"<script src='/site/js/list-view.js'></script>".
    "<script src='/site/parse-ad/js/parse-ad.js'></script>".
    //"<link rel='stylesheet' href='/site/css/listView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/parse-ad/css/parse-ad.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<p>
    <strong>В настоящее время скрипт парсинга объявлений больше не работает по следующим причинам:</strong>
<ol>
    <li>Avito окончательно заблокировал ip-адрес хоста, на котором размещен мой сайт</li>
    <li>При попытке настроить парсинг через прокси сервер возникли проблемы
<ul>
            <li>Загрузка через proxy слишком медленная</li>
            <li>Работа через proxy часто не стабильна и их придется менять, что сильно усложнит сам скрип,
                ведь для этого сначала придется распарсить список free proxy</li>
        </ul>
    </li>
</ol>
</p>".
    "<div class='parse-ad-descks'><ul>Скрипт с интервалом 5 минут парсит доски объявлений:".
    "<li><a href='https://www.avito.ru/ivanovo/noutbuki' target='_blank' title='авито иваново ноутбуки'>https://www.avito.ru/ivanovo/noutbuki</a></li>".
    "<li><a href='https://www.avito.ru/ivanovo/planshety_i_elektronnye_knigi' target='_blank' title='авито иваново планшеты'>https://www.avito.ru/ivanovo/planshety_i_elektronnye_knigi</a></li>".
    "<li><a href='https://www.avito.ru/ivanovo/telefony' target='_blank' title='авито иваново телефоны'>https://www.avito.ru/ivanovo/telefony</a></li>".
    "</ul>".
    "Подробнее о работе скрипта можно прочитать в моем блоге <a href='/dev/parse-ad-avito' title='читать статью'>Парсинг объявлений Авито</a></div>".
    "<div class='parseLog'>"."<h2>Обновлено: ".$adLog_row['logDate']."</h2>".
    "<div class='parseLog-controls'><label>Глубина: <input type='number' id='logDepth' min='1' max='10' value='1'></label>".
    "<input type='button' value='showLog' onclick='showLog()'>".
    "</div><div class='log-content'></div></div>".
    $logRes.
    "<div class='tbl-opt-wrap'><div class='tbl-pages'>".$pagesText."</div><div class='tbl-opt'>".
    "<label>Продавец <select id='adSaler'>".
    "<option value='all' ";
if($adSaler=='all'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">Все</option>".

    "<option value='company' ";
if($adSaler=='Компания'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].=">Компания</option>".
    "<option value='persP' ";
if($adSaler=='Частное лицо'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].=">Частные</option>".
    "</select></label>".
    "<label>Доска <select id='adType'>".
    "<option value='all' ";
if($adType=='all'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].=">Все</option>".
    "<option value='noutbuki' ";
if($adType=='noutbuki'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].=">noutbuki</option>".
    "<option value='telefony' ";
if($adType=='telefony'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].=">telefony</option>".
    "<option value='planshety_i_elektronnye_knigi' ";
if($adType=='planshety_i_elektronnye_knigi'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].=">planshety_i_elektronnye_knigi</option>".
    "</select></label>".
    "<label>На странице <select id='volP'>".
    "<option value='20'";
if($volP==20){
    $appRJ->response['result'].= " selected";
}
$appRJ->response['result'].=">20</option>".
    "<option value='50'";
if($volP==50){
    $appRJ->response['result'].=" selected";
}
$appRJ->response['result'].=">50</option>".
    "<option value='100'";
if($volP==100){
    $appRJ->response['result'].=" selected";
}
$appRJ->response['result'].=">100</option>".
    "</select></label>".
    "</div></div>".
    "<div class='line ad caption'><div class='ad_ref'>ref</div><div class='prodName'>prodName</div>".
    "<div class='prodSaler'>Saler</div>".
    "<div class='prodPrice'>Price</div>".
    "</div>";
$appRJ->response['result'].= $parseRes."</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";