<?php

$appRJ->response['result'].= "<form class='signIn' action='/signIn/' method='post' autocomplete='off'>";
$appRJ->response['result'].= "<span class='alerts warning'>".$required_fields->result['login']['err']."</span>";
$appRJ->response['result'].= "<span class='alerts warning'>".$required_fields->result['pw']['err']."</span>";
$appRJ->response['result'].= "<label for='usrLogin'  class='shown'>";
if (isset($_COOKIE['usrLogin']) and ($_COOKIE['usrLogin']!=null)){

}else{
    $appRJ->response['result'].= "Ваш логин";
}
$appRJ->response['result'].= "</label>";
$appRJ->response['result'].= "<input type='text' name='usrLogin' value='" .$_COOKIE['usrLogin']."'>";
$appRJ->response['result'].= "<label for='usrPassword' class='shown'>";
if (isset($_COOKIE['usrPassword']) and ($_COOKIE['usrPassword']!=null)){

}else{
    $appRJ->response['result'].= "Ваш пароль";
}
$appRJ->response['result'].= "</label>";
$appRJ->response['result'].= "<input type='password' name='usrPassword' value='" .$_COOKIE['usrPassword']."'>";
$appRJ->response['result'].= "<input type='checkbox' name='rememberMe' ";
if ($_COOKIE['rememberMe']=="on") {
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<label for='rememberMe' title='запомнить пароль'>запомнить";
$appRJ->response['result'].= "<input type='submit' value='Вход' onclick='saveSignMe()'>";
$appRJ->response['result'].= "</form>";