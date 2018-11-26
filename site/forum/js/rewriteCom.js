function rewriteCom(com_id)
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
    var posting = $.post( "/forum/forummanager/rewritecomment", formComment.serialize());
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