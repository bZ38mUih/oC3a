<?php
$query_text="create table wdSrvPath_dt (".
    "sName varchar(128) collate utf8_unicode_ci not null, ".
    "sPath varchar(128) collate utf8_unicode_ci not null, ".
    "sPathDiag TEXT, ".
    "primary key (sName, sPath)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";