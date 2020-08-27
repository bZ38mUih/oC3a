<?php

if(isset($_POST['queryText'])){
    $queryPosting_text = $_POST['queryText'];
    $queryPosting['result']=false;
    $queryPosting['log']=null;
    $appRJ->response['format']='json';

    if($queryPosting_res = $DB->query($queryPosting_text)){
        $queryPosting['result']=true;
        if($queryPosting_res->rowCount() > 0){
            $queryPosting['log']= "SUSSES: (".$queryPosting_res->rowCount().") rows";
        }else{
            $queryPosting['log']= "SUSSES: - rows";
        }
        $appRJ->response['result'] = $queryPosting;
    }else{
        $queryPosting['log'] = "QUERY FAIL";
        $appRJ->response['result'] = $queryPosting;
    }

}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/sql/views/defaultView.php");
}

