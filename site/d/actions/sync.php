<?php
if($syncResult=file_get_contents($sync_server."?syncMe=y&dateTo=".$_GET['dateTo']."&dateFrom=".$_GET['dateFrom'])){
    $dNt_out = json_decode($syncResult, true);
    $appRJ->response['result']= "<h2>sync diaryNotes_td</h2>".
        "<table>".
        "<tr class='caption'><td>diaryType</td><td>noteDate</td><td>Action</td><td>Result</td></tr>";
    foreach($dNt_out['notes'] as $k=>$v){
        $appRJ->response['result'].= "<tr>";
        $dNtRep_qry="select * from diaryNotes_dt WHERE noteDate='".$v['noteDate']."' and diaryType='".$v['diaryType']."'";
        $dNtRep_res=$DB->doQuery($dNtRep_qry);
        $diary_rd->result['diary_id']=null;
        $diary_rd->result['diaryType']=$v['diaryType'];
        $diary_rd->result['noteDate']=$v['noteDate'];
        $diary_rd->result['diaryHeader']=$v['diaryHeader'];
        $appRJ->response['result'].= "<td>".$v['diaryType']."</td><td>".$v['noteDate']."</td>";
        if(mysql_num_rows($dNtRep_res)==0){
            $appRJ->response['result'].= "<td>putOne</td>";
            if($diary_rd->putOne()){
                $appRJ->response['result'].= "<td>well</td>";
            }else{
                //echo print_r($DB->err);
                $appRJ->response['result'].= "<td>putOne err occured -> ".$diary_rd->result['diaryType']." / ".
                    $diary_rd->result['noteDate']." / ".$diary_rd->result['diaryHeader']."</td>";
            }
        }else{
            $dNtRep_row=$DB->doFetchRow($dNtRep_res);
            if($dNtRep_row['diaryHeader']!=$v['diaryHeader'] and $dNtRep_row['diaryHeader']==null){

                $diary_rd->result['diary_id']=$dNtRep_row['diary_id'];
                $appRJ->response['result'].= "<td>update header</td>";
                //$appRJ->response['result'].= "<td>just aborted</td>";
                if($diary_rd->updateOne()){
                    $appRJ->response['result'].= "<td>well</td>";
                }else{
                    $appRJ->response['result'].= "<td>updateOne err occured</td>";
                }
            }else{
                $appRJ->response['result'].= "<td>no needs</td><td> - </td>";
            }
        }
        $appRJ->response['result'].= "</tr>";
    }
    $appRJ->response['result'].= "</table>".
        "<h2>sync diaryNotesContent_td</h2>".
        "<table>".
        "<tr class='caption'><td>diaryType</td><td>noteDate</td><td>curDate</td><td>curTime</td><td>Action</td><td>Result</td></tr>";
    foreach($dNt_out['content'] as $k=>$v){
        $appRJ->response['result'].= "<tr>";
        $dNtContRep_qry="select * from diaryNotesContent_dt ".
            "WHERE curDate='".$v['curDate']."' and curTime='".$v['curTime']."'";
        $dNtContRep_res=$DB->doQuery($dNtContRep_qry);
        $appRJ->response['result'].= "<td>".$v['diaryType']."</td><td>".$v['noteDate']."</td>".
            "<td>".$v['curDate']."</td><td>".$v['curTime']."</td>";
        if(mysql_num_rows($dNtContRep_res)==0){
            $appRJ->response['result'].= "<td>putOne</td>";
            $diaryId_qry="select diary_id from diaryNotes_dt ".
                "WHERE noteDate='".$v['noteDate']."' and diaryType='".$v['diaryType']."'";
            $diaryId_res=$DB->doQuery($diaryId_qry);
            if(mysql_num_rows($diaryId_res) == 1){
                $diaryId_row=$DB->doFetchRow($diaryId_res);
                $note_rd->result['note_id']=null;
                $note_rd->result['diary_id']=$diaryId_row['diary_id'];
                $note_rd->result['curDate']=$v['curDate'];
                $note_rd->result['curTime']=$v['curTime'];
                $note_rd->result['content']=$v['content'];
                if($note_rd->putOne()){
                    $appRJ->response['result'].= "<td>well</td>";
                }else{
                    $appRJ->response['result'].= "<td>putOne err occured</td>";
                }
            }else{
                $appRJ->response['result'].= "<td>not possible to insert</td>";
            }
        }else{
            $appRJ->response['result'].= "<td>no needs</td><td> - </td>";
        }
        $appRJ->response['result'].= "</tr>";
    }
    $appRJ->response['result'].= "</table>";
}else{
    $appRJ->response['result'].= "<div class='pageErr'>not possible to load data from server</div>";
}