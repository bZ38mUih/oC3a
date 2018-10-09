<?php
function insertArray($tblName, $bindFld, $bindVal, $tgArr)
{
    $insVals=null;
    $insFld="(".$bindFld.", ";
    foreach ($tgArr as $key=>$val){
        foreach ($val as $kKey=>$kVal){
            $insFld.=$kKey.", ";
        }
        break;
    }
    $insFld=substr($insFld, 0, strlen($insFld)-2);
    $insFld.=")\n values \n";
    foreach ($tgArr as $key=>$val){
        $insVals.="(".$bindVal.", ";
        foreach ($val as $kKey=>$kVal){
            $insVals.="'".$kVal."', ";
        }
        $insVals=substr($insVals, 0, strlen($insVals)-2);
        $insVals.="),\n";
    }
    $insVals=substr($insVals, 0, strlen($insVals)-2);
    return "insert into ".$tblName." \n".$insFld.$insVals;
}

if(isset($_FILES) and $_FILES!=null){
    $appRJ->response['format']='json';
    $diagRes['data']=null;
    $fileContent=null;
    foreach ($_FILES as $file){
        $fileContent = file_get_contents($file['tmp_name']);
    }
    $diagRes['result']=true;
    $diagArr=json_decode($fileContent, true);
    $wdList_rd = new recordDefault("wdList_dt", "wd_id");
    $wdList_rd->result['wdTag']=$diagArr['fName'];
    $wdList_rd->result['comment']=null;
    $wdList_rd->result['diagDate']=date_format($appRJ->date['curDate'], "Y-m-d h:i:s");
    $diagRes['data'].="<hr>".$wdList_rd->result['wdTag']."<hr>";
    $bindVal=null;
    if($wdList_rd->putOne()){
        $bindFld="wd_id";
        $bindVal=$wdList_rd->result['wd_id'];

        if(isset($diagArr['envList'])){
            $insEnv_qry=insertArray("wdEnv_dt", $bindFld, $bindVal, $diagArr['envList']);
            if($DB->doQuery($insEnv_qry)){
                $diagRes['data'].="envList-WELL<hr>";
            }else{
                $diagRes['data'].="envList-FAIL<hr>";
                $diagRes['data'].=$insEnv_qry."<hr>";
            }
        }
        if(isset($diagArr['hardwareList'])){
            $insHw_qry=insertArray("wdHw_dt", $bindFld, $bindVal, $diagArr['hardwareList']);
            if($DB->doQuery($insHw_qry)){
                $diagRes['data'].="hwList-WELL<hr>";
            }else{
                $diagRes['data'].="hwList-FAIL<hr>";
                $diagRes['data'].=$insHw_qry."<hr>";
            }
        }
        if(isset($diagArr['procList'])){
            $insProc_qry.=insertArray("wdProc_dt", $bindFld, $bindVal, $diagArr['procList']);
            if($DB->doQuery($insProc_qry)){





                $diagRes['data'].="processList-WELL<hr>";
            }else{
                $diagRes['data'].="processList-FAIL<hr>";
                $diagRes['data'].=$insProc_qry."<hr>";
            }
        }
        if(isset($diagArr['srvList'])){
            $insSrv_qry.=insertArray("wdSrv_dt", $bindFld, $bindVal, $diagArr['srvList']);
            if($DB->doQuery($insSrv_qry)){
                $diagRes['data'].="srvList-WELL<hr>";
            }else{
                $diagRes['data'].="srvList-FAIL<hr>";
                $diagRes['data'].=$insSrv_qry."<hr>";
            }
        }
    }
    $diagRes['wd_id']=$bindVal;
    $appRJ->response['format']='json';
    $appRJ->response['result']=$diagRes;
}
elseif (isset($_GET['wdSearch'])){
    $appRJ->response['format']="ajax";
    if($_GET['wdSearch']!=null){
        //$appRJ->response['result']="not null wdSearch=".$_GET['wdSearch'];
        $wdList_qry="select * from wdList_dt WHERE wdTag LIKE '%".$_GET['wdSearch']."%'";
        $wdList_res=$DB->doQuery($wdList_qry);
        if(mysql_num_rows($wdList_res)>0){
            $appRJ->response['result'].="<div class='search-line caption'><div class='s-l-id'>wd_id</div>".
                "<div class='s-l-tag'>wdTag</div><div class='s-l-date'>diagDate</div></div>";
            while ($wdList_row=$DB->doFetchRow($wdList_res)){
                $appRJ->response['result'].="<div class='search-line'><div class='s-l-id'>".$wdList_row['wd_id'].
                    "</div><div class='s-l-tag'><a class='showRes' href='?wd_id=".$wdList_row['wd_id']."'>"
                    .$wdList_row['wdTag']."</a></div><div class='s-l-date'>".$wdList_row['diagDate']."</div></div>";
            }
        }else{
            $appRJ->response['result']="wdList with tag like %".$_GET['wdSearch']."% not found";
        }
    }else{
        $appRJ->response['result']="wdSearch is null";
    }
}
else{

    if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
        $wdList_rd = new recordDefault("wdList_dt", "wd_id");
        if(!$appRJ->server['reqUri_expl'][2]){
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){
                $wdList_rd->result['wd_id']=$_GET['wd_id'];
            }
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-diag/views/defaultView.php");
        }elseif ($appRJ->server['reqUri_expl'][2]==="enviropment"){
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){

            }
        }elseif ($appRJ->server['reqUri_expl'][2]==="hardware"){
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){

            }
        }elseif ($appRJ->server['reqUri_expl'][2]==="process"){
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/win-diag/views/process.php");

            /*
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){

            }
            */
        }elseif ($appRJ->server['reqUri_expl'][2]==="services"){
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){

            }
        }
    }else{
        $appRJ->errors['stab']="сервис временно на реконструкции";
    }
}


