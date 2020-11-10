<?php
$h1 ="Услуги";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Описание и стоимость услуг на rightjoint.ru.'/>".
    "<title>Заказ услуг</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/services/css/services-2020-11-v2.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/services/js/services-2020-11-v1.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='services-title-wrap'><div class='services-title-left'>
<ul>
<strong>Для тех, кому важны:</strong>
<li><img src='/site/services/img/F-plus.png'><span>Высокий профессионализм</span></li>
<li><img src='/site/services/img/responsobilities.jpg'>Ответсвенный подход</li>
<li><img src='/site/services/img/warranty.png'>Гарантия качества</li>
</ul>
</div>
<div class='services-title-right'>
<img src='/site/services/img/mind.png'>
<strong>
Доверив свои задачи специалисту, вам не придется волноваться что все будет сделано 
правильно и вовремя.</strong>
</div></div>";

$appRJ->response['result'].= "<h2 class='pop'><hr><span>Пoпулярные услуги</span></h2><div class='service-frame-wrap'><div class='service-frame'>";

$appRJ->response['result'].= "<div class='sf-card' sf-content='php' onclick='sfct_content(this)'>
<a><span></span><span></span><span></span><span></span>
<div class='scf-text'>
php
</div>
</a>
</div>";

$appRJ->response['result'].= "<div class='sf-card' sf-content='db' onclick='sfct_content(this)'>
<a><span></span><span></span><span></span><span></span>
<div class='scf-text'>
database
</div>
</a>
</div>";

$appRJ->response['result'].= "<div class='sf-card' sf-content='javascript' onclick='sfct_content(this)'>
<a><span></span><span></span><span></span><span></span>
<div class='scf-text'>
JavaScript
</div>
</a>
</div>";
$appRJ->response['result'].= "<div class='sf-card' sf-content='html' onclick='sfct_content(this)'>
<a><span></span><span></span><span></span><span></span>
<div class='scf-text'>
html
</div>
</a>
</div>";

$appRJ->response['result'].= "<div class='sf-card' sf-content='server' onclick='sfct_content(this)'>
<a><span></span><span></span><span></span><span></span>
<div class='scf-text'>
Server
</div>
</a>
</div>";

$appRJ->response['result'].= "<div class='sf-card' sf-content='crm' onclick='sfct_content(this)'>
<a><span></span><span></span><span></span><span></span>
<div class='scf-text'>
crm
</div>
</a>
</div>";

$appRJ->response['result'].= "<div class='sf-card' sf-content='seo' onclick='sfct_content(this)'>
<a><span></span><span></span><span></span><span></span>
<div class='scf-text'>
seo
</div>
</a>
</div>";

$appRJ->response['result'].= "<div class='sf-card' sf-content='c-sharp' onclick='sfct_content(this)'>
<a><span></span><span></span><span></span><span></span>
<div class='scf-text'>
c-sharp
</div>
</a>
</div>";

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='sfct-content' id='sc-php'>
<h3>php</h3>
<p>php считается самым простым языком программирования и предназначен в основном для создания сайтов, 
хотя с помощью него можно решать и другие задачи. 
Большинство сайтов в интернет написано имменно на php, плюс его еще и в том, что он бесплатный.</p>
<p>Скрипты должны быть написаны специалистами, быть понятными, гибкими для изменений и выполнятся быстро. 
При поиске проблем приходится проверять множество условий, например ошибки могут быть как в самом скрипте, так и 
в используемых библиотеках, зависящих сервисах, настроеках на сервере и  могом другом. При отладке кода на рабочих  
сайтах надо быть особенно внимательным потому что ошибки могут причинить неудобство 
пользователям и стоить денег заказчику. Обязательно нужно делать резервные копии файлов, проводить тестирование 
внесенных изменений. 
</p>
<p>Не cms - системы: существует множество систем и фреймворков на основе php (Bitrix, world press, laravel, yii и т. д.)
Большинство из них предназначены для упрошения создания сайтов, иногда даже без написания кода. 
Под индивидуальные требования заказчиков часто не существует готовых модулей или существующим требуется серьезная 
доработка, по этому в своей работе я не использую cms системы.</p>
</div>";
$appRJ->response['result'].= "<div class='sfct-content' id='sc-db'>
<h3>SQL-Базы данных</h3>
<p>Популярных баз данных много (PostgreSQL, MS-SQL, MySQL, Firebird и другие) и принцип работы с ними примерно одинаковый. 
На практике мне чаще всего приходится работать с MySQL</p>
<p>Опыт показывает что в небольших базах данных практически всегда все запросы выполняются быстро. В базах в несколько ГБ, где в 
таблицах хранятся и постоянно используются десятки миллионнов записей, все сложнее. Время выполнения разных запросов на 
выборку одних и тех же данных (с одинаковым результатом) может очень существенно различатся.</p>
<p>
Оптимизация баз данных требует тщательного анализа структуры и связей между таблицами, индексов и ключевых полей, 
типов операторов SQL, также настроек сервера и нагрузки на него.</p>
</div>";

$appRJ->response['result'].= "<div class='sfct-content' id='sc-javascript'>
<h3>javascript</h3>
<p>javascript поддрерживается браузерами и может применятся для различных целей, вам может быть интересно:<br>
1. Получения информации о действиях пользователя в браузере и применение изменений на настранице в зависимости от его выбора.<br>
2. Установка слайдеров, спинеров и прочих виджетов (погода, валюта). Возможно копирование и установка под заказ понравивщегося вам javascript.<br>
3. Взаимодейтсвие javascript с сервером через ajax позволяет ускорить время загрузки страницы и снизить нагрузку на сервер.
</div>";
$appRJ->response['result'].= "<div class='sfct-content' id='sc-html'>
<h3>Верстка html</h3>
<p>
Даже версткой html-документов должны заниматься компетентные люди, а при выполнении сложных элементов дизайна необходимо хороше 
знание и умение применять CSS. Здесь тоже нужно уделать внимание многим мелочам, прописывать метатеги и заголовки, 
в правильной последовательности включать в документ стили и скрипты, тогда документ будет работать привильно, 
 выглядеть привлекательно для пользователей и хорошо распознаваемым для робота.
</p>
<p>
Вы можете заказать верстку по собственным макетам или попросить скопировать понравившуюся вам страницу, выполнить адаптивный 
дизайн под разные размеры и ориентации экрана.
</p>
</div>";
$appRJ->response['result'].= "<div class='sfct-content' id='sc-server'>
<h3>Настройки сервера</h3>
<p>
От правильности настроек сервера во многом зависит правильность и безопасноть работы сайта. Чаще всего серверов одновременно 
несколько, у каждого из которых свои настройки и разрешенные пользователи, которым доступны определенные права и директории. 
Таким образом множество различных ошибок может возникать на сервере, отладку которых лучше доверить специалистам, или для 
начала можно попробовать разобрать логи.</p>
</div>";
$appRJ->response['result'].= "<div class='sfct-content' id='sc-crm'>
<h3>программирование crm</h3>
<p>
В продажах удобно использовать программы, в которых продавцы ведут базу клиентов и сделок с ними. Программа покажет 
продавцу входящую цену и его прибыль, сколько и когда клиент брал ранее, остатки на складах, создаст необходимые документы 
 на оплату и передачу товара, рассчитает дату отгрузки и доставки клиенту. Каждая стади такой цепочки продажи может быть 
 представлена отдельным бизнеспроцессом. 
</p>
<p>Примером такой customers relationships management может быть сложный web-сайт в локальной сети, работа которого может зависеть от разных 
сервисов и популярной 1С. 
Часто требуется анализ и исправление алгоритмов crm описывающих бизнезпроцессы, разработка 
под новые сущности структуры данных и методов обработки и представления. 
</p>
</div>";
$appRJ->response['result'].= "<div class='sfct-content' id='sc-seo'>
<h3>seo</h3>
<p>
Обычно процесс продвижения сайтов очень длительный, требует аудита большого количества данных и исходя из выводов 
применение каких-то мер, которые не гарантируют результат. 
</p>
<p>
Сравнительный анализ показывает что сайты примерно однинаковой тематики набирают примерно одинаковые показатели 
просмотров по контекстной рекламе. Сколько раз вам при этом позвонят и сколько купят будет в большей степени зависеть
от вас, возможно от расценок или условий доставки. Обратите внимание что при поиске товаров или услуг на первых 
позициях обычно показывается реклама, такой взгляд сейчас на это у поисковых систем.
</p>
<p>
Для продвижения сайтов обычно пользуюся стандартными бесплатными инструментами webmaster.yandex и googlesearch, следуют 
их рекомендациям. Эти инструменты покажут поисковые запросы и посещаемость сайта, допущенные ошибки на карте сайта или 
в размере текста на экране. 
</p>
</div>";
$appRJ->response['result'].= "<div class='sfct-content' id='sc-c-sharp'>
<h3>c# .Net</h3>
<p>Windows - приложения могут быть написаны с использованием библиотек net framework, который поддерживают различные 
языки программирования, в том числе c#</p>
<p>
Обычно приложения имеют оконный интерфейс, примером может быть мессенджер. Такие приложения могут получать и передавать 
данные через интернет, записывать или читать данные с пк, подключаться к базам данных и т.п. 
</p>
<p>
Сейчас я не занимаюсь программимрование на c#, но имею успешный опыт создания подобных программ.
</p>
</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].="</div></div></div>";

$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";

$price_add_text = null;
if($actStat['stName']=='lookFor' and $actStat['active'] == 1){
    $price_add_text = "Возможно сотрудничество на постоянной основе, при полной занятости и нормальном рабочем дне, 
желаемый уровень оплаты 100 тыс руб/месяц нетто.";
}
$appRJ->response['result'].= "
<h2 class='price'><hr><span>Условия и расценки</span></h2>
<div class='service-price-wrap'>
<div class='service-price'>
<p>Расценки на услуги часто договорные. Предоплата приветствуется и необходима при работах без оформления. 
Средняя стоимость одного часа работы = 800 руб. ".$price_add_text."</p>
<p>Возможны различные формы сотрудничества, по договору или без, наличная и безналичная оплата</p> 
</div></div>";
$appRJ->response['result'].="</div></div></div>";


$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><h2 class='portf'><hr><span>Мои работы</span></h2>";
$appRJ->response['result'].= "<div class='portf-blok'><div class='pb-item'>".
    "<div class='pbi-img'>".
    "<img src='/site/portfolio/img/sad-logo.png' alt='gallery-img'>".
    "</div><div class='pb-text'>".
    "<a href='http://sad-primorya.ru' title='Смотреть работу sad-primorya.ru' target='_blank'>Сад Приморья</a>".
    "<span>Интернет магазин саженцев плодовых и декоративных деревьев и кустарников во Владивостоке</span></div></div>";
$appRJ->response['result'].= "<div class='pb-item'>".
    "<div class='pbi-img'>".
    "<img src='/site/gallery/img/logo-big.png' alt='gallery-img'>".
    "</div><div class='pb-text'>".
    "<a href='/gallery' title='Смотреть работу на этом сайте'>Галерея</a>".
    "<span>Альбомы фотографий на разные темы</span>";
$appRJ->response['result'].= "</div></div></div>";
$appRJ->response['result'].="</div></div></div>";


$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><h2 class='ref'><hr><span>Отзывы клиентов</span></h2>";
$appRJ->response['result'].= "<div class='ref-block'>

".$tmpRes['text']."
<p class='toRef'><a href='/references' title='Смотеть все отзывы, написать отзыв'>
<img src='/site/references/img/logo.png'>
Написать отзыв</a></p>
</div>";
$appRJ->response['result'].="</div></div></div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";