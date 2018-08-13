<?php
/**
 * Created by PhpStorm.
 * User: AVP
 * Date: 26.11.2016
 * Time: 17:38
 */

$captchaRes=$captcha->create();

$appRJ->response['result'].= "<div class='checkIn-frame'>";

$appRJ->response['result'].= "<strong>Вам будут доступны дополнительные ресурсы этого сайта</strong>";

$appRJ->response['result'].= "<form class='checkIn' method='post' autocomplete='off'>";
$appRJ->response['result'].= "<div class='inputLine'>";
$appRJ->response['result'].= "<label for='login'>";
if($requiredFields['login']['val']==null){
    $appRJ->response['result'].= "Придумайте логин";
}
$appRJ->response['result'].= "</label>";
$appRJ->response['result'].= "<input type='text' name='login' value='".$requiredFields['login']['val']."'>";
if($requiredFields['login']['err']!=null){
    $appRJ->response['result'].= "<div class='pageErr active'>";
    $appRJ->response['result'].= $requiredFields['login']['err'];
}else{
    $appRJ->response['result'].= "<div class='pageErr'>";
    $appRJ->response['result'].= "&nbsp;";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='inputLine'>";
$appRJ->response['result'].= "<label for='eMail'>";
if($requiredFields['eMail']['val']==null){
    $appRJ->response['result'].= "Введите ваш e-mail";
}
$appRJ->response['result'].= "</label>";
$appRJ->response['result'].= "<input type='text' name='eMail' value='".$requiredFields['eMail']['val']."'>";
if($requiredFields['eMail']['err']!=null){
    $appRJ->response['result'].= "<div class='pageErr active'>";
    $appRJ->response['result'].= $requiredFields['eMail']['err'];
}else{
    $appRJ->response['result'].= "<div class='pageErr'>";
    $appRJ->response['result'].= "&nbsp;";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='inputLine'>";
$appRJ->response['result'].= "<label for='password'>";
if($requiredFields['password']['val']==null){
    $appRJ->response['result'].= "Придумайте пароль";
}
$appRJ->response['result'].= "</label>";
$appRJ->response['result'].= "<input type='password' name='password' value='".$requiredFields['password']['val']."'>";
if($requiredFields['password']['err']!=null){
    $appRJ->response['result'].= "<div class='pageErr active'>";
    $appRJ->response['result'].= $requiredFields['password']['err'];
}else{
    $appRJ->response['result'].= "<div class='pageErr'>";
    $appRJ->response['result'].= "&nbsp;";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='inputLine'>";
$appRJ->response['result'].= "<label for='password_2'>";
if($requiredFields['password_2']['val']==null){
    $appRJ->response['result'].= "Повторите пароль";
}
$appRJ->response['result'].= "</label>";
$appRJ->response['result'].= "<input type='password' name='password_2' value='".$requiredFields['password_2']['val']."'>";
if($requiredFields['password_2']['err']!=null){
    $appRJ->response['result'].= "<div class='pageErr active'>";
    $appRJ->response['result'].= $requiredFields['password_2']['err'];
}else{
    $appRJ->response['result'].= "<div class='pageErr'>";
    $appRJ->response['result'].= "&nbsp;";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='inputLine captcha'>";
$appRJ->response['result'].= "<div class='captcha_img'>";
$appRJ->response['result'].= "<img src='data:image/png;base64, ".base64_encode($captchaRes['image'])."' title='проверочный код'>";
$appRJ->response['result'].= "<a href='javaScript: void(0)' id='captcha_update'>Обновить</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='captcha_code'>";
$appRJ->response['result'].= '<input type="hidden" name="checkCode_crypt" value="'.$captcha->encryptCheckCode($captchaRes['code']).'">';
$appRJ->response['result'].= "<label for='checkCode'>Код с картинки</label>";
$appRJ->response['result'].= "<input type='text' name='checkCode'>";
$appRJ->response['result'].= "</div>";
if($requiredFields['checkCode']['err']!=null){
    $appRJ->response['result'].= "<div class='pageErr active'>";
}else{
    $appRJ->response['result'].= "<div class='pageErr'>";
}
$appRJ->response['result'].= "неправильный проверочный код";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($fieldsErr==true){
    $appRJ->response['result'].= "<div class='pageErr active'>";
}else{
    $appRJ->response['result'].= "<div class='pageErr'>";
}
$appRJ->response['result'].= "на странице присутствуют ошибки";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='inputLine submit'>";
$appRJ->response['result'].= "<input type='submit' value='Зарегистрироваться'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";
$appRJ->response['result'].= "</div>";
?>
