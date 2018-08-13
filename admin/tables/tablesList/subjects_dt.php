<?php
$query_text="create table subjects_dt (".
    "subject_id int(5) AUTO_INCREMENT, ".
    "user_id int(5) not null, ".
    "subjName varchar(128) collate utf8_unicode_ci not null, ".
    "subjAlias varchar(128) collate utf8_unicode_ci not null, ".

    //"subjectDescr TEXT collate utf8_unicode_ci not null, ".

    "metaDescr varchar(256) collate utf8_unicode_ci, ".

    /*
    "userGroup varchar(64) collate utf8_unicode_ci, ".
    "groupOrders int(2) not null, ".
    "guestOrders int(2) not null, ".
    "allowLikes BOOLEAN not null, ".
    */
    "dateOfCr date not null, ".
    "subjCat_id int(5), ".
    "subjImg varchar(128) collate utf8_unicode_ci, ".
    "activeFlag BOOLEAN, ".
    "readRule varchar(8) collate utf8_unicode_ci not null, ".
    "writeRule varchar(8) collate utf8_unicode_ci not null, ".
    "primary key (subject_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
?>