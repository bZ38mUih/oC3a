<?php
$query_text="create table payments_dt (".
    "notification_type varchar(256), ".
    "operation_id varchar(256), ".
    "amount DECIMAL(7,2), ".
    "withdraw_amount DECIMAL(7,2), ".
    "currency varchar(16), ".
    "datetime datetime, ".
    "sender varchar(128), ".
    "codepro BOOLEAN, ".
    "label varchar(128) not null, ".
    "sha1_hash varchar(256), ".
    "unaccepted BOOLEAN, ".
    "lastname varchar(128), ".
    "firstname varchar(128), ".
    "fathersname varchar(128), ".
    "email varchar(128), ".
    "phone varchar(128), ".
    "city varchar(128), ".
    "street varchar(128), ".
    "building varchar(64), ".
    "suite varchar(64), ".
    "flat varchar(64), ".
    "zip varchar(64), ".
    "user_id varchar(64), ".
    "primary key (label)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";