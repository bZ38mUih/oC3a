<?php
$query_text="create table ordersBucket_dt (".
    "bucket_id int(5) AUTO_INCREMENT, ".
    "order_id int(5) not null, ".
    "card_id varchar(128) collate utf8_unicode_ci not null, ".
    "bucketPrice int(5) not null, ".
    "primary key (bucket_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
