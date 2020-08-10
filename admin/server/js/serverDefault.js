function activateInputs()
{
    $("form.serverOptions input[type='text']").prop('disabled', false);
    $("[name='saveCon'], [name='cancelConn']").addClass("active");
    $("[name='editConn']").removeClass("active");
}

function saveConn()
{
    var posting = $.post( "", $("form.serverOptions").serialize());
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

    posting.done(function( data ) {
        $('.settingsPanel').html(data);
        $('.settingsPanel').preloader('remove');
        statUpdate();
    });
}

function cancel_Conn()
{
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
}

function statUpdate()
{
    var jqxhr = $.get( "?status=refresh", function(data) {
        $(".statusPanel").preloader({
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
        $('.statusPanel').html(data);
    })
        .done(function() {
            $('.statusPanel').preloader('remove');
        })
}
