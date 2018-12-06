<?php
$alertsArr['404']['title']='Не найдено';
$alertsArr['404']['h1']='Не найдено';
$alertsArr['404']['img']='/source/alerts/img/404-not-found.jpg';
$alertsArr['404']['respCode']=404;

$alertsArr['stab']['title']='Реконструкция';
$alertsArr['stab']['h1']='Сайт временно на реконструкции';
$alertsArr['stab']['img']='/source/alerts/img/stabErr.jpg';

$alertsArr['access']['title']='Запрещен';
$alertsArr['access']['h1']='Доступ запрещен';
$alertsArr['access']['img']='/source/alerts/img/accessErr.jpg';
$alertsArr['access']['respCode']=403;

$alertsArr['connection']['title']='Подключение';
$alertsArr['connection']['h1']='Подключение';
$alertsArr['connection']['img']='/source/alerts/img/connErr.jpg';

$alertsArr['request']['title']='Request';
$alertsArr['request']['h1']='Неправильные параметры запроса';
$alertsArr['request']['img']='/source/alerts/img/requestErr.jpg';
$alertsArr['request']['respCode']=400;

$alertsArr['config']['title']='Конфигурация';
$alertsArr['config']['h1']='Ошибка в конфигурации';
$alertsArr['config']['img']='/source/alerts/img/connErr.jpg';

$alertsArr['XXX']['title']='Неизвестная ошибка';
$alertsArr['XXX']['h1']='Неизвестная ошибка';
$alertsArr['XXX']['img']='/source/alerts/img/XXX-unknownError.jpg';

if($this->errors){
    $errType=null;
    $errDescr=null;
    foreach ($alertsArr as $key=>$val){
        if(isset($this->errors[$key])){
            $errType=$key;
            $errDescr=$this->errors[$key]['description'];
            break;
        }
    }
    if($alertsArr[$key]['respCode']){
        http_response_code($alertsArr[$key]['respCode']);
    }
    echo "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
        "<meta name='description' content='Возникла ошибка'>".
        "<title>".$errType."-".$alertsArr[$errType]['title']."</title>".
        "<link rel='SHORTCUT ICON' href='/source/alerts/img/favicon.png' type='image/png'>".
        "<link rel='stylesheet' href='/source/alerts/css/default.css' type='text/css' media='screen, projection'/>".
        "</head>".
        "<body>".
        "<div class='descriptionFrame' ";
    if($alertsArr[$errType]['img']){
        echo "style='background-image: url(".$alertsArr[$errType]['img'].")'";
    }
    echo ">".
        "<div class='df-title'>".
        "<h1>".$alertsArr[$errType]['h1']."</h1>".
        "<p>".$this->errors[$errType]['description']."</p>".
        "</div>".
        "<div class='alertsMenu'>".
        "<h2>На этом сайте:</h2>".
        "<h3>Блог</h3>".
        "<a href='/dev' title='Все статьи'><img src='/site/dev/img/logo.png'>Статьи о разработке</a>".
        "<a href='/pc' title='Все статьи'><img src='/site/pc/img/logo.png'>Статьи о компьютерных технологиях и ремонте ПК</a>".
        "<h3>Заказчику</h3>".
        "<a href='/services' title='Расценки и заказ услуг'><img src='/site/services/img/logo.png'>Услуги</a>".
        "<a href='/forum/faq' title='Об этом сайте'><img src='/site/status/img/faq.png'>Часто задаваемые вопросы</a>".
        "<a href='/references' title='Посмотреть отзывы, написать отзыв'><img src='/site/references/img/logo.png'>Отзывы</a>".
        "<h3>Полезные ссылки</h3>".
        "<a href='/downloads' title='Ссылки на загрузки программ'><img src='/site/downloads/img/logo.png'>Загрузки</a>".
        "<a href='/handbook'><img src='/site/handbook/img/logo.png'>Справочник</a>".
        "<h3>Портфолио</h3>".
        "<a href='/gallery' title='Галерея фотографий на разные темы'><img src='/site/gallery/img/logo.png'>Галерея</a>".
        "<h3>Еще</h3>".
        "<a href='/donate' title='Пожертвования на развитие проекта'><img src='/site/donate/img/logo.png'>Помощь проекту</a>".
        "<a href='/signIn' title='Авторизация'><img src='/site/signIn/img/logo.png'>Вход на сайт</a>".
        "</div>".
        "</div>".
        "</body>".
        "</html>";
}
exit;