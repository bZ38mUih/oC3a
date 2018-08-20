function addBucket(prod_id) {
    $(".orderBtn span").addClass("active");
    setTimeout(function () {
        $(".orderBtn span").removeClass("active");
        $(".srv-cntrl span:eq(1)").hide();



    }, 1000);
}

function addBucket(srv_id) {
    alert('add-'+srv_id);
}

function addBucket(srv_id) {
    alert('remove-'+srv_id);
}