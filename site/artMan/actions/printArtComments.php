<?php
function printArtComments($comPar_id=null, $art_id, $DB, $cntTotal=0)
{
    $tmpRes['text']=null;
    $tmpRes['cntCom']=null;
    $tmpRes['cntTotal']=null;
    if($comPar_id ==null){
        $slCm_qry = "select * from artComments_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=artComments_dt.user_id ".
            "WHERE artComments_dt.artCm_pid IS NULL and artComments_dt.activeFlag is TRUE ".
            "and artComments_dt.art_id=".$art_id." ".
            "ORDER BY artComments_dt.writeDate ";
    }else{
        $slCm_qry = "select * from artComments_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=artComments_dt.user_id ".
            "WHERE artComments_dt.artCm_pid = ".$comPar_id." and artComments_dt.activeFlag is TRUE ".
            "and artComments_dt.art_id=".$art_id." ".
            "ORDER BY artComments_dt.writeDate ";
    }
    $comCnt=0;
    if($slCm_res=$DB->doQuery($slCm_qry)){
        $comCnt=mysql_num_rows($slCm_res);
    }
    if($comCnt>0){
        $tmpRes['text'].= "<ul>";
        while ($slCm_row=$DB->doFetchRow($slCm_res)){
            $tmpCm=null;
            $tmpCm.="<li class='cmt'><div class='com-line'><div class='com-img'>";
            if($slCm_row['photoLink']){
                if($slCm_row['netWork']=='site'){
                    $tmpCm.= "<img src='".PP_USR_IMG_PAPH.$slCm_row['account_id']."/preview/".
                        $slCm_row['photoLink']."' alt='Avatar'>";
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
            $tmpCm.="</div><div class='com-date'>".$slCm_row['writeDate']."</div><div class='com-like'>";
            include ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artCmLikes.php");
            $tmpCm.="</div><div class='com-content-frame'><div class='com-content'>".$slCm_row['commmentCont'].
                "</div></div><div class='com-lv'>";
            if($_SESSION['user_id']){
                $tmpCm.="<span class='com-wrCm' id='com_".$slCm_row['artCm_id']."' onclick='newAnsw(".$slCm_row['artCm_id'].")'>Ответить</span>";
            }
            $tmpCm.="</div></div></div>";
            $tmpRes['text'].=$tmpCm;
            $responce=printArtComments($slCm_row['artCm_id'], $art_id, $DB, $tmpRes['cntTotal']);
            $tmpRes['cntTotal']+=$responce['cntTotal'];
            $tmpRes['cntTotal']++;
            if($comPar_id==null){
                $tmpRes['cntCom']++;
            }
            $cntTotal++;
            $tmpRes['text'].=$responce['text'];
            $tmpRes['text'].="</li>";
        }
        $tmpRes['text'].="</ul>";
        if($comPar_id==null) {
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artComForm.php");
        }
    }elseif($comPar_id==null){
        $tmpRes['text'].= "Напишите коммент первым";
        require_once($_SERVER['DOCUMENT_ROOT']."/site/artMan/views/artComForm.php");
    }
    return $tmpRes;
}