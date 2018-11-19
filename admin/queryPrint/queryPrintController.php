<?php
if(isset($_POST['queryText'])){
    $queryPosting_text = "SELECT ".$_POST['queryText']." LIMIT ".$_POST['qp-limit'];
    $queryPosting['result']=false;
    $queryPosting['log']=null;
    $queryPosting['table']=null;
    $queryPosting_res = $DB->doQuery($queryPosting_text);
    if(isset($DB->err['doQuery'])){
        $queryPosting['log']="FAIL:  ".$DB->err['doQuery']. "--".$queryPosting_text;
    }else{
        $queryPosting['result']=true;
        if(@mysql_num_rows($queryPosting_res)>0){
            $queryPosting['log']= "SUSSES: (".@mysql_num_rows($queryPosting_res).") rows";
            $queryPosting['table'].= "<table>";
            $queryPosting_row=$DB->doFetchRow($queryPosting_res);
            $queryPosting['table'].="<tr class='caption'>";
            foreach ($queryPosting_row as $key=>$value){
                $queryPosting['table'].="<td>".$key."</td>";
            }
            $queryPosting['table'].="</tr><tr>";
            foreach ($queryPosting_row as $key=>$value){
                $queryPosting['table'].="<td>".$value."</td>";
            }
            $queryPosting['table'].="</tr>";
            if(@mysql_num_rows($queryPosting_res)>1){
                while ($queryPosting_row=$DB->doFetchRow($queryPosting_res)){
                    $queryPosting['table'].="<tr>";
                    foreach ($queryPosting_row as $key=>$value){
                        $queryPosting['table'].="<td>".$value."</td>";
                    }
                    $queryPosting['table'].="</tr>";
                }
            }
            $queryPosting['table'].= "</table>";
        }else{
            $queryPosting['log']= "SUSSES: - rows";
        }
    }
    $appRJ->response['format']='json';
    $appRJ->response['result'] = $queryPosting;
}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/queryPrint/views/defaultView.php");
}