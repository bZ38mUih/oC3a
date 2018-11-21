<?php
$query_text="create table wdHwList_dt (".
    "paramName varchar(128) collate utf8_unicode_ci not null, ".
    "paramVal varchar(128) collate utf8_unicode_ci not null, ".
    "hwDescr TEXT, ".
    "hwImg varchar(128) collate utf8_unicode_ci, ".
    "lastMod date, ".
    "primary key (paramName, paramVal)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";