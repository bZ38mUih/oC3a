<?php
$addLnk_err=null;
$Link_rd=new recordDefault("artRef_dt", "artRef_id");
$Link_rd->result['artRef_id']=$_GET['delRef'];
if($Link_rd->removeOne()){
    $appRJ->response['result'].= "<div class='results success'>удаление успешно</div>";
}else{
    $appRJ->response['result'].= "<div class='results fail'>удаление неудачно</div>";
}