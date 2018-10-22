<?php
$delImg['result'] = false;
$delImg['data'] = null;
$slHw_qry="select * from wdProcList_dt WHERE pName='".$paramVal."'";
$slHw_res=$DB->doQuery($slHw_qry);
if(mysql_num_rows($slHw_res)==1){
    $slHw_row=$DB->doFetchRow($slHw_res);
    unlink ($_SERVER["DOCUMENT_ROOT"].WD_PROC_IMG.$slHw_row['pImg']);
    //unlink ($_SERVER["DOCUMENT_ROOT"].WD_HW_IMG.$paramName."/preview/".$slHw_row['hwImg']);
    $updateHw_qry="update wdProcList_dt set pImg=NULL WHERE pName='".$paramVal."'";
    if($DB->doQuery($updateHw_qry)){
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