function setPhotoLike(photo_id)
{
    $("#photo_"+photo_id).find(".photo-like").html("loading");

    var posting = $.post( "", "setLike="+photo_id);
    posting.done(function( data ) {
        $("#photo_"+photo_id).find(".photo-like").html(data);
    });
}