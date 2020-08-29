<?php
$itemsCount_query="select * from galleryVideo_dt where album_id = ".$_GET['alb_id']." order by uploadDate DESC, video_id DESC";
$itemsCount_res = $DB->query($itemsCount_query);
$itemsCount = $itemsCount_res->rowCount();
$appRJ->response['result'].= "<div class='manTopPanel'><div class='itemsCount'>".
    "Всего: <span>".$itemsCount."</span> видео</div><div class='newItem'>".
    "<input type='file' id='loadFilesBtn' onchange='linkVideo(".'"'."video".'", '.$_GET['alb_id'].
    ")' accept='video/*'>".
    "</div><div class='photo-frame'>";
if($itemsCount>0)
while($itemsCount_row = $itemsCount_res->fetch(PDO::FETCH_ASSOC)){
    include ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-videoAttachItem.php");
}
$appRJ->response['result'].= "</div></div>";
