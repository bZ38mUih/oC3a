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
            foreach ($this->tables as $table => $value) {
                if ( $query_row['TABLE_NAME'] == $table) {
                    $this->tables[$table]['exist'] = true;
                    break;
                }
            }
            if (!isset($this->tables[$table])) {
                $this->tables[$table]['list'] = false;
                $this->tables[$table]['exist'] = true;
            }
            $this->tables[$table]['qty'] = $query_row['TABLE_ROWS'];
        }
    }
}