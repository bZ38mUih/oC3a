<?php
$cmpShow=false;
if($cmpEnv){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareEnv.php");
    $cmpShow=true;
}
if($cmpHw){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareHw.php");
    $cmpShow=true;
}
if($cmpProc){
    $cmpShow=true;
    if($cmpProcPath){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareProcess.php");
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareProcess-noPath.php");
    }
}
if(!$cmpShow){
    $appRJ->response['result'].="<div class='pageErr'>nothing to show. select options and press compare</div>";
}