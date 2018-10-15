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

if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]=="wiMan"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/wiManController.php");
}elseif(isset($_FILES) and $_FILES!=null){
    $appRJ->response['format']='json';
    $diagRes['data']=null;
    $diagRes['err']=null;
    $bindFld=null;
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/actions/loadDiagFile.php");
    $appRJ->response['result']=$diagRes;
}
elseif (isset($_GET['wdSearch'])){
    $appRJ->response['format']="ajax";
    if($_GET['wdSearch']!=null){
        //$appRJ->response['result']="not null wdSearch=".$_GET['wdSearch'];
        $wdList_qry="select * from wdList_dt WHERE wdTag LIKE '%".$_GET['wdSearch']."%'";
        $wdList_res=$DB->doQuery($wdList_qry);
        if(mysql_num_rows($wdList_res)>0){
            $appRJ->response['result'].="<div class='line caption'><div class='td-15'>wd_id</div>".
                "<div class='td-45'>wdTag</div><div class='td-30'>diagDate</div></div>";
            while ($wdList_row=$DB->doFetchRow($wdList_res)){
                $appRJ->response['result'].="<div class='line'><div class='td-15'>".$wdList_row['wd_id'].
                    "</div><div class='td-45'><a class='showRes' href='?wd_id=".$wdList_row['wd_id']."'>"
                    .$wdList_row['wdTag']."</a></div><div class='td-30'>".$wdList_row['diagDate']."</div></div>";
            }
        }else{
            $appRJ->response['result']="wdList with tag like %".$_GET['wdSearch']."% not found";
        }
    }else{
        $appRJ->response['result']="wdSearch is null";
    }
}
elseif (isset($_GET['sInfo'])){

    if(isset($_GET['pVal']) and $_GET['pVal']!=null){
        $appRJ->response['format']='json';
        $appRJ->response['result']['tInfo']=null;
        $appRJ->response['result']['content']=null;
        $appRJ->response['result']['err']=null;
        if($_GET['sInfo']=='hardware'){
            $srcHw_qry="select * from wdHwList_dt WHERE paramVal='".$_GET['pVal']."'";
            $srcHw_res=$DB->doQuery($srcHw_qry);
            if(mysql_num_rows($srcHw_res)>1){
                //$srcHw_row=$DB->doFetchRow($srcHw_res);
                $appRJ->response['result']['tInfo']='table';
                while ($srcHw_row=$DB->doFetchRow($srcHw_res)){
                    $appRJ->response['result']['content']="<div class='line'>".
                        "<div class='td-30'>".$srcHw_row['paramName']."</div>".
                        "<div class='td-60'>".$srcHw_row['paramVal']."</div>".

                        "</div>";
                    //$appRJ->response['result']['content']
                }
            }else{
                //not found
            }
        }
    }else{
        //null pVal
    }

}
else{

    if(isset($_SESSION['user_id'])){
        $wdList_rd = new recordDefault("wdList_dt", "wd_id");
        if(!$appRJ->server['reqUri_expl'][2]){
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){
                $wdList_rd->result['wd_id']=$_GET['wd_id'];
            }
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/defaultView.php");
        }elseif ($appRJ->server['reqUri_expl'][2]==="environment"){
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){

            }
        }elseif ($appRJ->server['reqUri_expl'][2]==="hardware"){
            $wdInfo=null;
            if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
                $wdInfo.="<div class='wdInfo'>";
                $pVal=urldecode($appRJ->server['reqUri_expl'][3]);
                $wdInfo_qry="select * from wdHwList_dt WHERE paramVal='".$pVal."'";
                $wdInfo_res=$DB->doQuery($wdInfo_qry);
                if(mysql_num_rows($wdInfo_res)==1){
                    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
                    $wdInfo.="<div class='hwInfo-line'><span class='fName'>Тип: "."</span>".
                        "<span class='fVal'>".$wdInfo_row['paramName']."</span> </div>";
                    $wdInfo.="<div class='hwInfo-line'><img src='/data/win-pc-info/hardware/".$wdInfo_row['paramName'].
                        "/preview/".$wdInfo_row['hwImg']."'>".
                        "<span class='fVal'>".$wdInfo_row['paramVal']."</span> </div><div class='whDescr'>";
                    if($wdInfo_row['hwDescr']){
                        $wdInfo.=$wdInfo_row['hwDescr'];
                    }else{
                        $wdInfo.="описание не задано";
                    }
                }else{
                    $appRJ->errors['404']['description']="invalid pName";
                    //$wdInfo.="i"
                }
                $wdInfo.="</div></div>";
            }

            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/hardware.php");
        }elseif ($appRJ->server['reqUri_expl'][2]==="process"){
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/process.php");

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


