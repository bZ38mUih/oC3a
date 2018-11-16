$(document).ready(function () {
    $("button").click(function () {
        event.preventDefault();
    });
    $("span.pName-list").click(function () {
        if($(this).hasClass("active")){
            $(this).removeClass("active");
            $(this).parent("li").find("ul").slideUp(500);
        }else{
            $(this).addClass("active");
            $(this).parent("li").find("ul").slideDown(500);
        }
    })
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
    $.cookie(wiSearch, $("[name='tpSearch']").val());
    $.get("?wiSearch="+wiSearch+"&searchArg="+$("[name='tpSearch']").val(), function (data) {
        $('form.wi-form').preloader('remove');
        $(".wiSearch").html(data);
    })
}