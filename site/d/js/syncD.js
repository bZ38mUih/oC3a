function syncD()
{
    alert($("form").serialize());
    $(".syncD").preloader({
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

    $.get("", $("form").serialize(), function(data){
        $(".syncRes").html(data);
        $('.syncD').preloader('remove');
    });


    /*

    posting.done(function( data ) {
        $('.settingsPanel').html(data);
        $('.settingsPanel').preloader('remove');
        statUpdate();
    });

    var jqxhr = $.get( "?conn=cancel", function(data) {
        $(".settingsPanel").preloader({
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
        $('.settingsPanel').html(data);
    })
        .done(function() {
            $('.settingsPanel').preloader('remove');

        })
        */

    //alert('zzz');
}
