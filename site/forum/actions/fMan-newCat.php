<?php

$catErr=null;

$Cat_rd = new recordDefault("subjectsMenu_dt", "subjCat_id");

if(isset($_POST['catName']) and $_POST['catName']!=null){
    //$catName_err =
    $Cat_rd->result['catName']=htmlspecialchars($_POST['catName']);
}else{
    $catErr['catName']='недопустимое название категории';
}

if(isset($_POST['catAlias']) and $_POST['catAlias']!=null){
    $Cat_rd->result['catAlias']=htmlspecialchars($_POST['catAlias']);
}else{
    $catErr['catAlias']='недопустимый alias';
}
if(isset($_POST['catDescr'])){
    $Cat_rd->result['catDescr']=htmlspecialchars($_POST['catDescr']);
}else{
    $Cat_rd->result['catDescr']=null;
}


if(isset($_POST['subjCat_parId'])){

    if($_POST['subjCat_parId'] == 'none'){
        $Cat_rd->result['subjCat_parId']=null;
    }else{
        $Cat_rd->result['subjCat_parId']=$_POST['subjCat_parId'];
    }
}else{
    //$catErr['cat_id']='select';
}
if(isset($_POST['catActive']) and $_POST['catActive']=='on'){
    $Cat_rd->result['catActive']=true;
}else{
    $Cat_rd->result['catActive']=false;
}
//$appRJ->response['result'].= "111<br>";
if(isset($catErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/views/fMan-newCategory.php");
}else{
    //$appRJ->response['result'].= "222<br>";
    if($Cat_rd->putOne()){
        //$appRJ->response['result'].= "333<br>";
        //header("Location: ".)
        $page = "Location: /forum/forumManager/editCat/?cat_id=".$Cat_rd->result['subjCat_id'];
        header($page);
        //$appRJ->response['result'].= $page;
    }else{
        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa";
    }

    //$appRJ->response['result'].= 'all right';
    //exit;
}