<?php
$query_text="create table artRef_dt (".
"artRef_id int(5) AUTO_INCREMENT, ".
"art_id int(5) not null, ".
"refLink varchar(128) collate utf8_unicode_ci not null, ".
"refText varchar(128) collate utf8_unicode_ci not null, ".
"primary key (artRef_id)".
") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";