<?php
if($_SESSION['user_id']){
    $tmpRes['text'].= "<hr>".
        "<span class='com-wrCm' id='com_' style='margin-left: 2%; display: none' onclick='newAnsw(null)'>Новый коммент:</span>".
        "<form class='cmForm '><h4><img src='".$_SESSION['photoLink']."'>".
        "<span>Новый коммент:</span></h4><div class='cfForm-err'></div>".
        "<input type='hidden' name='artCm_pid' value=''>".
        "<input type='hidden' name='art_id' value='".$art_id."'><div class='cmForm-area'>".
        "<textarea name='artCm' id='artCm'></textarea></div><div class='cfForm-cp ta-right'>".
        "<input type='button' value='Написать' onclick='writeCom(".'"new"'.")'>";
    if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
        $tmpRes['text'].="<input type='button' value='Переписать' onclick='rewriteCom(".'"new"'.")'>";
    }
    $tmpRes['text'].="</div></form>";
}else{
    $authRefAnimate_val="Вы сможете написать коммент";
    require_once($_SERVER['DOCUMENT_ROOT']."/site/signIn/views/authRefAnimate.php");
    $tmpRes['text'].=$authRefAnimate_txt;
}