$(document).ready(function () {
    $("button").click(function () {
        event.preventDefault();
    });
    $("span.pName-list").click(function () {
        //alert('pName');
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
    $.get("?wiSearch="+wiSearch+"&searchArg="+$("[name='tpSearch']").val(), function (data) {
        $('form.wi-form').preloader('remove');
        $(".wiSearch").html(data);
    })
}