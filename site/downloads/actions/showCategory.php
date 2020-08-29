<?php

$selectCat_text = "select * from dwlCat_dt WHERE catAlias='".$appRJ->server['reqUri_expl'][2]."' limit 1";
$selectCat_res=$DB->query($selectCat_text);
if(mysql_num_rows($selectCat_res)===1){
    $selectCat_row = $selectCat_res->fetch(PDO::FETCH_ASSOC);

    $selectFiles_text = "select * from dwlFiles_dt WHERE dwlCat_id=".$selectCat_row['dwlCat_id'];
    $selectFiles_res = $DB->query($selectFiles_text);
    $selectFiles_count = mysql_num_rows($selectFiles_res);
    $selectSubCat_text="select * from dwlCat_dt WHERE dwlCatPar_id=".$selectCat_row['dwlCat_id'];
    $selectSubCat_res = $DB->query($selectSubCat_text);
    $selectSubCat_count = mysql_num_rows($selectSubCat_res);
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/showCategory.php");
}else{
    $appRJ->response['result'].= "category not found";
}

