<?php
$query_text="create table wdEnvList_dt (".
    "vName varchar(128) collate utf8_unicode_ci not null, ".
    "vVal varchar(128) collate utf8_unicode_ci not null, ".
    "vDescr TEXT, ".
    "lastMod date, ".
    "primary key (vName, vVal)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";