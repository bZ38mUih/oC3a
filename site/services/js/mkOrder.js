function mkOrder() {
    //alert('xyi');
    $("form.order").preloader({
        text: 'waiting for redirect to money.yandex.ru',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    alert($("form.order").serialize());
    $.get("?"+$("form.order").serialize(), function (data) {
        alert(data);
        //$("form.order").submit();
    })
}