<?php
$query_text="create table wdSrvList_dt (".
    "sName varchar(128) collate utf8_unicode_ci not null, ".
    "sDescr TEXT, ".
    "sImg varchar(128) collate utf8_unicode_ci, ".
    "sDiag TEXT, ".
    "primary key (sName)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";