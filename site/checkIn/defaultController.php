<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/source/captcha_class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/source/requiredFields_class.php');

$captcha = new captcha_class();
$err == false;
$checkCode_err=null;
$inserts_err = null;
$method = "main.php";
$requiredFields['login']['val'] = null;
$requiredFields['login']['err'] = null;
$requiredFields['password']['val'] = null;
$requiredFields['password']['err'] = null;
$requiredFields['eMail']['val'] = null;
$requiredFields['eMail']['err'] = null;
$requiredFields['checkCode']['val'] = null;
$requiredFields['checkCode']['err'] = null;
$requiredFields['password_2']['val'] = null;
$requiredFields['password_2']['err'] = null;
$fieldsErr = false;
$vldCode=null;

if ($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['login'])and $_POST['login']!=null){
        $requiredFields['login']['val'] = $_POST['login'];
        if(!requiredFields::checkLogin($_POST['login'])){
            $requiredFields['login']['err'] = "недопустимый логин";
        }elseif(!requiredFields::findDoubleLogin($_POST['login'], "site")){
            $requiredFields['login']['err'] = "login зарезервирован";
        }
    }else{
        $requiredFields['login']['err'] = "недопустимый логин";
    }
    if(isset($_POST['password'])and $_POST['password']!=null){
        $requiredFields['password']['val'] = $_POST['password'];
        if(!requiredFields::checkPassword($_POST['password'])){
            $requiredFields['password']['err'] = "недопустимый пароль";
        }
    }else{
        $requiredFields['password']['err'] = "недопустимый пароль";
    }
    if(isset($_POST['password_2'])and $_POST['password_2']!=null){
        $requiredFields['password_2']['val'] = $_POST['password_2'];
        if(//$requiredFields['password']['err']==null and
            $requiredFields['password_2']['val']!=$requiredFields['password']['val']){
            $requiredFields['password_2']['err'] = "пароли не совпадают";
        }
    }else{
        $requiredFields['password_2']['err'] = "пароли не совпадают - not set";
    }
    if(isset($_POST['eMail']) and $_POST['eMail']!=null){
        $requiredFields['eMail']['val'] = $_POST['eMail'];
        if(!requiredFields::checkEmail($_POST['eMail'])){
            $requiredFields['eMail']['err'] = "недопустимый eMail";
        }
    }else{
        $requiredFields['eMail']['err'] = "недопустимый eMail";
    }
    if(isset($_POST['checkCode']) and $_POST['checkCode']!=null){
        $requiredFields['checkCode']['val'] = $_POST['checkCode'];
        if($captcha->encryptCheckCode($_POST['checkCode']) !== $_POST['checkCode_crypt']){
            $requiredFields['checkCode']['err'] = "неправильный проверочный код";
        }
    }else{
        $requiredFields['checkCode']['err'] = "неправильный проверочный код";
    }
    foreach($requiredFields as $key=>$val){
        if($requiredFields[$key]['err']!=null){
            $fieldsErr = true;
            break;
        }
    }
    if(!$fieldsErr){
        $letters = array("g","u","q","d","x","f","g","h","k","l","z","x","n","1","2","3","4","5","6","7","8","9","0");
        for($i=0;$i < 16;$i++)
        {
            $vldCode .= $letters[rand(0,sizeof($letters)-1)];
        }
        $RD_users = new recordDefault("users_dt", "user_id");
        $RD_users->result['blackList']=false;
        $RD_users->putOne();
        $RD_accounts = new recordDefault("accounts_dt", "account_id");
        $RD_accounts->result['user_id']=$RD_users->result['user_id'];
        $RD_accounts->result['accLogin']=$requiredFields['login']['val'];
        $RD_accounts->result['accAlias']=$requiredFields['login']['val'];
        $RD_accounts->result['eMail']=$requiredFields['eMail']['val'];
        $RD_accounts->result['pw_salt']=requiredFields::mkSalt();
        $RD_accounts->result['pw_hash']=hash('md5', $requiredFields['password']['val'].$RD_accounts->result['pw_salt']);
        $RD_accounts->result['vldCode']=$vldCode;
        $appRJ->date['curDate'] = @date_create();
        $RD_accounts->result['regDate']=date_format($appRJ->date['curDate'], 'Y-m-d H:i:s');
        $RD_accounts->result['netWork']="site";
        $RD_accounts->result['validDate']=null;
        $RD_accounts->result['birthDay']=null;
        $RD_accounts->putOne();
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/checkIn/views/registrationSuccess.php");
    }else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/checkIn/views/defaultView.php");
    }
}
elseif($_SERVER['REQUEST_METHOD']=="GET" and !empty($_GET)){
    $appRJ->response['format']='ajax';
    if(isset($_GET['captcha']) and $_GET['captcha']=="update"){
        $captchaRes=$captcha->create();
        $arr['image'] = '<img src="data:image/png;base64,'.base64_encode($captchaRes['image']).'" title="проверочный код" />';//."<a href='#captcha_update' id='captcha_update'>Обновить</a>";
        $arr['code']=$captcha->encryptCheckCode($captchaRes['code']);
        $appRJ->response['format']='json';
        $appRJ->response['result'] = $arr;
    }elseif(isset($_GET['vldCode']) and $_GET['vldCode']!=null and isset($_GET['login']) and $_GET['login']!=null){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/checkIn/views/registrationFinish.php");
    }
    elseif (isset($_GET['login'])) {
        if(!requiredFields::checkLogin($_GET['login'])){
            $appRJ->response['result'] = "недопустимый логин";
        }elseif(!requiredFields::findDoubleLogin($_GET['login'], "site")){
            $appRJ->response['result'] = "login зарезервирован";
        }else{
            $appRJ->response['result'] = 'true';
        }
    }
    elseif(isset($_GET['password'])){
        if(!requiredFields::checkPassword($_GET['password'])){
            $appRJ->response['result'] = "недопустимый пароль";
        }else{
            $appRJ->response['result'] = 'true';
        }
    }
    elseif(isset($_GET['eMail'])){
        if ($_GET['eMail']!=null){
            if(!requiredFields::checkEmail($_GET['eMail'])){
                $appRJ->response['result'] = "недопустимый eMail";
            }else{
                $appRJ->response['result'] = 'true';
            }
        }
    }
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/checkIn/views/defaultView.php");
}
?>