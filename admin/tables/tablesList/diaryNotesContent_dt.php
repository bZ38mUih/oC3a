<?php
$query_text="create table diaryNotesContent_dt (".
    "note_id int(5) AUTO_INCREMENT, ".
    "diary_id int(5) not null, ".
    "curDate date not null, ".
    "curTime time not null, ".
    "content TEXT collate utf8_unicode_ci not null, ".
    "primary key (note_id) ".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
/*$query_text="create table diaryNotesContent_dt (".
    "diary_id int(5) AUTO_INCREMENT, ".
    "diaryType varchar(128) not null, ".
    "noteDate datetime not null, ".
    "primary key (diary_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";*/
?>