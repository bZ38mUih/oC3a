<?php
$lineOne_text = null;
$lineTwo_text = null;
$lineThree_text = null;
$lineOne_class = null;
$lineTwo_class = null;
$lineThree_class = null;
$ajaxRes['data'].= "
<div class='mc-container'>";
$ajaxRes['data'].=   "<h6>Создать режим</h6>".
    "<div class='slider-range-wrap'><div id='slider-range'></div></div>".
"<label class='mcGb-invert'><input type='checkbox' id='invert-time' ";
if($gbSchedule['result']['invertTime']){
    $ajaxRes['data'].= "checked";
    $lineOne_text = "Вкл (On):";
    $lineTwo_text = "Выкл (Off):";
    $lineThree_text = "Вкл (On):";
    $lineOne_class = "light-on";
    $lineTwo_class = "light-off";
    $lineThree_class = "light-on";
}else{
    $lineOne_text = "Выкл (Off):";
    $lineTwo_text = "Вкл (On):";
    $lineThree_text = "Выкл (Off):";
    $lineOne_class = "light-off";
    $lineTwo_class = "light-on";
    $lineThree_class = "light-off";
}
$ajaxRes['data'].=">Инвертировать</label>".
    "<div class='actLog'></div>".
    "<div class = 'mode-list'>".
    "<ul>".
    "<li><div class='light-line-one ".$lineOne_class."'><span class='mode'>".$lineOne_text."</span> 00:00 - <span class='time-val'>".$gbSchedule['result']['time1']."</span></div></li>".
    "<li><div class='light-line-two ".$lineTwo_class."'>
    <span class='mode'>".$lineTwo_text."</span>
    <span class='time-val'>".$gbSchedule['result']['time1']."</span> - <span class='time-val'>".$gbSchedule['result']['time2']."</span></div></li>".
    "<li><div class='light-line-three ".$lineThree_class."'><span class='mode'>".$lineThree_text."</span><span class='time-val'>".$gbSchedule['result']['time2']."</span> - 24:00</div></li>".
    "</ul>".
    "</div>".
    "<div class='mode-controls'>".
    "<label>Применить<input type='date' id='mode-date' value='".$gbSchedule['result']['modeDate']."'></label>".
    "<label>с :<input type='time' id='mode-time' value='".$gbSchedule['result']['modeTime']."'></label>".
    "<div class='mode-controls-btn-wrap'>".
    "<div class='mode-controls-btn mcBtnGoBack'><a href='javaScript: void(0)' onclick='modeGbShowDefault()'>Отказаться</a></div>".
    "<div class='mode-controls-btn toDel'></div>".
    "<div class='mode-controls-btn mcBtnCreate'><a href='javaScript: void(0)' onclick = 'modeGbCreate()'><img src='/source/img/create-icon.png'> - Create</a></div>".

    "</div>".

    "</div>";
$ajaxRes['data'].=   "</div>";