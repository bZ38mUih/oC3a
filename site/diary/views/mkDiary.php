<?php
/**
 * Created by PhpStorm.
 * User: AVP
 * Date: 27.11.2016
 * Time: 20:35
 */
$mkDiary.= "<form class='mkDiary'>";
if ($diary->result['diary_id']['val'] == null){
    $mkDiary.= "новая запись<br>";
    $diary->result["note_id"]["val"] = null;
}else{
    if ($diary->result["note_id"]["val"] != null){
        $mkDiary.= "редактировать запись<br>";
    }else{
        $mkDiary.= "добавить к существующей<br>";
    }
}
$mkDiary.= "Тип записи: <input type='text' name='diaryType' value='".$diary->result["diaryType"]["val"]."'>";
$mkDiary.= "<span class='field_err'>".$diary->result["diaryType"]["err"]."</span>";
$mkDiary.= "diary_id: <input type='text' name='diary_id' value='".$diary->result["diary_id"]["val"]."'>";
$mkDiary.= "<span class='field_err'>".$diary->result["diary_id"]["err"]."</span>";
$mkDiary.= "note_id: <input type='text' name='note_id' value='".$diary->result["note_id"]["val"]."'>";
$mkDiary.= "<span class='field_err'>".$diary->result["note_id"]["err"]."</span>";
$mkDiary.= " from: "."<input type='date' name='noteDate' value='".date("Y-m-d", strtotime($diary->result["noteDate"]["val"]))."'>";
$mkDiary.= "<span class='field_err'>".$diary->result["noteDate"]["err"]."</span>";
$mkDiary.= "<div class='diary_content'>";
$mkDiary.= "CurDate: <input type='date' name='curDate' value='".$diary->result["curDate"]["val"]."'>";
$mkDiary.= "<span class='field_err'>".$diary->result["curDate"]["err"]."</span>";
$mkDiary.= "CurTime: <input type='time' name='curTime' value='".$diary->result["curTime"]["val"]."'>";
$mkDiary.= "<span class='field_err'>".$diary->result["curTime"]["err"]."</span>";
$mkDiary.= "<textarea name='content' rows='5' id='content' class='form-control'>".dec_enc("decrypt", $diary->result['content']['val'])."</textarea>";
$mkDiary.= "<span class='field_err'>".$diary->result["content"]["err"]."</span>";
$mkDiary.= "</div>";
$mkDiary.= "<input type='button' value='Coxp' onclick='saveDiary(this)'>";
$mkDiary.= "</form>";