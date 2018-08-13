<?php
$itemsCount_query="select * from galleryPhotos_dt where album_id = ".$_GET['alb_id']." order by uploadDate DESC, photo_id DESC";
$itemsCount_res=$DB->doQuery($itemsCount_query);
$itemsCount = mysql_num_rows($itemsCount_res);
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$itemsCount."</span> фото";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<input type='file' id='loadFilesBtn' onchange='loadFilesM(".'"'."alb_id".'", '.$_GET['alb_id'].
    ")' accept='image/jpeg,image/png,image/gif' multiple>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='photo-frame'>";
if($itemsCount>0)
while($itemsCount_row=$DB->doFetchRow($itemsCount_res)){
    include ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-photoAttachItem.php");
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";