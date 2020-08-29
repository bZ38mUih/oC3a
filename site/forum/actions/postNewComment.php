<?php
if(isset($_POST['fc_pid'])){
    if($_POST['fCm'] and $_POST['fCm']!=null){
        if(isset($_POST['fs_id']) and $_POST['fs_id']!=null){
            $newCm = array("table" => 'forumComments_dt', "field_id" => 'fc_id');
            $newCm['result']['user_id']=$_SESSION['user_id'];
            $newCm['result']['fs_id']=$_POST['fs_id'];
            $newCm['result']['commmentCont']=$_POST['fCm'];
            $newCm['result']['writeDate']=@date_format($appRJ->date['curDate'], 'Y-m-d H-i-s');
            $newCm['result']['activeFlag']=true;
            if($_POST['fc_pid'] and $_POST['fc_pid']!=null){
                $newCm['result']['fc_pid']=$_POST['fc_pid'];
            }else{
                $newCm['result']['fc_pid']=null;
            }
            if($DB->putOne($newCm)){
                $refBlock= printFComments(null, $_POST['fs_id'], $DB, 0, $curPage, $fOptPN, $fComSort);
                if($refBlock['cntTotal']>0){
                    $refBlock['text']="<h3>Комментарии</h3>".$refBlock['text'];
                }
                $subjComms_query="select count(fc_id) as subjComm from forumComments_dt ".
                    "where fs_id=".$newCm['result']['fs_id']." and fc_pid is null";
                $subjAnsw_query="select count(fc_id) as subjAnsw from forumComments_dt ".
                    "where fs_id='".$newCm['result']['fs_id']."' and fc_pid is not null";
                $subjComms_res=$DB->query($subjComms_query);
                $subjAnsw_res=$DB->query($subjAnsw_query);
                $subjComms_row = $subjComms_res->fetch(PDO::FETCH_ASSOC);
                $subjAnsw_row = $subjAnsw_res->fetch(PDO::FETCH_ASSOC);
                $refBlock['subjComm']=$subjComms_row['subjComm'];
                $refBlock['subjAnsw']=$subjAnsw_row['subjAnsw'];
            }else{
                $refBlock['err']= "ошибка: метод putOne".$newCm['result']['commmentCont'];
            }
        }else{
            $refBlock['err']= "неправильный fs_id";
        }
    }else{
        $refBlock['err']= "вы ничего не написали";
    }
}else{
    $refBlock['err']= "неправильный fc_id";
}
$appRJ->response['format']='json';
$appRJ->response['result']= $refBlock;