function Donate() {
    $(".dnt-form").preloader({
        text: 'waiting for redirect to money.yandex.ru',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?"+$("form.donate").serialize(), function (data) {
        if(data=="yes"){
            //alert("yes");
            $("form.donate").submit();
        }else{
            $("form.donate").preloader.remove();
            alert(data);
        }
    })
}