<?php
function printFCommentsList2($comPar_id=null, $fs_id, $DB, $cntTotal=0, $page=1, $cLim=10, $sortOpt="ASC"){
    $pfclRes=null;
    if($comPar_id!=null){
        $slCm_qry = "select * from forumComments_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=forumComments_dt.user_id ".
            "WHERE forumComments_dt.fc_id = ".$comPar_id." and forumComments_dt.activeFlag is TRUE ".
            "and forumComments_dt.fs_id=".$fs_id." ".
            "ORDER BY forumComments_dt.writeDate ".$sortOpt;
        $slCm_res=$DB->doQuery($slCm_qry);
        $slCm_row=$DB->doFetchRow($slCm_res);
        $pfclRes="<div class='com-quote-line'><div class='com-info'><div class='com-alias'>".
            $slCm_row['accAlias']."</div><div class='com-date'>".$slCm_row['writeDate']."</div></div>";
        $responce=printFCommentsList2($slCm_row['fc_pid'], $fs_id, $DB, 0, $page, $cLim, $sortOpt);
        $pfclRes.=$responce;
        $pfclRes.=$slCm_row['commmentCont']."</div>";
        //$pfclRes=$slCm_row['commmentCont'];
    }
    return $pfclRes;
}



function printFComments($comPar_id=null, $fs_id, $DB, $cntTotal=0, $page=1, $cLim=10, $sortOpt="ASC")
{
    $tmpRes['text']=null;
    $tmpRes['cntCom']=null;
    $tmpRes['cntTotal']=null;
    //if($comPar_id ==null){
    $slCm_qry = "select * from forumComments_dt ".
        "INNER JOIN accounts_dt ON accounts_dt.user_id=forumComments_dt.user_id ".
        "WHERE forumComments_dt.activeFlag is TRUE ".
        "and forumComments_dt.fs_id=".$fs_id." ".
        "ORDER BY (forumComments_dt.likePlus-forumComments_dt.likeMinus) DESC, forumComments_dt.writeDate ".$sortOpt." LIMIT ".(($page-1)*10).", ".$cLim;
    $comCnt=0;
    if($slCm_res=$DB->doQuery($slCm_qry)){
        $comCnt=mysql_num_rows($slCm_res);
    }
    if($comCnt>0){
        $tmpRes['text'].= "<ul>";
        while ($slCm_row=$DB->doFetchRow($slCm_res)){
            $cntTotal++;
            $tmpRes['text'].="<li class='cmt'>";
            if($slCm_row['fc_pid']!=null){

                $responce=printFCommentsList2($slCm_row['fc_pid'], $fs_id, $DB, $tmpRes['cntTotal'], $page, $cLim, $sortOpt);
            }
            $tmpRes['text'].="<div class='com-line'><div class='com-img'>";
            if($slCm_row['photoLink']){
                if($slCm_row['netWork']=='site'){
                    $tmpRes['text'].= "<img src='".PP_USR_IMG_PAPH.$slCm_row['account_id']."/preview/".
                        $slCm_row['photoLink']."' alt='Avatar'>";
                }else{
                    $tmpRes['text'].= "<img src='".$slCm_row['photoLink']."'>";
                }
            }else{
                $tmpRes['text'].= "<img src='/data/avatar-default.jpg'>";
            }
            $tmpRes['text'].="</div><div class='com-info'><div class='com-alias'>";
            if(isset($_SESSION['user_id'])){
                if($slCm_row['socProf']){
                    $tmpRes['text'].="<a href='".$slCm_row['socProf']."' target='_blank'>".$slCm_row['accAlias']."</a>";
                }else{
                    $tmpRes['text'].=$slCm_row['accAlias'];
                }
            }else{
                $tmpRes['text'].=$slCm_row['accAlias'];
            }
            $tmpRes['text'].="</div><div class='com-date'>".$slCm_row['writeDate']."</div>".
            "<div class='com-like'>";
            $tmpCm=null;
            include ($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/cmLikes.php");
            $tmpRes['text'].=$tmpCm."</div>";

            if($responce){
                $tmpRes['text'].="<div class='quote-block'><span class='com-quote'>Цитата</span>".$responce."</div>";
            }
            $tmpRes['text'].="<div class='com-content-frame'><div class='com-content'>".$slCm_row['commmentCont'].
                "</div></div><div class='com-lv'>";
            if($_SESSION['user_id']){
                $tmpRes['text'].="<span class='com-wrCm' id='com_".$slCm_row['fc_id']."' onclick='newAnsw(".$slCm_row['fc_id'].")'>Ответить</span>";
            }
            $tmpRes['text'].="</div></div></div>";
            $tmpRes['text'].="</li>";
        }
        $tmpRes['text'].="</ul>";
        if($comPar_id==null) {
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fComForm.php");
        }
    }elseif($comPar_id==null){
        $tmpRes['text'].= "Напишите коммент первым";
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/views/fComForm.php");
    }
    $tmpRes['cntTotal']=$cntTotal;
    return $tmpRes;
}