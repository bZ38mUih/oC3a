<?php
$query_text="create table wdSrv_dt (".
    "sList_id int(5) AUTO_INCREMENT, ".
    "wd_id int(5) not null, ".
    "sName varchar(128) collate utf8_unicode_ci, ".
    "sdName varchar(128) collate utf8_unicode_ci, ".
    "sstName varchar(128) collate utf8_unicode_ci, ".
    "sDescr varchar(128) collate utf8_unicode_ci, ".
    "sPath varchar(128) collate utf8_unicode_ci, ".
    "primary key (sList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";