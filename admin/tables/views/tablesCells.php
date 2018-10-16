<?php

$tableCells.= "<div class='table-cell tblName'>" . $table . "</div>";
$td_list = "<div class='table-cell tblLst'>";
$td_exist = "<div class='table-cell tblExt'>";
$td_create = "<div class='table-cell action-icon'>";
$td_drop = "<div class='table-cell action-icon'>";
$td_clear = "<div class='table-cell action-icon'>";
$td_upload = "<div class='table-cell action-icon'>";
$td_download = "<div class='table-cell action-icon'>";
$td_select = "<div class='table-cell tblDwlTag'>";
$option_text = null;
$countArchives = 0;
foreach (glob($_SERVER['DOCUMENT_ROOT'] . DB_UPLOADS . "*".$table . "*.php") as $tableToInsert) {
    $option_text .= "<option value='" . $tableToInsert . "'>" .
        basename($tableToInsert).
        "</option>";
    $countArchives++;
}
if ($countArchives == 0) {
    $td_select .= " - ";
} else {
    $td_select .= "<select>" . $option_text . "</select>";
}
$td_list .= "<input type='checkbox' ";
$td_exist .= "<input type='checkbox' ";
if ($tables->tables[$table]['exist']) {
    $td_exist .= "checked";
    $td_drop .= "<img src='/source/img/drop-icon.png' action='drop' onclick='tables(this)'>";
    if($tables->tables[$table]['qty']>0){
        $td_clear .= "<span action='clear' onclick='tables(this)'>".
            " (".$tables->tables[$table]['qty'].")</span>";
        $td_upload .= "<img src='/source/img/upLoad-icon.png' action='upLoad' onclick='tables(this)'>";
    }else{
        $td_clear .= " 0 ";
        $td_upload .= " - ";
    }
    if ($countArchives > 0) {
        $td_download .= "<img src='/source/img/downLoad-icon.png' action='download'  onclick='tables(this)'>";
    }else{
        $td_download .= " - ";
    }
    if ($tables->tables[$table]['list']) {
        $td_list .= "checked";
    }
    $td_create .= " - ";
} else {
    $td_clear .= " - ";
    $td_upload .= " - ";
    $td_drop.=" - ";
    $td_download .= " - ";
    if ($tables->tables[$table]['list']) {
        $td_create .= "<img src='/source/img/create-icon.png' action='create' onclick='tables(this)'>";
        $td_list .= "checked";
    }
}
$td_exist .= " disabled>";
$td_list .= " disabled>";
$td_list .= "</div>";
$td_exist .= "</div>";
$td_create .= "</div>";
$td_drop .= "</div>";
$td_clear .= "</div>";
$td_upload .= "</div>";
$td_download .= "</div>";
$td_select .= "</div>";
$tableCells.= $td_list . $td_exist . $td_create . $td_drop . $td_clear . $td_upload . $td_download . $td_select;
