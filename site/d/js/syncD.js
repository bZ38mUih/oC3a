function syncD()
{
    $(".syncD").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("", $("form").serialize(), function(data){
        $(".syncRes").html(data);
        $('.syncD').preloader('remove');
    });
}
