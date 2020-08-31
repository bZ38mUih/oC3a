<?php
class tablesClass
{
    public $tables;
    public function initValues()
    {
        $this->result['log'] = null;
        $this->result['err'] = false;
        foreach (glob($_SERVER["DOCUMENT_ROOT"].DB_UPLOADS."tablesList/*_dt.php") as $filename){
            $this->tables[substr(basename($filename),0, strlen(basename($filename))-4)]['list']=true;
        }
    }

    public function dbCompare($DB)
    {
        $query_text = "SELECT TABLE_NAME, TABLE_ROWS FROM `information_schema`.`tables` WHERE
    `table_schema` = '".$DB->connSettings['CONN_DB']."';";
        $query_res = $DB->query($query_text);
        while ($query_row = $query_res->fetch(PDO::FETCH_ASSOC)) {
            $tbl_name = null;
            foreach ($this->tables as $table => $value) {
                if ( strtolower($query_row['TABLE_NAME']) == strtolower($table)) {
                    $this->tables[$table]['exist'] = true;
                    $tbl_name = $table;
                    break;
                }
            }

            if (!isset($this->tables[$tbl_name])) {
                $this->tables[$query_row['TABLE_NAME']]['list'] = false;
                $this->tables[$query_row['TABLE_NAME']]['exist'] = true;
                $this->tables[$query_row['TABLE_NAME']]['qty'] = $query_row['TABLE_ROWS'];
            }else{
                $this->tables[$table]['qty'] = $query_row['TABLE_ROWS'];
            }

        }
    }
}