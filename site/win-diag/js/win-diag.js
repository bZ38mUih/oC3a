$(document).ready(function(){
    /*
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
    */
    tinyInit();
})
function tinyInit()
{
    tinymce.init({
        selector: 'textarea',
        height: '20em',
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
function editDescr(com_id)
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
