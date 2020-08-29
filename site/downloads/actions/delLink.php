<?php

//require_once ($_SERVER["DOCUMENT_ROOT"]."/source/recordDefault_class.php");
$addLnk_err=null;
$Link_rd=new recordDefault("dwlLnk_dt", "dwlLnk_id");
$Link_rd['result']['dwlLnk_id']=$_GET['delRef'];
if($Link_rd->removeOne()){
    $appRJ->response['result'].= "<div class='results success'>удаление успешно</div>";
}else{
    $appRJ->response['result'].= "<div class='results fail'>удаление неудачно</div>";
}