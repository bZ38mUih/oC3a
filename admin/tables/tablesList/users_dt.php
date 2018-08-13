<?php
$query_text="create table users_dt (".
    "user_id int(5) AUTO_INCREMENT, ".
    "blackList BOOLEAN not null, ".
    "primary key (user_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";