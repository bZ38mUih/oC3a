<?php
$slEnvLeft_qry="select wdOS_dt.osName as osNameLeft, wdOS_dt.osVal AS osValLeft, wdOsList_dt.osDescr as osDescrLeft from wdOS_dt ".
    "left join wdOsList_dt on wdOS_dt.osName=wdOsList_dt.osName and wdOS_dt.osVal=wdOsList_dt.osVal WHERE wd_id=".$cmpLeft;
$slEnvRight_qry="select wdOS_dt.osName as osNameRight, wdOS_dt.osVal AS osValRight, wdOsList_dt.osDescr as osDescrRight  from wdOS_dt ".
    "left join wdOsList_dt on wdOS_dt.osName=wdOsList_dt.osName and wdOS_dt.osVal=wdOsList_dt.osVal WHERE wd_id=".$cmpRight;
$slDifEnv_qry="select * from (".$slEnvLeft_qry.") as wdOsLeft left join (".$slEnvRight_qry.") as wdOsRight".
    " on wdOsLeft.osNameLeft = wdOsRight.osNameRight ".
    "and wdOsLeft.osValLeft=wdOsRight.osValRight ".
    "union select * from (".$slEnvLeft_qry.") as wdOsLeft right join (".$slEnvRight_qry.") as wdOsRight".
    " on wdOsLeft.osNameLeft = wdOsRight.osNameRight ".
    "and wdOsLeft.osValLeft=wdOsRight.osValRight order by osNameLeft, osNameRight";
if(!$slDifEnv_res=$DB->doQuery($slDifEnv_qry)){
    $appRJ->response['result'].="---fail--";
};
if(mysql_num_rows($slDifEnv_res)>0){
    $leftDifCnt=0;
    $rightDifCnt=0;
    $envLines=null;
    $appRJ->response['result'].="<h3>Система (".mysql_num_rows($slDifEnv_res).")</h3>";
    while ($slDifEnv_row=$DB->doFetchRow($slDifEnv_res)){
        $envLine=null;
        $envLineClass=null;
        $envLine.="<div class='td-24'>";
        if($slDifEnv_row['osNameLeft']){
            $envLine.=$slDifEnv_row['osNameLeft'];
        }else{
            $envLine.="-";
            $envLineClass="no-left";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifEnv_row['osValLeft']){
            if($slDifEnv_row['osDescrLeft']){
                $envLine.="<a href='/handbook/win-system-info/".$slDifEnv_row['osNameLeft']."/".urlencode($slDifEnv_row['osValLeft'])."' title='подробнее'>";
            }else{

                $envLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $envLine.=$slDifEnv_row['osValLeft'];
            $envLine.="</a>";
        }else{
            $leftDifCnt++;
            $envLine.="-";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifEnv_row['osNameRight']){
            $envLine.=$slDifEnv_row['osNameRight'];
        }else{
            $envLineClass="no-right";
            $envLine.="-";
        }
        $envLine.="</div><div class='td-24'>";
        if($slDifEnv_row['osValRight']){
            if($slDifEnv_row['osDescrRight']){
                $envLine.="<a href='/handbook/win-system-info/".$slDifEnv_row['osNameRight']."/".urlencode($slDifEnv_row['osValRight'])."' title='подробнее'>";
            }else{

                $envLine.="<a href='#' class='deactive' onclick='return false' title='описание не задано'>";
            }
            $envLine.=$slDifEnv_row['osValRight'];
            $envLine.="</a>";
        }else{
            $rightDifCnt++;
            $envLine.="-";
        }
        $envLine.="</div>";
        $envLines.="<div class='line ".$envLineClass."'>".$envLine."</div>";
    }
    $appRJ->response['result'].="<div class='line caption'><div class='td-48'>".$wdLeftName_row['wdTag'].
        " (".$leftDifCnt." dif)</div><div class='td-48'>".$wdRightName_row['wdTag']." (".$rightDifCnt." dif)</div></div>";
    $appRJ->response['result'].="<div class='line caption'><div class='td-24'>vName-left</div>".
        "<div class='td-24'>vVal-left</div><div class='td-24'>vName-right</div><div class='td-24'>vVal-right</div></div>".
        $envLines;
}