<?php
$query_text="create table wdEnv_dt (".
    "envList_id int(6) AUTO_INCREMENT, ".
    "wd_id int(6) not null, ".
    "vName varchar(128) collate utf8_unicode_ci, ".
    "vVal varchar(128) collate utf8_unicode_ci, ".
    "primary key (envList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";