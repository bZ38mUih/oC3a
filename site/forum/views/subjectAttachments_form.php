<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 11.03.2017
 * Time: 9:30
 */
$selectAttachments_text="select * from subjectAttachments_dt WHERE subject_id='".$subject->result['subject_id']['val'].
    "' order by sort DESC, ref";
$selectAttachments_res=$DB->doQuery($selectAttachments_text);
//$appRJ->response['result'].= $selectAttachments_text;
$appRJ->response['result'].= "<form class='subjectAttachments_form'>";
$appRJ->response['result'].= "<input type='hidden' name='subject_id' value='".$subject->result['subject_id']['val']."'>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='subj_id_'>subjectID: </label>";
$appRJ->response['result'].= "<input type='text' name='subj_id_' value='".$subject->result['subject_id']['val']."' disabled>";
$appRJ->response['result'].= "</div>";
if(mysql_num_rows($selectAttachments_res)>0){
    while($selectAttachments_row=$DB->doFetchRow($selectAttachments_res)){
        $appRJ->response['result'].= "<div class='attachment_frame' id='attach_".$selectAttachments_row['attachment_id']."'>";
        //$appRJ->response['result'].= "<input type='hidden' value='".$selectAttachments_row['attachment_id']."'>";
        $appRJ->response['result'].= "<div class='attachment_img'>";
        //$appRJ->response['result'].= 'kkkkkkk';
        $appRJ->response['result'].= "<a href='/data/forum/attachments/".$subject->result['subject_id']['val']."/preview/".$selectAttachments_row['ref']
            ."'><img src='/data/forum/attachments/".$subject->result['subject_id']['val']."/preview/".$selectAttachments_row['ref']
            ."'></a>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='attachment_info'>";
        $appRJ->response['result'].= "fileName: ".$selectAttachments_row['ref']."<br>";
        $appRJ->response['result'].= "log: ";
        if (isset($subjectAttachments->log[$selectAttachments_row['ref']]) ){
            $appRJ->response['result'].= $subjectAttachments->log[$selectAttachments_row['ref']];
        }
        $appRJ->response['result'].= "<br>";
        //$appRJ->response['result'].= $subjectAttachments->log
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='attachment_action'>";
        $appRJ->response['result'].= "<span class='dellAttach_act' onclick='dellAttachment(".$selectAttachments_row['attachment_id'].")'>Удалить</span>";
        $appRJ->response['result'].= "<span class='mkMainAttach_act' onclick='mkMainAttach(".$selectAttachments_row['attachment_id'].")'>Сделать главной</span>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";

    }

}else{
    $appRJ->response['result'].= "Фоты не приложены";
}
/*
$appRJ->response['result'].= "<span class='field_name'>news_id: </span><input type='text' value='".$news_id."' disabled><br>";
$appRJ->response['result'].= "<div class='newsImages'>";
$foundFile = false;
$query_text="select * from blogAttachments_dt where news_id='".$news_id."'";
$query_res=$DB->doQuery($query_text);
while($query_row=$DB->doFetchRow($query_res)){
    $appRJ->response['result'].= "<div class='newsAttachments'>";
    $appRJ->response['result'].= "<img src='"."../../Blog/News/".$news_id."/prevue/".$query_row['fileName']."'/>";
    $appRJ->response['result'].= "<span class='deleteAttachment' onclick='deleteAttachment($news_id, ".'"'.$query_row['fileName'].'"'.")'>удалить</span>";
    if ($query_row['mainFlag']== true){
        $appRJ->response['result'].= "<span class='mainImage'>Уже главная</span>";
    }else{
        $appRJ->response['result'].= "<span class='mkMain' onclick='mkMain($news_id, ".'"'.$query_row['fileName'].'"'.")'>сделать главной</span>";
    }


    $appRJ->response['result'].= "</div>";
    $foundFile = true;
}
/*
foreach(glob("../../Blog/News/".$news_id."/prevue/*") as $subjImg) {
    $appRJ->response['result'].= "<div class='newsAttachments'>";
    $appRJ->response['result'].= "<img src='"."../../Blog/News/".$news_id."/prevue/".basename($subjImg)."'/>";
    $appRJ->response['result'].= "<span class='deleteAttachment' onclick='deleteNewsAttachment($news_id, basename($subjImg))'>удалить</span>";
    $appRJ->response['result'].= "<span class='mkMain' onclick='mkMain($news_id, basename($subjImg))'>сделать главной</span>";
    $appRJ->response['result'].= "</div>";
    $foundFile=true;
    //break;
}*/
/*
if ($foundFile !== true){
    $appRJ->response['result'].= "Фоты не приложены<br>";
}
$appRJ->response['result'].= "</div>";*/
$appRJ->response['result'].= "<input type='file' name='newsImages' id ='newsImages' onchange='loadFiles(".'"'.$subject->result['subject_id']['val'].'"'.")' accept='image/jpeg,image/png,image/gif' multiple>";
$appRJ->response['result'].= "</form>";
