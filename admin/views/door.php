<?php
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Вход в Admin' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Вход в Admin</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/css/door.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

$appRJ->response['result'].= "<div class='adminDoor'>";

$appRJ->response['result'].= "<form method='post' autocomplete='off'>";
$appRJ->response['result'].= "<h1>Вход в Admin</h1>";
if(isset($_SESSION['groups']['root']) and $_SESSION['groups']['root']===999){
    $appRJ->response['result'].= "<div class='bdUsrPanel'>";
    $appRJ->response['result'].= "Вы: <strong>".$_SESSION['usrLogin']."</strong>";
    $appRJ->response['result'].= "<a href='?cmd=exit' class='exit'>Выход</a>";
    $appRJ->response['result'].= "</div>";
}
if (isset($pageErr) and $pageErr!=null){
    $appRJ->response['result'].= "<div class='pagewarning'>".$pageErr."</div>";
}
$appRJ->response['result'].= "<label for='login'>Login:</label>";
$appRJ->response['result'].= "<input type='text' name='login' value='".$bdLogin."'>";
$appRJ->response['result'].= "<label for='password'>Password:</label>";
$appRJ->response['result'].= "<input type='password' name='password' value='".$bdPassword."'>";
$appRJ->response['result'].= "<div class='btnBlock'>";
$appRJ->response['result'].= "<input type='submit' value='Вход'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";