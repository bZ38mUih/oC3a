<?php
$catErr=null;
$Cat_rd = array("table" => "srvCat_dt", "field_id" => "srvCat_id");
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
if(isset($_POST['catDescr'])){
    $Cat_rd['result']['catDescr']=htmlspecialchars($_POST['catDescr']);
}else{
    $Cat_rd['result']['catDescr']=null;
}
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
if(isset($catErr)){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/services/views/srvMan-newCat.php");
}else{
    if($Cat_rd->putOne()){
        $page = "Location: /services/srvMan/cats/editCat/?cat_id=".$Cat_rd['result']['srvCat_id'];
        header($page);
    }else{
        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa";
    }
}