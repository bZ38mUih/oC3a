<?php
$query_text="create table galleryComments_dt (".
    "comment_id int(5) not null, ".
    "photo_id int(5) not null, ".
    "user_id int(5) not null, ".
    "commentPar_id int(5) not null, ".
    "writeDate datetime not null, ".
    "commmentCont TEXT not null, ".
    "primary key (comment_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";