<?php

if(isset($_POST['queryText'])){
    $queryPosting_text = $_POST['queryText'];
    $queryPosting['result']=false;
    $queryPosting['log']=null;
    $queryPosting_res = $DB->doQuery($queryPosting_text);
    if(isset($DB->err['doQuery'])){
        $queryPosting['log']="FAIL:  ".$DB->err['doQuery'];
    }else{
        $queryPosting['result']=true;
        if(@mysql_num_rows($queryPosting_res)>0){
            $queryPosting['log']= "SUSSES: (".@mysql_num_rows($queryPosting_res).") rows";
        }else{

            $queryPosting['log']= "SUSSES: - rows";
        }
    }
    $appRJ->response['format']='json';
    $appRJ->response['result'] = $queryPosting;
}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/sql/views/defaultView.php");
}

