function blogMenu(em, blogCat){
    $(".art-list-frame").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $(".blog-menu a").removeClass("active");
    $(em).addClass("active");
    $.post("", "changeCat="+blogCat+"&listCount="+$(".pl_text .p_num.active").html(), function (data) {
        $(".art-list-frame").html(data);
        $(".art-list-frame").preloader("remove");
    });
}

function blogPage(blog_page, blog_cat, listCount) {
    $(".art-list-frame").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.post("", "changeCat="+blog_cat+"&blog_page="+blog_page+"&listCount="+listCount, function (data) {
        $(".art-list-frame").html(data);
        $(".art-list-frame").preloader("remove");
    });
}

function chItmQty(em, blogCat, listCount) {
    $(".art-list-frame").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.post("", "changeCat="+blogCat+"&listCount="+listCount, function (data) {
        $(".art-list-frame").html(data);
        $(".art-list-frame").preloader("remove");
    });
}