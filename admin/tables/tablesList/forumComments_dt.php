<?php
$query_text="create table forumComments_dt (".
    "fc_id int(5) AUTO_INCREMENT, ".
    "user_id int(5) not null, ".
    "fc_pid int(5), ".
    "writeDate datetime not null, ".
    "commmentCont TEXT not null, ".
    "primary key (fc_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";