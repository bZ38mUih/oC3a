function loadDiagFile()
{
    $(".diagSl").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    var form_data = new FormData();
    var file_data = $(".diagSl input[type='file']").prop('files')[0];
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
            if(response.result == true){
                location.href = "/win-diag?wd_id="+response.wd_id;
                //$(".diagResults").html(response.data);
            }else {

            }
            $('.diagSl').preloader('remove');
        }
    });
}

function searchDiag()
{
    $.get("?wdSearch="+$("form.diagSl input[type=text]").val(), function (data) {
        //alert(data);
        $(".wdSearch").addClass("active");
        $(".wdSearch").html(data);

    })
    //alert("xyi-zzz-xxx");
}
function showDRes(wd_id) {
    alert(wd_id);
}
