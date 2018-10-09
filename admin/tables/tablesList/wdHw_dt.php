<?php
$query_text="create table wdHw_dt (".
    "hwList_id int(5) AUTO_INCREMENT, ".
    "wd_id int(5) not null, ".
    "paramName varchar(128) collate utf8_unicode_ci, ".
    "paramVal varchar(128) collate utf8_unicode_ci, ".
    "primary key (hwList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";