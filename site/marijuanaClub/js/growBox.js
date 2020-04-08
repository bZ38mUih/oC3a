var srMin = 0;
var srMax = 0;

$(document).ready(function(){

});

function runSlider(){
    var srMin_split =  $(".light-line-one span.time-val").html().split(":");
    srMin = parseInt(srMin_split[0]*60)+parseInt(srMin_split[1]);

    var srMax_split = $(".light-line-three span.time-val").html().split(":");
    srMax = parseInt(srMax_split[0]*60)+parseInt(srMax_split[1]);

    $("#invert-time").change(function(){
        if($(this).is(':checked')){

            $(".light-line-one").removeClass("light-on");
            $(".light-line-one").addClass("light-off");
            $(".light-line-two").removeClass("light-off");
            $(".light-line-two").addClass("light-on");
            $(".light-line-three").removeClass("light-on");
            $(".light-line-three").addClass("light-off");
            $(".light-line-one span.mode").html("Выкл (Off):");
            $(".light-line-two span.mode").html("Вкл (On):");
            $(".light-line-three span.mode").html("Выкл (Off):");
            $("#slider-range").css("background", "darkred");
            $("#slider-range .ui-slider-range.ui-corner-all.ui-widget-header").css("background", "limegreen");
        }else{
            $(".light-line-one").removeClass("light-off");
            $(".light-line-one").addClass("light-on");
            $(".light-line-two").removeClass("light-on");
            $(".light-line-two").addClass("light-off");
            $(".light-line-three").removeClass("light-off");
            $(".light-line-three").addClass("light-on");
            $(".light-line-one span.mode").html("Вкл (On):");
            $(".light-line-two span.mode").html("Выкл (Off):");
            $(".light-line-three span.mode").html("Вкл (On):");
            $("#slider-range").css("background", "limegreen");
            $("#slider-range .ui-slider-range.ui-corner-all.ui-widget-header").css("background", "darkred");

        }
    });

    $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 1440,
                values: [ srMin, srMax ],
                slide: function( event, ui ) {
                    var h1 =  Math.round((ui.values[ 0 ]/60));
                    var m1 = ui.values[ 0 ] - h1*60;
                    if (m1 < 0){
                        h1 -= 1;
                        m1 =60 + m1;
                    }
                    if(m1 < 10){
                        m1 = "0"+m1;
                    }
                    var h2 =  Math.round((ui.values[ 1 ]/60));
                    var m2 = ui.values[ 1 ] - h2*60;
                    if (m2 < 0) {
                        h2 -= 1;
                        m2 = 60 + m2;
                    }
                    if(m2 < 10){
                        m2 = "0"+m2;
                    }

                    $(".light-line-one span.time-val").html( h1 + ":"+m1);
                    $(".light-line-two span.time-val:eq(0)").html( h1 + ":"+m1);
                    $(".light-line-two span.time-val:eq(1)").html( h2 + ":"+m2);
                    $(".light-line-three span.time-val").html( h2 + ":"+m2);
                }

            });
        }
    );
    $("#invert-time").trigger("change");
}
function modeGbEditEntry(sch_id){
    $(".mc-container-wrap.gbMode").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get( "?modeGbEditEntry=y&sch_id="+sch_id
    )
        .done(function( data ) {
            $(".mc-container-wrap.gbMode").preloader("remove");
            var response=JSON.parse(data);
            if(response.err){
                alert(response.data);
            }else{
                $(".mc-container-wrap.gbMode").html(response.data);
                runSlider();
            }
        });
}
function modeGbCreateEntry(){
    $(".mc-container-wrap.gbMode").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.get( "?modeGbCreateEntry=y")
        .done(function( data ) {
            $('.mc-container-wrap.gbMode').preloader('remove');
            var response=JSON.parse(data);
            if(response.err){
                alert(response.data);
            }else{
                $(".mc-container-wrap.gbMode").html(response.data);
                runSlider();
            }
        });
}
function modeGbShowDefault(){
    $(".mc-container-wrap.gbMode").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get( "?modeGbShowDefault=y")
        .done(function( data ) {
            $('.mc-container-wrap.gbMode').preloader('remove');
            var response=JSON.parse(data);
            if(response.err){
                alert(response.data);
            }else{
                $(".mc-container-wrap.gbMode").html(response.data);
            }
        });
}
function modeGbEdit(){

    $(".mc-container-wrap.gbMode").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.get( "?modeGbEdit=y&time1="+$(".light-line-one span.time-val").html()
        +"&sch_id="+$("#sch_id").html()
        +"&time2="+ $(".light-line-three span.time-val").html()
        +"&invertTime="+$("#invert-time").is(':checked')
        +"&modeTime="+$("#mode-time").val()
        +"&modeDate="+$("#mode-date").val()
    )
        .done(function( data ) {
            $(".mc-container-wrap.gbMode").preloader("remove");
            var response=JSON.parse(data);
            $(".actLog").html(response.data);
        });
}
function noteGbEdit(){

    $(".mc-container-wrap.gbNote").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.post( "", "noteGbEdit=y&temper="+$("#temper").val()
        +"&humid="+$("#humid").val()
        +"&noteDate="+ $("#note-date").val()
        +"&noteTime="+$("#note-time").val()
        +"&note_id="+$("#note_id").val()
        +"&noteContent="+$("#note-content").val()
        +"&electricity="+$("#electricity").val()

    )
        .done(function( data ) {
            $(".mc-container-wrap.gbNote").preloader("remove");
            var response=JSON.parse(data);
            $(".actLog").html(response.data);
        });
}
function modeGbShow(sch_id){
    $(".mc-container-wrap.gbMode").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get( "?showModeBy_id=y&sch_id="+sch_id)
        .done(function( data ) {
            $(".mc-container-wrap.gbMode").preloader("remove");
            var response=JSON.parse(data);
            if(response.err){
                $(".mc-container-wrap.gbMode .actLog").html(response.data);
            }else{
                $(".mc-container-wrap.gbMode").html(response.data);
            }
        });
}
function modeGbRemove(sch_id){
    $(".mc-container-wrap.gbMode").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.get( "?modeGbRemove=y&sch_id="+sch_id)
        .done(function( data ) {
            $(".mc-container-wrap.gbMode").preloader("remove");
            var response=JSON.parse(data);
            if(response.err){
                alert(response.data);
            }else{
                $(".mc-container-wrap.gbMode").html(response.data);
            }
        });
}
function modeGbCreate(){
    $(".mc-container-wrap.gbMode").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.get( "?modeGbCreate=y&time1="+$(".light-line-one span.time-val").html()
    +"&time2="+ $(".light-line-three span.time-val").html()
    +"&invertTime="+$("#invert-time").is(':checked')
    +"&modeTime="+$("#mode-time").val()
    +"&modeDate="+$("#mode-date").val())
        .done(function( data ) {
            $('.mc-container-wrap.gbMode').preloader('remove');
            var response=JSON.parse(data);
            if(response.err){
                alert(response.data);
            }else{
                $(".mc-container-wrap.gbMode").html(response.data);
            }
        });
}

//noteGb
function noteGbRemove(note_id){
    if (confirm("Delete this note ?")) {
        $(".mc-container-wrap.gbNote").preloader({
            text: 'loading',
            percent: '',
            duration: '',
            zIndex: '',
            setRelative: true
        });

        $.get("?noteGbRemove=y&note_id=" + note_id)
            .done(function (data) {
                $(".mc-container-wrap.gbNote").preloader("remove");
                var response = JSON.parse(data);
                if (response.err) {
                    alert(response.data);
                } else {
                    $(".mc-container-wrap.gbNote").html(response.data);
                }
            });
    }
}
function noteGbEditEntry(note_id){
    $(".mc-container-wrap.gbNote").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get( "?noteGbEditEntry=y&note_id="+note_id
    )
        .done(function( data ) {
            $(".mc-container-wrap.gbNote").preloader("remove");
            var response=JSON.parse(data);
            if(response.err){
                alert(response.data);
            }else{
                $(".mc-container-wrap.gbNote").html(response.data);
            }
        });
}


function noteGbShow(note_id){
    $(".mc-container-wrap.gbNote").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get( "?showNoteBy_id=y&note_id="+note_id)
        .done(function( data ) {
            //alert(data);
            $(".mc-container-wrap.gbNote").preloader("remove");

            var response=JSON.parse(data);
            if(response.err){
                alert(response.data);
            }else{
                $(".mc-container-wrap.gbNote").html(response.data);
            }


        });
}
function noteGbCreateEntry(){
    $(".mc-container-wrap.gbNote").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.get( "?noteGbCreateEntry=y")
        .done(function( data ) {
            $('.mc-container-wrap.gbNote').preloader('remove');
            var response=JSON.parse(data);
            if(response.err){
                alert(response.data);
            }else{
                $(".mc-container-wrap.gbNote").html(response.data);
                //runSlider();
            }
        });
}


function noteGbCreate(){
    $(".mc-container-wrap.gbNote").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.post( "", "noteGbCreate=y&temper="+ $("#temper").val()
    +"&humid="+$("#humid").val()+"&electricity="+$("#electricity").val()
    +"&content="+$("#note-content").val()
    +"&noteTime="+$("#note-time").val()
    +"&noteDate="+$("#note-date").val())
        .done(function( data ) {

            $('.mc-container-wrap.gbNote').preloader('remove');
            var response=JSON.parse(data);
            if(response.err){
                $(".actLog").html(response.data);
            }else{
                $(".mc-container-wrap.gbNote").html(response.data);
                //alert("Ok");
                //window.location.replace('/marijuanaClub/gbEditMode?mode_id='+response.data);
            }
        });
}

//lights


