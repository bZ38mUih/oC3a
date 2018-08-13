<?php
$query_text="create table artCat_dt (".
    "artCat_id int(5) AUTO_INCREMENT, ".
    "artCatPar_id int(5), ".
    "catName varchar(128) collate utf8_unicode_ci not null, ".
    "catAlias varchar(128) collate utf8_unicode_ci not null, ".
    "catDescr varchar(128) collate utf8_unicode_ci, ".
    "catImg varchar(128) collate utf8_unicode_ci, ".
    "activeFlag BOOLEAN, ".
    "primary key (artCat_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";