<?php
$ntfPage = 1;
$ntfLnPage=10;
$h1 ="Альбомы";
if(isset($_GET['page']) and $_GET['page']!=null){
    $ntfPage = $_GET['page'];
}
$slUsrNtf_cnt=0;
$notRdnNtf=0;
$slUsrNtf_qry="select COUNT(ntfList_id) as ntfQty, COUNT(readDate) as rdnQty from ntfList_dt WHERE user_id = ".$_SESSION['user_id'];
$slUsrNtf_res=$DB->query($slUsrNtf_qry);
if($slUsrNtf_res->rowCount() > 0){
    $slUsrNtf_row = $slUsrNtf_res->fetch(PDO::FETCH_ASSOC);
    $slUsrNtf_cnt=$slUsrNtf_row['ntfQty'];
    $notRdnNtf = $slUsrNtf_cnt-$slUsrNtf_row['rdnQty'];
}
$slUsrNtfLim_cnt=0;
$slUsrNtfLim_qry="select ntf_dt.ntfSubj, ntf_dt.ntfDate, ntfList_dt.ntfList_id, ntfList_dt.readDate from ntfList_dt ".
    "INNER JOIN ntf_dt ON ".
    "ntfList_dt.ntf_id = ntf_dt.ntf_id WHERE ntfList_dt.user_id = ".$_SESSION['user_id'].
    " ORDER BY ntf_dt.ntfDate DESC".
    " limit ".strval(($ntfPage-1)*$ntfLnPage).
    ", ".$ntfLnPage;
$slUsrNtfLim_res=$DB->query($slUsrNtfLim_qry);
if($slUsrNtfLim_res->rowCount() > 0){
    $slUsrNtfLim_cnt = $slUsrNtfLim_res->rowCount();
}
$appRJ->response['result'].= "<div class='manFrame'><div class='manTopPanel'><div class='itemsCount'>".
    "Всего: <span>".$slUsrNtf_cnt."</span> записей";
if($notRdnNtf>0){
    $appRJ->response['result'].= ", непрочитано: <span>".$notRdnNtf."</span> ";
}
if($slUsrNtf_cnt/$ntfLnPage>1){
    $appRJ->response['result'].= ", стр. ";
    $curPp=1;
    while($ntfLnPage*($curPp-1) < $slUsrNtf_cnt){
        $appRJ->response['result'].="<a href='?page=".$curPp."'";
        if($curPp==$ntfPage){
            $appRJ->response['result'].=" class='active'";
        }
        $appRJ->response['result'].=">";
        $appRJ->response['result'].=strval($curPp);
        $appRJ->response['result'].= "</a>";
        $curPp++;
    }
}
$appRJ->response['result'].= "</div><div class='newItem'></div></div>";
if($slUsrNtfLim_cnt>0){
    $appRJ->response['result'].= "<div class='item-line caption'><div class='item-line-subj'>subj</div>".
        "<div class='item-line-date'>date</div></div>";
    while ($slUsrNtfLim_row = $slUsrNtfLim_res->fetch(PDO::FETCH_ASSOC)){
        $appRJ->response['result'].= "<div class='item-line'><div class='item-line-subj'>";
        $appRJ->response['result'].= "<a href='/personal-page/notification/read?ntfList_id=".
            $slUsrNtfLim_row['ntfList_id']."'";
        if(!$slUsrNtfLim_row['readDate']){
            $appRJ->response['result'].=" class='nRdn'";
        }
        $appRJ->response['result'].=">".$slUsrNtfLim_row['ntfSubj']."</a></div>";
        $appRJ->response['result'].= "<div class='item-line-date'>".$slUsrNtfLim_row['ntfDate']."</div></div>";
    }
}else{
    $appRJ->response['result'].= "there is no notofications there<br>";
}
