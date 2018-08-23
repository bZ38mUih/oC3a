function Donate() {
    //alert('xyi');
    $(".dnt-form").preloader({
        text: 'waiting for redirect to money.yandex.ru',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    alert($("form.donate").serialize());
    $.get("?"+$("form.donate").serialize(), function (data) {
        alert(data);
        //$("form.order").submit();
    })
}