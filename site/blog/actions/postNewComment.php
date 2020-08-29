<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/artMan/actions/printArtComments.php");
if(isset($_POST['artCm_pid'])){
    if($_POST['artCm'] and $_POST['artCm']!=null){
        if(isset($_POST['art_id']) and $_POST['art_id']!=null){
            $newCm = new recordDefault('artComments_dt', 'artCm_id');
            $newCm['result']['user_id']=$_SESSION['user_id'];
            $newCm['result']['art_id']=$_POST['art_id'];
            $newCm['result']['commmentCont']=$_POST['artCm'];
            $newCm['result']['writeDate']=@date_format($appRJ->date['curDate'], 'Y-m-d h-i-s');
            $newCm['result']['activeFlag']=true;
            if($_POST['artCm_pid'] and $_POST['artCm_pid']!=null){
                $newCm['result']['artCm_pid']=$_POST['artCm_pid'];
            }else{
                $newCm['result']['artCm_pid']=null;
            }
            if($newCm->putOne()){
                $refBlock= printArtComments(null, $_POST['art_id'], $DB, 0);
                $artComms_query="select count(artCm_id) as artComm from artComments_dt ".
                    "where art_id=".$newCm['result']['art_id']." and artCm_pid is null";
                $artAnsw_query="select count(artCm_id) as artAnsw from artComments_dt ".
                    "where art_id='".$newCm['result']['art_id']."' and artCm_pid is not null";
                $artComms_res=$DB->doQuery($artComms_query);
                $artAnsw_res=$DB->doQuery($artAnsw_query);
                $artComms_row=$DB->doFetchRow($artComms_res);
                $artAnsw_row=$DB->doFetchRow($artAnsw_res);
                $refBlock['artComm']=$artComms_row['artComm'];
                $refBlock['artAnsw']=$artAnsw_row['artAnsw'];
                if($refBlock['cntTotal']>0){
                    $refBlock['text']="<h3><span class='cmCnt'>Комментарии: <span>".$refBlock['artComm']."</span></span>".
                        "<span class='answCnt'>Ответы: <span>".$refBlock['artAnsw']."</span></span></h3>".$refBlock['text'];
                }
            }else{
                $refBlock['err']= "ошибка: метод putOne".$newCm['result']['commmentCont'];
            }
        }else{
            $refBlock['err']= "неправильный art_id";
        }
    }else{
        $refBlock['err']= "вы ничего не написали";
    }
}else{
    $refBlock['err']= "неправильный artCm_id";
}
$appRJ->response['format']='json';
$appRJ->response['result']= $refBlock;