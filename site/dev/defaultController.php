<?php
if($_POST['brackets']){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/dev/actions/parse-brackets.php");

    $bracketsSigns['br_1']['start']="<";
    $bracketsSigns['br_1']['end']=">";
    $bracketsSigns['br_2']['start']="{";
    $bracketsSigns['br_2']['end']="}";
    $bracketsSigns['br_3']['start']="[";
    $bracketsSigns['br_3']['end']="]";
    $bracketsSigns['br_4']['start']="(";
    $bracketsSigns['br_4']['end']=")";

    foreach ($bracketsSigns as $br_num => $br_data){
        if(!$_POST[$br_num]){
            unset($bracketsSigns[$br_num]);
        }
    }

    if($_POST['brackets-text']){
        if(checkBrackets($_POST["brackets-text"], $bracketsSigns)){
            $appRJ->response['result'] = "Правильно - Ok :-)";
        }else{
            $appRJ->response['result'] = "Не правильно - Wrong :-(";
        }

    }else{
        $appRJ->response['result'] = "строка не введена";
    }


    $appRJ->response['format'] = "ajax";
}elseif(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    $andWhere = " and artCat_dt.artCat_id = '3'";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artView.php");
}else{
    $appRJ->errors['404']['description']="страницы dev больше не существует";
}


