<?php
if(isset($_POST['curDate']) and $_POST['curDate']!=null){
    $note_rd->result['curDate']=$_POST['curDate'];
}else{
    $note_rd->result['curDate']=null;
    $pageErr .= "не задано curDate<br>";
}
if(isset($_POST['curTime']) and $_POST['curTime']!="") {
    $note_rd->result['curTime']=$_POST['curTime'];
}else{
    $note_rd->result['curTime']=null;
    $pageErr .= "не задано curTime<br>";
}
if(isset($_POST['content']) and $_POST['content']!="") {
    $note_rd->result['content']=dec_enc("encrypt", $_POST['content'], $note_rd->result["curDate"]);
}else{
    $note_rd->result['content']=null;
    $pageErr .= "не задано content<br>";
}