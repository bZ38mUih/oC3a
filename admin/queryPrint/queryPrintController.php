<?php
if(isset($_POST['queryText'])){
    $queryPosting_text = "SELECT ".$_POST['queryText']." LIMIT ".$_POST['qp-limit'];
    $queryPosting['result']=false;
    $queryPosting['log']=null;
    $queryPosting['table']=null;
    $appRJ->response['format']='json';
    if($queryPosting_res = $DB->query($queryPosting_text)){
        $queryPosting['result']=true;
        if($queryPosting_res->rowCount() > 0){
            $queryPosting['log']= "SUSSES: (".$queryPosting_res->rowCount().") rows";
            $queryPosting['table'].= "<table>";
            $queryPosting_row = $queryPosting_res->fetch(PDO::FETCH_ASSOC);
            $queryPosting['table'].="<tr class='caption'>";
            foreach ($queryPosting_row as $key=>$value){
                $queryPosting['table'].="<td>".$key."</td>";
            }
            $queryPosting['table'].="</tr><tr>";
            foreach ($queryPosting_row as $key=>$value){
                $queryPosting['table'].="<td>".$value."</td>";
            }
            $queryPosting['table'].="</tr>";
            if($queryPosting_res->rowCount() >1){
                while ($queryPosting_row = $queryPosting_res->fetch(PDO::FETCH_ASSOC)){
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
        $appRJ->response['result'] = $queryPosting;
    }else{
        $queryPosting['log'] = "QUERY FAIL";
        $appRJ->response['result'] = $queryPosting;
    }

}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/queryPrint/views/defaultView.php");
}