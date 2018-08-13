<?php

$File_rd = new recordDefault("dwlFiles_dt", "dwlFile_id");
if(isset($_GET['file_id']) and $_GET['file_id']!=null){
    $File_rd->result['dwlFile_id'] = $_GET['file_id'];
    $File_rd->copyOne();
    if(isset($_POST['dwlFileName']) and $_POST['dwlFileName']!=null){
        $File_rd->result['dwlFileName']=htmlspecialchars($_POST['dwlFileName']);
    }else{
        $fileErr['fileName']='недопустимое название категории';
    }
    if(isset($_POST['dwlFileAliace']) and $_POST['dwlFileAliace']!=null){
        $File_rd->result['dwlFileAliace']=htmlspecialchars($_POST['dwlFileAliace']);
    }else{
        $fileErr['dwlFileAliace']='недопустимый alias';
    }
    if(isset($_POST['fileVersion']) and $_POST['fileVersion']!=null){
        $File_rd->result['fileVersion']=htmlspecialchars($_POST['fileVersion']);
    }else{
        $File_rd->result['fileVersion']=null;
    }
    if(isset($_POST['fileLicence'])){
        $File_rd->result['fileLicence']=htmlspecialchars($_POST['fileLicence']);
    }else{
        $File_rd->result['fileLicence']=null;
    }
    $File_rd->result['dwlFileDescr']=$_POST['dwlFileDescr'];
    if(isset($_POST['dwlCat_id'])){

        if($_POST['dwlCat_id'] == 'none'){
            $File_rd->result['dwlCat_id']=null;
        }else{
            $File_rd->result['dwlCat_id']=$_POST['dwlCat_id'];
        }
    }else{
        //$catErr['cat_id']='select';
    }
    if(isset($_POST['fileActive_flag']) and $_POST['fileActive_flag']=='on'){
        $File_rd->result['fileActive_flag']=true;
    }else{
        $File_rd->result['fileActive_flag']=false;
    }
}else{
    $fileErr['file_id']='недопустимое file_id';
}
if(isset($fileErr)){
    $fileErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/editFile.php");
}else{
    if($File_rd->updateOne()){
        $fileErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/editFile.php");
    }else{

        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa-edit";
    }
}