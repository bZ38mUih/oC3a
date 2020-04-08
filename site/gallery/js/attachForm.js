$(document).ready(function(){
    //alert('I am here');
})

function loadFilesM(fieldName, fieldId)
{
    $("form.loadFilesForm").preloader({
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

    for (var i=0; i<$('#loadFilesBtn').prop('files').length; i++){
        var file_data = $('#loadFilesBtn').prop('files')[i];
        form_data.append(i, file_data);
    }

    form_data.append("fieldName", fieldName);
    form_data.append("fieldId", fieldId);

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
}

function updateAttach(attach_id, em){
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
    var attachTransf=$(em).parent().parent().find("input[type=number]").val();
    //alert('attachName='+attachName+'/ attachDescr='+attachDescr+"/ attachDate="+attachDate+"/ attachFlag="+attachFlag);
    var posting = $.post( "", "flagField=updateAlbAttach&photo_id="+attach_id+
    "&attachName="+attachName+"&attachDescr="+attachDescr+"&attachDate="+attachDate+
    "&attachFlag="+attachFlag+"&attachTransf="+attachTransf);
    posting.done(function( data ) {
        $(attachItem).html(data);
        $(attachItem).preloader('remove');
    });
}

function deleteAttach(attach_id, em){

    var attachItem=$(em).parent().parent().parent();
    $(attachItem).preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    var posting = $.post( "", "flagField=delAlbAttach&photo_id="+attach_id);
    posting.done(function( data ) {
        $(attachItem).html(data);
        $(attachItem).preloader('remove');
        $(".itemsCount span").html(parseInt( $(".itemsCount span").text())-1);
    });
}

function reAssignCateg(attach_id, em){
    $(em).parent().preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    var posting = $.post( "", "reAssignCateg=y&glCat_id="+$(em).val()+"&photo_id="+attach_id);
    posting.done(function( data ) {
        $(em).parent().preloader("remove");
        var response=JSON.parse(data);
        if(response.err){
            $(em).parent().find("select:eq(1)").css("display", "none");
            $(em).parent().find(".reAssignAlb-btn-line").css("display", "none");
            //alert(response.data);
        }else{
            $(em).parent().find("select:eq(1)").css("display", "inline-block");
            $(em).parent().find("select:eq(1)").html(response.data)
            $(em).parent().find(".reAssignAlb-btn-line").css("display", "inline-block");
        }
    });
}
function reAssignCancel(em){
    $(em).parent().parent().parent().find("select:eq(1)").css("display", "none");
    $(em).parent().parent().parent().find(".reAssignAlb-btn-line").css("display", "none");
}
function reAssignPhoto(photo_id, em) {
    $(em).parent().parent().parent().parent().preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    var posting = $.post( "", "reAssignPhoto=y&photo_id="+photo_id+"&album_id="+
    $(em).parent().parent().parent().find("select.pick-reAssignAlb").val());
    posting.done(function( data ) {
        $(em).parent().parent().parent().parent().preloader("remove");
        var response=JSON.parse(data);
        if(response.err){
            alert(response.data);
        }else{
            $(em).parent().parent().parent().parent().html(response.data);
        }
    });
}