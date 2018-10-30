<?php
$orderBy=null;
$tables->result['log'].="prefixTag=".$_GET['prefixTag']."<br>dateTag=".$_GET['dateTag']."<br>";
$query_text = "select * from ".$_GET['tableName']." ".$orderBy;
$query_res = $DB->doQuery($query_text);
if (mysql_num_rows($query_res)==0){
    $tables->result['log'].= "nothing to upload<br>";
}else
{
    $queryToInsert = null;
    $queryToInsert_temp = "(";
    $queryToInsert .= "insert into ".$_GET['tableName']." (\r";
    $query_row = $DB->doFetchRow($query_res);
    foreach ($query_row as $key => $value) {
        if ($value == null) {
            $queryToInsert_temp .= "null, ";
        } else {
            $queryToInsert_temp .= "'" . $value . "', ";
        }
        $queryToInsert .= $key . ", ";
    }
    $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . ")\r values \r";
    $queryToInsert_temp = substr($queryToInsert_temp, 0, strlen($queryToInsert_temp) - 2) . "), \r";
    $queryToInsert .= $queryToInsert_temp;
    while ($query_row = $DB->doFetchRow($query_res)) {
        $queryToInsert .= "(";
        foreach ($query_row as $key => $value) {
            if ($value == null) {
                $queryToInsert .= "null, ";
            } else {
                $queryToInsert .= "'" . mysql_real_escape_string($value)  . "', ";
            }
        }
        $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . "), \r";
    }
    $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 3);
    $appRJ->date['curDate'] = @date_create();
    if(isset($_GET['prefixTag']) and $_GET['prefixTag']!=null){
        $file = htmlspecialchars($_GET['prefixTag'])."-".$_GET['tableName'];
    }else{
        $file = $_GET['tableName'];
    }
    if($_GET['dateTag']=='true'){
        $file .="_".date_format($appRJ->date['curDate'], 'Ymd_His');
    }
    $file.=".php";
    if(!file_put_contents($_SERVER["DOCUMENT_ROOT"]."/".DB_UPLOADS.$file, $queryToInsert)){
        $tables->result['err'].= "невозможно сохранить файл";
    }
}