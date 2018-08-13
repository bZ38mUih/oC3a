<?php
$query_text="create table refCom_dt (".
    "com_id int(5) AUTO_INCREMENT, ".
    "comPar_id int(5), ".
    "user_id int(5) not null, ".
    "Content TEXT collate utf8_unicode_ci not null, ".
    "writeDate datetime not null, ".
    "activeFlag BOOLEAN, ".
    "primary key (com_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";