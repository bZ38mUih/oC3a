function delNote(note_id)
{
    if (confirm("Delete this note ?")) {
        $("#"+note_id).preloader({
            text: 'loading',
            setRelative: true
        });
        $.get("?delNote="+note_id, function (data) {
            if(data==true){
                $("#"+note_id).remove();
            }else{
                $("#"+note_id+" div:first").before("<div class='pageErr'>"+data+"</div>");
            }
            $('#'+note_id).preloader('remove');
        });
    }
}

function delDiary(diary_id)
{
    if (confirm("Delete this DIARY !?")) {
        $(".note-wrap").preloader({
            text: 'loading',
            setRelative: true
        });
        $.get("?delDiary="+diary_id, function (data) {
            if(data==true){
                var pathArray = window.location.pathname.split('/');
                location.replace("/d/"+pathArray[2]+"/lastNote");
          }else{
                $(".note-wrap div:first").before("<div class='pageErr'>"+data+"</div>");
                $(".note-wrap").preloader('remove');
            }
        });
    }
}