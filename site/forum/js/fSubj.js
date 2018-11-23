$(document).ready(function(){
    tinyInit();
})
/*
function appreciate(aprVal)
{
    $(".ref-apprec").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("?aprVal="+aprVal, function(data){
        var obj = JSON.parse(data);
        $(".ref-apprec").html(obj.content);
        $(".ref-stat span.fldVal:eq(1)").html(obj.qty);
        $(".ref-apprec").preloader('remove');
    });
}
*/
function writeCom(com_id)
{
    $(".comments-block").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    tinymce.triggerSave();
    var formComment=$('form.cmForm');
    var posting = $.post( "", formComment.serialize());
    posting.done(function( data ) {
        $('.comments-block').preloader('remove');
        var responce=JSON.parse(data);
        if(responce.err!=null){
            $(".cfForm-err").html(responce.err);
        }else{
            tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'fCm');
            $(".comments-block").html(responce.text);
            $(".fOptMenu span.cmCnt").html(responce.subjComm);
            $(".fOptMenu span.answCnt").html(responce.subjAnsw);
            //$(".ref-stat span.fldVal:first").html(responce.cntCom);
            tinymce.EditorManager.execCommand('mceAddEditor',true, 'fCm');
            tinyInit();
        }
    });
}

function newAnsw(com_id)
{
    if(com_id != null){
        $("#com_").css("display", "block");
        $("form.cmForm h4").html("Ваш ответ:");
        $("#com_"+com_id).hide();
    }else{
        $("#com_").css("display", "none");
        $("form.cmForm h4").html("Ваш отзыв:");
    }
    $("#com_"+$("form.cmForm [name='fc_pid']").val()).show();
    $("form.cmForm [name='fc_pid']").val(com_id);
    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'fCm');
    var formComment=$('form.cmForm');
    if(com_id != null){
        $("#com_"+com_id).after(formComment);
    }else{
        $("#com_").after(formComment);
    }
    tinyInit();
}

function tinyInit()
{
    tinymce.init({
        selector: '#fCm',
        height: '10em',
        theme: 'modern',
        plugins:             'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste code',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//source/js/tinymce/skins/lightgray/skin.mim.css'
        ]
    });
}