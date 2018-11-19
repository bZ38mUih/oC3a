function mkQuery()
{
    var posting = $.post( "", "queryText="+$("textarea").val()+"&qp-limit="+$("[name='qp-limit']").val());
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
            $('.res-frame').addClass("active");
            $('.queryResults').removeClass("fail");
            $('.queryResults').addClass("well");
        }else{
            $('.res-frame').removeClass("active");
            $('.queryResults').removeClass("well");
            $('.queryResults').addClass("fail");
        }
        if(response.table!=null){
            $(".res-frame").html(response.table);
        }
        $('.queryResults').preloader('remove');
    });
}