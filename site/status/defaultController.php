<?php
if(isset($_GET['changeStaus']) and $_GET['changeStaus']=='yes'){
    $appRJ->response['format']='json';
    $actStat=null;
    if($curStatus['free']['active']==true){
        $curStatus['free']['active']=false;
        $curStatus['lookFor']['active']=true;
        $actStat=$curStatus['lookFor'];
    }elseif ($curStatus['lookFor']['active']==true){
        $curStatus['lookFor']['active']=false;
        $curStatus['busy']['active']=true;
        $actStat=$curStatus['busy'];
    }elseif ($curStatus['busy']['active']==true){
        $curStatus['free']['active']=true;
        $curStatus['busy']['active']=false;
        $actStat=$curStatus['free'];
    }
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/site/status/status.txt", json_encode($curStatus));
    $appRJ->response['result']=$actStat;
}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/status/views/defaultView.php");
}
