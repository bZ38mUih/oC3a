<?php
if(isset($_POST['diaryType']) and $_POST['diaryType']!=null){
    $diary_rd->result['diaryType'] = $_POST['diaryType'];
}else{
    $diary_rd->result['diaryType']=null;
    $pageErr .= "not set diaryType<br>";
}
if(isset($_POST['noteDate']) and $_POST['noteDate']!=null){
    $diary_rd->result['noteDate'] = $_POST['noteDate'];
}else{
    $diary_rd->result['noteDate']=null;
    $pageErr .= "not set noteDate<br>";
}
if(isset($_POST['diaryHeader']) and $_POST['diaryHeader']!=null){
    $diary_rd->result['diaryHeader'] = $_POST['diaryHeader'];
}else{
    $diary_rd->result['diaryHeader']=null;
}