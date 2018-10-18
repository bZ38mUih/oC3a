$(document).ready(function () {
    $("button").click(function () {
        event.preventDefault();
    });
})

function wiSearch(wiSearch)
{
    $("form.wi-form").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?wiSearch="+wiSearch+"&searchArg="+$("[name='tpSearch']").val(), function (data) {
        $('form.wi-form').preloader('remove');
        $(".wiSearch").html(data);
    })
}