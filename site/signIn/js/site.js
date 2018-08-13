$(document).ready(function() {
    $("form.signIn input[name=login]").keyup(function () {
        if ($(this).val() != "") {
            $("label[for='login']").removeClass("shown");
        } else {
            $("label[for='login']").addClass("shown");
        }
    });
    $("form.signIn input[name=password]").keyup(function () {
        if ($(this).val() != "") {
            $("label[for='password']").removeClass("shown");
        } else {
            $("label[for='password']").addClass("shown");
        }
    });
    $("form.signIn input[name=rememberMe]").click(function(){
        if($(this).prop('checked') == true){
            $.cookie('rememberMe', "on", {expires: 30, path:'/'});
        }else{
            $.cookie('rememberMe', null, {expires: 30, path:'/'});
            $.cookie('password', null, {expires: 30, path:'/'});
        };
    });
});