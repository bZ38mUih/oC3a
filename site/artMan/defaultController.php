<?php
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    if($_POST){
        if(isset($_POST['flagField']) and $_POST['flagField']=='newCat'){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-newCat_post.php");
        }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editArt'){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-editArt_post.php");
        }elseif(isset($_POST['flagField']) and $_POST['flagField']=='newArt'){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-newArt_post.php");
        }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editCat') {
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-editCat_post.php");
        }elseif (isset($_POST['cat_id']) and $_POST['cat_id']!==null){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-edtitCatImg.php");
        }elseif (isset($_POST['art_id']) and $_POST['art_id']!==null){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-editArtImg.php");
        }elseif (isset($_POST['addNewLink']) and $_POST['addNewLink']=='yyy'){
            $appRJ->response['format']='ajax';
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/actions/artMan-newRef.php");
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-refList.php");
        }elseif (isset($_POST['dest']) and $_POST['dest']!=null){
            $appRJ->response['format']='ajax';
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-putFile.php");
        }
    }
    elseif (isset($_GET['delRef']) and $_GET['delRef']!=null){
        $appRJ->response['format']='ajax';
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/actions/artMan-delLink.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-refList.php");
    }
    elseif (isset($_GET['delCatImg']) and $_GET['delCatImg']!=null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-delCatImg.php");
    }elseif (isset($_GET['delArtImg']) and $_GET['delArtImg']!=null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/actions/artMan-delArtImg.php");
    }
    elseif(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
        if(strtolower($appRJ->server['reqUri_expl'][2])=="categories"){
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artMan-categories.php");
        }
        elseif(strtolower($appRJ->server['reqUri_expl'][2])=="newcat"){
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artMan-newCat.php");
        }elseif(strtolower($appRJ->server['reqUri_expl'][2])=="newart"){
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artMan-newArt.php");
        }elseif(isset($appRJ->server['reqUri_expl'][2]) and strtolower($appRJ->server['reqUri_expl'][2])=="editcat"){
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/actions/artMan-editCat_get.php");
        }elseif(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] =="editArt"){
            $artErr=null;
            $catSelect=null;
            if(isset($_GET['art_id']) and $_GET['art_id']!=null){
                $Art_rd = array("table" => "art_dt", "field_id" => "art_id");
                $Art_rd['result']['art_id']=$_GET['art_id'];
                if($Art_rd = $DB->copyOne($Art_rd)){
                    if(!$appRJ->server['reqUri_expl'][3]){
                        require_once ($_SERVER['DOCUMENT_ROOT']."/site/artMan/views/artMan-editArt.php");
                    }
                    elseif (isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] == 'content'){
                        require_once ($_SERVER['DOCUMENT_ROOT']."/site/artMan/views/artMan-editArtContent.php");
                    }elseif (isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] == 'ref'){
                        require_once ($_SERVER['DOCUMENT_ROOT']."/site/artMan/views/artMan-editArtRef.php");
                    }
                }else{
                    $appRJ->errors['request']['description']="неправильные параметры art_id";
                }
            }else{
                $appRJ->errors['request']['description']="не задан art_id";
            }
        }elseif(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] =="preview"){
            if(isset($_GET['art_id']) and $_GET['art_id']!=null){
                $Art_rd = array("table" => "art_dt", "field_id" => "art_id");
                $Art_rd['result']['art_id'] = $_GET['art_id'];
                if($Art_rd = $DB->copyOne($Art_rd)){
                    require_once ($_SERVER['DOCUMENT_ROOT']."/site/artMan/views/artMan-preview.php");
                }else{
                    $appRJ->errors['request']['description']="неправильные параметры art_id";
                }
            }else{
                $appRJ->errors['request']['description']="не задан art_id";
            }
        }
    }
    else{
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/artMan/views/artMan-defaultView.php");
    }
}else{
    $appRJ->errors['access']['description']="у вас нет прав доступа";
}