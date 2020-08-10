<?php
$adminModule = null;

require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/modules_conf.php");

if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    $adminModule=$appRJ->server['reqUri_expl'][2];
}

require_once($_SERVER["DOCUMENT_ROOT"]."/source/DB_class.php");
$connResult = false;
$connErr = null;
$connSettings=json_decode(@file_get_contents($_SERVER["DOCUMENT_ROOT"].$pathToConn), true);
try {
    $DB=new DB($pathToConn);
    $connResult = true;
} catch (Exception $e) {
    $connErr = $e->getMessage();
}

if((isset($_POST['login']) and $_POST['login']!=null) or (isset($_POST['password'])and $_POST['password']!=null)){
    $bdLogin=null;
    $bdPassword=null;
    $postErr=null;
    $bdLogin=$_POST['login'];
    $bdPassword=$_POST['password'];
    $bdUsers=json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/source/_conf/admin/adminUsers.php"));
    foreach ($bdUsers as $usr=>$pw){
        if($bdLogin==$usr and hash_equals($pw, crypt($bdPassword, $pw)))
        {
            $_SESSION['groups']['root']=999;
            $_SESSION['adminAlias']=$bdLogin;;
            $page = "Location: /admin/";
            header($page);
        }
    }
    $pageErr='неправильный логин или пароль';
}

if(isset($_SESSION['groups']['root']) and $_SESSION['groups']['root']>10){
    $sModRes=false;
    $moduleExist=false;
    if(is_null($adminModule)){
        //$sModRes = true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/admin/views/startView.php");
        //exit;
    }else{
        foreach ($adminModules as $key=>$value){
            if($adminModules[$key]['active']==true and $key == $adminModule){
                $moduleExist=true;
                if ($connResult){
                    $sModRes=true;
                }elseif($key=="server" or $key=="adminUsers"){
                    $sModRes=true;
                }elseif($key=='sql' and $DB->connectServer()){
                    $sModRes=true;
                }
                if($sModRes===true){
                    break;
                }
            }
        }
        if($sModRes){
            require_once($_SERVER['DOCUMENT_ROOT']."/admin/".$adminModule."/".$adminModule."Controller.php");
        }elseif($moduleExist){
            $appRJ->errors['connection']['description'] = "невозможно без подключения к базе данных";
        }else{
            $appRJ->errors['404']['description']='controller "'.$adminModule.'" not found';
        }
    }
}else{
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/views/door.php");
}