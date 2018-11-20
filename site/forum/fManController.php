<?php
//require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-defaultView.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/source/accessorial_class.php");
if($_POST){
    if(isset($_POST['flagField']) and $_POST['flagField']=='newCat'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/actions/fMan-newCat.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='newSubject'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/actions/fMan-newSubject.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='sDescr'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/actions/fMan-editSubjDescr.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editCat') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-editCat_post.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editSubj') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-editSubj_post.php");
    }elseif (isset($_POST['fm_id']) and $_POST['fm_id']!==null and !isset($_POST['flagField'])){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-editCatImg.php");
    }elseif (isset($_POST['forumS_id']) and $_POST['forumS_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-editSubjImg.php");
    }
    else{
        $appRJ->errors['request']['description']="неправильные параметры запроса _POST";
    }
}elseif (isset($_GET['delCatImg']) and $_GET['delCatImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-delCatImg.php");
}elseif (isset($_GET['delSubjImg']) and $_GET['delSubjImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-delSubjImg.php");
}/*elseif (isset($_GET['mkAlias'])){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/source/accessorial_class.php");
    $appRJ->response['result'].= accessorialClass::mkAlias($_GET['mkAlias']);
}*/elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newcat"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-newCategory.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newsubject"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-newSubject.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editcat"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/actions/fMan-editCat_get.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editsubject"){
    $subjErr=null;
    $subjSelectOptions=null;
    if(isset($_GET['fs_id']) and $_GET['fs_id']!=null){
        $Subj_rd = new recordDefault("forumSubj_dt", "fs_id");
        $Subj_rd->result['fs_id']=$_GET['fs_id'];
        if($Subj_rd->copyOne()){

            if(!$appRJ->server['reqUri_expl'][4]){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/forum/views/fMan-editSubj.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'description'){
                /*
                if($_POST["sDescr"]){
                    echo "xyi";
                    exit;
                }else{

                }
                */
                require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-editSubjDescr.php");
            }/*
            elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'photo'){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-photoAttachments.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'access'){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-editAlbumAccess.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'remove'){
                if (isset($_GET['delLikes']) and $_GET['delLikes']=='yyy'){
                    $appRJ->response['format']='ajax';
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-rmPhotoLikes.php");
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-delAlb-form.php");
                }elseif (isset($_GET['delPhotos']) and $_GET['delPhotos']=='yyy'){
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-rmPhotos.php");
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-delAlb-form.php");
                }elseif (isset($_GET["delAlbum"]) and $_GET["delAlbum"]=='yyy'){
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-rmAlbum.php");
                    if(!$rmRes){
                        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-delAlb-form.php");
                    }else{
                        $Alb_rd->removeOne();
                        $appRJ->response['result'].="<span class='results success'>Удаление успешно</span>";
                    }
                }
                else{
                    require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-removeAlb.php");
                }
            }*/


        }else{
            $appRJ->errors['request']['description']="неправильные параметры запроса fs_id";
        }
    }else{
        $appRJ->errors['request']['description']="неправильные параметры запроса null fs_id";
    }
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="subjects"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-subjects.php");
}else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-defaultView.php");
}