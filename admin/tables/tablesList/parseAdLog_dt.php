<?php
$query_text="create table parseAdLog_dt (".
    "logDate datetime not null, ".
    "logContent TEXT not null, ".
    "primary key (logDate)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";