$(document).ready(function () {
    //alert('xyi');
})

function uploadAlbums()
{
    $("form.uploadAlb-res").preloader({
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
    var jqxhr = $.get("?uploadAlbums="+$("#targetFolder").val(), function () {
    })
        .done(function(data) {
            $("form.uploadAlb-res").html(data);
            $('form.uploadAlb-res').preloader('remove');
        });
}