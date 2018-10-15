<?php
$query_text="create table wdSrvSTName_dt (".
    "sName varchar(128) collate utf8_unicode_ci not null, ".
    "sSTName varchar(128) collate utf8_unicode_ci not null, ".
    "sSTNamediag TEXT, ".
    "primary key (sName, sSTName)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";