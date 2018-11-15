<?php
$query_text="create table forumMenu_dt (".
    "fm_id int(5) AUTO_INCREMENT, ".
    "fm_pid int(5), ".
    "mName varchar(128) collate utf8_unicode_ci not null, ".
    "mDescr varchar(128) collate utf8_unicode_ci not null, ".
    "mAlias varchar(128) collate utf8_unicode_ci not null, ".
    "mActive BOOLEAN, ".
    "robIndex BOOLEAN, ".
    "mImg varchar(128) collate utf8_unicode_ci, ".
    "primary key (fm_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";