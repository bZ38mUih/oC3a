<?php
$fld_id=null;
if($_GET['file_id'] and $_GET['file_id']!=null){
    $fld_id=$_GET['file_id'];
}else{
    $fld_id=$_GET['fld_id'];
}
$refList_text="select * from dwlLnk_dt WHERE dwlFile_id='".$fld_id."'";
$refList_res=$DB->doQuery($refList_text);
$refList_count=mysql_num_rows($refList_res);
if($refList_count>0){
    while($refList_row=$DB->doFetchRow($refList_res)){
        $appRJ->response['result'].= "<div class='ref-line'>";
        $appRJ->response['result'].= "<a href='".$refList_row['refLink']."' title='".$refList_row['refLink']."'>".$refList_row['refText']."</a>".
            "<span onclick='delRef(".$refList_row['dwlLnk_id'].", ".$fld_id.")'><img src='/source/img/drop-icon.png'></span> ";
        $appRJ->response['result'].= "</div>";
    }
}else{
    $appRJ->response['result'].= "no ref for the file";
}