<?php
define(WD_HW_IMG, "/data/win-diag/hardware/");
//define(GL_ALBUM_IMG_PAPH, "/data/gallery/albums/");
if($_POST){
    if(isset($_POST['hwEdit']) and $_POST['hwEdit']=='yyy'){
        $appRJ->response['format']='json';
        $hwEdit['data']=null;
        $hwEdit['err']=null;

        $paramName=null;
        $paramVal=null;
        $hwDescr=null;

        if(isset($_POST['pName']) and $_POST['pName']!=null){
            $paramName=$_POST['pName'];
        }else{
            $hwEdit['err']="null pName; ";
        }
        if(isset($_POST['pVal']) and $_POST['pVal']!=null){
            $paramVal=$_POST['pVal'];
        }else{
            $hwEdit['err'].="null pVal; ";
        }
        if(isset($_POST['hwDescr']) and  $_POST['hwDescr']!=null){
            $hwDescr=$_POST['hwDescr'];
        }else{
            $hwEdit['err']="null Description; ";
        }
        if(is_null($hwEdit['err'])){
            $slHw_qry="select * from wdHwList_dt WHERE paramVal='".$paramVal."' and paramName='".$paramName."'";
            $slHw_res=$DB->doQuery($slHw_qry);
            if(mysql_num_rows($slHw_res)===1){
                $slHw_row=$DB->doFetchRow($slHw_res);
                $udHw_qry="update wdHwList_dt set hwDescr='".$hwDescr."' ".
                    "WHERE paramVal='".$paramVal."' and paramName='".$paramName."'";
                if($DB->doQuery($udHw_qry)){
                    $hwEdit['data']="WELL";
                }else{

                }
            }else{
                $hwEdit['err'].="invalid pName or pVal; ".$slHw_qry." rows=".mysql_num_rows($slHw_res);
            }
        }
        $appRJ->response['result']=$hwEdit;
    }else{
        $paramName=null;
        $paramVal=null;
        if(isset($_POST['processor']) and $_POST['processor']!=null){
            $paramName="processor";
            $paramVal=$_POST['processor'];
        }elseif(isset($_POST['graphic']) and $_POST['graphic']!=null){

        }
        if ($paramName!=null and  $paramVal!=null){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-diag/actions/editHwImg.php");
        }
    }
}
elseif ($_GET){
    $paramName=null;
    $paramVal=null;
    if(isset($_GET['processor']) and $_GET['processor']!=null){
        $paramName="processor";
        $paramVal=$_GET['processor'];
    }elseif(isset($_GET['graphic']) and $_GET['graphic']!=null){

    }

    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-diag/actions/delHwImg.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="hardware"){
    if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4]!=null){
        $urlDec=urldecode($appRJ->server['reqUri_expl'][4]);
        $slHw_qry="select * from wdHwList_dt WHERE paramVal='".$urlDec."'";
        $slHw_res=$DB->doQuery($slHw_qry);
        if(mysql_num_rows($slHw_res)==1){
            $slHw_row=$DB->doFetchRow($slHw_res);
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-diag/views/wdMan-hardware.php");
        }else{
            $appRJ->errors['404']['description']="wrong paramName";
        }
    }
}