<?php
$addLnk_err=null;
$Link_rd=new recordDefault("artRef_dt", "artRef_id");
$Link_rd->result['art_id']=$_GET['art_id'];
if(isset($_POST['refLnk']) and $_POST['refLnk']!=null){
    $Link_rd->result['refLink']=$_POST['refLnk'];
}else{
    $addLnk_err="неправильный refLnk";
}
if(isset($_POST['refTxt']) and $_POST['refTxt']!=null){
    $Link_rd->result['refText']=$_POST['refTxt'];
}else{
    if($addLnk_err){
        $addLnk_err.=" / неправильный refText";
    }else{
        $addLnk_err="неправильный refText";
    }
}
if(!$addLnk_err){
    $Link_rd->putOne();
    $appRJ->response['result'].= "<div class='results success'>добавлено успешно</div>";
}else{
    $appRJ->response['result'].= "<div class='results fail'>".$addLnk_err."</div>";
}