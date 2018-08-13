<?php
$query_text="create table ntf_dt (".
    "ntf_id int(5) AUTO_INCREMENT, ".
    "ntfType varchar(128) collate utf8_unicode_ci not null, ".//auth, group_id, personal
    "ntfSubscr int(5) not null, ".
    "ntfDescr TEXT collate utf8_unicode_ci not null, ".
    "ntfSubj varchar(128) collate utf8_unicode_ci not null, ".
    "ntfDate datetime not null, ".
    "activeFlag BOOLEAN, ".
    "primary key (ntf_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";