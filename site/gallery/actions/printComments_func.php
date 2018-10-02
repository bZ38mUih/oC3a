<?php

function prtPhCm($photo_id, $comPar_id=null, $DB, $wrAccRes, $cntComm=0)
{
    $tmpRes['text']=null;
    $tmpRes['cntCom']=null;

    if($comPar_id ==null){
        $slCm_qry = "select galleryComments_dt.comment_id, galleryComments_dt.commentPar_id, galleryComments_dt.user_id, ".
            "galleryComments_dt.commmentCont, ".
            "galleryComments_dt.writeDate, accounts_dt.account_id, accounts_dt.netWork, accounts_dt.photoLink, accounts_dt.accAlias, accounts_dt.socProf from galleryComments_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=galleryComments_dt.user_id ".
            "WHERE galleryComments_dt.commentPar_id IS NULL and galleryComments_dt.photo_id=".$photo_id.
            " ORDER BY galleryComments_dt.writeDate DESC";
    }else{
        $slCm_qry = "select galleryComments_dt.comment_id, galleryComments_dt.commentPar_id, galleryComments_dt.user_id, ".
            "galleryComments_dt.commmentCont, ".
            "galleryComments_dt.writeDate, accounts_dt.account_id, accounts_dt.netWork, accounts_dt.photoLink, accounts_dt.accAlias, accounts_dt.socProf ".
            "from galleryComments_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=galleryComments_dt.user_id ".
            "WHERE galleryComments_dt.commentPar_id = ".$comPar_id." ".
            "ORDER BY galleryComments_dt.writeDate DESC";
    }
    $comCnt=0;
    if($slCm_res=$DB->doQuery($slCm_qry)){
        $comCnt=mysql_num_rows($slCm_res);
    }
    if($comCnt>0){
        $tmpRes['text'].= "<ul>";
        while ($slCm_row=$DB->doFetchRow($slCm_res)){
            $tmpCm=null;
            $tmpCm.="<li><div class='com-line'><div class='com-img'>";
            if($slCm_row['photoLink']){
                if($slCm_row['netWork']=='site'){
                    $tmpCm.= "<img src='".PP_USR_IMG_PAPH."/".$slCm_row['account_id']."/preview/".$slCm_row['photoLink']."'>";
                }else{
                    $tmpCm.= "<img src='".$slCm_row['photoLink']."'>";
                }
            }else{
                $tmpCm.= "<img src='/data/avatar-default.jpg'>";
            }
            $tmpCm.="</div><div class='com-info'><div class='com-alias'>";
            if(isset($_SESSION['user_id'])){
                if($slCm_row['socProf']){
                    $tmpCm.="<a href='".$slCm_row['socProf']."' target='_blank'>".$slCm_row['accAlias']."</a>";
                }else{
                    $tmpCm.=$slCm_row['accAlias'];
                }
            }else{
                $tmpCm.=$slCm_row['accAlias'];
            }
            $tmpCm.="</div><div class='com-date'>".$slCm_row['writeDate']."</div>".
                "<div class='com-content-frame'><div class='com-content'>".$slCm_row['commmentCont']."</div></div>".
                "<div class='com-lv'>";
            if($_SESSION['user_id']){
                if($wrAccRes){
                    $tmpCm.="<span class='newComment' comm-id='".$slCm_row['comment_id']."' onclick='addComment(this)'>Ответить</span>";
                }
            }
            $tmpCm.="</div></div></div>";
            $tmpRes['text'].=$tmpCm;
            $responce=prtPhCm($photo_id, $slCm_row['comment_id'], $DB, $wrAccRes, $tmpRes['cntCom']);
            $tmpRes['cntCom']+=$responce['cntCom'];
            $tmpRes['cntCom']++;
            $tmpRes['text'].=$responce['text'];
            $tmpRes['text'].="</li>";
        }
        $tmpRes['text'].="</ul>";
        if($comPar_id==null) {
            $tmpRes['text'].="<span class='newComment' comm-id='null' onclick='addComment(this)'>Написать комментарий</span>";
        }
    }elseif($comPar_id==null){
        if($wrAccRes){
            $tmpRes['text'].="<span class='newComment' comm-id='null' onclick='addComment(this)'>Написать комментарий</span>";
        }
    }
    return $tmpRes;
}