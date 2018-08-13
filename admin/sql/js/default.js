$(document).ready(function () {
    //alert('sql');
})

function mkQuery()
{
    var posting = $.post( "", "queryText="+$("textarea").val());
    $(".queryResults").preloader({
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
        var response=JSON.parse(data);
        $('.queryResults').html(response.log);
        if(response.result == true){
            $('.queryResults').removeClass("fail");
            $('.queryResults').addClass("well");
        }else{
            $('.queryResults').removeClass("well");
            $('.queryResults').addClass("fail");
        }
        if(response.table!=null){
            $(".res-frame").html(response.table);
        }
        $('.queryResults').preloader('remove');
    });
}