<?php
$itemsCount_query="select * from galleryVideo_dt where album_id = ".$_GET['alb_id']." order by uploadDate DESC, video_id DESC";
$itemsCount_res=$DB->doQuery($itemsCount_query);
$itemsCount = mysql_num_rows($itemsCount_res);
$appRJ->response['result'].= "<div class='manTopPanel'><div class='itemsCount'>".
    "Всего: <span>".$itemsCount."</span> видео</div><div class='newItem'>".
    "<input type='file' id='loadFilesBtn' onchange='linkVideo(".'"'."video".'", '.$_GET['alb_id'].
    ")' accept='video/*'>".
    "</div><div class='photo-frame'>";
if($itemsCount>0)
while($itemsCount_row=$DB->doFetchRow($itemsCount_res)){
    include ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-videoAttachItem.php");
}
$appRJ->response['result'].= "</div></div>";
