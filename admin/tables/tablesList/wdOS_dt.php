<?php
$query_text="create table wdOS_dt (".
    "osList_id int(6) AUTO_INCREMENT, ".
    "wd_id int(6) not null, ".
    "osName varchar(128) collate utf8_unicode_ci, ".
    "osVal varchar(128) collate utf8_unicode_ci, ".
    "primary key (osList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";