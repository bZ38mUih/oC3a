<?php
$Cat_rd = array("table" => "galleryMenu_dt", "field_id" => "glCat_id");
if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
    $Cat_rd['result']['glCat_id'] = $_GET['cat_id'];
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
    if(isset($_POST['catDescr']) and $_POST['catDescr']!=null){
        $Cat_rd['result']['catDescr']=htmlspecialchars($_POST['catDescr']);
    }else{
        $catErr['catDescr']='недопустимое описание';
    }
    if(isset($_POST['glCat_parId'])){
        if($_POST['glCat_parId'] == 'none'){
            $Cat_rd['result']['glCat_parId']=null;
        }else{
            $Cat_rd['result']['glCat_parId']=$_POST['glCat_parId'];
        }
    }
    if(isset($_POST['catActive']) and $_POST['catActive']=='on'){
        $Cat_rd['result']['catActive']=true;
    }else{
        $Cat_rd['result']['catActive']=false;
    }
    if(isset($_POST['catIndex']) and $_POST['catIndex']=='on'){
        $Cat_rd['result']['catIndex']=true;
    }else{
        $Cat_rd['result']['catIndex']=false;
    }
}else{
    $catErr['glCat_id']='недопустимое cat_id';
}
if(isset($catErr)){
    $catErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editCat.php");
}else{
    if($DB->updateOne($Cat_rd)){
        $catErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editCat.php");
    }else{
        $appRJ->errors['XXX']['description']="ошибка не обработана: insert into galleryMenu error";
    }
}