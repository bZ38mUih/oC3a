<?php
$delLike_qry = "delete from galleryLike_dt WHERE galleryLike_dt.photo_id ".
    "IN (select photo_id from galleryPhotos_dt where album_id=".$Alb_rd->result['album_id'].")";
$Alb_rd->doQuery($delLike_qry);