function loadDiagFile(){
    //alert('ld-file');
    $("form.diagSl").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    var form_data = new FormData();
    var file_data = $("form.diagSl input[type='file']").prop('files')[0];
    form_data.append(0, file_data);

    //form_data.append(dest, img_id);

    $.ajax({
        url: '', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
            var response=JSON.parse(php_script_response);
            $('form.diagSl').preloader('remove');
            if(response.err != null){
                $(".diagResults").html(response.err);
                //location
                /*
                $('.editImg .img-frame').html(response.data)
                //$('.editImg .err-line').html('успешно');
                $('.editImg .results').html('успешно');
                $('.editImg .results').addClass("success");
                $(".delImg-line span").addClass("active");
                */
            }else {
                //alert('xxx');
                window.location="/win-pc-info?wd_id="+response.data;
                //$(".diagResults").html(response.data);
                //$('.editImg .results').html('неудачное').addClass("fail");
            }
            $('.img-frame').preloader('remove');
        }
    });
}
function searchDiag()
{
    $("form.diagSl").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?wdSearch="+$("form.diagSl input[type=text]").val(), function (data) {
        $('form.diagSl').preloader('remove');
        $(".wdSearch").addClass("active");
        $(".wdSearch").html(data);
    })
}