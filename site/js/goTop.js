$(document).ready(function() {
    $("body").append("<img src='/source/img/goTop.png' class='toTop' onclick='goTop()'>");
    $(document).scroll(function () {
        if ($(this).scrollTop() > $(window).height()) {
            if($("img.toTop").is(":visible")==false){
                var timerInterval = setTimeout(function() {
                    $("img.toTop").css("display", "none");
                }, 3000);
            }else {
                clearInterval(timerInterval);
            }
            $("img.toTop").css("display", "block");
        } else {
            $("img.toTop").css("display", "none");
        }
    });
})

function goTop() {
    $('html,body').animate({scrollTop: 0}, 1000);
}

