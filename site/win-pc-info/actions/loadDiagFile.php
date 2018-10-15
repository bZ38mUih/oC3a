<?php
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