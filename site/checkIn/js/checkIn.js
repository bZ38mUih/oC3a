/**
 * Created by AVP on 26.11.2016.
 */

var pageErr = {login:true, password:true, password_2:true, eMail:true};

$(document).ready(function(){
    if($("[name='login']").parent().find(".pageErr").hasClass("active")){
        pageErr.login=false;
    }
    if($("[name='password']").parent().find(".pageErr").hasClass("active")){
        pageErr.password=false;
    }
    if($("[name='eMail']").parent().find(".pageErr").hasClass("active")){
        pageErr.eMail=false;
    }
    if($("[name='password_2']").parent().find(".pageErr").hasClass("active")){
        pageErr.password_2=false;
    }
    $("[name='login']").keyup(function() {
        if ($(this).val() != ""){
            $("label[for='login']").html('');
        }else{
            $("label[for='login']").html('Придумайте логин');
        }
    });
    $("[name='password']").keyup(function() {
        if ($(this).val() != ""){
            $("label[for='password']").html('');
        }else{
            $("label[for='password']").html('Придумайте пароль');
        }
    });
    $("[name='password_2']").keyup(function() {
        if ($(this).val() != ""){
            $("label[for='password_2']").html('');
        }else{
            $("label[for='password_2']").html('Повторите пароль');
        }
    });
    $("[name='eMail']").keyup(function() {
        if ($(this).val() != ""){
            $("label[for='eMail']").html('');
        }else{
            $("label[for='eMail']").html('Введите ваш e-mail');
        }
    });
    $("[name='checkCode']").keyup(function() {
        if ($(this).val() != ""){
            $("label[for='checkCode']").html('');
        }else{
            $("label[for='checkCode']").html('Код с картинки');
        }
    });
    $("[name='checkCode']").change(function() {
        $(this).parent().parent().find(".pageErr").removeClass("active");
        errMessage();
    });
    $("[name='login'], [name='password'], [name='password_2'], [name='eMail']").change(function(){
        var fieldName=$(this).attr("name");
        var fieldVal=$(this).val();
        if(fieldName!="password_2"){
            $.get("?"+$(this).attr("name")+"="+$(this).val(), function(data) {
                if(data=='true'){
                    pageErr[fieldName]=true;
                    $("[name='"+fieldName+"']").parent().find(".pageErr").removeClass("active");
                }else{
                    pageErr[fieldName]=false;
                    $("[name='"+fieldName+"']").parent().find(".pageErr").html(data);
                    $("[name='"+fieldName+"']").parent().find(".pageErr").addClass("active");
                }
                errMessage();
            });
        }else{
            pageErr[fieldName]=true;
            $("[name='"+fieldName+"']").parent().find(".pageErr").removeClass("active");
            errMessage();
        }

    });
    $("#captcha_update").click(function(){
        $.get("?captcha=update", function(data){
            $(".captcha_img img").remove();
            var obj = JSON.parse(data);
            $(".captcha_img a").before(obj.image);
            $("#checkIn_checkCode").val(obj.code);
        });
    });
});
function errMessage()
{
    if(pageErr.login===true && pageErr.password===true && pageErr.eMail===true && pageErr.password_2===true){
        $("form.checkIn .pageErr").last().removeClass("active");
    }else{
        $("form.checkIn .pageErr").last().addClass("active");
    }
}