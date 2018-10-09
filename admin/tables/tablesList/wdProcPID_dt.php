<?php
$query_text="create table wdProcPID_dt (".
    "pName varchar(128) collate utf8_unicode_ci not null, ".
    "PID int(5) not null, ".
    "pPIDdiag TEXT, ".
    "primary key (pName, PID)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";