<?php
$query_text="create table galleryPhotos_dt (".
    "photo_id int(5) AUTO_INCREMENT, ".
    "user_id int(5) not null, ".
    "photoLink varchar(128) collate utf8_unicode_ci not null, ".
    "transPhoto int(3), ".
    "photoName varchar(128) collate utf8_unicode_ci, ".
    "photoDescr varchar(256) collate utf8_unicode_ci, ".
    "uploadDate date not null, ".
    "album_id int(5) not null, ".
    "activeFlag BOOLEAN, ".
    "primary key (photo_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";