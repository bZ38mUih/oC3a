<?php
$apprRes['content']=null;
$apprRes['err']=null;
$apprRes['qty']=0;

$aprArr['totalCnt']=0;
$aprArr['yourAprVal'] =null;
$aprArr['values']['fine']['qty']=0;
$aprArr['values']['fine']['alias']="отлично";
$aprArr['values']['fine']['color']="red";
$aprArr['values']['well']['qty']=0;
$aprArr['values']['well']['alias']="хорошо";
$aprArr['values']['well']['color']="limegreen";
$aprArr['values']['normal']['qty']=0;
$aprArr['values']['normal']['alias']="нормально";
$aprArr['values']['normal']['color']="aqua";

if($_SESSION['user_id']){
    $yourApr_txt="select * from refVoting_dt WHERE user_id=".$_SESSION['user_id'];
    if($yourApr_res=$DB->doQuery($yourApr_txt)){
        if(mysql_num_rows($yourApr_res)==1){
            $yourApr_row=$DB->doFetchRow($yourApr_res);
            $aprArr['yourAprVal']=$yourApr_row['aprVal'];
        }
    }

}

$printApprec_txt="select COUNT(user_id) as aprQty, aprVal from refVoting_dt GROUP BY aprVal ORDER BY aprVal";
$printApprec_cnt=0;

if($printApprec_res=$DB->doQuery($printApprec_txt)){
    $printApprec_cnt=mysql_num_rows($printApprec_res);
}

$maxAprVal=0;

if($printApprec_cnt>0){

    while($printApprec_row=$DB->doFetchRow($printApprec_res)){
        $aprArr['totalCnt']+=$printApprec_row['aprQty'];
        if($maxAprVal<$printApprec_row['aprQty']){
            $maxAprVal=$printApprec_row['aprQty'];
        }
        $aprArr['values'][$printApprec_row['aprVal']]['qty']=$printApprec_row['aprQty'];
    }

    foreach($aprArr['values'] as $key=>$value){
        $apprRes['content'].= "<div class='apprec-line ".$key."'>";
        $apprRes['content'].= "<span class='apprec-val' ";
        if($_SESSION['user_id']){
            $apprRes['content'].= "onclick='appreciate(".'"'.$key.'"'.")'";
        }
        if($aprArr['yourAprVal']==$key){
            $apprRes['content'].= " style='text-decoration: underline; ' ";
        }

        $apprRes['content'].= ">".$aprArr['values'][$key]['alias']."</span>";

        $wdPr=round($aprArr['values'][$key]['qty']/$maxAprVal*100);

        $apprRes['content'].= "<span class='apprec-back' ".
            " style='background: linear-gradient(to right, ".
            $aprArr['values'][$key]['color']." ".$wdPr."%, rgba(25,25,50,1) ".strval(100 - $wdPr)."%); ".
            "background-repeat: no-repeat;' >".
            //"<span class='apprec-back-val'>".strval(round($aprArr['values'][$key]['qty']/$aprArr['totalCnt']*100))."%</span>".
            "</span>".
            "</div>";
    }

}else{

    foreach($aprArr['values'] as $key=>$value){
        $apprRes['content'].= "<div class='apprec-line ".$key."'>";
        $apprRes['content'].= "<span class='apprec-val' ";
        if($_SESSION['user_id']){
            $apprRes['content'].= "onclick='appreciate(".'"'.$key.'"'.")'";
        }
        $apprRes['content'].= ">".$aprArr['values'][$key]['alias']."</span>";
        $apprRes['content'].= "<span class='apprec-back'>".
            "<span class='apprec-back-val'>".$aprArr['values'][$key]['qty']."%</span>".
            "</span>";
        $apprRes['content'].= "</div>";
    }

}

if($aprArr['errors']){
    $apprRes['content'].= "<div class='aprErrors'>";
    $apprRes['content'].= $aprArr['errors'];
    $apprRes['content'].= "</div>";

}

$apprRes['err']=$aprArr['errors'];
$apprRes['qty']=$aprArr['totalCnt'];