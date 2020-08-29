<?php

$catErr=null;

$Cat_rd = array("table" => "forumMenu_dt", "field_id" => "fm_id");

if(isset($_POST['mName']) and $_POST['mName']!=null){
    $Cat_rd['result']['mName']=htmlspecialchars($_POST['mName']);
}else{
    $catErr['mName']='недопустимое название категории';
}

if(isset($_POST['mAlias']) and $_POST['mAlias']!=null){
    $Cat_rd['result']['mAlias']=htmlspecialchars($_POST['mAlias']);
}else{
    $catErr['mAlias']='недопустимый alias';
}
if(isset($_POST['mDescr']) and $_POST['mDescr']!=null){
    $Cat_rd['result']['mDescr']=htmlspecialchars($_POST['mDescr']);
}else{
    $catErr['mDescr']='недопустимое описание';
}

if(isset($_POST['fm_pid'])){

    if($_POST['fm_pid'] == 'none'){
        $Cat_rd['result']['fm_pid']=null;
    }else{
        $Cat_rd['result']['fm_pid']=$_POST['fm_pid'];
    }
}else{

}
if(isset($_POST['mActive']) and $_POST['mActive']=='on'){
    $Cat_rd['result']['mActive']=true;
}else{
    $Cat_rd['result']['mActive']=false;
}
if(isset($_POST['robIndex']) and $_POST['robIndex']=='on'){
    $Cat_rd['result']['robIndex']=true;
}else{
    $Cat_rd['result']['robIndex']=false;
}

if(isset($catErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-newCategory.php");
}else{
    if($Cat_rd->putOne()){
        $page = "Location: /forum/forummanager/editCat/?fm_id=".$Cat_rd['result']['fm_id'];
        header($page);
    }else{
        $appRJ->errors["XXX"]["description"]="insert into forumMenu err";
    }
}