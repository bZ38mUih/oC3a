<?php
$appRJ->response['format']="json";
$appRJ->response['result']['error']=null;
if(isset($_GET['photo_id']) and $_GET['photo_id']!=null){
    $glComment = array("table" => "galleryComments_dt", "field_id" => "comment_id");
    $glComment['result']['photo_id']=$_GET['photo_id'];
    $slWriteAcc_qry="select galleryAlb_dt.writeRule ".
        "from galleryPhotos_dt INNER JOIN galleryAlb_dt ON galleryPhotos_dt.album_id = galleryAlb_dt.album_id ".
        "WHERE galleryPhotos_dt.photo_id=".$glComment['result']['photo_id']." LIMIT 1";
    $slWriteAcc_res = $DB->query($slWriteAcc_qry);
    if($slWriteAcc_res->rowCount() == 1) {
        $wrAccRes = false;
        $slWriteAcc_row = $slWriteAcc_res->fetch(PDO::FETCH_ASSOC);
        if ($slWriteAcc_row['writeRule'] == 'users' and isset($_SESSION['user_id'])) {
            $wrAccRes = true;
        } elseif (isset($_SESSION['groups'][$slWriteAcc_row['writeRule']])) {
            $wrAccRes = true;
        }
        if($wrAccRes){
            $glComment['result']['user_id']=$_SESSION['user_id'];
            if($_GET['comPar_id']=="null"){
                $glComment['result']['commentPar_id']=null;
            }else{
                $glComment['result']['commentPar_id']=$_GET['comPar_id'];
            }
            $glComment['result']['writeDate']=@date_format($appRJ->date['curDate'], 'Y-m-d H-i-s');
            if(isset($_GET['comment']) and $_GET['comment']!=null){
                $glComment['result']['commmentCont']=$_GET['comment'];
                if($DB->putOne($glComment)){
                    $glComment['result']['photo_id'] = $DB->lastInsertId();
                    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/gallery/actions/printComments_func.php");
                    $printComments=prtPhCm($glComment['result']['photo_id'] ,null, $DB, true);
                    $appRJ->response['result']['comments'].="<span class='cntCcomments'>Всего :<span class='cntComm-val'>".
                        $printComments['cntCom']."</span>коммент.</span>".$printComments['text'];
                }else{
                    $appRJ->response['result']['error'].="fail | commmentCont=".$glComment['result']['commmentCont']." | photo_id=".
                        $glComment['result']['photo_id'].
                        "| user_id=".$glComment['result']['user_id']." | commentPar_id=".$glComment['result']['commentPar_id']." | ".
                        "writeDate=".$glComment['result']['writeDate'];
                }
            }else{
                $appRJ->response['result']['error']='null comment';
            }
        }else{
            $appRJ->response['result']['error']='not allowed';
        }
    }else{
        $appRJ->response['result']['error']='invalid photo_id';
    }
}else{
    $appRJ->response['result']['error']='null photo_id';
}