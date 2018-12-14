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
})