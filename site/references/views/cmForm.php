<?php
if($_SESSION['user_id']){
    $tmpRes['text'].= "<hr>".
        "<span class='com-wrCm' id='com_' style='margin-left: 2%;' onclick='newAnsw(null)'>Написать отзыв</span>".
        "<form class='cmForm '><h4><img src='".$_SESSION['photoLink']."'><span>Ваш отзыв:</span></h4>".
        "<div class='cfForm-err'></div><input type='hidden' name='newComPar_id' value=''><div class='cmForm-area'>".
        "<textarea name='yCm' id='yCm'></textarea></div><div class='cfForm-cp ta-right'>".
        "<input type='button' value='Написать' onclick='writeCom(".'"new"'.")'></div></form>";
}else{
    $authRefAnimate_val="Вы сможете написать отзыв и поставить оценку";
    require_once($_SERVER['DOCUMENT_ROOT']."/site/signIn/views/authRefAnimate.php");
    $tmpRes['text'].=$authRefAnimate_txt;
}