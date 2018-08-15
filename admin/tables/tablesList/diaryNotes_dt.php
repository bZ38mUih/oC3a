<?php
$query_text="create table diaryNotes_dt (".
    "diary_id int(5) AUTO_INCREMENT, ".
    "diaryType varchar(128) not null, ".
    "noteDate datetime not null, ".
    "primary key (diary_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";