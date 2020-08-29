<?php
$delImg['result'] = false;
$delImg['data'] = null;
$slHw_qry="select * from wdHwList_dt WHERE paramVal='".$paramVal."' and paramName='".$paramName."'";
$slHw_res=$DB->query($slHw_qry);
if(mysql_num_rows($slHw_res)==1){
    $slHw_row = $slHw_res->fetch(PDO::FETCH_ASSOC);
    unlink ($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/".$slHw_row['hwImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/preview/".$slHw_row['hwImg']);
    $updateHw_qry="update wdHwList_dt set hwImg=NULL WHERE paramVal='".$paramVal."' and paramName='".$paramName."'";
    if($DB->query($updateHw_qry)){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса account_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;