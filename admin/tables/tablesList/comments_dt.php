<?php
$query_text="create table comments_dt (".
    "comment_id int(5) AUTO_INCREMENT, ".
    "comment_parId int(5), ".
    "subject_id int(5) not null, ".
    "dateOfCr datetime not null, ".
    "user_id int(5) not null, ".
    "commContent TEXT collate utf8_unicode_ci not null, ".
    "active BOOLEAN not null, ".
    "primary key (comment_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
?>