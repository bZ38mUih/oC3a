<?php
$slEnvLeft_qry="select wdEnv_dt.vName as vNameLeft, wdEnv_dt.vVal AS vValLeft, wdEnvList_dt.vDescr as vDescrLeft from wdEnv_dt ".
    "left join wdEnvList_dt on wdEnv_dt.vName=wdEnvList_dt.vName and wdEnv_dt.vVal=wdEnvList_dt.vVal WHERE wd_id=".$cmpLeft;
$slEnvRight_qry="select wdEnv_dt.vName as vNameRight, wdEnv_dt.vVal AS vValRight, wdEnvList_dt.vDescr as vDescrRight  from wdEnv_dt ".
    "left join wdEnvList_dt on wdEnv_dt.vName=wdEnvList_dt.vName and wdEnv_dt.vVal=wdEnvList_dt.vVal WHERE wd_id=".$cmpRight;
$slDifEnv_qry="select * from (".$slEnvLeft_qry.") as wdEnvLeft left join (".$slEnvRight_qry.") as wdEnvRight".
    " on wdEnvLeft.vNameLeft = wdEnvRight.vNameRight ".
    "and wdEnvLeft.vValLeft=wdEnvRight.vValRight ".
    "union select * from (".$slEnvLeft_qry.") as wdEnvLeft right join (".$slEnvRight_qry.") as wdEnvRight".
    " on wdEnvLeft.vNameLeft = wdEnvRight.vNameRight ".
    "and wdEnvLeft.vValLeft=wdEnvRight.vValRight order by vNameLeft, vNameRight";
if(!$slDifEnv_res=$DB->doQuery($slDifEnv_qry)){
    $appRJ->response['result'].="---fail--";
};
if(mysql_num_rows($slDifEnv_res)>0){
    $leftDifCnt=0;
    $rightDifCnt=0;
    $envLines=null;
    $appRJ->response['result'].="<h3>Окружение (".mysql_num_rows($slDifEnv_res).")</h3>";
    while ($slDifEnv_row=$DB->doFetchRow($slDifEnv_res)){
        $envLine=null;
        $envLineClass=null;
        $envLine.="<div class='td-24'>";
        if($slDifEnv_row['vNameLeft']){
            $envLine.=$slDifEnv_row['vNameLeft'];
        }else{
            $envLine.="-";
            $envLineClass="no-left";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifEnv_row['vValLeft']){
            if($slDifEnv_row['vDescrLeft']){
                $envLine.="<a href='/handbook/win-environment/".$slDifEnv_row['vNameLeft']."/".urlencode($slDifEnv_row['vValLeft'])."' title='подробнее'>";
            }else{

                $envLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $envLine.=$slDifEnv_row['vValLeft'];
            $envLine.="</a>";
        }else{
            $leftDifCnt++;
            $envLine.="-";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifEnv_row['vNameRight']){
            $envLine.=$slDifEnv_row['vNameRight'];
        }else{
            $envLineClass="no-right";
            $envLine.="-";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifEnv_row['vValRight']){
            if($slDifEnv_row['vDescrRight']){
                $envLine.="<a href='/handbook/win-environment/".$slDifEnv_row['vNameRight']."/".urlencode($slDifEnv_row['vValRight'])."' title='подробнее'>";
            }else{

                $envLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $envLine.=$slDifEnv_row['vValRight'];
            $envLine.="</a>";
        }else{
            $rightDifCnt++;
            $envLine.="-";
        }
        $envLine.="</div>";
        $envLines.="<div class='line ".$envLineClass."'>".$envLine."</div>";
    }
    $appRJ->response['result'].="<div class='line caption'><div class='td-48'>".$wdLeftName_row['wdTag'].
        " (".$rightDifCnt." dif)</div><div class='td-48'>".$wdRightName_row['wdTag']." (".$leftDifCnt." dif)</div></div>";
    $appRJ->response['result'].="<div class='line caption'><div class='td-24'>vName-left</div>".
        "<div class='td-24'>vVal-left</div><div class='td-24'>vName-right</div><div class='td-24'>vVal-right</div></div>".
        $envLines;
}