<?php

//require_once ($_SERVER["DOCUMENT_ROOT"]."/source/recordDefault_class.php");
$addLnk_err=null;
$Link_rd = array("table" => "dwlLnk_dt", "field_id" => "dwlLnk_id");
$Link_rd['result']['dwlLnk_id']=$_GET['delRef'];
if($DB->removeOne($Link_rd)){
    $appRJ->response['result'].= "<div class='results success'>удаление успешно</div>";
}else{
    $appRJ->response['result'].= "<div class='results fail'>удаление неудачно</div>";
}