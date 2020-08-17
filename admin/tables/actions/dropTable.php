<?php
$query_text = "drop table ".$_GET['tableName'];
if ($DB->query($query_text) == true){
    $tables->tables[$_GET['tableName']]['exist']=false;
}else{
    $tables->rusult['err']= 'query fail';
}