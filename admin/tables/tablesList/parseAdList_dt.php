<?php
$query_text="create table parseAdList_dt (".
    "ad_id  int(5) AUTO_INCREMENT, ".
    "adType varchar(256), ".
    "prodRef TEXT not null, ".
    "prodName TEXT not null, ".
    "prodComp TEXT, ".//not null
    "prodSaler TEXT, ".//not null
    "prodPrice int(7) not null, ".
    "adDate datetime not null, ".
    "comment TEXT, ".
    "primary key (ad_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";