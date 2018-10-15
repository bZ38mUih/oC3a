<?php
$query_text="create table wdList_dt (".
    "wd_id int(5) AUTO_INCREMENT, ".
    "wdTag varchar(128) collate utf8_unicode_ci, ".
    "comment varchar(128) collate utf8_unicode_ci, ".
    "diagDate datetime not null, ".
    "user_id int(5) not null, ".
    "primary key (wd_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";