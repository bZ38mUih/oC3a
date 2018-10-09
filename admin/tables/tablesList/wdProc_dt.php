<?php
$query_text="create table wdProc_dt (".
    "pList_id int(5) AUTO_INCREMENT, ".
    "wd_id int(5) not null, ".
    "pName varchar(128) collate utf8_unicode_ci, ".
    "PID int(6) not null, ".
    "pPath TEXT collate utf8_unicode_ci, ".
    "primary key (pList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";