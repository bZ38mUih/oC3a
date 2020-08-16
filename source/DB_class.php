<?php
class DB extends PDO
{
    public $err = null;
    public $pathToConn;
    private $connSettings;

    function __construct($pathToConn){
        $this->pathToConn = $pathToConn;
        if(!$this->connSettings=json_decode(@file_get_contents($_SERVER["DOCUMENT_ROOT"].$this->pathToConn), true)){
            $this->err = true;
        }
    }

    function connectDb()
    {
        try {
            parent::__construct('mysql:host='.$this->connSettings["CONN_LOC"].';dbname='.$this->connSettings["CONN_DB"],
                $this->connSettings["CONN_USER"], $this->connSettings["CONN_PW"]);
            return true;
        }catch (Exception $e) {
            $this->err = $e->getMessage();
        }
    }

    function copyOne($row)
    {
        $query_text="select * from ".$row['table']." where ".$row['field_id']."='".$row['result'][$row['field_id']]."'";
        $query_res = $this->query($query_text);
        if($query_res->rowCount()===1){
            $row['result']=$query_res->fetch(PDO::FETCH_ASSOC);
            /*
            foreach ($query_row as $key => $value) {
                $row['result'][$key]=$value;
            }
            */

            return $row;
        }else{
            return false;
        }
    }
    public function putOne($rd)
    {
        $queryToInsert = null;
        $queryToInsert_temp = "(";
        $queryToInsert .= "insert into ".$rd['table']." (\r";
        foreach ($rd['result'] as $key => $value) {
            if ($value === null) {
                $queryToInsert_temp .= "null, ";
            } else {
                $queryToInsert_temp .= "'" . $value. "', ";
            }
            $queryToInsert .= $key . ", ";
        }
        $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . ")\r values \r";
        $queryToInsert_temp = substr($queryToInsert_temp, 0, strlen($queryToInsert_temp) - 2) . ")";
        $queryToInsert .= $queryToInsert_temp;
        if($this->query($queryToInsert)){
            return true;
        }else{
            return false;
        }
    }

    function updateOne($table, $field_id, $row)
    {
        $query_text = "update ".$table." set ";
        foreach ($row as $key => $value) {
            $query_text.=$key."=";
            if ($value == null) {
                $query_text .= "null, ";
            } else {
                $query_text .= "'" . $value. "', ";
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text) - 2) .
            " where ".$field_id."='".$row[$field_id]."';";

        if($this->query($query_text)){
            return true;
        }else{
            return false;
        }
    }

    function removeOne($table, $field_id, $remove_id)
    {
        $query_text="delete from ".$table." where $field_id='".$remove_id."'";
        if($this->query($query_text)){
            return true;
        }else{
            return false;
        }
    }

    function setDefault($table, $row)
    {
        $query_text = "SELECT `COLUMN_NAME`
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA`='".$this->connSettings['CONN_DB']."'
    AND `TABLE_NAME`='".$table."'";

        $query_res= $this->query($query_text);
        while($query_row=$query_res->fetch(PDO::FETCH_ASSOC)){
            $row[$query_row['COLUMN_NAME']]=null;
        }
        return $row;
    }

}

/*

class DB extends PDO
{
    public $pathToConn;
    public $err = null;
    public $connSettings;

    function __construct($pathToConn){
        $this->pathToConn = $pathToConn;
        if($this->connSettings=json_decode(@file_get_contents($_SERVER["DOCUMENT_ROOT"].$this->pathToConn), true)){
            parent::__construct('mysql:host='.$this->connSettings["CONN_LOC"].';dbname='.$this->connSettings["CONN_DB"],
                $this->connSettings["CONN_USER"], $this->connSettings["CONN_PW"]);
            return true;
        }else{
            $this->err['settings']='connection settings not found';
            return false;
        }
    }

    function copyOne($table, $field_id, $row)
    {
        $query_text="select * from ".$table." where $field_id='".$row[$field_id]."'";
        $query_res = $this->query($query_text);
        if($query_res->rowCount()===1){
            $query_row=$query_res->fetch(PDO::FETCH_ASSOC);
            foreach ($query_row as $key => $value) {
                $row[$key]=$value;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function putOne($table, $row)
    {
        $queryToInsert = null;
        $queryToInsert_temp = "(";
        $queryToInsert .= "insert into ".$table." (\r";
        foreach ($row as $key => $value) {
            if ($value === null) {
                $queryToInsert_temp .= "null, ";
            } else {
                $queryToInsert_temp .= "'" . $value. "', ";
            }
            $queryToInsert .= $key . ", ";
        }
        $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . ")\r values \r";
        $queryToInsert_temp = substr($queryToInsert_temp, 0, strlen($queryToInsert_temp) - 2) . ")";
        $queryToInsert .= $queryToInsert_temp;
        if($this->query($queryToInsert)){
            return $this->lastInsertId();
        }else{
            echo $queryToInsert;
            return false;
        }
    }

    function updateOne($table, $field_id, $row)
    {
        $query_text = "update ".$table." set ";
        foreach ($row as $key => $value) {
            $query_text.=$key."=";
            if ($value == null) {
                $query_text .= "null, ";
            } else {
                $query_text .= "'" . $value. "', ";
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text) - 2) .
            " where ".$field_id."='".$row[$field_id]."';";

        if($this->query($query_text)){
            return true;
        }else{
            return false;
        }
    }

    function removeOne($table, $field_id, $remove_id)
    {
        $query_text="delete from ".$table." where $field_id='".$remove_id."'";
        if($this->query($query_text)){
            return true;
        }else{
            return false;
        }
    }

    function setDefault($table, $row)
    {
        $query_text = "SELECT `COLUMN_NAME`
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA`='".$this->connSettings['CONN_DB']."'
    AND `TABLE_NAME`='".$table."'";

        $query_res= $this->query($query_text);
        while($query_row=$query_res->fetch(PDO::FETCH_ASSOC)){
            $row[$query_row['COLUMN_NAME']]=null;
        }
        return $row;
    }
}
?>
*/