function loadDiagFile()
{
    //alert('xyi-diag');
    $(".diagSl").preloader({
        // loading text
        text: 'loading',
        // from 0 to 100
        percent: '',
        // duration in ms
        duration: '',
        // z-index property
        zIndex: '',
        // sets relative position to preloader's parent
        setRelative: true
    });
    var form_data = new FormData();
    var file_data = $(".diagSl input[type='file']").prop('files')[0];
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
            if(response.result == true){
                $(".diagResults").html(response.data);

                /*
                $('.editImg .img-frame').html(response.data)
                //$('.editImg .err-line').html('успешно');
                $('.editImg .results').html('успешно');
                $('.editImg .results').addClass("success");
                $(".delImg-line span").addClass("active");
                */
            }else {
                /*
                $('.editImg .results').html('неудачное').addClass("fail");
                */
            }
            $('.diagSl').preloader('remove');
        }
    });
}
