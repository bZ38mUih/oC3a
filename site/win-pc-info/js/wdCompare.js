$(document).ready(function () {
    $("select").change(function () {
        $.cookie($(this).attr("name"), $(this).find("option:selected").val(), {expires: 30, path: '/'});
    });
    $(".option-panel .line input[type='checkbox']").click(function () {
        if ($(this).prop("checked") == true) {
            $.cookie($(this).attr("name"), $(this).prop("checked"), {expires: 30, path: '/'});
            if ($(this).parent("div").find("input[type='checkbox']").length > 1) {
                if ($(this).index() == 1) {
                    $(this).parent().find("input[type='checkbox']:eq(1)").prop("disabled", false);
                }
            }
        }
        else {
            $.cookie($(this).attr("name"), null, {expires: 30, path: '/'});
            if ($(this).parent("div").find("input[type='checkbox']").length > 1) {
                if ($(this).index() == 1) {
                    $(this).parent().find("input[type='checkbox']:eq(1)").prop("disabled", true);
                }
            }
        }
    });
})

function wiCompare() {
    //alert($("[name='cmpLeft'] option:selected").val());
    //alert(
    if($("[name='opt-envir']").prop("checked")==true){
        alert('y');
    }else{

        alert('n');
    };
}