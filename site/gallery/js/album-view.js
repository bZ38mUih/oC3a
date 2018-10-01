function setPhotoLike(photo_id)
{
    $("#photo_"+photo_id).find(".photo-like").html("loading");

    var posting = $.post( "", "setLike="+photo_id);
    posting.done(function( data ) {
        $("#photo_"+photo_id).find(".photo-like").html(data);
    });
}

function addComment(el) {
    var photo_id=$(el).closest(".photo-line").attr("id").substr(6, 5);
    if($("form.addComment").length==1){
        $("span.newComment").show();
        $("form.addComment").remove();
    }
    $(el).after("<form class='addComment'><textarea name='phComment' rows='4'>"+"" +
        "</textarea><input type='button' value='написать' onclick='writeComment("+photo_id+","+$(el).attr("comm-id")+")'>"+
        "</form>");
    $(el).hide();
}

function writeComment(photo_id, comPar_id) {
    //alert("photo_id="+photo_id+" / commPar_id="+comPar_id);
    $("#photo_"+photo_id+" .photo-comments").preloader({
        // loading text
        text: 'loading',
        // from 0 to 100
        percent: '',
        // duration in ms
        duration: '',
        // z-index property
        zIndex: '',
        // sets relative position to preloader's parent
        setRelative: true
    });

    $.get("?writeComment=true&photo_id="+photo_id+"&comPar_id="+comPar_id+"&comment="+$("[name='phComment']").val(),
        function(data){
            $("#photo_"+photo_id+" .photo-comments").html(data);
            $("#photo_"+photo_id+" .photo-comments").preloader('remove');
            //alert(data);

        })
}