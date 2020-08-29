<?php
$appRJ->response['result'].= "<form class='signIn' action='/signIn/' method='post' autocomplete='off'>".
    "<span class='alerts warning'>".$required_fields['result']['login']['err']."</span>".
    "<span class='alerts warning'>".$required_fields['result']['pw']['err']."</span>".
    "<label for='usrLogin'  class='shown'>";
if (isset($_COOKIE['usrLogin']) and ($_COOKIE['usrLogin']!=null)){

}else{
    $appRJ->response['result'].= "Ваш логин";
}
$appRJ->response['result'].= "</label>".
    "<input type='text' name='usrLogin' value='" .$_COOKIE['usrLogin']."'>".
    "<label for='usrPassword' class='shown'>";
if (isset($_COOKIE['usrPassword']) and ($_COOKIE['usrPassword']!=null)){

}else{
    $appRJ->response['result'].= "Ваш пароль";
}
$appRJ->response['result'].= "</label>".
    "<input type='password' name='usrPassword' value='" .$_COOKIE['usrPassword']."'>".
    "<input type='checkbox' name='rememberMe' ";
if ($_COOKIE['rememberMe']=="on") {
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">".
    "<label for='rememberMe' title='запомнить пароль'>запомнить".
    "<input type='submit' value='Вход' onclick='saveSignMe()'></form>";