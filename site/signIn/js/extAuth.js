$(document).ready(function(){
    $("body").append("<div class='modal signIn'><div class='overlay'></div><div class='contentBlock-frame'>"+
    "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div></div>"+
    "<div class='modal-left'></div></div></div></div>");
    $('a.signIn').click(function (e) {
        $('.modal.signIn, .modal.signIn .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
        $(".modal.signIn .modal-left").preloader({
            text: 'loading',
            percent: '',
            duration: '',
            zIndex: '',
            setRelative: true
        });
        $.get("/signIn/?auth=try", function(data){
            $(".modal.signIn .modal-left").html(data);
            $("head").append("<link rel='stylesheet' href='/site/signIn/css/defaultForm.css' type='text/css' media='screen, projection'/>");
            $("head").append("<script src='/site/signIn/js/default.js'></script>");
            $("head").append("<script type='text/javascript' src='/site/signIn/js/site.js'></script>");

            $('.modal.signIn .modal-left').preloader('remove');
        })
    });
})