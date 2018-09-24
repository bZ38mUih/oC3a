<?php
$query_text="create table galleryMenu_dt (".
    "glCat_id int(5) AUTO_INCREMENT, ".
    "glCat_parId int(5), ".
    "catName varchar(128) collate utf8_unicode_ci not null, ".
    "catDescr varchar(128) collate utf8_unicode_ci not null, ".
    "catAlias varchar(128) collate utf8_unicode_ci not null, ".
    "catActive BOOLEAN, ".
    "catIndex BOOLEAN, ".
    "catImg varchar(128) collate utf8_unicode_ci, ".
    "primary key (glCat_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";