<?php

function prtPhCm($comPar_id=null, $DB)
{
    $tmpRes['text']=null;
    $tmpRes['cntCom']=null;

    if($comPar_id ==null){
        $slCm_qry = "select galleryComments_dt.comment_id, galleryComments_dt.commentPar_id, galleryComments_dt.user_id, ".
            "galleryComments_dt.commmentCont, ".
            "galleryComments_dt.writeDate, accounts_dt.photoLink, accounts_dt.accAlias, accounts_dt.socProf from galleryComments_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=galleryComments_dt.user_id ".
            "WHERE galleryComments_dt.commentPar_id IS NULL ".
            "ORDER BY galleryComments_dt.writeDate DESC";
    }else{
        $slCm_qry = "select galleryComments_dt.comment_id, galleryComments_dt.commentPar_id, galleryComments_dt.user_id, ".
            "galleryComments_dt.commmentCont, ".
            "galleryComments_dt.writeDate, accounts_dt.photoLink, accounts_dt.accAlias, accounts_dt.socProf from galleryComments_dt ".
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
            $tmpCm.="<li>";
            $tmpCm.="<div class='com-line'>";
            $tmpCm.="<div class='com-img'>";
            if($slCm_row['photoLink']){
                $tmpCm.= "<img src='".$slCm_row['photoLink']."'>";
            }else{
                $tmpCm.= "<img src='/data/avatar-default.jpg'>";
            }
            $tmpCm.="</div>";

            $tmpCm.="<div class='com-info'>";

            $tmpCm.="<div class='com-alias'>";
            if(isset($_SESSION['user_id'])){
                if($slCm_row['socProf']){
                    $tmpCm.="<a href='".$slCm_row['socProf']."' target='_blank'>".$slCm_row['accAlias']."</a>";
                }else{
                    $tmpCm.=$slCm_row['accAlias'];
                }
            }else{
                $tmpCm.=$slCm_row['accAlias'];
            }
            $tmpCm.="</div>";

            $tmpCm.="<div class='com-date'>";
            $tmpCm.=$slCm_row['writeDate'];
            $tmpCm.="</div>";

            $tmpCm.="<div class='com-content-frame'><div class='com-content'>";
            $tmpCm.=$slCm_row['commmentCont'];
            $tmpCm.="</div></div>";

            $tmpCm.="<div class='com-lv'>";
            if($_SESSION['user_id']){
                $tmpCm.="<span class='com-wrCm' id='com_".$slCm_row['comment_id']."' onclick='newAnsw(".$slCm_row['comment_id'].")'>Ответить</span>";
            }
            $tmpCm.="</div>";
            $tmpCm.="</div>";
            $tmpCm.="</div>";

            $tmpRes['text'].=$tmpCm;

            $responce=prtCm($slCm_row['comment_id'], $DB);
            if($comPar_id==null){
                $tmpRes['cntCom']++;
            }
            $tmpRes['text'].=$responce['text'];
            $tmpRes['text'].="</li>";
        }
        $tmpRes['text'].="</ul>";
        if($comPar_id==null) {
            include($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/ptPhCmtFm.php");
        }
    }elseif($comPar_id==null){
        $tmpRes['text'].= "Пока еще никто не написал коммент";
        include($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/ptPhCmtFm.php");
    }
    return $tmpRes;
}