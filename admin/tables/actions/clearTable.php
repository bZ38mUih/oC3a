<?php
$query_text = "delete from ".$_GET['tableName'];
if ($DB->doQuery($query_text) === true){

}else{
    $tables->rusult['err']= 'query fail';
}