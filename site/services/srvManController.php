<?php
if($_POST){
    if(isset($_POST['flagField']) and $_POST['flagField']=='newCat'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/services/actions/srvMan-newCat.php");
    }if(isset($_POST['flagField']) and $_POST['flagField']=='newCard'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/services/actions/srvMan-newCard.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editCat') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-editCat.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editFile') {
        //require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/editFile_post.php");
    }elseif (isset($_POST['cat_id']) and $_POST['cat_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-editCatImg.php");
    }/*elseif (isset($_POST['file_id']) and $_POST['file_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/dwlMan-editFileImg.php");
    }elseif (isset($_POST['addNewLink']) and $_POST['addNewLink']=='yyy'){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/newLink.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/refList.php");
    }
    else{

    }*/
}/*elseif (isset($_GET['delFileImg']) and $_GET['delFileImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/delFileImg.php");
}*/elseif (isset($_GET['delCatImg']) and $_GET['delCatImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-delCatImg.php");
}elseif (isset($_GET['delRef']) and $_GET['delRef']!=null){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/delLink.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/refList.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="newService"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/services/views/srvMan-newService.php");
}/*elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editcat"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/editCat_get.php");
}*/elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="editCard"){
    $cardErr=null;
    if(isset($_GET['card_id']) and $_GET['card_id']!=null){
        $Card_rd = new recordDefault("srvCards_dt", "card_id");
        $Card_rd->result['card_id']=$_GET['card_id'];
        if($Card_rd->copyOne()){
            if(!$appRJ->server['reqUri_expl'][4]){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/services/views/srvMan-editCard.php");
            }
        }else{
            $appRJ->errors['404']['description']='неправильные параметры запроса card_id';
        }


    }else{
        $appRJ->errors['404']['description']='неправильные параметры запроса card_id NULL';
    }
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="cats"){
    if(!$appRJ->server['reqUri_expl'][4]){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/services/views/srvMan-Cat.php");
    }elseif ($appRJ->server['reqUri_expl'][4]=='newCat'){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/services/views/srvMan-newCat.php");
    }elseif ($appRJ->server['reqUri_expl'][4]=='editCat'){
        $catErr=null;
        $catSelectOptions=null;
        if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
            $Cat_rd = new recordDefault("srvCat_dt", "srvCat_id");
            $Cat_rd->result['srvCat_id']=$_GET['cat_id'];
            if($Cat_rd->copyOne()){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/services/views/srvMan-editCat.php");
            }else{
                $appRJ->response['result'].= "неправильные параметры запроса cat_id";
            }
        }else{
            $appRJ->errors['404']['description']='неправильные параметры запроса cat_id NULL';
        }

    }
    //require_once($_SERVER["DOCUMENT_ROOT"] . "/site/downloads/views/filesView.php");
}/*elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newfile"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/newFile.php");
}*/else{
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-dflt.php");
}