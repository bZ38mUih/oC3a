<?php
$query_text="create table subjectAttachments_dt (".
    "attachment_id int(5) AUTO_INCREMENT, ".
    "subject_id int(5) not null, ".
    "ref varchar(128) collate utf8_unicode_ci not null, ".
    "sort int(2) not null, ".
    "primary key (attachment_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
?>