function addBucket(prod_id) {
    $(".orderBtn span").addClass("active");
    setTimeout(function () {
        $(".orderBtn span").removeClass("active");
    }, 1000);
}