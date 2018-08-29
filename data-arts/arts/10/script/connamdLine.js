$(document).ready(function(){
    $('span.slideSign').click(function(){
        if($(this).parent().find(".command-line").is(":visible")==true){
            $(this).parent().find(".command-line:not(.exmpl)").slideUp();
            $(this).html("[+]");
        }else{
            $(this).parent().find(".command-line:not(.exmpl)").slideDown();
            $(this).html("[-]");
        }
    });
    $('span.exmpl-btn').click(function(){
        if($(this).parent().find(".command-line.exmpl").is(":visible")==true){
            $(this).parent().find(".command-line.exmpl").slideUp();
            $(this).html("показать[+]");
        }else{
            $(this).parent().find(".command-line.exmpl").slideDown();
            $(this).html("скрыть[-]");
        }
    });
});