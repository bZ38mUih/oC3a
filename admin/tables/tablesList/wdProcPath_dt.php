<?php
$query_text="create table wdProcPath_dt (".
    "pName varchar(128) collate utf8_unicode_ci not null, ".
    "pPath varchar(128) collate utf8_unicode_ci not null, ".
    "pPathDiag TEXT, ".
    "primary key (pName, pPath)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";