<?php
$query_text="create table forumCmLike_dt (".
    "fc_id int(5) AUTO_INCREMENT, ".
    "likeStatus BOOLEAN, ".
    "user_id int(5) not null, ".
    "likeDate datetime not null, ".
    "primary key (fc_id, user_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";