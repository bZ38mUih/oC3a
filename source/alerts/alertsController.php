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
    echo "<!DOCTYPE html>";
    echo "<html lang='en-Us'>";
    echo "<head>";
    echo "<http-equiv='Content-Type' charset='charset=utf-8'>";
    echo "<meta name='description' content='Возникла ошибка'>";
    echo "<title>".$errType."</title>";
    echo "<link rel='SHORTCUT ICON' href='/source/alerts/img/favicon.jpg' type='image/png'>";
    echo "<link rel='stylesheet' href='/source/alerts/css/default.css' type='text/css' media='screen, projection'/>";;
    echo "</head>";
    echo "<body>";
    echo "<div class='descriptionFrame' ";
    if($alertsArr[$errType]['img']){
        echo "style='background-image: url(".$alertsArr[$errType]['img'].")'";
    }
    echo ">";
    echo "<div class='df-title'>";
    echo "<h1>".$alertsArr[$errType]['h1']."</h1>";
    echo "<p>".$this->errors[$errType]['description']."</p>";
    echo "</div>";
    echo "<div class='alertsMenu'>";
    echo "<h2>На этом сайте:</h2>";
    echo "<h3>Блог</h3>";
    echo "<a href='/dev'><img src='/site/dev/img/logo.png'>Статьи о разработке</a>".
        "<a href='/pc'><img src='/site/pc/img/logo.png'>Статьи о компьютерных технологиях и ремонте ПК</a>";
    echo "<h3>Заказчику</h3>";
    echo "<a href='/services'><img src='/site/services/img/logo.png'>Услуги</a>";
    echo "<a href='/references'><img src='/site/references/img/logo.png'>Отзывы</a>";
    echo "<h3>Полезные ссылки</h3>";
    echo "<a href='/downloads'><img src='/site/downloads/img/logo.png'>Загрузки</a>";
    echo "<a href='/handbook'><img src='/site/handbook/img/logo.png'>Справочник</a>";
    echo "<h3>Портфолио</h3>";
    echo "<a href='/gallery'><img src='/site/gallery/img/logo.png'>Галерея</a>";
    echo "<h3>Еще</h3>";
    echo "<a href='/signIn'><img src='/site/signIn/img/logo.png'>Вход на сайт</a>";
    echo "<a href='/donate'><img src='/site/donate/img/logo.png'>Пожертвования</a>";
    echo "</div>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
}
exit;