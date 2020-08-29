<?php
$Cat_rd = array("table" => "srvCat_dt", "field_id" => "srvCat_id");
if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
    $Cat_rd['result']['srvCat_id'] = $_GET['cat_id'];
    $Cat_rd = $DB->copyOne($Cat_rd);
    if(isset($_POST['catName']) and $_POST['catName']!=null){
        $Cat_rd['result']['catName']=htmlspecialchars($_POST['catName']);
    }else{
        $catErr['catName']='недопустимое название категории';
    }
    if(isset($_POST['catAlias']) and $_POST['catAlias']!=null){
        $Cat_rd['result']['catAlias']=htmlspecialchars($_POST['catAlias']);
    }else{
        $catErr['catAlias']='недопустимый alias';
    }
    $Cat_rd['result']['catDescr']=$_POST['catDescr'];
    if(isset($_POST['srvCatPar_id'])){

        if($_POST['srvCatPar_id'] == 'none'){
            $Cat_rd['result']['srvCatPar_id']=null;
        }else{
            $Cat_rd['result']['srvCatPar_id']=$_POST['srvCatPar_id'];
        }
    }else{

    }
    if(isset($_POST['catActive']) and $_POST['catActive']=='on'){
        $Cat_rd['result']['catActive']=true;
    }else{
        $Cat_rd['result']['catActive']=false;
    }
}else{
    $catErr['cat_id']='недопустимое cat_id';
}
if(isset($catErr)){
    $catErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/services/views/srvMan-editCat.php");
}else{
    if($DB->updateOne($Cat_rd)){
        $catErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/services/views/srvMan-editCat.php");
    }else{

        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa-edit";
    }
}