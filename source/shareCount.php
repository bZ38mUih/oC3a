<?php
$fbResp = json_decode(file_get_contents("https://graph.facebook.com/?fields=og_object{likes.summary(total_count).limit(0)},share&id=http://"
    .$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL']), true);
$appRJ->response['result']['fb']=$fbResp['share']['share_count'];

$okResp = json_decode(file_get_contents("https://connect.ok.ru/dk?st.cmd=extLike&tp=json&ref=http://"
    .$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL']), true);
$appRJ->response['result']['ok']=$okResp['count'];

$vkResp = file_get_contents("http://vk.com/share.php?act=count&url=http://".$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL']);
$numSym = strpos($vkResp, ',');
$appRJ->response['result']['vk'] = substr($vkResp, $numSym+1, strlen($vkResp)-2-$numSym-1);