function removeLikes(alb_id) {
    $("form").preloader({
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
    var jqxhr = $.get("?delLikes=yyy&alb_id="+alb_id, function () {
    })
        .done(function(data) {
            $("form").html(data);
            $('form').preloader('remove');
        });
}

function removePhotos(alb_id) {
    $("form").preloader({
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
    var jqxhr = $.get("?delPhotos=yyy&alb_id="+alb_id, function () {
    })
        .done(function(data) {
            $("form").html(data);
            $('form').preloader('remove');
        });
}

function removeAlbum(alb_id) {
    $("form").preloader({
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
    var jqxhr = $.get("?delAlbum=yyy&alb_id="+alb_id, function () {
    })
        .done(function(data) {
            $("form").html(data);
            $('form').preloader('remove');
        });
}