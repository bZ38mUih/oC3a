$(document).ready(function () {
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