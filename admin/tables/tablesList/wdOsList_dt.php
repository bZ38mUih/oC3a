<?php
$query_text="create table wdOsList_dt (".
    "osName varchar(128) collate utf8_unicode_ci not null, ".
    "osVal varchar(128) collate utf8_unicode_ci not null, ".
    "osDescr TEXT, ".
    "lastMod date, ".
    "primary key (osName, osVal)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";