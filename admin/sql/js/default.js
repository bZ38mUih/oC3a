function mkQuery()
{
    var posting = $.post( "", "queryText="+$("textarea").val());
    $(".queryResults").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
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