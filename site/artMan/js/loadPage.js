function loadPage(dest)
{
    $(".load-page."+dest).preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    var form_data = new FormData();
    var file_data = $(".load-page."+dest+" input[type='file']").prop('files')[0];
    form_data.append(0, file_data);
    form_data.append('dest', dest);
    $.ajax({
        url: '', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
            $(".load-page."+dest+" .ref-list").html(php_script_response);
            $(".load-page."+dest).parent().preloader('remove');
        }
    });
}

function delPage(dest)
{
    alert(dest);
}