<?php
$query_text=null;
if(@include($_SERVER['DOCUMENT_ROOT']."/admin/tables/tablesList/".$_GET['tableName'].".php")){
    if ($DB->doQuery($query_text) === true){
        $tables->tables[$_GET['tableName']]['exist']=true;
    }else{
        $tables->result['err'] = "query fail";
    }
}else{
    $tables->result['err'].="query file not found";
}