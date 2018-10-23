<?php
$slHwLeft_qry="select paramName as paramNameLeft, paramVal AS paramValLeft from wdHw_dt WHERE wd_id=".$cmpLeft;
$slHwRight_qry="select paramName as paramNameRight, paramVal AS paramValRight from wdHw_dt WHERE wd_id=".$cmpRight;
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
    $appRJ->response['result'].="<h3>Аппаратура:</h3>";
    $appRJ->response['result'].="<div class='line caption'><div class='td-48'>".$wdLeftName_row['wdTag'].
        "</div><div class='td-48'>".$wdRightName_row['wdTag']."</div></div>";
    $appRJ->response['result'].="<div class='line caption'><div class='td-24'>hwType-left</div>".
        "<div class='td-24'>hwName-left</div><div class='td-24'>hwType-right</div><div class='td-24'>hwName-right</div></div>";
    while ($slDifHw_row=$DB->doFetchRow($slDifHw_res)){
        $envLine=null;
        $hwLineClass=null;
        $envLine.="<div class='td-24'>";
        if($slDifHw_row['paramNameLeft']){
            $envLine.=$slDifHw_row['paramNameLeft'];
        }else{
            $envLine.="-";
            $hwLineClass="no-left";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifHw_row['paramValLeft']){
            $envLine.=$slDifHw_row['paramValLeft'];
        }else{
            $envLine.="-";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifHw_row['paramNameRight']){
            $envLine.=$slDifHw_row['paramNameRight'];
        }else{
            $hwLineClass="no-right";
            $envLine.="-";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifHw_row['paramValRight']){
            $envLine.=$slDifHw_row['paramValRight'];
        }else{
            $envLine.="-";
        }
        $envLine.="</div>";
        $appRJ->response['result'].="<div class='line ".$envLineClass."'>".$envLine."</div>";
    }
}