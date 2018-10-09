<?php
$query_text="create table wdSrv_dt (".
    "sList_id int(5) AUTO_INCREMENT, ".
    "wd_id int(5) not null, ".
    "sName varchar(128) collate utf8_unicode_ci, ".
    "sDName varchar(128) collate utf8_unicode_ci, ".
    "sSTName TEXT collate utf8_unicode_ci, ".
    "sDescr TEXT collate utf8_unicode_ci, ".
    "sPath TEXT collate utf8_unicode_ci, ".
    "primary key (sList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";