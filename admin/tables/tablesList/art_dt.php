<?php
$query_text="create table art_dt (".
    "art_id int(5) AUTO_INCREMENT, ".
    "artCat_id int(5) not null, ".
    "artName varchar(128) collate utf8_unicode_ci not null, ".
    "artAlias varchar(128) collate utf8_unicode_ci not null, ".
    "artMeta TEXT collate utf8_unicode_ci, ".
    "artImg varchar(128) collate utf8_unicode_ci, ".
    "activeFlag BOOLEAN, ".
    "pubDate date, ".
    "refreshDate date, ".
    "allowCm BOOLEAN, ".
    "primary key (art_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";