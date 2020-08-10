<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/admin/tables/tableClass.php");
$tables = new tablesClass();
$tables->initValues();
$tables->dbCompare($DB);
$tables->result['log']=null;
$tables->result['err']=false;
$tables->result['row']=null;
if($_GET){
    $appRJ->response['format']='json';
    if(isset($_GET['action'])and($_GET['action']==="refreshTables")){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tables/views/tablesView.php");
        $appRJ->response['result']= $tables->result;
    }elseif(isset($_GET['action'])and($_GET['action']==="upLoadAll")) {
        $start_time = microtime(true);
        $tables->result['log'].="Action: upLoadAll<br>";
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tables/actions/upLoadAll.php");
        $tables->result['log'].= date_format($appRJ->date['curDate'], 'Y-m-d H:i:s').'</br>';
        $end_time = microtime(true);
        $tables->result['log'].= 'lead time: '.($end_time-$start_time);
        $appRJ->response['result']= $tables->result;
    }
    else{
        $start_time = microtime(true);
        $tables->result['log'].="Action: ".$_GET['action']."<br>";
        if(isset($_GET['action'])and $_GET['action']=="download" and isset($_GET['dwlTable'])and($_GET['dwlTable'])!=null){
            $tables->result['log'].="<ul>Options:<li>tableName--> ".$_GET['tableName']."</li></ul>";
            require_once($_SERVER['DOCUMENT_ROOT'] . "/admin/tables/actions/".$_GET['action']."Table.php");
        }
        elseif(isset($_GET['action'])and $_GET['action']!=null and isset($_GET['tableName'])and($_GET['tableName'])!=null){
            $tables->result['log'].="<ul>Options:<li>tableName--> ".$_GET['tableName']."</li></ul>";
            require_once($_SERVER['DOCUMENT_ROOT'] . "/admin/tables/actions/".$_GET['action']."Table.php");
        }else{
            $tables->result['err']="Log: wrong request parameters action";
        }
        $tables->result['log'].= date_format($appRJ->date['curDate'], 'Y-m-d H:i:s').'</br>';
        $end_time = microtime(true);
        $tables->result['log'].= 'lead time: '.($end_time-$start_time);
        $appRJ->response['result']= $tables->result;
        foreach ($tables->tables as $table=>$tName) {
            $tableCells=null;
            if($table==$_GET['tableName']){
                include ($_SERVER["DOCUMENT_ROOT"]."/admin/tables/views/tablesCells.php");
                break;
            }
        }
        $appRJ->response['result']['row']= $tableCells;
    }

}else{
    require_once($_SERVER['DOCUMENT_ROOT'] . "/admin/tables/views/defaultView.php");
}