<?php
$appRJ->response['result'].= "<form class='signIn' method='post' action='/signIn' autocomplete='off'>".
    "<div class='inputLine'>";
if(isset($_COOKIE['login']) and $_COOKIE['login']!=null){
    $appRJ->response['result'].= "<label for='login'>Ваш логин</label>".
        "<input type='text' name='login' value='".$_COOKIE['login']."'>";
}else{
    $appRJ->response['result'].= "<label for='login' class='shown'>Ваш логин</label>".
        "<input type='text' name='login'>";
}
$appRJ->response['result'].= "</div><div class='inputLine'>";
if (isset($_COOKIE['rememberMe']) and $_COOKIE['rememberMe']=='on' and isset($_COOKIE['password'])
    and $_COOKIE['password']!=null){
    $appRJ->response['result'].= "<label for='password'>Ваш пароль</label>".
        "<input type='password' name='password' value='".$_COOKIE['password']."'>";
}else{
    $appRJ->response['result'].= "<label for='password'  class='shown'>Ваш пароль</label>".
        "<input type='password' name='password' value=''>";
}
$appRJ->response['result'].= "</div><div class='inputLine rememberMe'><label for='rememberMe'>Запомнить</label>".
    "<input type='checkbox' name='rememberMe' ";
if (isset($_COOKIE['rememberMe']) and $_COOKIE['rememberMe']=='on'){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div><div class='pageErr'>".$validErr."</div>".
    "<div class='inputLine submit'><input type='submit' value='Вход' onclick='signIn()'></div></form>";