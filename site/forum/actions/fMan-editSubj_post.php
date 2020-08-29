<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/source/accessorial_class.php");
$Subj_rd = array("table" => "forumSubj_dt", "field_id" => "fs_id");
if(isset($_GET['fs_id']) and $_GET['fs_id']!=null){
    $Subj_rd['result']['fs_id'] = $_GET['fs_id'];
    $Subj_rd->copyOne();
    if(isset($_POST['sName']) and $_POST['sName']!=null){
        $Subj_rd['result']['sName']=htmlspecialchars($_POST['sName']);
    }else{
        $subjErr['sName']='недопустимое название альбома';
    }
    if(isset($_POST['sAlias']) and $_POST['sAlias']!=null){
        if($Subj_rd['result']['sAlias']!=htmlspecialchars($_POST['sAlias'])){
            $Subj_rd['result']['sAlias']=htmlspecialchars($_POST['sAlias']);
            if(!accessorialClass::checkDouble("forumSubj_dt", "sAlias", $Subj_rd['result']['sAlias'])){
                $subjErr['sAlias']='недопустимый alias - double ';
            }
        }
    }else{
        $subjErr['sAlias']='недопустимый alias - null';
    }
    $Subj_rd['result']['metaDescr']=htmlspecialchars($_POST['metaDescr']);
    if(isset($_POST['fm_id'])){
        if($_POST['fm_id'] == 'none'){
            $Subj_rd['result']['fm_id']=null;
        }else{
            $Subj_rd['result']['fm_id']=$_POST['fm_id'];
        }
    }
    if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
        $Subj_rd['result']['activeFlag']=true;
    }else{
        $Subj_rd['result']['activeFlag']=false;
    }
    if(isset($_POST['robIndex']) and $_POST['robIndex']=='on'){
        $Subj_rd['result']['robIndex']=true;
    }else{
        $Subj_rd['result']['robIndex']=false;
    }
    if(isset($_POST['dateOfCr']) and $_POST['dateOfCr']!=null){
        $Subj_rd['result']['dateOfCr']=$_POST['dateOfCr'];
    }
}else{
    $subjErr['album_id']='недопустимое alb_id';
}
if(isset($subjErr)){
    $subjErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-editSubj.php");
}else{
    if($Subj_rd->updateOne()){
        $subjErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-editSubj.php");
    }else{
        $appRJ->errors['XXX']['description']="ошибка не обработана: insert into forumSubj error";
    }
}