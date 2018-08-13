<?php
$query_text="create table galleryLike_dt (".
    "photo_id int(5) not null, ".
    "user_id int(5) not null, ".
    "primary key (photo_id, user_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";