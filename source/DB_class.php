<?php
class DB
{
    public $dbLink = null;
    public $err = null;
    public $connSettings = null;
    public $pathToConn = "/source/_conf/db_conn.php";

    function readSettings()
    {
        if($this->connSettings=json_decode(@file_get_contents($_SERVER["DOCUMENT_ROOT"].$this->pathToConn), true)){
            return true;
        }else{
            $this->err['settings']='connection settings not found';
        }
    }

    function connectServer()
    {
        if (@$this->dbLink = mysql_connect($this->connSettings['CONN_LOC'], $this->connSettings['CONN_USER'],
            $this->connSettings['CONN_PW'])) {
            unset($this->err['conn']);
            return true;
        } else {
            $this->err['conn'] = 'connection server fail';
        }
    }

    function connect_db()
    {
        if ($this->connectServer()) {
            if (mysql_select_db($this->connSettings['CONN_DB'], $this->dbLink)) {
                unset($this->err['conn']);
                return true;
            }
            else{
                $this->err['conn'] = 'connection database fail';
                return false;
            }
        }
    }

    function doQuery($queryText)
    {
        if ($doQuery = mysql_query($queryText)) {
            unset ($this->err['doQuery']);
            return $doQuery;
        } else {
            $this->err['doQuery'] = 'some error has occured';
            return false;
        }
    }

    function doFetchRow($doQuery)
    {
        if ($doFetchRow = @mysql_fetch_assoc($doQuery)){
            unset ($this->err['doFetchRow']);
            return $doFetchRow;
        }else {
            $this->err['doFetchRow'] = 'some error has occured';
            return false;
        }
    }
}
?>