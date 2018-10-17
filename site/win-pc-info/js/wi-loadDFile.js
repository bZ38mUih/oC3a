function loadDiagFile(){
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
            }else {
                window.location="/win-pc-info?wd_id="+response.data;
            }
            $('.img-frame').preloader('remove');
        }
    });
}