<?php
$ajaxRes['data'].= "
<div class='timeMode'><div class='mc-container'>";
$ajaxRes['data'].=   "<h6>Создать заметку</h6>";
$ajaxRes['data'].=
    "<div class='actLog'></div>".
    "<div class='mode-controls'>".
    "<span class='mcGbNote-temp'><input type='number' id='temper' value='".$gbNote->result['temper']."'></span>".
    "<span class='mcGbNote-humid'><input type='number' id='humid' value='".$gbNote->result['humid']."'></span>".
    "<span class='mcGbNote-el'><input type='number' id='electricity' value='".$gbNote->result['electricity']."'></span>".
    //"<label>Температура: <input type='number' id='temper' value='".$gbNote->result['temper']."'></label>".
    //"<label>Влажность :<input type='number' id='humid' value='".$gbNote->result['humid']."'></label>".
    //"<label>Электричество :<input type='number' id='electricity' value='".$gbNote->result['electricity']."'></label>".
    "<div class='note-content-wrap'><textarea rows='3' id='note-content'>".$gbNote->result['content']."</textarea></div>".
    "<label>Применить<input type='date' id='note-date' value='".$gbNote->result['noteDate']."'></label>".
    "<label>с :<input type='time' id='note-time' value='".$gbNote->result['noteTime']."'></label>".
    "<div class='mode-controls-btn-wrap'>".
    "<div class='mode-controls-btn mcBtnGoBack'><a href='javaScript: void(0)' onclick='noteGbShow(".$note_id.")'>Отказаться</a></div>".
    "<div class='mode-controls-btn mcBtnCreate'><a href='javaScript: void(0)' onclick = 'noteGbCreate()'><img src='/source/img/create-icon.png'> - Create</a></div>".
    "<div class='mode-controls-btn toDel'></div>".
    "</div>".
    "</div>";
$ajaxRes['data'].=   "</div></div>";