/*
var commOnPage = 10;
var useAlias='yes';
var curPage = 1;
var commOnPage = 10;
*/
$(document).ready(function(){
    /*
    $('.fancybox-thumbs').fancybox({
        prevEffect : 'none',
        nextEffect : 'none',

        closeBtn  : true,
        arrows    : false,
        nextClick : true,

        helpers : {
            thumbs : {
                width  : 50,
                height : 50
            }
        }
    });

    $(".subjMenu a.subject").click(function(){
        $(".subjMenu a.subject").removeClass("active");
        $(this).addClass("active");
    });

    $(".leftMenu a").click(function(){
        $(".leftMenu a").removeClass("active");
        $(this).addClass("active");
    })
*/
    tinyInit();
    //alert('zzz');
})
/*
function movePhotoScroll_left()
{
    var scrollLeft=$("span.moveLeft").parent().find(".photoLine").scrollLeft();
    var emSize = parseFloat($("body").css("font-size"));
    $("span.moveLeft").parent().find(".photoLine").scrollLeft(scrollLeft+emSize*7);
    if((scrollLeft+emSize*7)>=($("span.moveLeft").parent().find(".photoLine").prop('scrollWidth')-$("span.moveLeft").parent().width())){
        $("span.moveLeft").hide();
    }else{
        $("span.moveRight").show();
   }
}
/*
function movePhotoScroll_right()
{
    var scrollLeft=$("span.moveLeft").parent().find(".photoLine").scrollLeft();
    var emSize = parseFloat($("body").css("font-size"));
    $("span.moveLeft").parent().find(".photoLine").scrollLeft(scrollLeft-emSize*7);
    if(scrollLeft-emSize*7<=0){
        $("span.moveRight").hide();
    }else{
        $("span.moveLeft").show();
    }
}
*/
/*
function openSubject(subject_id, capAlias)
{
    event.preventDefault();
    if(capAlias!=null){
        history.replaceState(null, null, capAlias);
    }else{
        history.replaceState(null, null, "subj_"+subject_id);
    }
    $(".subject_frame").loading({ overlay: true,base: 0.3 });
    $('.subject_frame').loading("show");
    $.get("/forum/?openSubject=yes&subject_id="+subject_id, function(data){
        tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'content');
        var responce=JSON.parse(data);
        $('.subject_frame').loading("hide");
        $("meta[name='description']").attr("content", responce.meta);
        $("title").html(responce.title);
        $(".subject_frame").html(responce.content);
        tinyInit();
        var scrollLeft=$("span.moveLeft").parent().find(".photoLine").scrollLeft();
        if(scrollLeft<=0){
            $("span.moveRight").hide();
        }
        if((scrollLeft)>=($("span.moveLeft").parent().find(".photoLine").prop('scrollWidth')-$("span.moveLeft").parent().width())){
            $("span.moveLeft").hide();
        }
    });
}
*/
/*
function newComment()
{
    tinyMCE.triggerSave();
    var formComment=$('form.formComment')
    var url = "/forum/index.php";
    var posting = $.post( url, formComment.serialize()+"&curPage="+curPage+"&subject_id="+$("#subject_id").val());
    posting.done(function( data ) {
        $('form.formComment').remove();
        tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'content');
        var responce=JSON.parse(data);
        $(".subjectStatistic_frame").html(responce.subjectStatistic);
        $(".subjectPagination_frame").html(responce.pagination);
        $(".subjectComments_frame").html(responce.comments);
        tinyInit();
        tinymce.EditorManager.execCommand('mceAddEditor',true, 'content');
    });
}
*/
/*
function answer(comment_id)
{
    if (comment_id == null){
        comment_id='';
    }
    $('[name=comment_parId]').val(comment_id);
    var form = $('form.formComment');
    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'content');
    $('form.formComment').remove();
    $("#answId_"+comment_id).after(form);
    tinyInit();
    if ($('[name=comment_parId]').val()!=''){
        $('.newComment a').show();
        $("form.formComment span.caption").html("Ответить");
    }else{
        $('.newComment a').hide();
        $("form.formComment span.caption").html("Добавить коммент");
    }
}
*/
/*
function showPage(Page)
{
    curPage = Page;
    $.get("/forum/?pagination=update&curPage="+Page+"&subject_id="+$("#subject_id").val(), function (data) {
        $(".subjectPagination_frame a").removeClass("active");
        tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'content');
        $('form.formComment').remove();
        $('.subjectComments_frame').html(data);
        tinyInit();
        $(".pagination a").removeClass("active");
        $(".subjectPagination_frame a:eq("+(Page-1)+")").addClass("active");
    });
}
*/
function tinyInit()
{
    tinymce.init({
        selector: 'textarea',
        height: 350,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: '/modules/forum/css/codepen.min.css'
    });
}