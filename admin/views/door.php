<?php
$appRJ->response['result'].= "<html lang='en-Us'>".
    "<head>".
    "<meta  http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='description' content='Вход в Admin'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Вход в Admin</title>".
    "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>".
    "<link rel='stylesheet' href='/admin/css/door.css' type='text/css' media='screen, projection'/>".
    "</head><body>".
    "<div class='adminDoor'>".
    "<form method='post' autocomplete='off'>".
    "<h1>Вход в Admin</h1>";
if(isset($_SESSION['groups']['root']) and $_SESSION['groups']['root']===999){
    $appRJ->response['result'].= "<div class='bdUsrPanel'>Вы: <strong>".$_SESSION['usrLogin']."</strong>".
        "<a href='?cmd=exit' class='exit'>Выход</a></div>";
}
if (isset($pageErr) and $pageErr!=null){
    $appRJ->response['result'].= "<div class='pagewarning'>".$pageErr."</div>";
}
$appRJ->response['result'].= "<label for='login'>Login:</label><input type='text' name='login' value='".$bdLogin."'>".
    "<label for='password'>Password:</label><input type='password' name='password' value='".$bdPassword."'>".
    "<div class='btnBlock'><input type='submit' value='Вход'></div></form>".
    "</div></body></html>";