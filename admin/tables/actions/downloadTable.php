<?php
if(!$queryToInsert=file_get_contents($_GET['tableName'])){
    $tables->result['err']='таблица для загрузки не найдена';
}else{
    if (!$DB->doQuery($queryToInsert)){
        $tables->result['err']='ошибки вставки'.$queryToInsert;
    }
}
