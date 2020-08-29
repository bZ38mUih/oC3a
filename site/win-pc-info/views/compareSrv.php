<?php
$slSrvLeft_qry="select DISTINCT wdSrv_dt.sName as sNameLeft, wdSrv_dt.sPath AS sPathLeft, ".
    "wdSrvList_dt.sImg as sImgLeft, wdSrvList_dt.sDescr as sDescrLeft from wdSrv_dt LEFT JOIN wdSrvList_dt ON ".
    "wdSrv_dt.sName=wdSrvList_dt.sName WHERE wd_id=".$cmpLeft;
$slSrvRight_qry="select DISTINCT wdSrv_dt.sName as sNameRight, wdSrv_dt.sPath AS sPathRight, ".
    "wdSrvList_dt.sImg as sImgRight, wdSrvList_dt.sDescr as sDescrRight from wdSrv_dt LEFT JOIN wdSrvList_dt ON ".
    "wdSrv_dt.sName=wdSrvList_dt.sName WHERE wd_id=".$cmpRight;

$slDifSrv_qry="select * from (".$slSrvLeft_qry.") as wdSrvLeft left join (".$slSrvRight_qry.") as wdSrvRight".
    " on wdSrvLeft.sNameLeft = wdSrvRight.sNameRight ".
    "and wdSrvLeft.sPathLeft=wdSrvRight.sPathRight ".
    "union select * from (".$slSrvLeft_qry.") as wdSrvLeft right join (".$slSrvRight_qry.") as wdSrvRight".
    " on wdSrvLeft.sNameLeft = wdSrvRight.sNameRight ".
    "and wdSrvLeft.sPathLeft=wdSrvRight.sPathRight order by sNameLeft, sNameRight";

$slDifSrv_res=$DB->query($slDifSrv_qry);
if($slDifSrv_res->rowCount() > 0){
    $appRJ->response['result'].="<h3>Службы (".$slDifSrv_res->rowCount().")</h3>";
    $leftDifCnt=0;
    $rightDifCnt=0;
    $pLines=null;
    while ($slDifSrv_row = $slDifSrv_res->fetch(PDO::FETCH_ASSOC)){
        $pLineClass=null;
        $pLine=null;
        $pLine.="<div class='td-24'>";
        if($slDifSrv_row['sNameLeft']){
            $pLine.="<div class='pCell-img'>";
            if($slDifSrv_row['sImgLeft']){
                $pLine.="<img src='".WD_SRV_IMG.$slDifSrv_row['sImgLeft']."'>";
            }else{
                $pLine.="<img src='/data/default-img.png'>";
            }
            $pLine.="</div><div class='pCell-name'>";
            if($slDifSrv_row['sDescrLeft']){
                $pLine.="<a href='/handbook/win-services/".urlencode($slDifSrv_row['sNameLeft'])."' title='подробнее'>";
            }else{
                $pLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $pLine.=$slDifSrv_row['sNameLeft'];
            $pLine.="</a></div>";
        }else{
            $leftDifCnt++;
            $pLine.="-";
            $pLineClass="no-left";
        }
        $pLine.="</div><div class='td-24'>";

        if($slDifSrv_row['sPathLeft']){
            $pLine.=$slDifSrv_row['sPathLeft'];
        }else{
            $pLine.="-";
        }
        $pLine.="</div><div class='td-24'>";
        if($slDifSrv_row['sNameRight']){
            $pLine.="<div class='pCell-img'>";
            if($slDifSrv_row['sImgRight']){
                $pLine.="<img src='".WD_SRV_IMG.$slDifSrv_row['sImgRight']."'>";
            }else{
                $pLine.="<img src='/data/default-img.png'>";
            }
            $pLine.="</div><div class='pCell-name'>";
            if($slDifSrv_row['sDescrRight']){
                $pLine.="<a href='/handbook/win-services/".urlencode($slDifSrv_row['sNameRight'])."' title='подробнее'>";
            }else{
                $pLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $pLine.=$slDifSrv_row['sNameRight'];
            $pLine.="</a></div>";
        }else{
            $rightDifCnt++;
            $pLine.="-";
            $pLineClass="no-right";
        }
        $pLine.="</div><div class='td-24'>";
        if($slDifSrv_row['sPathRight']){
            $pLine.=$slDifSrv_row['sPathRight'];
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
}else{

}