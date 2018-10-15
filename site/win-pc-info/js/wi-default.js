
function searchDiag()
{
    $.get("?wdSearch="+$("form.diagSl input[type=text]").val(), function (data) {
        $(".wdSearch").addClass("active");
        $(".wdSearch").html(data);

    })
}