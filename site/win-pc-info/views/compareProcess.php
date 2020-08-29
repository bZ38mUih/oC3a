<?php
$slProcLeft_qry="select DISTINCT wdProc_dt.pName as pNameLeft, wdProc_dt.pPath AS pPathLeft, ".
    "wdProcList_dt.pImg as pImgLeft, wdProcList_dt.pDescr as pDescrLeft from wdProc_dt LEFT JOIN wdProcList_dt ON ".
    "wdProc_dt.pName=wdProcList_dt.pName WHERE wd_id=".$cmpLeft;
$slProcRight_qry="select DISTINCT wdProc_dt.pName as pNameRight, wdProc_dt.pPath AS pPathRight, ".
    "wdProcList_dt.pImg as pImgRight, wdProcList_dt.pDescr as pDescrRight from wdProc_dt LEFT JOIN wdProcList_dt ON ".
    "wdProc_dt.pName=wdProcList_dt.pName WHERE wd_id=".$cmpRight;

$slDifProc_qry="select * from (".$slProcLeft_qry.") as wdProcLeft left join (".$slProcRight_qry.") as wdProcRight".
    " on wdProcLeft.pNameLeft = wdProcRight.pNameRight ".
    "and wdProcLeft.pPathLeft=wdProcRight.pPathRight ".
    "union select * from (".$slProcLeft_qry.") as wdProcLeft right join (".$slProcRight_qry.") as wdProcRight".
    " on wdProcLeft.pNameLeft = wdProcRight.pNameRight ".
    "and wdProcLeft.pPathLeft=wdProcRight.pPathRight order by pNameLeft, pNameRight";

$slDifProc_res=$DB->query($slDifProc_qry);
if(mysql_num_rows($slDifProc_res)>0){
    $appRJ->response['result'].="<h3>Процессы (".mysql_num_rows($slDifProc_res).")</h3>";
    $leftDifCnt=0;
    $rightDifCnt=0;
    $pLines=null;
    while ($slDifProc_row = $slDifProc_res->fetch(PDO::FETCH_ASSOC)){
        $pLineClass=null;
        $pLine=null;
        $pLine.="<div class='td-24'>";
        if($slDifProc_row['pNameLeft']){
            $pLine.="<div class='pCell-img'>";
            if($slDifProc_row['pImgLeft']){
                $pLine.="<img src='".WD_PROC_IMG.$slDifProc_row['pImgLeft']."'>";
            }else{
                $pLine.="<img src='/data/default-img.png'>";
            }
            $pLine.="</div><div class='pCell-name'>";
            if($slDifProc_row['pDescrLeft']){
                $pLine.="<a href='/handbook/win-process/".urlencode($slDifProc_row['pNameLeft'])."' title='подробнее'>";
            }else{
                $pLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $pLine.=$slDifProc_row['pNameLeft'];
            $pLine.="</a></div>";
        }else{
            $leftDifCnt++;
            $pLine.="-";
            $pLineClass="no-left";
        }
        $pLine.="</div><div class='td-24'>";

        if($slDifProc_row['pPathLeft']){
            $pLine.=$slDifProc_row['pPathLeft'];
        }else{
            $pLine.="-";
        }
        $pLine.="</div><div class='td-24'>";
        if($slDifProc_row['pNameRight']){
            $pLine.="<div class='pCell-img'>";
            if($slDifProc_row['pImgRight']){
                $pLine.="<img src='".WD_PROC_IMG.$slDifProc_row['pImgRight']."'>";
            }else{
                $pLine.="<img src='/data/default-img.png'>";
            }
            $pLine.="</div><div class='pCell-name'>";
            if($slDifProc_row['pDescrRight']){
                $pLine.="<a href='/handbook/win-process/".urlencode($slDifProc_row['pNameRight'])."' title='подробнее'>";
            }else{
                $pLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $pLine.=$slDifProc_row['pNameRight'];
            $pLine.="</a></div>";
        }else{
            $rightDifCnt++;
            $pLine.="-";
            $pLineClass="no-right";
        }
        $pLine.="</div><div class='td-24'>";
        if($slDifProc_row['pPathRight']){
            $pLine.=$slDifProc_row['pPathRight'];
        }else{
            $pLine.="-";
        }
        $pLine.="</div>";
        $pLines.="<div class='line ".$pLineClass."'>".$pLine."</div>";
    }
    $appRJ->response['result'].="<div class='line caption'><div class='td-48'>".$wdLeftName_row['wdTag'].
        " (".$rightDifCnt." dif)</div><div class='td-48'>".$wdRightName_row['wdTag']." (".$leftDifCnt." dif)</div></div>";
    $appRJ->response['result'].="<div class='line caption'><div class='td-24'>pName-left</div>".
        "<div class='td-24'>pPath-left</div><div class='td-24'>pName-right</div><div class='td-24'>pPath-right</div></div>";
    $appRJ->response['result'].=$pLines;
}