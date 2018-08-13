<?php
$query_text="create table ntfList_dt (".
    "ntfList_id int(5) AUTO_INCREMENT, ".
    "ntf_id int(5) not null, ".
    "user_id int(5) not null, ".
    "readDate datetime, ".
    "primary key (ntfList_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";