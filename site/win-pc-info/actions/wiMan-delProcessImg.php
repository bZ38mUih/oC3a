<?php
$delImg['result'] = false;
$delImg['data'] = null;
$slHw_qry="select * from wdProcList_dt WHERE pName='".$paramVal."'";
$slHw_res=$DB->query($slHw_qry);
if(mysql_num_rows($slHw_res)==1){
    $slHw_row = $slHw_res->fetch(PDO::FETCH_ASSOC);
    unlink ($_SERVER["DOCUMENT_ROOT"].WD_PROC_IMG.$slHw_row['pImg']);
    $updateHw_qry="update wdProcList_dt set pImg=NULL WHERE pName='".$paramVal."'";
    if($DB->query($updateHw_qry)){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса pName";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;