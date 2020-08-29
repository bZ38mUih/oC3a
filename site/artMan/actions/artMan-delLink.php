<?php
$addLnk_err=null;
$Link_rd = array("table" => "artRef_dt", "field_id" => "artRef_id");
$Link_rd->result['artRef_id']=$_GET['delRef'];
if($DB->removeOne($Link_rd)){
    $appRJ->response['result'].= "<div class='results success'>удаление успешно</div>";
}else{
    $appRJ->response['result'].= "<div class='results fail'>удаление неудачно</div>";
}