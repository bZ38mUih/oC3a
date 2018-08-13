/**
 * Created with JetBrains PhpStorm.
 * User: DorianGray
 * Date: 09.03.17
 * Time: 10:27
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){
    //alert('forum here');
    //$("span.dellAttach_act").click(function(){
    //    alert('zzz');

        //alert($(this).parent().parent().find("input").val());
    //})


})

function menuEdit(subjMenu_id, subjMenu_parId)
{
    $.get("?menuEdit=true&subjMenu_id="+subjMenu_id+"&subjMenu_parId="+subjMenu_parId, function(data){
       $(".rightPanel").html(data);
    });

}

function saveForm(className)
{
    var datastring = $("."+className).serialize();
    $.ajax({
        type: "POST",
        url: "/modules/forum/forumManager/index.php",
        data: datastring,
        //dataType: "json",
        success: function(data) {
            //alert($(".subject_fm_frame input:eq(1)").val());
            if(className=='subjMenu_form'){
                $(".rightPanel").html(data);
                //alert('not null='+$(".subject_fm_frame input:eq(1)").val());
            }else{
                $(".subject_fm_frame").html(data);
                //alert('null---');
            }
            if($(".subject_fm_frame input:eq(1)").val()!=null){
               // alert('not null');
            }else{
                //alert('---null');
            }
            //$(".subject_fm_frame").html(data);
        },
        error: function() {
            alert('error handing here');
        }
    });
}

function subjectEdit(subjMenu_id, subject_id)
{
    //alert('zzz');
    $.get("?subjectEdit=true&subjMenu_id="+subjMenu_id+"&subject_id="+subject_id, function(data){
        $(".rightPanel").html(data);
    });
}

function loadFiles(subject_id)
{
    var form_data = new FormData();
    for (var i=0; i<$('#newsImages').prop('files').length; i++){
        var file_data = $('#newsImages').prop('files')[i];
        form_data.append(i, file_data);
    }
    form_data.append("subject_id", subject_id);
    //alert('zzz');
    $('.subjectAttach_fm_frame').html("wating for files loading");
    $(".subjectAttach_fm_frame").loading({ overlay: true,base: 0.3 });
    $('.subjectAttach_fm_frame').loading("show");
    $.ajax({
        url: '', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
            $('.subjectAttach_fm_frame').html(php_script_response);
            $('.subMenuContent').loading("hide");
            //alignPanels();
        }
    });
}

function dellAttachment(attachment_id)
{
    //alert(attachment_id);

    $.get("?dellAttachment=dellNow&attachment_id="+attachment_id, function(data){
        //alert(data);
        //$(".rightPanel").html(data);
        if(data=='well'){
            $("#attach_"+attachment_id).remove();
            //remove div
        }else{
            $("#attach_"+attachment_id).after(data);
            //print message to info
        }
    });
}

function mkMainAttach(attachment_id)
{
    $.get("?mkMainAttach=yes&attachment_id="+attachment_id, function(data){
        $("#attach_"+attachment_id).after(data);
    });
}