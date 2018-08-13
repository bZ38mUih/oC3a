<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/admin/tables/tableClass.php");
$tables = new tablesClass();
$tables->initValues();
$tables->dbCompare();
$tables->result['log']=null;
$tables->result['err']=false;
if($_GET){
    if(isset($_GET['action'])and($_GET['action']==="refreshTables")){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tables/actions/tablesView.php");
    }else{
        $appRJ->date['curDate'] = @date_create();
        $start_time = microtime(true);
        $tables->result['log'].="Action: ".$_GET['action']."<br>";
        if(isset($_GET['action'])and($_GET['action']==="upLoadAll")) {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tables/actions/upLoadAll.php");
        }elseif(isset($_GET['action'])and $_GET['action']!=null and isset($_GET['tableName'])and($_GET['tableName'])!=null){
            $tables->result['log'].="<ul>Options:<li>tableName--> ".$_GET['tableName']."</li></ul>";
            require_once($_SERVER['DOCUMENT_ROOT'] . "/admin/tables/actions/".$_GET['action']."Table.php");
        }else{
            $tables->result['err']="Log: wrong request parameters action";
        }
        $tables->result['log'].= date_format($appRJ->date['curDate'], 'Y-m-d H:i:s').'</br>';
        $end_time = microtime(true);
        $tables->result['log'].= 'lead time: '.($end_time-$start_time);
    }

    $appRJ->response['format']='json';
    //$appRJ->response['result'].= json_encode($tables->result);
    $appRJ->response['result']= $tables->result;
    //$appRJ->response['result']= $tables->result;
    //exit;
}else{
    require_once($_SERVER['DOCUMENT_ROOT'] . "/admin/tables/views/defaultView.php");
}