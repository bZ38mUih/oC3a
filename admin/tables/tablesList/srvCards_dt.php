<?php
$query_text="create table srvCards_dt (".
    "card_id int(5) AUTO_INCREMENT, ".
    "srvCat_id int(5), ".
    "cardName varchar(128) collate utf8_unicode_ci not null, ".
    "cardAlias varchar(128) collate utf8_unicode_ci not null, ".
    "shortDescr TEXT collate utf8_unicode_ci, ".
    "longDescr TEXT collate utf8_unicode_ci, ".
    "cardImg varchar(128) collate utf8_unicode_ci, ".
    "cardActive BOOLEAN, ".
    "cardPrice int(5) not null, ".
    "cardCurr int(5) not null, ".
    "sortDate date not null, ".
    "primary key (card_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";