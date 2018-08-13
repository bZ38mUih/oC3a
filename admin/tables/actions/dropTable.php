<?php
$query_text = "drop table ".$_GET['tableName'];

if ($DB->doQuery($query_text) === true){

}else{
    $tables->rusult['err']= 'query fail';
}