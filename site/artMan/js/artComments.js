$(document).ready(function(){
    tinyInit();
})
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
    var posting = $.post( "/blog", formComment.serialize());
    posting.done(function( data ) {
        $('.comments-block').preloader('remove');
        var responce=JSON.parse(data);
        if(responce.err!=null){
            $(".cfForm-err").html(responce.err);
        }else{
            tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'artCm');
            $(".comments-block").html(responce.text);
            tinymce.EditorManager.execCommand('mceAddEditor',true, 'artCm');
            tinyInit();
        }
    });
}

function newAnsw(com_id)
{
    if(com_id != null){
        $("#com_").css("display", "block");
        $("form.cmForm h4 span").html("Ваш ответ:");
        $("#com_"+com_id).hide();
    }else{
        $("#com_").css("display", "none");
        $("form.cmForm h4 span").html("Новый коммент:");
    }
    $("#com_"+$("form.cmForm [name='artCm_pid']").val()).show();
    $("form.cmForm [name='artCm_pid']").val(com_id);
    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'artCm');
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
        selector: '#artCm',
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

function setLike(artCm_id, likeVal) {
    $("#com_"+artCm_id).parent().parent().parent().find(".com-like").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get("/blog?likeVal="+likeVal+"&artCm_id="+artCm_id, function (data) {
        $("#com_"+artCm_id).parent().parent().parent().find(".com-like").preloader("remove");
        $("#com_"+artCm_id).parent().parent().parent().find(".com-like").html(data);
    })
}