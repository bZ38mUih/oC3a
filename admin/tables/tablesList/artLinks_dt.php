<?php
$query_text="create table artLinks_dt (".
    "artLink_id int(5) AUTO_INCREMENT, ".
    "art_id int(5), ".
    "linkType varchar(64) collate utf8_unicode_ci not null, ".
    "linkRef varchar(256) collate utf8_unicode_ci not null, ".
    "primary key (artLink_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";