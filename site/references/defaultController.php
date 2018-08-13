<?php
function prtCm($comPar_id=null, $DB)
{
    $tmpRes['text']=null;
    $tmpRes['cntCom']=null;

    if($comPar_id ==null){
        $slCm_qry = "select refCom_dt.com_id, refCom_dt.comPar_id, refCom_dt.user_id, refCom_dt.Content, ".
            "refCom_dt.writeDate, refCom_dt.activeFlag, accounts_dt.photoLink, accounts_dt.accAlias, accounts_dt.socProf from refCom_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=refCom_dt.user_id ".
            "WHERE refCom_dt.comPar_id IS NULL and refCom_dt.activeFlag is TRUE ".
            "ORDER BY refCom_dt.writeDate DESC";
    }else{
        $slCm_qry = "select refCom_dt.com_id, refCom_dt.comPar_id, refCom_dt.user_id, refCom_dt.Content, ".
            "refCom_dt.writeDate, refCom_dt.activeFlag, accounts_dt.photoLink, accounts_dt.accAlias, accounts_dt.socProf from refCom_dt ".
            "INNER JOIN accounts_dt ON accounts_dt.user_id=refCom_dt.user_id ".
            "WHERE refCom_dt.comPar_id = ".$comPar_id." and refCom_dt.activeFlag is TRUE ".
            "ORDER BY refCom_dt.writeDate DESC";
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
            $tmpCm.=$slCm_row['Content'];
            $tmpCm.="</div></div>";

            $tmpCm.="<div class='com-lv'>";
            if($_SESSION['user_id']){
                $tmpCm.="<span class='com-wrCm' id='com_".$slCm_row['com_id']."' onclick='newAnsw(".$slCm_row['com_id'].")'>Ответить</span>";
            }
            $tmpCm.="</div>";
            $tmpCm.="</div>";
            $tmpCm.="</div>";

            $tmpRes['text'].=$tmpCm;

            $responce=prtCm($slCm_row['com_id'], $DB);
            if($comPar_id==null){
                $tmpRes['cntCom']++;
            }
            $tmpRes['text'].=$responce['text'];
            $tmpRes['text'].="</li>";
        }
        $tmpRes['text'].="</ul>";
        if($comPar_id==null) {
            include($_SERVER['DOCUMENT_ROOT'] . "/site/references/views/cmForm.php");
        }
    }elseif($comPar_id==null){
        $tmpRes['text'].= "Пока еще никто не написал отзыв";
        include($_SERVER['DOCUMENT_ROOT']."/site/references/views/cmForm.php");
    }
    return $tmpRes;
}

if($_POST){
    $refBlock['err']=null;
    if($_SESSION['user_id']){
        if(isset($_POST['newComPar_id'])){
            if($_POST['yCm'] and $_POST['yCm']!=null){
                $newCm = new recordDefault('refCom_dt', 'com_id');
                $newCm->result['user_id']=$_SESSION['user_id'];
                $newCm->result['Content']=$_POST['yCm'];
                $newCm->result['writeDate']=@date_format($appRJ->date['curDate'], 'Y-m-d H-m-s');
                $newCm->result['activeFlag']=true;
                if($_POST['newComPar_id'] and $_POST['newComPar_id']!=null){
                    $newCm->result['comPar_id']=$_POST['newComPar_id'];
                }else{
                    $newCm->result['comPar_id']=null;
                }
                if($newCm->putOne()){

                    $refBlock= prtCm(null, $DB);
                }else{
                    $refBlock['err']= "ошибка: метод putOne";
                }
            }else{
                $refBlock['err']= "вы ничего не написали";
            }
        }else{
            $refBlock['err']= "неправильный par_id";
        }
        $appRJ->response['format']='json';
        $appRJ->response['result']= $refBlock;

    }else{
        $appRJ->errors['access']['description']="добавление отзыва запрещено неавторизированным пользователям";
    }
}
elseif(isset($_GET['aprVal'])){
    if(isset($_SESSION['user_id'])){
        if($_GET['aprVal']=='normal' or $_GET['aprVal']=='well' or $_GET['aprVal']=='fine'){
            $yApBf_txt="select * from refVoting_dt WHERE user_id=".$_SESSION['user_id'];
            if($yourAprBefore_res=$DB->doQuery($yApBf_txt)){
                if(mysql_num_rows($yourAprBefore_res)==1){
                    $yourApprNew_txt="update refVoting_dt set aprVal='".$_GET['aprVal']."' where user_id=".$_SESSION['user_id'];
                }else{
                    $yourApprNew_txt="insert into refVoting_dt (user_id, aprVal) VALUES (".$_SESSION['user_id'].", '".$_GET['aprVal']."')";
                }
                if(!$DB->doQuery($yourApprNew_txt)){
                    $aprArr['errors'] = "ошибка выполнения запроса yourApprNew";
                }
            }
        }else{
            $aprArr['errors'] = "неправильные параметры запроса aprVal";
        }
    }else {
        $aprArr['errors'] = "запрещено для неавторизированных пользователей";
    }
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/references/views/ref-aprec.php");
    $appRJ->response['format']='json';
    $appRJ->response['result']= $apprRes;
}
else{
    require_once ($_SERVER['DOCUMENT_ROOT']."/site/references/views/defaulView.php");
}

