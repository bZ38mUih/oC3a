<?php
$showGbMode = null;
$showGbMode .= "<div class='mc-container'>";
if($gbSchedule->result['sch_id']){
    $gbSchTime1 = explode(":", $gbSchedule->result['time1']);
    $gbSchTime2 = explode(":", $gbSchedule->result['time2']);
    $gbSchTime3 = explode(":", $gbSchedule->result['time3']);
    if($gbSchedule->result['invertTime']){
        $gbModeInterval_2 = round($gbSchTime1[0]+$gbSchTime1[1]/60+$gbSchTime3[0]+$gbSchTime3[1]/60, 1);
        $gbModeInterval_1 = round($gbSchTime2[0]+$gbSchTime2[1]/60, 1);
    }else{
        $gbModeInterval_1 = round($gbSchTime1[0]+$gbSchTime1[1]/60+$gbSchTime3[0]+$gbSchTime3[1]/60, 1);
        $gbModeInterval_2 = round($gbSchTime2[0]+$gbSchTime2[1]/60, 1);
    }
    /*
    if(!$gbModeInterval){
        $gbModeInterval = '0';
    }
    if(!$gbModeInterva2){
        $gbModeInterva2 = '0';
    }
    */


    $showGbMode.= "<div class='top-panel'>".
        "<div class='btn-next' ";
    if($btnNextImg_flag){
        $showGbMode .= "onclick='modeGbShow(".$gbSchedule_pre->result['sch_id'].")'><img src='/source/img/Forward-next.png'>";
    }else{
        $showGbMode .= "><img src='/source/img/Forward-next-deact.png'>";
    }
    $showGbMode .= "</div>".
        "<h6>".$gbModeName." #<span id='sch_id'>".$gbSchedule->result['sch_id']."</span>".
        "<span class='stDate-mode'>".$gbSchedule->result['modeDate']." ".
        $gbSchedule->result['modeTime']."</span>".
        "<div class='gbMode-hours'><span class='light-on'>".$gbModeInterval_1."</span> / ".
        "<span class='light-off'>".$gbModeInterval_2."</span></div>".
        "</h6>".
        "<div class='btn-pre' ";
    if($btnPreImg_flag){
        $showGbMode .= "onclick='modeGbShow(".$gbSchedule_next->result['sch_id'].")'><img src='/source/img/Forward-pre.png'>";
    }else{
        $showGbMode .= "><img src='/source/img/Forward-pre-deact.png'>";
    }
    $showGbMode .= "</div>".
        "</div>";
    $showGbMode.=
        "<div class = 'mode-list'>".
        "<ul>".
        "<li><div class='light-line-one light-off'><span class='mode'>Выкл (Off):</span> 00:00 - <span class='time-val'>".
        $gbSchedule->result['time1']."</span></div></li>".
        "<li><div class='light-line-two light-on'>
    <span class='mode'>Вкл (On):</span>
    <span class='time-val'>".$gbSchedule->result['time1']."</span> - <span class='time-val'>".
        $gbSchedule->result['time2']."</span></div></li>".
        "<li><div class='light-line-three light-off'><span class='mode'>Выкл (Off):</span><span class='time-val'>".
        $gbSchedule->result['time2']."</span> - 24:00</div></li>".
        "</ul>".
        "</div>".

        "<div class='mode-controls'>".
        "<div class='mode-controls-btn-wrap'>".
        "<div class='mode-controls-btn mcBtnDelete'>".
        "<a href='javaScrip: void(0)' onclick = 'modeGbRemove(".$gbSchedule->result['sch_id'].")' class='create-btn'><img src='/source/img/drop-icon.png'> - Delete</a>".
        "</div>".
        "<div class='mode-controls-btn mcBtnEdit'>".
        "<a href='javaScrip: void(0)' onclick = 'modeGbEditEntry(".$gbSchedule->result['sch_id'].")' class='edit-btn'><img src='/source/img/edit-icon.png'> - Edit</a>".
        "</div>".
        "<div class='mode-controls-btn mcBtnCreate'>".
        "<a href='javaScript: void(0)' onclick='event.preventDefault(); modeGbCreateEntry()' class='create-btn'><img src='/source/img/create-icon.png'> - Create</a>".
        "</div>";
    $showGbMode.= "</div></div>";
}else{
    $showGbMode.= "Не задан ни один режим. Попробуйте создать :-)";
    $showGbMode.="<div class='mode-controls'>".
        "<div class='mode-controls-btn-wrap'>".
    "<a href='/marijuanaClub/gbCreateMode' class='create-btn'><img src='/source/img/create-icon.png'> - Create</a>".
    "</div></div>";
}


$showGbMode.=   "</div>";