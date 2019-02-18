<?php
class tablesClass
{
    public $tables;
    public function initValues()
    {
        $this->result['log'] = null;
        $this->result['err'] = false;
        foreach (glob($_SERVER["DOCUMENT_ROOT"].TABLES_LIST."*_dt.php") as $filename){
            $this->tables[substr(basename($filename),0, strlen(basename($filename))-4)]['list']=true;
        }
    }

    public function dbCompare()
    {
        //$this->tables=null;
        $DB = new DB();
        $DB->readSettings();
        $DB->connect_db();
        $query_text = "SELECT TABLE_NAME, TABLE_ROWS FROM `information_schema`.`tables` WHERE
    `table_schema` = '".$DB->connSettings['CONN_DB']."';";
        $query_res = $DB->doQuery($query_text);
        while ($query_row = $DB->doFetchRow($query_res)) {
            foreach ($this->tables as $table => $value) {
                if ($query_row['TABLE_NAME'] == $table) {
                    $this->tables[$table]['exist'] = true;
                    break;
                }
            }
            if (!isset($this->tables[$query_row['TABLE_NAME']])) {
                $this->tables[$query_row['TABLE_NAME']]['list'] = false;
                $this->tables[$query_row['TABLE_NAME']]['exist'] = true;
            }
            $this->tables[$query_row['TABLE_NAME']]['qty'] = $query_row['TABLE_ROWS'];
        }
    }
}