<?php
$slHwLeft_qry="select wdHw_dt.paramName as paramNameLeft, wdHw_dt.paramVal AS paramValLeft, ".
    "wdHwList_dt.hwDescr as hwDescrLeft, wdHw_dt.hwNum as hwNumLeft from wdHw_dt ".
    "LEFT JOIN wdHwList_dt ON wdHw_dt.paramName=wdHwList_dt.paramName and wdHw_dt.paramVal=wdHwList_dt.paramVal WHERE wdHw_dt.wd_id=".$cmpLeft;
$slHwRight_qry="select wdHw_dt.paramName as paramNameRight, wdHw_dt.paramVal AS paramValRight, ".
    "wdHwList_dt.hwDescr as hwDescrRight, wdHw_dt.hwNum as hwNumRight from wdHw_dt ".
    "LEFT JOIN wdHwList_dt ON wdHw_dt.paramName=wdHwList_dt.paramName and wdHw_dt.paramVal=wdHwList_dt.paramVal WHERE wdHw_dt.wd_id=".$cmpRight;
$slDifHw_qry="select * from (".$slHwLeft_qry.") as wdHwLeft left join (".$slHwRight_qry.") as wdHwRight".
    " on wdHwLeft.paramNameLeft = wdHwRight.paramNameRight ".
    "and wdHwLeft.paramValLeft=wdHwRight.paramValRight ".
    "union select * from (".$slHwLeft_qry.") as wdHwLeft right join (".$slHwRight_qry.") as wdHwRight".
    " on wdHwLeft.paramNameLeft = wdHwRight.paramNameRight ".
    "and wdHwLeft.paramValLeft=wdHwRight.paramValRight order by paramNameLeft, paramNameRight";
if(!$slDifHw_res=$DB->doQuery($slDifHw_qry)){
    $appRJ->response['result'].="---fail--";
};
if(mysql_num_rows($slDifHw_res)>0){
    $leftDifCnt=0;
    $rightDifCnt=0;
    $hwLines=null;
    $appRJ->response['result'].="<h3>Аппаратура: (".mysql_num_rows($slDifHw_res).")</h3>";
    while ($slDifHw_row=$DB->doFetchRow($slDifHw_res)){
        $hwLine=null;
        $hwLineClass=null;
        $hwLine.="<div class='td-24'>";
        if($slDifHw_row['paramNameLeft']){
            $hwLine.=$slDifHw_row['paramNameLeft'];
            if(isset($slDifHw_row['hwNumLeft']) and $slDifHw_row['hwNumLeft']!="-"){
                $hwLine.=" (".$slDifHw_row['hwNumLeft'].")";
            }
        }else{
            $hwLine.="-";
            $hwLineClass="no-left";
        }
        $hwLine.="</div><div class='td-24'>";
        if($slDifHw_row['paramValLeft']){
            if($slDifHw_row['hwDescrLeft']){
                $hwLine.="<a href='/handbook/win-hardware/".$slDifHw_row['paramNameLeft']."/".urlencode($slDifHw_row['paramValLeft'])."' title='подробнее'>";
            }else{
                //if($slDifHw_row['paramNameLeft']!='RAM'){
                $hwLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
                //}
            }
            $hwLine.=$slDifHw_row['paramValLeft'];
            $hwLine.="</a>";
        }else{
            $hwLine.="-";
            $leftDifCnt++;
        }
        $hwLine.="</div><div class='td-24'>";
        if($slDifHw_row['paramNameRight']){
            $hwLine.=$slDifHw_row['paramNameRight'];
            if(isset($slDifHw_row['hwNumRight']) and $slDifHw_row['hwNumRight']!="-"){
                $hwLine.=" (".$slDifHw_row['hwNumRight'].")";
            }
        }else{
            $hwLineClass="no-right";
            $hwLine.="-";
        }
        $hwLine.="</div><div class='td-24'>";
        if($slDifHw_row['paramValRight']){
            if($slDifHw_row['hwDescrRight']){
                $hwLine.="<a href='/handbook/win-hardware/".$slDifHw_row['paramNameRight']."/".urlencode($slDifHw_row['paramValRight'])."' title='подробнее'>";
            }else{
                //if($slDifHw_row['paramNameRight']!='RAM'){
                $hwLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
                //}
            }
            $hwLine.=$slDifHw_row['paramValRight'];
            $hwLine.="</a>";
        }else{
            $rightDifCnt++;
            $hwLine.="-";
        }
        $hwLine.="</div>";
        $hwLines.="<div class='line ".$hwLineClass."'>".$hwLine."</div>";
    }
    $appRJ->response['result'].="<div class='line caption'><div class='td-48'>".$wdLeftName_row['wdTag'].
        " (".$leftDifCnt." dif)</div><div class='td-48'>".$wdRightName_row['wdTag']." (".$rightDifCnt." dif)</div></div>";
    $appRJ->response['result'].="<div class='line caption'><div class='td-24'>hwType-left</div>".
        "<div class='td-24'>hwName-left</div><div class='td-24'>hwType-right</div><div class='td-24'>hwName-right</div></div>";
    $appRJ->response['result'].=$hwLines;
    //$appRJ->response['result'].=$pLines;
}