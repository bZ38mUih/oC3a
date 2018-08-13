<?php
if($_SESSION['user_id']){
    $tmpRes['text'].= "<hr>";
    $tmpRes['text'].= "<span class='com-wrCm' id='com_' style='margin-left: 2%;' onclick='newAnsw(null)'>Написать отзыв</span>";
    $tmpRes['text'].= "<form class='cmForm'>";
    $tmpRes['text'].= "<h4>Ваш отзыв:</h4>";
    $tmpRes['text'].= "<div class='cfForm-err'>";
    $tmpRes['text'].= "</div>";
    $tmpRes['text'].= "<input type='hidden' name='newComPar_id' value=''>";

    $tmpRes['text'].= "<div class='cmForm-area'>";
    $tmpRes['text'].= "<textarea name='yCm' id='yCm'></textarea>";
    $tmpRes['text'].= "</div>";
    $tmpRes['text'].= "<div class='cfForm-cp'>";


    $tmpRes['text'].= "<input type='button' value='Написать' onclick='writeCom(".'"new"'.")'>";
    $tmpRes['text'].= "</div>";
    $tmpRes['text'].= "</form>";

}else{
    $tmpRes['text'].= "<a href='/signIn' class='signIn'><img src='/site/signIn/img/logo.png'>Авторизуйтесь для написания отзыва</a>";
}