<?php
$query_text="create table forumComments_dt (".
    "fc_id int(5) AUTO_INCREMENT, ".
    "fc_pid int(5), ".
    "fs_id int(5) not null, ".
    "user_id int(5) not null, ".
    "writeDate datetime not null, ".
    "commmentCont TEXT not null, ".
    "activeFlag BOOLEAN not null, ".
    "likePlus int(5) not null, ".
    "likeMinus int(5) not null, ".
    "primary key (fc_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";