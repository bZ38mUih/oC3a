$(document).ready(function() {
    $('.modal-right .modal-close').click(function () {
        $('.modal, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
    });
    $('.orderBtn span, .orderBtn img').click(function (e) {
        $('.modal.order, .modal.order .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
    });
    $('.menuBtn span, .menuBtn img').click(function (e) {
        $('.modal.menu, .modal.menu .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
    });
    $("span.opnSubMenu").click(function () {
        if($(this).html()=='+'){
            $(this).parent().find("ul").slideDown("slow");
            $(this).html("-");
        }else{
            $(this).parent().find("ul").slideUp("slow");
            $(this).html("+");
        }
    })
})

