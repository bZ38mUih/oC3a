<?php
$ajaxRes['data'].= "
<div class='timeMode'><div class='mc-container'>";
$ajaxRes['data'].=   "<h6>Править заметку #".$gbNote['result']['note_id']."</h6>";
$ajaxRes['data'].=
    "<div class='actLog'></div>".
    "<div class='mode-controls'>".
    "<input type='hidden' id='note_id' value='".$gbNote['result']['note_id']."'>".

    "<label>Температура: <input type='number' id='temper' value='".$gbNote['result']['temper']."'></label>".
    "<label>Влажность :<input type='number' id='humid' value='".$gbNote['result']['humid']."'></label>".
    "<label>Электричество :<input type='number' id='electricity' value='".$gbNote['result']['electricity']."'></label>".
    "<div class='note-content-wrap'><textarea rows='3' id='note-content'>".$gbNote['result']['content']."</textarea></div>".
    "<label>Применить<input type='date' id='note-date' value='".$gbNote['result']['noteDate']."'></label>".
    "<label>с :<input type='time' id='note-time' value='".$gbNote['result']['noteTime']."'></label>".
    "<div class='mode-controls-btn-wrap'>".
    "<div class='mode-controls-btn mcBtnGoBack'><a href='javaScript: void(0)' onclick='noteGbShow(".$gbNote['result']['note_id'].")'>Отказаться</a></div>".
    "<div class='mode-controls-btn mcBtnEdit'><a href='javaScript: void(0)' onclick = 'noteGbEdit()'><img src='/source/img/edit-icon.png'> - Edit</a></div>".
    "<div class='mode-controls-btn toDel'></div>".
    "</div>".
    "</div>";
$ajaxRes['data'].=   "</div></div>";