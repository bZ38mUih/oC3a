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
        //selector: "[name=hwDescr]",
        selector: "form textarea",
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

function editDescr()
{
    $("form.wdEditParams").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    tinymce.triggerSave();
    var formComment=$('form.wdEditParams');
    var posting = $.post( "", formComment.serialize());
    //alert(formComment.serialize());
    posting.done(function( data ) {
        $('form.wdEditParams').preloader('remove');
        var responce=JSON.parse(data);
        if(responce.err!=null){
            $(".field-err").html(responce.err);
        }
    });

}
