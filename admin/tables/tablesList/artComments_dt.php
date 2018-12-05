<?php
$query_text="create table artComments_dt (".
    "artCm_id int(5) AUTO_INCREMENT, ".
    "artCm_pid int(5), ".
    "art_id int(5) not null, ".
    "user_id int(5) not null, ".
    "writeDate datetime not null, ".
    "commmentCont TEXT not null, ".
    "activeFlag BOOLEAN not null, ".
    "likePlus int(5) not null, ".
    "likeMinus int(5) not null, ".
    "primary key (artCm_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";