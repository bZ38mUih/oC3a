<?php
$query_text = "create table inLog_dt (".
    "account_id varchar(128) collate utf8_unicode_ci not null, ".
    "comeDate datetime not null, ".
    "uAgent varchar(256) collate utf8_unicode_ci, ".
    "rmAddr varchar(128) collate utf8_unicode_ci, ".
    "rmPort varchar(128) collate utf8_unicode_ci) ".
    "ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

?>