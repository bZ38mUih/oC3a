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
$fileContent=null;
foreach ($_FILES as $file){
    $fileContent = file_get_contents($file['tmp_name']);
}
$diagArr=json_decode($fileContent, true);
$wdList_rd = new recordDefault("wdList_dt", "wd_id");
$wdList_rd->result['wdTag']=$diagArr['fName'];
$wdList_rd->result['comment']=null;
$wdList_rd->result['diagDate']=date_format($appRJ->date['curDate'], "Y-m-d h:i:s");
$wdList_rd->result['user_id']=$_SESSION['user_id'];
$bindVal=null;
if($wdList_rd->putOne()){
    $bindFld="wd_id";
    $bindVal=$wdList_rd->result['wd_id'];
    if(isset($diagArr['envList'])){
        $insEnv_qry=insertArray("wdEnv_dt", $bindFld, $bindVal, $diagArr['envList']);
        if($DB->doQuery($insEnv_qry)){
            $difEnv_qry="select wdEnv_dt.vName, wdEnv_dt.vVal from wdEnv_dt ".
                "LEFT JOIN wdEnvList_dt ON wdEnv_dt.vName=wdEnvList_dt.vName and wdEnv_dt.vVal=wdEnvList_dt.vVal ".
                "WHERE wdEnv_dt.wd_id=".$bindVal." and wdEnv_dt.vName<>'MachineName' ".
                "and wdEnv_dt.vName<>'UserName' ".
                "and wdEnvList_dt.vName is null ".
                "and wdEnvList_dt.vVal is null ".
                "order by wdEnv_dt.vName, wdEnv_dt.vVal";
            $insertEnvList_qry="insert into wdEnvList_dt(vName, vVal) ".$difEnv_qry;
            $DB->doQuery($insertEnvList_qry);
        }else{
            $diagRes['err'].="envList-FAIL<hr>";
        }
    }
    if(isset($diagArr['hardwareList'])){
        $insHw_qry=insertArray("wdHw_dt", $bindFld, $bindVal, $diagArr['hardwareList']);
        if($DB->doQuery($insHw_qry)){
            $difHw_qry="select wdHw_dt.paramName, wdHw_dt.paramVal from wdHw_dt ".
                "LEFT JOIN wdHwList_dt ON wdHw_dt.paramName=wdHwList_dt.paramName and wdHw_dt.paramVal=wdHwList_dt.paramVal ".
                "WHERE wdHw_dt.wd_id=".$bindVal." and wdHwList_dt.paramName is null and wdHwList_dt.paramVal is null and ".
                "wdHw_dt.paramName<>'RAM' ".
                "order by wdHw_dt.paramName, wdHw_dt.paramVal";
            $insertHwList_qry="insert into wdHwList_dt(paramName, paramVal) ".$difHw_qry;
            $DB->doQuery($insertHwList_qry);
        }else{
            $diagRes['err'].="hwList-FAIL<hr>";
        }
    }
    if(isset($diagArr['procList'])){
        $insProc_qry.=insertArray("wdProc_dt", $bindFld, $bindVal, $diagArr['procList']);
        if($DB->doQuery($insProc_qry)){
            $difProc_qry="select distinct wdProc_dt.pName from wdProc_dt ".
                "LEFT JOIN wdProcList_dt ON wdProc_dt.pName=wdProcList_dt.pName ".
                "WHERE wdProc_dt.wd_id=".$bindFld." and wdProcList_dt.pName is null order by wdProc_dt.pName";
            $insertProc_qry="insert into wdProcList_dt(pName) ".$difProc_qry;
            $DB->doQuery($insertProc_qry);
            $difProcPID_qry="select wdProc_dt.pName, wdProc_dt.PID from wdProc_dt ".
                "LEFT JOIN wdProcPID_dt ON wdProc_dt.pName=wdProcPID_dt.pName and wdProc_dt.PID=wdProcPID_dt.PID ".
                "WHERE wdProc_dt.wd_id=".$bindFld." and wdProcPID_dt.pName is null and wdProcPID_dt.pName is null ".
                "order by wdProc_dt.pName, wdProc_dt.PID";
            $insertProcPID_qry="insert into wdProcPID_dt(pName, PID) ".$difProcPID_qry;
            $DB->doQuery($insertProcPID_qry);
            $difProcPath_qry="select DISTINCT wdProc_dt.pName, wdProc_dt.pPath from wdProc_dt ".
                "LEFT JOIN wdProcPath_dt ON wdProc_dt.pName=wdProcPath_dt.pName and wdProc_dt.pPath=wdProcPath_dt.pPath ".
                "WHERE wdProc_dt.wd_id=".$bindFld." and wdProcPath_dt.pName is null and wdProcPath_dt.pPath is null ".
                "order by wdProc_dt.pName, wdProc_dt.pPath";
            $insertProcPath_qry="insert into wdProcPath_dt(pName, pPath) ".$difProcPath_qry;
            $DB->doQuery($insertProcPath_qry);
        }else{
            $diagRes['err'].="processList-FAIL<hr>";
        }
    }
    if(isset($diagArr['srvList'])){
        $insSrv_qry.=insertArray("wdSrv_dt", $bindFld, $bindVal, $diagArr['srvList']);
        if($DB->doQuery($insSrv_qry)){
            $difSrv_qry="select distinct wdSrv_dt.sName from wdSrv_dt ".
                "LEFT JOIN wdSrvList_dt ON wdSrv_dt.sName=wdSrvList_dt.sName ".
                "WHERE wdSrv_dt.wd_id=".$bindFld." and wdSrvList_dt.sName is null".
                " order by wdSrv_dt.sName";
            $insertSrv_qry="insert into wdSrvList_dt(sName) ".$difSrv_qry;
            $DB->doQuery($insertSrv_qry);
            $difSrvSTName_qry="select wdSrv_dt.sName, wdSrv_dt.sSTName from wdSrv_dt ".
                "LEFT JOIN wdSrvSTName_dt ON wdSrv_dt.sName=wdSrvSTName_dt.sName and wdSrv_dt.sSTName=wdSrvSTName_dt.sSTName ".
                "WHERE wdSrv_dt.wd_id=".$bindFld." and wdSrvSTName_dt.sName is null and wdSrvSTName_dt.sSTName is null ".
                "order by wdSrv_dt.sName, wdSrv_dt.sSTName";
            $insertSrvSTName_qry="insert into wdSrvSTName_dt(sName, sSTName) ".$difSrvSTName_qry;
            $DB->doQuery($insertSrvSTName_qry);
            $difSrvPath_qry="select DISTINCT wdSrv_dt.sName, wdSrv_dt.sPath from wdSrv_dt ".
                "LEFT JOIN wdSrvPath_dt ON wdSrv_dt.sName=wdSrvPath_dt.sName and wdSrv_dt.sPath=wdSrvPath_dt.sPath ".
                "WHERE wdSrv_dt.wd_id=".$bindFld." and wdSrvPath_dt.sName is null and wdSrvPath_dt.sPath is null ".
                "order by wdSrv_dt.sName, wdSrv_dt.sPath";
            $insertSrvPath_qry="insert into wdSrvPath_dt(sName, sPath) ".$difSrvPath_qry;
            $DB->doQuery($insertSrvPath_qry);
        }else{
            $diagRes['err'].="srvList-FAIL<hr>";
        }
    }
}
$diagRes['data']=$bindVal;
$diagRes['wd_id']=$bindVal;