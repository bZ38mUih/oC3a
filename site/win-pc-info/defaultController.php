<?php
define(WD_HW_IMG, "/data/win-pc-info/hardware/");
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
elseif (isset($_GET['wiSearch']) and $_GET['wiSearch']!=null){
    $appRJ->response['format']="ajax";
    $appRJ->response['result'].="<h4>Результаты поиска:</h4>";
    if($_GET['wiSearch']=="wiFile"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/views/searchDFile.php");
    }elseif($_GET['wiSearch']=="environment"){
        $envSearch_qry="select * from wdEnvList_dt WHERE vVal LIKE '%".$_GET['searchArg']."%' order by vName, vVal";
        $envSearch_res=$DB->doQuery($envSearch_qry);
        if(mysql_num_rows($envSearch_res)>0){
            $appRJ->response['result'].="<div class='line caption'>".
                "<div class='td-45'>varName</div><div class='td-30'>varValue</div></div>";
            while ($envSearch_row=$DB->doFetchRow($envSearch_res)){
                $appRJ->response['result'].="<div class='line'><div class='td-45'>".$envSearch_row['vName']."</div>".
                    "<div class='td-30'><a href='/win-pc-info/environment/".$envSearch_row['vVal']."'>".$envSearch_row['vVal']."</a></div></div>";
            }
        }
    }elseif($_GET['wiSearch']=="hardware"){
        $hwSearch_qry="select * from wdHwList_dt WHERE paramVal LIKE '%".$_GET['searchArg']."%' ORDER BY paramName, paramVal";
        $hwSearch_res=$DB->doQuery($hwSearch_qry);
        if(mysql_num_rows($hwSearch_res)>0){
            $appRJ->response['result'].="<div class='line caption'>".
                "<div class='td-45'>pName</div><div class='td-30'>pVal</div></div>";
            while ($hwSearch_row=$DB->doFetchRow($hwSearch_res)){
                $appRJ->response['result'].="<div class='line'><div class='td-45'>".$hwSearch_row['paramName']."</div>".
                    "<div class='td-30'><a href='/win-pc-info/hardware/".urlencode($hwSearch_row['paramVal']).
                    "'>".$hwSearch_row['paramVal']."</a>";
                if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                    $appRJ->response['result'].=
                        "<br><a href='/win-pc-info/wiMan/hardware/" . urlencode($hwSearch_row['paramVal']) . "' class='editP'>" .
                        "<img src='/source/img/edit-icon.png'> - Edit</a></div>";
                }
                $appRJ->response['result'].="</div></div>";
            }
        }else{
            $appRJ->response['result']="wdHwList with tag like %".$_GET['searchArg']."% not found";
        }
    }
    else{
        $appRJ->response['result']="wrong search param";
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
        $wdList_rd = new recordDefault("wdList_dt", "wd_id");
        if(!$appRJ->server['reqUri_expl'][2]){
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){
                $wdList_rd->result['wd_id']=$_GET['wd_id'];
            }
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/defaultView.php");
        }elseif ($appRJ->server['reqUri_expl'][2]==="environment"){
            $wdInfo=null;
            if(isset($_GET['envList_id']) and $_GET['envList_id']!=null){
                $wdInfo.="<div class='wiInfo ta-left'>";
                $wdInfo_qry="select * from wdEnv_dt INNER JOIN wdEnvList_dt ON wdEnv_dt.vName=wdEnvList_dt.vName and ".
                    "wdEnv_dt.vVal=wdEnvList_dt.vVal WHERE wdEnv_dt.envList_id='".$_GET['envList_id']."'";
                $wdInfo_res=$DB->doQuery($wdInfo_qry);
                if(mysql_num_rows($wdInfo_res)==1){
                    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
                    $wdInfo.="<div class='line ta-left'><span class='fName'>".$wdInfo_row['vName'].": "."</span>".
                        "<span class='fVal'>".$wdInfo_row['vVal']."</span>";
                    $wdInfo.=    "<span class='fVal'>".$wdInfo_row['paramVal']."</span> </div><div class='whDescr'>";
                    if($wdInfo_row['vDescr']){
                        $wdInfo.=$wdInfo_row['vDescr'];
                    }else{
                        $wdInfo.="описание не задано";
                    }
                }else{
                    $appRJ->errors['404']['description']="invalid vName";
                }
                $wdInfo.="</div></div>";
            }elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
                $wdInfo.="<div class='wiInfo  ta-left'>";
                $vVal=urldecode($appRJ->server['reqUri_expl'][3]);
                $wdInfo_qry="select * from wdEnvList_dt WHERE vVal='".$vVal."'";
                $wdInfo_res=$DB->doQuery($wdInfo_qry);
                if(mysql_num_rows($wdInfo_res)==1){
                    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
                    $wdInfo.="<div class='line ta-left'><span class='fName'>".$wdInfo_row['vName'].": "."</span>".
                        "<span class='fVal'>".$wdInfo_row['vVal']."</span>";
                    $wdInfo.=    "<span class='fVal'>".$wdInfo_row['paramVal']."</span> </div><div class='whDescr'>";
                    if($wdInfo_row['vDescr']){
                        $wdInfo.=$wdInfo_row['vDescr'];
                    }else{
                        $wdInfo.="описание не задано";
                    }
                }else{
                    $appRJ->errors['404']['description']="invalid vName";
                }
                $wdInfo.="</div></div>";
            }

            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/environment.php");
        }elseif ($appRJ->server['reqUri_expl'][2]==="hardware"){
            $wdInfo=null;
            if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
                $wdInfo.="<div class='wiInfo ta-left'>";
                $pVal=urldecode($appRJ->server['reqUri_expl'][3]);
                $wdInfo_qry="select * from wdHwList_dt WHERE paramVal='".$pVal."'";
                $wdInfo_res=$DB->doQuery($wdInfo_qry);
                if(mysql_num_rows($wdInfo_res)==1){
                    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
                    $wdInfo.="<div class='line ta-left'><span class='fName'>Тип: "."</span>".
                        "<span class='fVal'>".$wdInfo_row['paramName']."</span> </div>";
                    $wdInfo.="<div class='line ta-left'>";
                    if($wdInfo_row['hwImg']){
                        $wdInfo.="<img src='".WD_HW_IMG.$wdInfo_row['paramName']."/preview/".$wdInfo_row['hwImg']."'>";
                    }

                    $wdInfo.="<span class='fVal'>".$wdInfo_row['paramVal']."</span> </div><div class='whDescr'>";
                    if($wdInfo_row['hwDescr']){
                        $wdInfo.=$wdInfo_row['hwDescr'];
                    }else{
                        $wdInfo.="описание не задано";
                    }
                }else{
                    $appRJ->errors['404']['description']="invalid pName";
                }
                $wdInfo.="</div></div>";
            }
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/hardware.php");
        }elseif ($appRJ->server['reqUri_expl'][2]==="process"){
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/process.php");
        }elseif ($appRJ->server['reqUri_expl'][2]==="services"){
            if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){

            }
        }
}


