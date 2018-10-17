function wiSearch(wiSearch)
{
    $("form.diagSl").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?wiSearch="+wiSearch+"&searchArg="+$("[name='tpSearch']").val(), function (data) {
        $('form.diagSl').preloader('remove');
        //$(".wiSearch").addClass("active");
        alert(data);
        $(".wiSearch").html(data);
    })
}