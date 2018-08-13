<?php
$query_text="create table blogArt_dt (".
    "art_id int(5) AUTO_INCREMENT, ".
    "blogCat_id int(5) not null, ".
    "artName varchar(128) collate utf8_unicode_ci not null, ".
    "artAliace varchar(128) collate utf8_unicode_ci not null, ".
    //"dwlFileDescr TEXT collate utf8_unicode_ci, ".
    //"fileVersion varchar(128) collate utf8_unicode_ci, ".
    //"fileLicence varchar(128) collate utf8_unicode_ci, ".
    "artImg varchar(128) collate utf8_unicode_ci, ".
    "activeFlag BOOLEAN, ".
    "pubDate date not null, ".
    "primary key (art_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";