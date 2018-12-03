<?php
$tmpCm.="<img src='/source/img/like-btn.png' onclick='setLike(" .'"'.$slCm_row['fc_id'].'", "likePlus"'.")'>".
    "<span class='likePlus'>+".$slCm_row['likePlus']."</span>".
    "<img src='/source/img/dislike-btn.jpg' onclick='setLike(" .'"'.$slCm_row['fc_id'].'", "likeMinus"'.")'>".
    "<span class='likeMinus'>-".$slCm_row['likeMinus']."</span>";