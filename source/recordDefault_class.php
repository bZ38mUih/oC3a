<?php

class recordDefault extends DB
{
    public $result;
    public $table;
    public $field_id;

    function __construct($table, $field_id){
        $this->table=$table;
        $this->field_id=$field_id;
    }

    public function putOne()
    {
        $queryToInsert = null;
        $queryToInsert_temp = "(";
        $queryToInsert .= "insert into ".$this->table." (\r";
        foreach ($this->result as $key => $value) {
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
        if($this->doQuery($queryToInsert)==true){
            $this->result[$this->field_id]=mysql_insert_id();
            return true;
        }else{
            return false;
        }
    }

    function updateOne()
    {
        $query_text = "update ".$this->table." set ";
        foreach ($this->result as $key => $value) {
            $query_text.=$key."=";
            if ($value == null) {
                $query_text .= "null, ";
            } else {
                $query_text .= "'" . $value. "', ";
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text) - 2) .
            " where ".$this->field_id."='".$this->result[$this->field_id]."';";

        if($this->doQuery($query_text)==true){
            return true;
        }else{
            return false;
        }
    }

    function copyOne()
    {
        $query_text="select * from ".$this->table." where $this->field_id='".$this->result[$this->field_id]."'";
        $query_res = $this->doQuery($query_text);
        if(@mysql_num_rows($query_res)==1){
            $query_row=$this->doFetchRow($query_res);
            foreach ($query_row as $key => $value) {
                $this->result[$key]=$value;
            }
            return true;
        }else{
            return false;
        }
    }

    function removeOne()
    {
        $query_text="delete from ".$this->table." where $this->field_id='".$this->result[$this->field_id]."'";
        if($this->doQuery($query_text)==true){
            return true;
        }else{
            return false;
        }
    }

    function setDefault()
    {
        $query_text = "SELECT `COLUMN_NAME`
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA`='".$this->connSettings['CONN_DB']."'
    AND `TABLE_NAME`='".$this->table."'";
        $query_res= $this->doQuery($query_text);
        while($query_row=$this->doFetchRow($query_res)){
            $this->result[$query_row['COLUMN_NAME']]=null;
        }
    }
}