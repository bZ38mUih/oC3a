$(document).ready(function ()
{
    $("span.slide-stat").click(function () {
        if($(this).html() == '[-]'){
            $(this).parent().parent().find('ul:first').slideUp("slow");
            $(this).html("[+]");
        }else{
            $(this).parent().parent().find('ul:first').slideDown("slow");
            $(this).html("[-]");
        }
    })
})