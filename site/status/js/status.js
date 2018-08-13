function showLoc(arg) {
    if(arg=='img1'){
        if($("#img2-lk").hasClass("active")){
            $("#img2").fadeOut("slow", function () {
                $("#img1").fadeIn("slow");
            });
        }else{
            $(".yMap-wrap").fadeOut("slow", function () {
                $("#img1").fadeIn("slow");
            });
        }
        $("#img1-lk").addClass("active");
        $("#img2-lk").removeClass("active");
        $("#yMap-lk").removeClass("active");
    }

    if(arg=='img2'){
        if($("#img1-lk").hasClass("active")){
            $("#img1").fadeOut("slow", function () {
                $("#img2").fadeIn("slow");
            });
        }else {
            $(".yMap-wrap").fadeOut("slow", function () {
                $("#img2").fadeIn("slow");
            });
        }
        $("#img2-lk").addClass("active");
        $("#img1-lk").removeClass("active");
        $("#yMap-lk").removeClass("active");
    }

    if(arg=='yMap'){
        if($("#img1-lk").hasClass("active")){
            $("#img1").fadeOut("slow", function () {
                $(".yMap-wrap").fadeIn("slow");
                $("#yMap-lk").addClass("active");
            });
            $("#img1-lk").removeClass("active");
        }else{
            $("#img2").fadeOut("slow", function () {
                $(".yMap-wrap").fadeIn("slow");
                $("#yMap-lk").addClass("active");
            });
            $("#img2-lk").removeClass("active");
        }
    }
}