<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 04.01.2018
 * Time: 23:05
 */

$appRJ->response['result'].= "<form class='signIn' method='post' action='/signIn' autocomplete='off'>";
$appRJ->response['result'].= "<div class='inputLine'>";
if(isset($_COOKIE['login']) and $_COOKIE['login']!=null){
    $appRJ->response['result'].= "<label for='login'>Ваш логин</label>";
    $appRJ->response['result'].= "<input type='text' name='login' value='".$_COOKIE['login']."'>";
}else{
    $appRJ->response['result'].= "<label for='login' class='shown'>Ваш логин</label>";
    $appRJ->response['result'].= "<input type='text' name='login'>";
}

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='inputLine'>";
if (isset($_COOKIE['rememberMe']) and $_COOKIE['rememberMe']=='on' and isset($_COOKIE['password'])
    and $_COOKIE['password']!=null){
    $appRJ->response['result'].= "<label for='password'>Ваш пароль</label>";
    $appRJ->response['result'].= "<input type='password' name='password' value='".$_COOKIE['password']."'>";
}else{
    $appRJ->response['result'].= "<label for='password'  class='shown'>Ваш пароль</label>";
    $appRJ->response['result'].= "<input type='password' name='password' value=''>";
}

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='inputLine rememberMe'>";
$appRJ->response['result'].= "<label for='rememberMe'>Запомнить</label>";
$appRJ->response['result'].= "<input type='checkbox' name='rememberMe' ";
if (isset($_COOKIE['rememberMe']) and $_COOKIE['rememberMe']=='on'){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='pageErr'>";
$appRJ->response['result'].= $validErr;
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='inputLine submit'>";
$appRJ->response['result'].= "<input type='submit' value='Вход' onclick='signIn()'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";