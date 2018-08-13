<?php
$query_text="create table usersGroups_dt (".
    "group_id int(5) AUTO_INCREMENT, ".
    "groupAlias varchar(128) collate utf8_unicode_ci not null, ".
    "img varchar(128) collate utf8_unicode_ci, ".
    "activeFlag BOOLEAN not null, ".
    "primary key (group_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";