<?php
$query_text="create table galleryAlb_dt (".
    "album_id int(5) AUTO_INCREMENT, ".
    "user_id int(5) not null, ".
    "albumName varchar(128) collate utf8_unicode_ci not null, ".
    "albumAlias varchar(128) collate utf8_unicode_ci not null, ".
    "metaDescr varchar(512) collate utf8_unicode_ci, ".
    "dateOfCr date not null, ".
    "glCat_id int(5), ".
    "albumImg varchar(128) collate utf8_unicode_ci, ".
    "transAlbImg int(3), ".
    "activeFlag BOOLEAN, ".
    "readRule varchar(8) collate utf8_unicode_ci not null, ".
    "writeRule varchar(8) collate utf8_unicode_ci not null, ".
    "refreshDate date, ".
    "robIndex BOOLEAN, ".
    "primary key (album_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";