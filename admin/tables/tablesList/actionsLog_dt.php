<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 14.01.2018
 * Time: 19:24
 */
$query_text="create table actionsLog_dt (".
    "action_id int(7) not null, ".
    "user_id int(5) not null, ".
    "tableName varchar(128) collate utf8_unicode_ci not null, ".
    "field_id varchar(16) collate utf8_unicode_ci not null, ".
    "actionField int(2) not null, ".
    "valueField varchar(128) collate utf8_unicode_ci not null, ".
    "actionDate datetime not null, ".
    "resultField BOOLEAN not null, ".
    "primary key (action_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";