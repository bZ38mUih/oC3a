function addBucket(prod_id) {
    alert(prod_id);
    $("#srv"+prod_id).preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?addBucket="+prod_id, function (data) {
        alert(data);
        $("#srv"+prod_id).preloader('remove');
    });


    $(".orderBtn span").addClass("active");
    setTimeout(function () {
        $(".orderBtn span").removeClass("active");
        $(".srv-cntrl span:eq(1)").hide();



    }, 1000);
}

function rmBucket()
{

}