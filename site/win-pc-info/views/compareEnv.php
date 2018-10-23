<?php
$slEnvLeft_qry="select vName as vNameLeft, vVal AS vValLeft from wdEnv_dt WHERE wd_id=".$cmpLeft;
$slEnvRight_qry="select vName as vNameRight, vVal AS vValRight from wdEnv_dt WHERE wd_id=".$cmpRight;
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
    $appRJ->response['result'].="<h3>Окружение:</h3>";
    $appRJ->response['result'].="<div class='line caption'><div class='td-48'>".$wdLeftName_row['wdTag'].
        "</div><div class='td-48'>".$wdRightName_row['wdTag']."</div></div>";
    $appRJ->response['result'].="<div class='line caption'><div class='td-24'>vName-left</div>".
        "<div class='td-24'>vVal-left</div><div class='td-24'>vName-right</div><div class='td-24'>vVal-right</div></div>";
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
            $envLine.=$slDifEnv_row['vValLeft'];
        }else{
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
            $envLine.=$slDifEnv_row['vValRight'];
        }else{
            $envLine.="-";
        }
        $envLine.="</div>";
        $appRJ->response['result'].="<div class='line ".$envLineClass."'>".$envLine."</div>";
    }
}