<?php
$query_text="create table usersToGroups_dt (".
    "rec_id int(5) AUTO_INCREMENT, ".
    "group_id int(5) not null, ".
    "user_id int(5) not null, ".
    "rules int(3) not null, ".
    "primary key (rec_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";