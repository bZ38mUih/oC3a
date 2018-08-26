function mkOrder() {
    $("form.order").preloader({
        text: 'waiting for redirect to money.yandex.ru',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    //alert($("form.order").serialize());
    $.get("?"+$("form.order").serialize(), function (data) {
        if(data=="yes"){
            alert("yes");
            //$("form.order").submit();
        }else{
            $("form.order").preloader.remove();
            alert(data);
        }
    })
}

function paymType(numb){
    $(".paymType-descr").removeClass("active");
    $(".paymType-descr:eq("+numb+")").addClass("active");
    //alert(numb);
}