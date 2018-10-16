function addNewUser()
{
    $("[name='newUsrName']").val();
    $("[name='newUsrPass']").val();

    var posting = $.post( "", "addAdmUsrFlag=y&newUsrName="+$("[name='newUsrName']").val()+"&newUsrPass="+$("[name='newUsrPass']").val());
    $(".newUsr-err").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    posting.done(function( data ) {
        var response=JSON.parse(data);
        $('.newUsr-err').html(response.log);
        if(response.result == true){
            $('.newUsr-err').removeClass("fail");
            $('.newUsr-err').addClass("well");
            $(".usersList").preloader({
                text: 'loading',
                percent: '',
                duration: '',
                zIndex: '',
                setRelative: true
            });
            $.get( "", {action: "refreshUsers"} )
                .done(function( resp_data ) {
                    //var response=JSON.parse(data);
                    $('.usersList').html(resp_data);
                    $('.usersList').preloader('remove');
                });
        }else{
            $('.newUsr-err').removeClass("well");
            $('.newUsr-err').addClass("fail");
        }
        $('.newUsr-err').preloader('remove');
    });
}

function dropAdminUsr(usrName)
{
    $(".usersList").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get( "", {dropUser: usrName} )
        .done(function( data ) {
            $('.usersList').html(data);
            $('.usersList').preloader('remove');
        });
}