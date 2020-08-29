<?php

$slGr_qry = "select * from usersGroups_dt";
$slGr_res=$DB->query($slGr_qry);
$grCount=0;
if($slGr_res->rowCount() > 0){
    $grCount = $slGr_res->rowCount();
}
$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$grCount."</span> записей";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<a href='/personal-page/ppManager/newGroup/'><img src='/source/img/create-icon.png'>Создать группу</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($grCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "group_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    $appRJ->response['result'].= "img";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias'>";
    $appRJ->response['result'].= "groupAlias";
    $appRJ->response['result'].= "</div>";

    $appRJ->response['result'].= "<div class='item-line-flag'>";
    $appRJ->response['result'].= "active";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
    while ($slGr_row = $slGr_res->fetch(PDO::FETCH_ASSOC)){

        $appRJ->response['result'].= "<div class='item-line'>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='/personal-page/ppManager/editGroup/?group_id=".$slGr_row['group_id']."'>".$slGr_row['group_id']."</a>";
        $appRJ->response['result'].= "</div>";

        $appRJ->response['result'].= "<div class='item-line-img'>";
        if($slGr_row['img']){
            $appRJ->response['result'].= "<img src='".PP_USRGR_IMG_PAPH.$slGr_row['group_id']."/preview/".$slGr_row['img']."'>";
            //$appRJ->response['result'].= "---";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";

        $appRJ->response['result'].= "<div class='item-line-alias'>";
        $appRJ->response['result'].= $slGr_row['groupAlias'];
        $appRJ->response['result'].= "</div>";

        $appRJ->response['result'].= "<div class='item-line-flag'>";
        $appRJ->response['result'].= "<input type='checkbox' ";
        if($slGr_row['activeFlag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";
    }
}else{
    $appRJ->response['result'].= "there is no groups there<br>";
}
$appRJ->response['result'].= "</div>";