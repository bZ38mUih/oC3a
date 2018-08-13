<?php
$query_text="create table dwlLnk_dt (".
    "dwlLnk_id int(5) AUTO_INCREMENT, ".
    "dwlFile_id int(5) not null, ".
    "refLink varchar(128) collate utf8_unicode_ci not null, ".
    "refText varchar(128) collate utf8_unicode_ci not null, ".
    "primary key (dwlLnk_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";