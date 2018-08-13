<?php
$query_text="create table subjectsDescr_dt (".
    "subject_id int(5) not null, ".
    "subjectDescr TEXT collate utf8_unicode_ci not null, ".
    //"metaDescr varchar(128) collate utf8_unicode_ci not null, ".

    /*
    "userGroup varchar(64) collate utf8_unicode_ci, ".
    "groupOrders int(2) not null, ".
    "guestOrders int(2) not null, ".
    "allowLikes BOOLEAN not null, ".
    */
    //"dateOfCr datetime not null, ".
    //"subjCat_id int(5), ".
    //"subjImg varchar(128) collate utf8_unicode_ci, ".
    "primary key (subject_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";