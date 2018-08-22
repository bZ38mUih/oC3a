<?php
$query_text="create table ordersList_dt (".
    "order_id int(5) AUTO_INCREMENT, ".
    "receiver varchar(128) collate utf8_unicode_ci not null, ".
    "formcomment varchar(128) collate utf8_unicode_ci not null, ".
    "shortDest varchar(128) collate utf8_unicode_ci not null, ".
    "label varchar(128) collate utf8_unicode_ci not null, ".
    "quickpayForm varchar(128) collate utf8_unicode_ci not null, ".
    "targets varchar(128) collate utf8_unicode_ci not null, ".
    "orderSum DEC(7,2) not null, ".
    "comment varchar(512) collate utf8_unicode_ci, ".
    "needFio BOOLEAN, ".
    "needEmai BOOLEAN, ".
    "needPhone BOOLEAN, ".
    "needAddress BOOLEAN, ".
    "paymentType varchar(128) collate utf8_unicode_ci, ".
    "ordDate datetime not null, ".
    "discont DEC(7,2) not null, ".
    "user_id int(5), ".
    "primary key (order_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";