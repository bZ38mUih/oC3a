<?php

if(isset($_POST['test'])){
    header("Location: https://money.yandex.ru/quickpay/confirm.xml");
    /*
   print_r($_POST);
    exit;
     */
    /*
    $url = 'https://money.yandex.ru/quickpay/confirm.xml';
    $data = array(
        'receiver' => '410017333214411',
        'formcomment' => 'Железный человек: реактор холодного ядерного синтеза',
        'short-dest' => 'Железный человек: реактор холодного ядерного синтеза',
        'label' => 'xyi-111',
        'quickpay-form' => 'donate',
        'targets' => 'transaction num xyi',
        'sum' => '100',
        'comment' => 'Хотелось бы получить дистанционное управление.',
        'need-fio' => 'false',
        'need-email' => 'false',
        'need-phone' => 'false',
        'need-address' => 'false',
        'paymentType' => 'AC',
    );
*/
// use key 'http' even if you send the request to https://...
    /*
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
*/
    //if ($result === FALSE) { /* Handle error */ }

    //var_dump($result);
    //echo $result;
    //exit;

}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/donate/views/defaultView.php");
}
