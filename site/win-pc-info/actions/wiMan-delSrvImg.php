<?php
$delImg['result'] = false;
$delImg['data'] = null;
$slHw_qry="select * from wdSrvList_dt WHERE sName='".$paramVal."'";
$slHw_res=$DB->query($slHw_qry);
if($slHw_res->rowCount() == 1){
    $slHw_row = $slHw_res->fetch(PDO::FETCH_ASSOC);
    unlink ($_SERVER["DOCUMENT_ROOT"].WD_SRV_IMG.$slHw_row['sImg']);
    $updateHw_qry="update wdSrvList_dt set sImg=NULL WHERE sName='".$paramVal."'";
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