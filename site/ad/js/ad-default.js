/**
 * Created by mrSmitch on 03.06.2018.
 */
$(document).ready(function(){
    $('a.signIn-block').click(function (e) {
        //$('.modal.signIn, .modal.signIn .overlay').css({'opacity': 1, 'visibility': 'visible'});
        $('.modal.signIn, .modal.signIn .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
        $(".modal.signIn .modal-left").preloader({
            // loading text
            text: 'loading',
            // from 0 to 100
            percent: '',
            // duration in ms
            duration: '',
            // z-index property
            zIndex: '',
            // sets relative position to preloader's parent
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