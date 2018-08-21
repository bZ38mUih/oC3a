function addBucket(prod_id) {
    $("#srv"+prod_id).preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?addBucket="+prod_id, function (data) {
        $("#srv"+prod_id+" span.addBucket").removeClass("active");
        $("#srv"+prod_id+" span.rmBucket").addClass("active");
        $("#srv"+prod_id+" a.toOrder").addClass("active");
        $("#srv"+prod_id).preloader('remove');
        $(".modal-line-text.bucket a span").html(data);
        if(data>=1000){
            $(".modal-line-text.bucket").parent().show();
        }
    });
    $(".orderBtn span").addClass("active");
    setTimeout(function () {
        $(".orderBtn span").removeClass("active");
    }, 1000);
}

function rmBucket(prod_id)
{
    $("#srv"+prod_id).preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?rmBucket="+prod_id, function (data) {
        $("#srv"+prod_id+" span.addBucket").addClass("active");
        $("#srv"+prod_id+" span.rmBucket").removeClass("active");
        $("#srv"+prod_id+" a.toOrder").removeClass("active");
        $("#srv"+prod_id).preloader('remove');
        $(".modal-line-text.bucket a span").html(data);
        if(data<=1000){
            $(".modal-line-text.bucket").parent().hide();
        }
    });
    $(".orderBtn span").addClass("active");
    setTimeout(function () {
        $(".orderBtn span").removeClass("active");
    }, 1000);
}