<?php
$categ_qry = "select DISTINCT catName, glCat_id from galleryMenu_dt where catActive = true order by catName";
$categ_res = $DB->doQuery($categ_qry);
$categ_arr = [];
while ($categ_row = $DB->doFetchRow($categ_res)){
    //if($Alb_rd->result['glCat_id'] != $categ_row['glCat_id']){
        $categ_arr[$categ_row['glCat_id']] = $categ_row['catName'];
    //}
}
$itemsCount_query="select * from galleryPhotos_dt where album_id = ".$_GET['alb_id']." order by uploadDate DESC, photo_id DESC";
$itemsCount_res=$DB->doQuery($itemsCount_query);
$itemsCount = mysql_num_rows($itemsCount_res);
$appRJ->response['result'].= "<div class='manTopPanel'><div class='itemsCount'>".
    "Всего: <span>".$itemsCount."</span> фото</div><div class='newItem'>".
    "<input type='file' id='loadFilesBtn' onchange='loadFilesM(".'"'."alb_id".'", '.$_GET['alb_id'].
    ")' accept='image/jpeg,image/png,image/gif' multiple>".
    "</div><div class='photo-frame'>";
if($itemsCount>0)
while($itemsCount_row=$DB->doFetchRow($itemsCount_res)){
    include ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-photoAttachItem.php");
}
$appRJ->response['result'].= "</div></div>";