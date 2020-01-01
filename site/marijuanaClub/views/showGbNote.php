<?php
$showGbNote = null;
$showGbNote .= "<div class='mc-container gbNote'>";
if($gbNote->result['note_id']){
    $showGbNote.= "<div class='top-panel'>".
        "<div class='btn-next' ";
    if($btnNextNote_flag){
        $showGbNote .= "onclick='noteGbShow(".$gbNote_pre->result['note_id'].")'><img src='/source/img/Forward-next.png'>";
    }else{
        $showGbNote .= "><img src='/source/img/Forward-next-deact.png'>";
    }
    $showGbNote .= "</div>".
        "<h6>".$gbNoteName." #<span id='sch_id'>".$gbNote->result['note_id']."</span>".
        "<span class='stDate-mode'>Сделана: ".$gbNote->result['noteDate']." ".
        $gbNote->result['noteTime']."</span></h6>".
        "<div class='btn-pre' ";
    if($btnPreNote_flag){
        $showGbNote .= "onclick='noteGbShow(".$gbNote_next->result['note_id'].")'><img src='/source/img/Forward-pre.png'>";
    }else{
        $showGbNote .= "><img src='/source/img/Forward-pre-deact.png'>";
    }

    //"onclick='showGbMode(".$gbSchedule_next->result['sch_id'].")'><img src='/source/img/".$btnPreImg."'>";

    $showGbNote .= "</div>".
        "</div>";
    $showGbNote.=
        "<div class = 'mode-list'>".
        "<ul>".
        "<li><span class='mcGbNote-temp'>".$gbNote->result['temper']."</span></li>".
        "<li><span class='mcGbNote-humid'>".$gbNote->result['humid']."</span></li>".
        "<li><span class='mcGbNote-el'>".$gbNote->result['electricity']."</span></li>".
        //"<li><div class='light-line-three light-off'><span class='mode'>Выкл (Off):</span><span class='time-val'>".$gbSchedule->result['time2']."</span> - 24:00</div></li>".
        "</ul>".
        "<div class='gb-note-content'>".
        $gbNote->result['content'].
        "</div>".
        "</div>".
        "<div class='mode-controls'>".

        "<div class='mode-controls-btn-wrap'>".
        "<div class='mode-controls-btn mcBtnDelete'>".
        "<a href='javaScript: void(0)' onclick='noteGbRemove(".$gbNote->result['note_id'].")' class='create-btn'><img src='/source/img/drop-icon.png'> - Delete</a>".
        "</div>".
        "<div class='mode-controls-btn mcBtnEdit'>".
        "<a href='javaScript: void(0)' onclick='noteGbEditEntry(".$gbNote->result['note_id'].")' class='edit-btn'><img src='/source/img/edit-icon.png'> - Edit</a>".
        "</div>".
        "<div class='mode-controls-btn mcBtnCreate'>".
        "<a href='javaScript: void(0)' onclick='noteGbCreateEntry()' class='create-btn'><img src='/source/img/create-icon.png'> - Create</a>".
        "</div>".


        "</div>";
    $showGbNote.= "</div>";
}else{
    $showGbNote.= "<div class='actLog'>Нет ни одиной заметки. Попробуйте создать :-)</div>";
    $showGbNote.="<div class='mode-controls-btn-wrap'>".
        "<a href='javaScript: void(0)' onclick='noteGbCreateEntry()' class='create-btn'><img src='/source/img/create-icon.png'> - Create</a>".
        "</div>";
}


$showGbNote.=   "</div>";