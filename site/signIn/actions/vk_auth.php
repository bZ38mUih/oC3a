<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/source/_conf/site/socialAuth-vk.php");
$tokenReq=file_get_contents("https://oauth.vk.com/access_token?client_id=".$socialConf['client_id']
    ."&client_secret=".$socialConf['client_secret']."&redirect_uri=".$socialConf['redirect_uri']."&code=".$_GET['code']);
$tokenArr=json_decode($tokenReq, true);

file_put_contents($_SERVER["DOCUMENT_ROOT"]."/temp/vk_redir.txt", json_encode($_SERVER, true));

if(isset($tokenArr['access_token']) and $tokenArr['access_token']!=null){
    $usrReq = @file_get_contents('https://api.vk.com/method/users.get?user_ids='. $tokenArr['user_id'].
        "&fields=photo_100,bdate&v=5.80&access_token=".$tokenArr['access_token']);
    $usrArr = json_decode($usrReq, true);
    if($usrArr!=null and isset($usrArr['response']['0']['id']) and $usrArr['response']['0']['id']!=null){
        $RD_accounts->result['netWork']="vk";
        $RD_accounts->result['accLogin']=$usrArr['response']['0']['id'];
        $RD_accounts->result['accAlias']=$usrArr['response']['0']['first_name']." ".$usrArr['response']['0']['last_name'];
        $RD_accounts->result['photoLink']=$usrArr['response']['0']['photo_100'];
        $RD_accounts->result['birthDay']=date_format(date_create($usrArr['response']['0']['bdate']), 'Y-m-d');
        $RD_accounts->result['socProf']='https://vk.com/id'.$usrArr['response']['0']['id'];
        $socialAuth_err = true;
    }else{
        $validErr=$usrReq;
    }
}else{
    $validErr=$tokenReq;
}