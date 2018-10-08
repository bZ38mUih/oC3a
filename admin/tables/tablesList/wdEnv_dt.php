<?php
$query_text="create table wdEnv_dt (".
    "envList_id int(5) AUTO_INCREMENT, ".
    "wd_id int(5) not null, ".
    "envName varchar(128) collate utf8_unicode_ci, ".
    "envVal varchar(128) collate utf8_unicode_ci, ".
    "primary key (envList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";