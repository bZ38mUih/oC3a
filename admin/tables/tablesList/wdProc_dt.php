<?php
$query_text="create table wdProc_dt (".
    "pList_id int(5) AUTO_INCREMENT, ".
    "wd_id int(5) not null, ".
    "procName varchar(128) collate utf8_unicode_ci, ".
    "procPID int(6) not null, ".
    "procFile varchar(128) collate utf8_unicode_ci, ".
    "primary key (pList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";