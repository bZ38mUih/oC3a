$(document).ready(function(){
    var swiper = new Swiper('.alb-frame-wrapper', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 80,
            stretch: 0,
            depth: 400,
            modifier: 4,
            slideShadows : true,
        },
        pagination: {
            el: '.swiper-pagination',
        },
    });
})