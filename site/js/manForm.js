function loadFiles(img_id, dest)
{
    $(".img-frame").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    var form_data = new FormData();
    var file_data = $(".control-frame input[type='file']").prop('files')[0];
    form_data.append(0, file_data);
    form_data.append(dest, img_id);
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
                $('.editImg .img-frame').html(response.data)
                $('.editImg .results').html('успешно');
                $('.editImg .results').addClass("success");
                $(".delImg-line span").addClass("active");
            }else {
                $('.editImg .results').html('неудачное').addClass("fail");
            }
            $('.img-frame').preloader('remove');
        }
    });
}

function delImg(img_id, dest) {
    $(".editImg").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    var jqxhr = $.get( "?"+dest+"="+img_id, function(data) {
        var response=JSON.parse(data);
        if(response.result == true){
            $('.editImg .img-frame').html(response.data)
            $('.editImg .err-line').html('удаление успешно');
            $(".delImg-line span").removeClass("active");
        }else {
            $('.editImg .err-line').html('удаление неудачно');
        }
        $('.editImg').preloader('remove');
    })
        .done(function() {
            $('.editImg').preloader('remove');
        })
}

function mkAlias()
{
    var jqxhr = $.get("?mkAlias=" + $("#targetName").val(), function () {
    })
        .done(function(data) {
            $('#targetAlias').val(data);
        });
}

function addNewLink()
{
    $(".ref-list").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    var posting = $.post( "", "addNewLink=yyy&refLnk="+$("[name='refLnk']").val()+"&refTxt="+$("[name='refTxt']").val());
    posting.done(function( data ) {
        $('.ref-list').html(data);
        $('.ref-list').preloader('remove');
    });
}

function delRef(ref_id, fld_id)
{
    $(".ref-list").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    var jqxhr = $.get("?delRef="+ref_id+"&fld_id="+fld_id, function () {

    })
        .done(function(data) {
            $('.ref-list').html(data);
            $('.ref-list').preloader('remove');
        });
}