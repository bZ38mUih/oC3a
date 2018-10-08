<?php
if(isset($_FILES) and $_FILES!=null){
    $appRJ->response['format']='json';
    $diagRes['data']=null;
    $fileContent=null;
    foreach ($_FILES as $file){
        $fileContent = file_get_contents($file['tmp_name']);
    }


    $diagRes['result']=true;
    $diagArr=json_decode($fileContent, true);
    if(isset($diagArr['envList'])){
        foreach ($diagArr['envList'] as $envVar=>$envVal){
            $diagRes['data'].="<div class='envLine'>".$diagArr['envList'][$envVar]['vName']." = ".$diagArr['envList'][$envVar]['vVal']."</div><hr>";
        }
    }



    //$diagRes['data'].=$fileContent;
    $appRJ->response['format']='json';
    $appRJ->response['result']=$diagRes;
    //echo "";
    //exit;
}elseif(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
    if(!$appRJ->server['reqUri_expl'][2]){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-diag/views/defaultView.php");
    }elseif ($appRJ->server['reqUri_expl'][2]==="enviropment"){

    }elseif ($appRJ->server['reqUri_expl'][2]==="hardware"){

    }elseif ($appRJ->server['reqUri_expl'][2]==="process"){

    }elseif ($appRJ->server['reqUri_expl'][2]==="services"){

    }
}else{
    $appRJ->errors['stab']="сервис временно на реконструкции";
}
