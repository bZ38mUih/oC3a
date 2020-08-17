<?php
$query_text=null;
if(@include($_SERVER['DOCUMENT_ROOT'].DB_UPLOADS."tablesList/".$_GET['tableName'].".php")){
    if ($DB->query($query_text) == true){
        $tables->tables[$_GET['tableName']]['exist']=true;
    }else{
        $tables->result['err'] = "query fail";
    }
}else{
    $tables->result['err'].="query file not found";
}