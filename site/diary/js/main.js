/**
 * Created by AVP on 27.11.2016.
 */
//alert('zzz');

$(document).ready(function(){
    tinyInit();
})

function subMemu(id)
{
    $(".mainMenu a:not(.subMenu)").removeClass("active");
    $.get("?subMenu="+id, function (data) {
        $(".subMenu").html(data);
        $("#"+id).addClass("active");
    });
}

function mkDiary(diaryType, diary_id, note_id, el)
{
    //alert("?diary=mkDiary&diaryType="+diaryType+"&diary_id="+diary_id+"&note_id="+note_id);
    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'content');
    $.get("?diary=mkDiary&diaryType="+diaryType+"&diary_id="+diary_id+"&note_id="+note_id, function (data) {

        //$(".mkDiary").remove();
        //tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'content');
        //tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'content');
        //tinymce.EditorManager.execCommand('mceAddEditor',true, 'content');

        if (diary_id == null && note_id == null){
            data = "<div class='diaryNote'><div class='note' style="+'"display: inherit;"'+"> "+data+"</div></div>";
            $(".middlePanel").html(data);
        }
        if (diary_id != null & note_id == null){
             $(el).parent("div").parent("div").html(data);
        }

        if (diary_id != null & note_id != null){
            $(el).parent("div").parent("div").html(data);
        }

        tinyInit();
    });
}

function saveDiary(el)
{

    tinymce.triggerSave();
    //alert('xyi-2');
    var url = "/diary/";
    var posting = $.post( url, $("form.mkDiary").serialize());
    alert($("form.mkDiary").serialize());
    posting.done(function( data ) {
        tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'content');
        $(el).parent().parent("div").parent("div").html(data);
        tinymce.EditorManager.execCommand('mceAddEditor',true, 'content');
        //tinymce.EditorManager.execCommand('mceAddEditor',true, 'content');
        /*
        tinymce.init({
            selector: 'textarea',
            height: 200,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_css: '/modules/diary/styles/codepen.min.css'
        });
        */
        tinyInit();
    });
}

function applyFilter(diaryType)
{
    $.get("?diaryType="+diaryType+"&dailyFrom="+$("#from").val()+"&dailyTill="+$("#till").val(), function (data) {
        //alert(data)
        $('.middlePanel').html(data);
    });
}

function slideNotes(el)
{
    if ($(el).hasClass("active") == true){
        $(el).parent().find("div").each(function() {
            $(this).hide(500);
        });
        $(el).removeClass("active");
    }else{
        $(el).parent().find("div").each(function() {
            $(this).show(500);
            $(el).addClass("active");
        });
    }
}

function delDiary(diary_id, el)
{
    $.get("?diary=delDiary&diary_id="+diary_id, function (data) {
            $(el).parent("div").html(data);
    });
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
            '//source/js/tinymce/js/tinymce/skins/lightgray/skin.mim.css'
        ]
    });
}