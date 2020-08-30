<?php
if(isset($_POST['addAdmUsrFlag']) and $_POST['addAdmUsrFlag']==='y'){
    $addUsrRes['result']=false;
    $addUsrRes['log']=null;
    require_once ($_SERVER["DOCUMENT_ROOT"]."/source/accessorial_class.php");
    $checkAdmUseName=false;
    $checkAdmUsePass=false;

    if(isset($_POST['newUsrName'])and $_POST['newUsrName']!=null){
        $checkAdmUseName = accessorialClass::checkLogin($_POST['newUsrName']);
    }

    if(isset($_POST['newUsrPass'])and $_POST['newUsrPass']!=null){
        $checkAdmUsePass = accessorialClass::checkPassword($_POST['newUsrPass']);
    }

    if($checkAdmUseName and $checkAdmUsePass){
        $bdUsers=json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/source/_conf/admin/adminUsers.php"), true);
        $findDoubleUsr=false;
        foreach ($bdUsers as $usr=>$pw){
            if($usr==$_POST['newUsrName'])
            {
                $findDoubleUsr=true;
                break;
            }
        }
        if($findDoubleUsr){
            $addUsrRes['log']='логин зарезервирован';
        }else{
            $bdUsers[$_POST['newUsrName']]=crypt($_POST['newUsrPass']);
            if(file_put_contents($_SERVER["DOCUMENT_ROOT"]."/source/_conf/admin/adminUsers.php",
                json_encode($bdUsers, true))){
                $addUsrRes['result']=true;
                $addUsrRes['log']='удачно';
            }else{
                $addUsrRes['log']='сохранение неудачно';
            }

        }
    }else{
        if(!$checkAdmUseName){
            $addUsrRes['log'].="недопустимый логин<br>";
        }
        if(!$checkAdmUseName){
            $addUsrRes['log'].="недопустимый пароль<br>";
        }
    }

    $appRJ->response['format']='json';
    $appRJ->response['result'] = $addUsrRes;
}elseif (isset($_GET['action']) and $_GET['action']=='refreshUsers'){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/adminUsers/views/usersList.php");
}elseif (isset($_GET["dropUser"]) and $_GET["dropUser"]!=null){
    $bdUsers=json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/source/_conf/admin/adminUsers.php"), true);
    unset($bdUsers[$_GET["dropUser"]]);
    if(file_put_contents($_SERVER["DOCUMENT_ROOT"]."/source/_conf/admin/adminUsers.php",
        json_encode($bdUsers, true))){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/adminUsers/views/usersList.php");
    }else{
        $appRJ->response['result'].= 'удаление неудачно';
    }
}
else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/adminUsers/views/defaultView.php");
}
