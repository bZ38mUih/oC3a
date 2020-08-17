<?php
if(!$queryToInsert=file_get_contents($_GET['dwlTable'])){
    $tables->result['err']='таблица для загрузки не найдена';
}else{
    if ($DB->query($queryToInsert)){
        $slQty_qry="select count(*) as qty from ".$_GET['tableName'];
        $slQty_res=$DB->query($slQty_qry);
        $slQty_row=$slQty_res->fetch(PDO::FETCH_ASSOC);
        $tables->tables[$_GET['tableName']]['qty']=$slQty_row['qty'];
    }else{
        $tables->result['err']='ошибки вставки'.$queryToInsert;
    }
}
