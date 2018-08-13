<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/source/_conf/site/socialAuth-ok.php");
$postReq = http_build_query(
    array(
        'code' => $_GET['code'],
        'client_id' => $socialConf['client_id'],
        'client_secret' => $socialConf['client_secret'],
        "redirect_uri" => $socialConf['redirect_uri'],
        "grant_type" => "authorization_code"
    )
);

$opts = array('http' =>
    array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postReq
    )
);

$context = stream_context_create($opts);

$tokenReq = file_get_contents('https://api.ok.ru/oauth/token.do?', false, $context);

$tokenArr = json_decode($tokenReq, true);

if(isset($tokenArr['access_token']) and $tokenArr['access_token']!=null){
    $secret_key = MD5($tokenArr['access_token'] . $socialConf['client_secret']);
    $sig = MD5("application_key=" . $socialConf['application_key'] . "format=jsonmethod=users.getCurrentUser" . $secret_key);

    $usrReq = file_get_contents("https://api.ok.ru/fb.do?application_key=" . $socialConf['application_key'] . "&format=json" .
        "&method=users.getCurrentUser&sig=" . $sig . "&access_token=" . $tokenArr['access_token']);
    $usrArr = json_decode($usrReq, true);

    if(isset($usrArr['uid']) and $usrArr['uid']!=null){
        $RD_accounts->result['netWork'] = 'ok';
        $RD_accounts->result['accLogin']=$usrArr['uid'];
        $RD_accounts->result['accAlias']=$usrArr['name'];
        $RD_accounts->result['photoLink']=$usrArr['pic_2'];
        $RD_accounts->result['birthDay']=$usrArr['birthday'];
        $RD_accounts->result['socProf']='https://ok.ru/profile/'.$usrArr['uid'];
        $socialAuth_err = true;
    }else{
        $validErr=$usrReq;
    }
}else{
    $validErr=$tokenReq;
}




