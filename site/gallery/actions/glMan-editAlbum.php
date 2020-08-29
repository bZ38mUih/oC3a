<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/source/accessorial_class.php");
$Alb_rd = array("table" => "galleryAlb_dt", "field_id" => "album_id");
if(isset($_GET['alb_id']) and $_GET['alb_id']!=null){
    $Alb_rd['result']['album_id'] = $_GET['alb_id'];
    $Alb_rd = $DB->copyOne($Alb_rd);
    if(isset($_POST['albumName']) and $_POST['albumName']!=null){
        $Alb_rd['result']['albumName']=htmlspecialchars($_POST['albumName']);
    }else{
        $albErr['albumName']='недопустимое название альбома';
    }
    if(isset($_POST['albumAlias']) and $_POST['albumAlias']!=null){
        if($Alb_rd['result']['albumAlias']!=htmlspecialchars($_POST['albumAlias'])){
            $Alb_rd['result']['albumAlias']=htmlspecialchars($_POST['albumAlias']);

            $checkDouble_qry="select COUNT(albumAlias) as dblAlias from galleryAlb_dt where albumAlias = '".$Alb_rd['result']['albumAlias']."'";
            $checkDouble_res = $DB->query($checkDouble_qry);
            $checkDouble_row = $checkDouble_res->fetch(PDO::FETCH_ASSOC);
            if($checkDouble_row['dblAlias'] == 0){
                $albErr['albumAlias']='недопустимый alias - double ';
            }
        }
    }else{
        $albErr['albumAlias']='недопустимый alias - null';
    }
    $Alb_rd['result']['metaDescr']=htmlspecialchars($_POST['metaDescr']);
    if(isset($_POST['glCat_id'])){
        if($_POST['glCat_id'] == 'none'){
            $Alb_rd['result']['glCat_id']=null;
        }else{
            $Alb_rd['result']['glCat_id']=$_POST['glCat_id'];
        }
    }
    if(isset($_POST['activeFlag']) and $_POST['activeFlag']=='on'){
        $Alb_rd['result']['activeFlag']=true;
    }else{
        $Alb_rd['result']['activeFlag']=false;
    }
    if(isset($_POST['robIndex']) and $_POST['robIndex']=='on'){
        $Alb_rd['result']['robIndex']=true;
    }else{
        $Alb_rd['result']['robIndex']=false;
    }
    if(isset($_POST['dateOfCr']) and $_POST['dateOfCr']!=null){
        $Alb_rd['result']['dateOfCr']=$_POST['dateOfCr'];
    }
    if(isset($_POST['refreshDate']) and $_POST['refreshDate']!=null){
        $Alb_rd['result']['refreshDate']=$_POST['refreshDate'];
        if($Alb_rd['result']['refreshDate']<=$Alb_rd['result']['dateOfCr']){
            $albErr['refreshDate']="меньше даты создания";
        }
    }else{
        $Alb_rd['result']['refreshDate']=null;
    }
    if(isset($_POST['transAlbImg']) and $_POST['transAlbImg']!=null){
        $Alb_rd['result']['transAlbImg']=$_POST['transAlbImg'];
    }else{
        $Alb_rd['result']['transAlbImg']=null;
    }
}else{
    $albErr['album_id']='недопустимое alb_id';
}
if(isset($albErr)){
    $albErr['common']=false;
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editAlbum.php");
}else{
    if($DB->updateOne($Alb_rd)){
        $albErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editAlbum.php");
    }else{
        $appRJ->errors['XXX']['description']="ошибка не обработана: insert into galleryAlb error";
    }
}