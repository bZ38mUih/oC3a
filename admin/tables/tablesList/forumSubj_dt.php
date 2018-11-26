<?php
$query_text="create table forumSubj_dt (".
    "fs_id int(5) AUTO_INCREMENT, ".
    "user_id int(5) not null, ".
    "sName varchar(128) collate utf8_unicode_ci not null, ".
    "sAlias varchar(128) collate utf8_unicode_ci not null, ".
    "metaDescr varchar(512) collate utf8_unicode_ci, ".
    "dateOfCr date not null, ".
    "fm_id int(5), ".
    "sImg varchar(128) collate utf8_unicode_ci, ".
    "activeFlag BOOLEAN, ".
    "readRule varchar(8) collate utf8_unicode_ci, ".
    "writeRule varchar(8) collate utf8_unicode_ci, ".
    "robIndex BOOLEAN, ".
    "longDescr TEXT, ".
    "primary key (fs_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";