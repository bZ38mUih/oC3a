<?php

//print_r($_POST);
//exit;

$albErr=null;

$Alb_rd = new recordDefault("galleryAlb_dt", "album_id");

$Alb_rd->result['album_id']=$_GET['alb_id'];
if($Alb_rd->copyOne()){

    if(isset($_POST['readRule']) and $_POST['readRule']!=null){
        $Alb_rd->result['readRule'] = $_POST['readRule'];
    }

    if(isset($_POST['writeRule']) and $_POST['writeRule']!=null){
        $Alb_rd->result['writeRule'] = $_POST['writeRule'];
    }

    //print_r($Alb_rd);
    //exit;

    if($Alb_rd->updateOne()){
        $albErr['common']=true;
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editAlbumAccess.php");
    }else{
        //$catErr['common']=true;
        //require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-editCat.php");
    //}else{

        $appRJ->response['result'].= "444<br>";
        $appRJ->response['result'].= "zhopa-edit";
    //}
    }

}else{
    $editImg['data'] = "неправильный alb_id";
}
/*}else{
    $editImg['data'] = "неправильный cat_id";
}*/
//$appRJ->response['result'].= json_encode($editImg);