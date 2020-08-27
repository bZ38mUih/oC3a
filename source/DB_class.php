<?php
class DB extends PDO
{
    public $err = null;
    public $pathToConn;
    public $connSettings;

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

    function copyOne($rd)
    {
        $query_text="select * from ".$rd['table']." where ".$rd['field_id']."='".$rd['result'][$rd['field_id']]."'";
        $query_res = $this->query($query_text);
        if($query_res->rowCount()===1){
            $rd['result']=$query_res->fetch(PDO::FETCH_ASSOC);
            return $rd;
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

    function updateOne($rd)
    {
        $query_text = "update ".$rd['table']." set ";
        foreach ($rd['result'] as $key => $value) {
            $query_text.=$key."=";
            if ($value == null) {
                $query_text .= "null, ";
            } else {
                $query_text .= "'" . $value. "', ";
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text) - 2) .
            " where ".$rd['field_id']."='".$rd['result'][$rd['field_id']]."';";

        if($this->query($query_text)){
            return true;
        }else{
            return false;
        }
    }

    function removeOne($rd)
    {
        $query_text="delete from ".$rd['table']." where ".$rd['field_id']."='".$rd['result'][$rd['field_id']]."'";
        if($this->query($query_text)){
            return true;
        }else{
            return false;
        }
    }

    function setDefault($rd)
    {
        $query_text = "SELECT `COLUMN_NAME`
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA`='".$this->connSettings['CONN_DB']."'
    AND `TABLE_NAME`='".$rd['table']."'";

        $query_res= $this->query($query_text);
        while($query_row=$query_res->fetch(PDO::FETCH_ASSOC)){
            $rd['result'][$query_row['COLUMN_NAME']]=null;
        }
        return $rd;
    }

}