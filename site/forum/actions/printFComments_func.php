<?php
function printFComments($comPar_id=null, $fs_id, $DB)
{
    $tmpRes['text']=null;
    $tmpRes['cntCom']=null;
    if($comPar_id ==null){
        $slCm_qry = "select * from forumComments_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=forumComments_dt.user_id ".
            "WHERE forumComments_dt.fc_pid IS NULL and forumComments_dt.activeFlag is TRUE ".
            "and forumComments_dt.fs_id=".$fs_id." ".
            "ORDER BY forumComments_dt.writeDate DESC";
    }else{
        $slCm_qry = "select * from forumComments_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=forumComments_dt.user_id ".
            "WHERE forumComments_dt.fc_pid = ".$comPar_id." and forumComments_dt.activeFlag is TRUE ".
            "and forumComments_dt.fs_id=".$fs_id." ".
            "ORDER BY forumComments_dt.writeDate DESC";
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
            $tmpCm.="</div><div class='com-date'>".$slCm_row['writeDate']."</div>".
                "<div class='com-content-frame'><div class='com-content'>".$slCm_row['commmentCont'].
                "</div></div><div class='com-lv'>";
            if($_SESSION['user_id']){
                $tmpCm.="<span class='com-wrCm' id='com_".$slCm_row['fc_id']."' onclick='newAnsw(".$slCm_row['fc_id'].")'>Ответить</span>";
            }
            $tmpCm.="</div></div></div>";
            $tmpRes['text'].=$tmpCm;
            $responce=printFComments($slCm_row['fc_id'], $fs_id, $DB);
            if($comPar_id==null){
                $tmpRes['cntCom']++;
            }
            $tmpRes['text'].=$responce['text'];
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
    return $tmpRes;
}