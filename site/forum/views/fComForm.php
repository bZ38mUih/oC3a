<?php
if($_SESSION['user_id']){
    $tmpRes['text'].= "<hr>".
        "<span class='com-wrCm' id='com_' style='margin-left: 2%;' onclick='newAnsw(null)'>Ваш ответ:</span>".
        "<form class='cmForm '><h4>Новый коммент:</h4><div class='cfForm-err'></div>".
        "<input type='hidden' name='fc_pid' value=''><div class='cmForm-area'>".
        "<input type='hidden' name='fs_id' value='".$fs_id."'><div class='cmForm-area'>".
        "<textarea name='fCm' id='fCm'></textarea></div><div class='cfForm-cp ta-right'>".
        "<input type='button' value='Написать' onclick='writeCom(".'"new"'.")'></div></form>";
}else{
    $tmpRes['text'].= "<a href='/signIn' class='signIn ta-left'><img src='/site/signIn/img/logo.png'>Авторизуйтесь".
        " для написания комментов</a>";
}