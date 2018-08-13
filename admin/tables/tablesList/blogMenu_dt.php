<?php
$query_text="create table blogMenu_dt (".
    "bm_id int(5) AUTO_INCREMENT, ".
    "bmP_id int(5), ".
    "bmName varchar(128) collate utf8_unicode_ci not null, ".
    "bmAlias varchar(128) collate utf8_unicode_ci not null, ".
    "bmDescr TEXT collate utf8_unicode_ci, ".
    "bmImg varchar(128) collate utf8_unicode_ci, ".
    "activeFlag BOOLEAN, ".
    "primary key (bm_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";