$(document).ready(function(){
    tinyInit();
})
function tinyInit()
{
    tinymce.init({
        selector: '[name=longDescr]',
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
function updateSDescr(fs_id) {
    tinymce.triggerSave();
    var posting = $.post( "", $("form.s-descr").serialize());
    posting.done(function( data ) {
        if(data==true){
            alert("yyyy");
        }else {
            alert(data);
        }
        /*
        $('form.wdEditParams').preloader('remove');
        var responce=JSON.parse(data);
        if(responce.err!=null){
            $(".field-err").html(responce.err);
        }
        */
        //alert(data);
    });
    //$.get("?sDescr="+$("[name='sDescr']").val())
    //alert($("[name='sDescr']").val());
}