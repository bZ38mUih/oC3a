<?php
$query_text="create table srvCat_dt (".
    "srvCat_id int(5) AUTO_INCREMENT, ".
    "srvCatPar_id int(5), ".
    "catName varchar(128) collate utf8_unicode_ci not null, ".
    "catAlias varchar(128) collate utf8_unicode_ci not null, ".
    "catDescr varchar(128) collate utf8_unicode_ci, ".
    "catImg varchar(128) collate utf8_unicode_ci, ".
    "catActive_flag BOOLEAN, ".
    "primary key (srvCat_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";