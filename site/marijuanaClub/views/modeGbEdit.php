<?php
$ajaxRes['data'].= "<div class='mc-container'>
<div class='timeMode'>";
$ajaxRes['data'].=   "<h6>Изменить режим #<span id='sch_id'>".$gbSchedule->result['sch_id']."</span></h6>".
    "<div class='slider-range-wrap'><div id='slider-range'></div></div>".
"<label><input type='checkbox' id='invert-time' ";
if($gbSchedule->result['invertTime']){
    $ajaxRes['data'].= "checked";
}
$ajaxRes['data'].=">Инвертировать</label>".
    "<div class='actLog'></div>".
    "<div class = 'mode-list'>".
    "<ul>".
    "<li><div class='light-line-one light-off'><span class='mode'>Выкл (Off):</span> 00:00 - <span class='time-val'>".$gbSchedule->result['time1']."</span></div></li>".
    "<li><div class='light-line-two light-on'>
    <span class='mode'>Вкл (On):</span>
    <span class='time-val'>".$gbSchedule->result['time1']."</span> - <span class='time-val'>".$gbSchedule->result['time2']."</span></div></li>".
    "<li><div class='light-line-three light-off'><span class='mode'>Выкл (Off):</span><span class='time-val'>".$gbSchedule->result['time2']."</span> - 24:00</div></li>".
    "</ul>".
    "</div>".
    "<div class='mode-controls'>".
    "<label>Применить<input type='date' id='mode-date' value='".$gbSchedule->result['modeDate']."'></label>".
    "<label>с :<input type='time' id='mode-time' value='".$gbSchedule->result['modeTime']."'></label>".
    "<div class='mode-controls-btn-wrap'>".
    "<div class='mode-controls-btn'><a href='javaScript: void(0)' onclick='modeGbShow(".$gbSchedule->result['sch_id'].")'>Отказаться</a></div>".
    "<div class='mode-controls-btn toUpdate'><input type='button' value='Применить' onclick = 'modeGbEdit()'></div>".
    "<div class='mode-controls-btn toDel'><input type='button' value='Удалить' onclick = 'delGbMode(".$gbSchedule->result['sch_id'].")'></div>".
    "</div>".
    "</div>";
$ajaxRes['data'].=   "</div></div>";