function linkVideo(fieldName, fieldId)
{

    $("form.loadFilesForm").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    var form_data = new FormData();

    /*
    for (var i=0; i<$('#loadFilesBtn').prop('files').length; i++){
        var file_data = $('#loadFilesBtn').prop('files')[i];
        form_data.append(i, file_data);
    }


    //alert($('#loadFilesBtn').prop('files')[0].name);
    //alert($('#loadFilesBtn').value);
    */
    form_data.append("fieldName", fieldName);
    form_data.append("fieldId", fieldId);
    form_data.append("videoName", $('#loadFilesBtn').prop('files')[0].name);

    $.ajax({
        url: '', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
            //var response=JSON.parse(php_script_response);
            //alert(php_script_response);
            $('form.loadFilesForm').html(php_script_response);
            $('form.loadFilesForm').preloader('remove');
        }
    });

    //alert('xyi');
}
function updVideoAttach(attach_id, em)
{
    //alert('updVideoAttach')
    var attachItem=$(em).parent().parent().parent();
    $(attachItem).preloader({
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

    var attachName=$(em).parent().parent().find("input[type=text]:eq(0)").val();
    var attachDescr=$(em).parent().parent().find("input[type=text]:eq(1)").val();
    var attachDate=$(em).parent().parent().find("input[type=date]").val();
    var attachFlag=$(em).parent().parent().find("input[type=checkbox]").prop('checked');
    //var attachTransf=$(em).parent().parent().find("input[type=number]").val();
    //alert('attachName='+attachName+'/ attachDescr='+attachDescr+"/ attachDate="+attachDate+"/ attachFlag="+attachFlag);
    var posting = $.post( "", "flagField=updateVideoAttach&video_id="+attach_id+
    "&attachName="+attachName+"&attachDescr="+attachDescr+"&attachDate="+attachDate+
    //"&attachFlag="+attachFlag+"&attachTransf="+attachTransf);
    "&attachFlag="+attachFlag);
    posting.done(function( data ) {
        $(attachItem).html(data);
        $(attachItem).preloader('remove');
    });
}

function delVideoLink(attach_id, em)
{
    var attachItem=$(em).parent().parent().parent();
    $(attachItem).preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    var posting = $.post( "", "flagField=delAlbVideoAttach&video_id="+attach_id);
    posting.done(function( data ) {
        $(attachItem).html(data);
        $(attachItem).preloader('remove');
        $(".itemsCount span").html(parseInt( $(".itemsCount span").text())-1);
    });
}
