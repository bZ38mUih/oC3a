<?php
if(!$queryToInsert=file_get_contents($_GET['dwlTable'])){
    $tables->result['err']='таблица для загрузки не найдена';
}else{
    if ($DB->doQuery($queryToInsert)){
        $slQty_qry="select count(*) as qty from ".$_GET['tableName'];
        $slQty_res=$DB->doQuery($slQty_qry);
        $slQty_row=$DB->doFetchRow($slQty_res);
        $tables->tables[$_GET['tableName']]['qty']=$slQty_row['qty'];
    }else{
        $tables->result['err']='ошибки вставки'.$queryToInsert;
    }
}
