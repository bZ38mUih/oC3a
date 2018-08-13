function changeStatus() {
    $.get("?changeStaus=yes", function (data) {
        var response=JSON.parse(data);
        $(".stat-block").removeClass("busy");
        $(".stat-block").removeClass("lookFor");
        $(".stat-block").removeClass("free");
        $(".stat-block").addClass(response.stName);
        $(".stat-block .stat-block-txt").html(response.descr);
        $(".stat-block span.status").html(response.alias);
        $(".stat-descr").html(response.detail);
        $(".stat-block-img").html("<img src='/site/status/img/logo-"+response.stName+".png' onclick='changeStatus()'>");
    });
}