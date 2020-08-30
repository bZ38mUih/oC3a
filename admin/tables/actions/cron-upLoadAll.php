<?php
$pathToConn = "/source/_conf/db_conn.php";
$ntfLog['txt']=null;
//$appRJ->response['result'].= "zzzz-1";
require_once("/home/p264533/public_html/rightjoint.ru/source/DB_class.php");
//$appRJ->response['result'].= "zzzz-2";
$DB = new DB($pathToConn);
$DB->connectDb();

require_once("/home/p264533/public_html/rightjoint.ru/admin/tables/tableClass.php");
$tables = new tablesClass();

foreach (glob("/home/p264533/public_html/rightjoint.ru/data/db/tablesList/*_dt.php") as $filename){
    $tables->tables[substr(basename($filename),0, strlen(basename($filename))-4)]['list']=true;
}



//$tables->dbCompare();
$query_text = "SELECT TABLE_NAME, TABLE_ROWS FROM `information_schema`.`tables` WHERE
    `table_schema` = '".$DB->connSettings['CONN_DB']."';";
$query_res = $DB->query($query_text);
while ($query_row = $query_res->fetch(PDO::FETCH_ASSOC)) {
    //$appRJ->response['result'].= "mmm---<br>";
    foreach ($tables->tables as $table => $value) {
        if ($query_row['TABLE_NAME'] == $table) {
            $tables->tables[$table]['exist'] = true;
            break;
        }
    }
    if (!isset($tables->tables[$query_row['TABLE_NAME']])) {
        $tables->tables[$query_row['TABLE_NAME']]['list'] = false;
        $tables->tables[$query_row['TABLE_NAME']]['exist'] = true;
    }
    $tables->tables[$query_row['TABLE_NAME']]['qty'] = $query_row['TABLE_ROWS'];
}
//$appRJ->response['result'].= "xyi-5";
//print_r($tables);
//$appRJ->response['result'].= "xyi-2";
$tables->result['log']=null;
$tables->result['err']=false;
//if($_GET){
//if(isset($_GET['action'])and($_GET['action']==="refreshTables")){
//   require_once("/home/p264533/public_html/rightjoint.ru/admin/tables/actions/tablesView.php");
//}else{
$CurDate = @date_create();
$start_time = microtime(true);
$tables->result['log'].="Action: upLoadAllTables<br>";


$orderBy=null;
mkdir("/home/p264533/public_html/rightjoint.ru/data/db/".date_format($CurDate, 'Ymd'),
    0777, true);
foreach ($tables->tables as $table => $value) {
    if ($tables->tables[$table]['exist']===true) {
        $query_text = "select * from ".$table." ".$orderBy;
        $query_res = $DB->query($query_text);
        if ($query_res->rowCount() == 0){
            $tables->result['log'].= $table."-->> nothing to upload<br>";
        }else{
            $queryToInsert = null;
            $queryToInsert_temp = "(";
            $queryToInsert .= "insert into ".$table." (\r";
            $query_row = $query_res->fetch(PDO::FETCH_ASSOC);
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
            while ($query_row = $query_res->fetch(PDO::FETCH_ASSOC)) {
                $queryToInsert .= "(";
                foreach ($query_row as $key => $value) {
                    if ($value == null) {
                        $queryToInsert .= "null, ";
                    } else {
                        $queryToInsert .= "'" . $value . "', ";
                    }
                }
                $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . "), \r";
            }
            $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 3);
            $CurDate = @date_create();
            $file="auto_".$table;
            $file .="_".date_format($CurDate, 'Ymd_His');
            $file.=".php";
            if(!file_put_contents("/home/p264533/public_html/rightjoint.ru/data/db/".
                date_format($CurDate, 'Ymd')."/".$file, $queryToInsert)){
                $tables->result['err']= $table."-->> невозможно создать файл<br>";
            }else{
                $tables->result['log'].= $table."-->> success<br>";
            }
        }
    }
}

$tables->result['log'].= date_format($CurDate, 'Y-m-d H:i:s').'</br>';
$end_time = microtime(true);
$tables->result['log'].= 'lead time: '.($end_time-$start_time);
//}
//}

$Ntf_rd = array("table" => "ntf_dt", "field_id" => "ntf_id");
$Ntf_rd['result']['ntfDate']=@date_format($CurDate, 'Y-m-d H-i-s');
$Ntf_rd['result']['activeFlag']=true;

$Ntf_rd['result']['ntfType']='group';
$Ntf_rd['result']['ntfSubscr']=1;
$Ntf_rd['result']['ntfDescr']=$tables->result['log'];
$Ntf_rd['result']['ntfSubj']="Auto Back Up";
$DB->putOne($Ntf_rd);