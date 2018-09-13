var lastScrollTop = 0;
$(document).ready(function() {
    $("body").append("<img src='/source/img/goTop.png' class='toTop' onclick='goTop()'>");
    $(document).scroll(function () {
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            // downscroll code
            $("img.toTop").css("display", "none");
        } else {
            // upscroll code
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
        }
        lastScrollTop = st;
    });
})
function goTop() {
    $('html,body').animate({scrollTop: 0}, 1000);
}

