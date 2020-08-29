<?php
$refBlock['err']=null;
if(isset($_POST['fc_pid'])){
    if($_POST['fCm'] and $_POST['fCm']!=null){
        if(isset($_POST['fs_id']) and $_POST['fs_id']!=null){
            $rewrCm = new recordDefault('forumComments_dt', 'fc_id');
            $rewrCm['result']['fc_id']=$_POST['fc_pid'];
            if($rewrCm->copyOne()){
                $rewrCm['result']['commmentCont']=$_POST['fCm'];
                if($rewrCm->updateOne()){
                    $refBlock= printFComments(null, $_POST['fs_id'], $DB, 0, $curPage, $comsOnPage);
                    $refBlock['subjComm']=$subjComms_row['subjComm'];
                    $refBlock['subjAnsw']=$subjAnsw_row['subjAnsw'];
                }else{
                    $refBlock['err']= "ошибка fMan-rewriteComm updateOne";
                }
            }else{
                $refBlock['err']= "неправильный fc_pid";
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