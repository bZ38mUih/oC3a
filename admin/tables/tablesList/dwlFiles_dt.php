<?php
$query_text="create table dwlFiles_dt (".
    "dwlFile_id int(5) AUTO_INCREMENT, ".
    "dwlCat_id int(5) not null, ".
    "dwlFileName varchar(128) collate utf8_unicode_ci not null, ".
    "dwlFileAliace varchar(128) collate utf8_unicode_ci not null, ".
    "dwlFileDescr TEXT collate utf8_unicode_ci, ".
    "fileVersion varchar(128) collate utf8_unicode_ci, ".
    "fileLicence varchar(128) collate utf8_unicode_ci, ".
    "fileImg varchar(128) collate utf8_unicode_ci, ".
    "fileActive_flag BOOLEAN, ".
    "fileSort int(5) not null, ".
    "primary key (dwlFile_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";