$(document).ready(function(){

    $('a.signIn').click(function (e) {

        $('.modal.signIn, .modal.signIn .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
        $(".modal.signIn .modal-left").preloader({
            text: 'loading',
            percent: '',
            duration: '',
            zIndex: '',
            setRelative: true
        });

        $.get("/signIn/?auth=try", function(data){
            $(".modal.signIn .modal-left").html(data);
            $("head").append("<link rel='stylesheet' href='/site/signIn/css/defaultForm.css' type='text/css' media='screen, projection'/>");
            $("head").append("<script src='/site/signIn/js/default.js'></script>");
            $("head").append("<script type='text/javascript' src='/site/signIn/js/site.js'></script>");

            $('.modal.signIn .modal-left').preloader('remove');
        })
    });

    tinyInit();

})

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

function writeCom(com_id)
{
    $(".ref-block").preloader({
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
        $('.ref-block').preloader('remove');
        var responce=JSON.parse(data);

        if(responce.err!=null){
            $(".cfForm-err").html(responce.err);
        }else{
            tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'yCm');
            $(".ref-block").html(responce.text);
            $(".ref-stat span.fldVal:first").html(responce.cntCom);
            tinymce.EditorManager.execCommand('mceAddEditor',true, 'yCm');
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
        if($("form.cmForm [name='newComPar_id']").val()!=null){
            $("#com_"+$("form.cmForm [name='newComPar_id']").val()).show();
        }
    }else{
        $("#com_").css("display", "none");
        $("form.cmForm h4").html("Ваш отзыв:");
    }

    $("form.cmForm [name='newComPar_id']").val(com_id);
    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'yCm');
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
        selector: 'textarea',
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