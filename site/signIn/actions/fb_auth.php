<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/source/_conf/site/socialAuth-fb.php");
$tokenReq = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=".$socialConf['client_id'].
"&redirect_uri=".$socialConf["redirect_uri"]."&client_secret=".$socialConf['client_secret']."&code=".$_GET['code']);
$tokenArr = json_decode($tokenReq, true);
if(isset($tokenArr["access_token"]) and $tokenArr["access_token"]!=null){
    $usrReq=file_get_contents("https://graph.facebook.com/me?access_token=".$tokenArr["access_token"].
        "&fields=id,first_name,last_name,link,email,gender,birthday,picture.width(60).height(60)");
    $usrArr = json_decode($usrReq, true);
    if(isset($usrArr["id"]) and $usrArr["id"]!=null){
        $RD_accounts['result']['netWork']="fb";
        $RD_accounts['result']['accLogin']=$usrArr['id'];
        $RD_accounts['result']['accAlias']=$usrArr['first_name']." ".$usrArr['last_name'];
        $RD_accounts['result']['photoLink']=$usrArr['picture']['data']['url'];
        $RD_accounts['result']['socProf']=$usrArr['link'];
        $socialAuth_err = true;
    }else{
        $validErr=$usrReq;
    }
}else{
    $validErr=$tokenReq;
}