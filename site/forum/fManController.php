<?php
if($_POST){
    //require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
    if(isset($_POST['flagField']) and $_POST['flagField']=='newCat'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/actions/fMan-newCat.php");
    }
    elseif(isset($_POST['flagField']) and $_POST['flagField']=='newSubject'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/actions/fMan-newSubject.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editSubjDescr'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/actions/fMan-editSubjDescr.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editCat') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-editCat_post.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='editSubject') {
        //print_r($_POST);
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-editSubj_post.php");
    }elseif (isset($_POST['cat_id']) and $_POST['cat_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-editCatImg.php");
    }elseif (isset($_POST['subj_id']) and $_POST['subj_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-editSubjImg.php");
    }/*elseif (isset($_POST['file_id']) and $_POST['file_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/actions/dwlMan-editFileImg.php");
    }elseif (isset($_POST['addNewLink']) and $_POST['addNewLink']=='yyy'){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/newLink.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/refList.php");
    }
    else{

    }
*/
}elseif (isset($_GET['delCatImg']) and $_GET['delCatImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-delCatImg.php");
}elseif (isset($_GET['delSubjImg']) and $_GET['delSubjImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/actions/fMan-delSubjImg.php");
}elseif (isset($_GET['mkAlias'])){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/source/accessorial_class.php");
    $appRJ->response['result'].= accessorialClass::mkAlias($_GET['mkAlias']);
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newcat"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-newCategory.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newsubject"){
    //$appRJ->response['result'].= "new subject here";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-newSubject.php");
}

elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editcat"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/actions/fMan-editCat_get.php");
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editsubject"){
    $subjErr=null;
    $subjSelectOptions=null;
    if(isset($_GET['subj_id']) and $_GET['subj_id']!=null){
        //require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
        $Subj_rd = new recordDefault("subjects_dt", "subject_id");
        $Subj_rd->result['subject_id']=$_GET['subj_id'];
        if($Subj_rd->copyOne()){
            if(!$appRJ->server['reqUri_expl'][4]){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/forum/views/fMan-editSubj.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'descr'){


                $Descr_rd = new recordDefault('subjectsDescr_dt', 'subject_id');
                $Descr_rd->result['subject_id']=$Subj_rd->result['subject_id'];
                $Descr_rd->copyOne();

                 require_once ($_SERVER['DOCUMENT_ROOT']."/site/forum/views/fMan-editSubjDescr.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'images'){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/forum/views/fMan-editSubjImages.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'access'){

                require_once ($_SERVER['DOCUMENT_ROOT']."/site/forum/views/fMan-editSubjAccess.php");

                $appRJ->response['result'].= "access here";
            }
        }else{
            $appRJ->response['result'].= "неправильные параметры запроса subj_id";
            exit;
        }
    }else{
        $appRJ->response['result'].= "zzz";
        exit;
    }
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="subjects"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-subjects.php");
}else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-defaultView.php");
}

