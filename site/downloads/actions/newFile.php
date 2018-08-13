<?php

$fileErr=null;

$File_rd = new recordDefault("dwlFiles_dt", "dwlFile_id");

if(isset($_POST['dwlFileName']) and $_POST['dwlFileName']!=null){
    $File_rd->result['dwlFileName']=htmlspecialchars($_POST['dwlFileName']);
}else{
    $fileErr['dwlFileName']='недопустимое название категории';
}

if(isset($_POST['dwlFileAliace']) and $_POST['dwlFileAliace']!=null){
    $File_rd->result['dwlFileAliace']=htmlspecialchars($_POST['dwlFileAliace']);
}else{
    $fileErr['dwlFileAliace']='недопустимый alias';
}
if(isset($_POST['dwlFileDescr'])){
    $File_rd->result['dwlFileDescr']=htmlspecialchars($_POST['dwlFileDescr']);
}else{
    $File_rd->result['dwlFileDescr']=null;
}
if(isset($_POST['fileVersion'])){
    $File_rd->result['fileVersion']=htmlspecialchars($_POST['fileVersion']);
}else{
    $File_rd->result['fileVersion']=null;
}
if(isset($_POST['fileLicence'])){
    $File_rd->result['fileLicence']=htmlspecialchars($_POST['fileLicence']);
}else{
    $File_rd->result['fileLicence']=null;
}


if(isset($_POST['dwlCat_id'])){

    if($_POST['dwlCat_id'] == 'none'){
        $File_rd->result['dwlCat_id']=null;
    }else{
        $File_rd->result['dwlCat_id']=$_POST['dwlCat_id'];
    }
}else{

}

if(isset($_POST['fileActive_flag']) and $_POST['fileActive_flag']=='on'){
    $File_rd->result['fileActive_flag']=true;
}else{
    $File_rd->result['fileActive_flag']=false;
}
if(isset($fileErr)){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/newFile.php");
}else{
    if($File_rd->putOne()){
        $page = "Location: /downloads/dwlManager/editFile/?file_id=".$File_rd->result['dwlFile_id'];
        header($page);
    }else{
        $appRJ->response['result'].= "444-files<br>";
    }
}