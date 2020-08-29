<?php
$categ_res = $DB->query("select DISTINCT catName, glCat_id from galleryMenu_dt where catActive = true order by catName");
$categ_arr = [];
while ($categ_res->fetch(PDO::FETCH_ASSOC)){
    //if($Alb_rd['result']['glCat_id'] != $categ_row['glCat_id']){
        $categ_arr[$categ_row['glCat_id']] = $categ_row['catName'];
    //}
}
$itemsCount_res=$DB->query("select * from galleryPhotos_dt where album_id = ".$_GET['alb_id']." order by uploadDate DESC, photo_id DESC");
$itemsCount = $itemsCount_res->rowCount();
$appRJ->response['result'].= "<div class='manTopPanel'><div class='itemsCount'>".
    "Всего: <span>".$itemsCount."</span> фото</div><div class='newItem'>".
    "<input type='file' id='loadFilesBtn' onchange='loadFilesM(".'"'."alb_id".'", '.$_GET['alb_id'].
    ")' accept='image/jpeg,image/png,image/gif' multiple>".
    "</div><div class='photo-frame'>";
if($itemsCount>0)
while($itemsCount_row = $itemsCount_res->fetch(PDO::FETCH_ASSOC)){
    include ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-photoAttachItem.php");
}
$appRJ->response['result'].= "</div></div>";