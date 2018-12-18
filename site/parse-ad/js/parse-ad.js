$(document).ready(function(){
    $(".line.ad .control-wrap span").click(function(){
        if($(this).hasClass("active")){
            $(this).removeClass("active");
            $(this).parent().parent().find(".prodDescr").hide();

        }else{
            $(this).addClass("active");
            $(this).parent().parent().find(".prodDescr").css("display", "inline-block");
        }
    })
    $(".tbl-opt select").change(function () {
        $.cookie($(this).attr('id'), $(this).find("option:selected").val());
        window.location = window.location.pathname;
    })
})

function showLog() {
    $(".log-content").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?logdepth="+$("#logDepth").val(), function (data) {
        $(".log-content").html(data);
    })
}