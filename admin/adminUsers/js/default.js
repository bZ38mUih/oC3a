function addNewUser()
{
    $("[name='newUsrName']").val();
    $("[name='newUsrPass']").val();

    var posting = $.post( "", "addAdmUsrFlag=y&newUsrName="+$("[name='newUsrName']").val()+"&newUsrPass="+$("[name='newUsrPass']").val());
    $(".newUsr-err").preloader({
        // loading text
        text: 'loading',
        // from 0 to 100
        percent: '',
        // duration in ms
        duration: '',
        // z-index property
        zIndex: '',
        // sets relative position to preloader's parent
        setRelative: true
    });

    posting.done(function( data ) {
        //alert(data);
        var response=JSON.parse(data);
        $('.newUsr-err').html(response.log);
        if(response.result == true){
            $('.newUsr-err').removeClass("fail");
            $('.newUsr-err').addClass("well");
            $(".usersList").preloader({
                // loading text
                text: 'loading',
                // from 0 to 100
                percent: '',
                // duration in ms
                duration: '',
                // z-index property
                zIndex: '',
                // sets relative position to preloader's parent
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

function dropAdminUsr(usrName) {
    $(".usersList").preloader({
        // loading text
        text: 'loading',
        // from 0 to 100
        percent: '',
        // duration in ms
        duration: '',
        // z-index property
        zIndex: '',
        // sets relative position to preloader's parent
        setRelative: true
    });
    $.get( "", {dropUser: usrName} )
        .done(function( data ) {
            //var response=JSON.parse(data);
            $('.usersList').html(data);
            $('.usersList').preloader('remove');
        });
}