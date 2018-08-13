<?php
$appRJ->response['result'].= "<div class='contentBlock-frame dark'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<footer>";

if($App['views']['social-block']) {
    $appRJ->response['result'].= "<div class='ft-service'>";

    $appRJ->response['result'].= "<noscript><div><img src='https://mc.yandex.ru/watch/44136454' 
style='position:absolute; left:-9999px;' alt='' /></div></noscript>";
    $appRJ->response['result'].= "<a href='https://metrika.yandex.ru/stat/?id=44136454&amp;from=informer' 
target='_blank' rel='nofollow'><img src='https://informer.yandex.ru/informer/44136454/3_1_FFFFFFFF_EFEFEFFF_0_pageviews' 
style='width:88px; height:31px; border:0;' alt='Яндекс.Метрика' title='Яндекс.Метрика: данные за сегодня (просмотры, 
визиты и уникальные посетители)' class='ym-advanced-informer' data-cid='44136454' data-lang='ru' /></a>";


    $appRJ->response['result'].= "</div>";
}

$appRJ->response['result'].= "<div class='ft-center'>";
$appRJ->response['result'].= "<hr>";
$appRJ->response['result'].= "<span>by Right Joint</span>";
$appRJ->response['result'].= "</div>";

if($App['views']['social-block']){
    $appRJ->response['result'].= "<div class='ft-like'>";

    $appRJ->response['result'].= "<a href='#' class='social_share' data-type='ok' title='Одноклассники'>";
    $appRJ->response['result'].= "<img src='/site/siteFooter/img/ok.png'><sup></sup>";
    $appRJ->response['result'].= "</a>";

    $appRJ->response['result'].= "<a href='#' class='social_share' data-type='fb' title='Facebook'>";
    $appRJ->response['result'].= "<img src='/site/siteFooter/img/fb.png'><sup></sup>";
    $appRJ->response['result'].= "</a>";

    $appRJ->response['result'].= "<a href='#' class='social_share' data-type='vk' title='ВКонтакте'>";
    $appRJ->response['result'].= "<img src='/site/siteFooter/img/vk.png'><sup></sup>";
    $appRJ->response['result'].= "</a>";

    $appRJ->response['result'].= "</div>";
}

$appRJ->response['result'].= "</footer>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
?>