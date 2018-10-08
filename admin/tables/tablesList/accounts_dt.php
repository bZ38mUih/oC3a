<?php
$query_text="create table accounts_dt (".
    "account_id int(5) AUTO_INCREMENT, ".
    "user_id int(5) not null, ".
    "accLogin varchar(128) collate utf8_unicode_ci not null, ".
    "accAlias varchar(128) collate utf8_unicode_ci not null, ".
    "pw_hash varchar(256) collate utf8_unicode_ci, ".
    "vldCode varchar(16) collate utf8_unicode_ci, ".
    "regDate datetime not null, ".
    "netWork varchar(16) collate utf8_unicode_ci not null, ".
    "validDate datetime, ".
    "photoLink varchar(512) collate utf8_unicode_ci, ".
    "eMail varchar(128) collate utf8_unicode_ci, ".
    "birthDay datetime, ".
    "accMain_flag BOOLEAN not null, ".
    "socProf varchar(512) collate utf8_unicode_ci, ".
    "primary key (account_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";