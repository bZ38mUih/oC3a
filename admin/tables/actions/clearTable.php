<?php
$query_text = "delete from ".$_GET['tableName'];
if ($DB->query($query_text) == true){
    $tables->tables[$_GET['tableName']]['qty']=0;
}else{
    $tables->rusult['err']= 'query fail';
}