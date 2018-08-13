<?php
$query_text="create table subjectsMenu_dt (".
    "subjCat_id int(5) AUTO_INCREMENT, ".
    "subjCat_parId int(5), ".
    //"user_id int(5) not null, ".
    //"dateOfCr datetime not null, ".
    "catName varchar(128) collate utf8_unicode_ci not null, ".
    "catDescr varchar(128) collate utf8_unicode_ci not null, ".
    "catAlias varchar(128) collate utf8_unicode_ci not null, ".
    "catActive BOOLEAN, ".
    "catImg varchar(128) collate utf8_unicode_ci, ".
    "primary key (subjCat_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
?>