<?php
if($_SESSION['user_id']){
    $tmpRes['text'].= "<hr>".
        "<span class='com-wrCm' id='com_' style='margin-left: 2%;' onclick='newAnsw(null)'>Написать отзыв</span>".
        "<form class='cmForm'><h4>Ваш отзыв:</h4><div class='cfForm-err'></div>".
        "<input type='hidden' name='newComPar_id' value=''><div class='cmForm-area'>".
        "<textarea name='yCm' id='yCm'></textarea></div><div class='cfForm-cp'>".
        "<input type='button' value='Написать' onclick='writeCom(".'"new"'.")'></div></form>";
}else{
    $tmpRes['text'].= "<a href='/signIn' class='signIn'><img src='/site/signIn/img/logo.png'>Авторизуйтесь".
        " для написания отзыва</a>";
}