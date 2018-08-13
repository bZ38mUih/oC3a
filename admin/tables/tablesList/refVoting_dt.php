<?php
$query_text="create table refVoting_dt (".
    "user_id int(5) not null, ".
    "aprVal varchar(64) collate utf8_unicode_ci not null, ".
    "primary key (user_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";