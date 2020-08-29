<?php
/*status-->*/
$curStatus=json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/site/status/status.txt"), true);
$actStat=null;
foreach ($curStatus as $key=>$val){
    if($curStatus[$key]['active']==true){
        $actStat=$curStatus[$key];
        break;
    }
}
/*<--status*/

if (isset($_GET['mkAlias'])){
    $appRJ->response['format']='ajax';
    require_once($_SERVER['DOCUMENT_ROOT'] . "/source/accessorial_class.php");
    $appRJ->response['result'].= accessorialClass::mkAlias($_GET['mkAlias']);
}
elseif (isset($_GET['shareCount'])){
    $appRJ->response['format']='json';
    require_once($_SERVER["DOCUMENT_ROOT"]."/source/shareCount.php");
}
else{
    //$Ntf_rd = new recordDefault("ntf_dt", "ntf_id");
    //$Ntf_rd['result']['ntfDate']=@date_format($appRJ->date['curDate'], 'Y-m-d H-i-s');
    //$Ntf_rd['result']['activeFlag']=true;

    @define(ART_CATEG_IMG_PAPH, "/data-arts/categs/");
    @define(ARTS_IMG_PAPH, "/data-arts/arts/");
    @define(PP_USRGR_IMG_PAPH, '/data/usersGroups/');
    @define(PP_USR_IMG_PAPH, '/data/users/');
    @define(SRV_CAT_IMG_PAPH, "/data/services/categs/");
    @define(SRV_CARD_IMG_PAPH, "/data/services/cards/");

    if($appRJ->server['reqUri_expl'][1]!=null){
        if(!@include($_SERVER["DOCUMENT_ROOT"]."/site/".$appRJ->server['reqUri_expl'][1]."/defaultController.php")){
            $appRJ->errors['404']['description']="directory '".$appRJ->server['reqUri_expl'][1]."' is not exist";
        }
    }else{
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/landing/defaultController.php");
    }
}
