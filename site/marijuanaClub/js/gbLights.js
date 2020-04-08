function lightModelCreate(){
    $(".mc-container-wrap.gbLights").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.post( "", "lightModelCreate=y&modelName="+ $("#modelName").val()
        +"&activeFlag="+$("#activeFlag").is(':checked')
    +"&power="+$("#power").val()+"&colorT="+$("#colorT").val()
    +"&settle="+$("#settle").val()
    +"&lightType="+$("#lightType").val()
    +"&lightNote="+$("#lightNote").val())
        .done(function( data ) {

            $('.mc-container-wrap.gbLights').preloader('remove');
            var response=JSON.parse(data);
            if(response.err){
                $(".actLog").html(response.data);
            }else{
                $(".mc-container-wrap.gbLights").html(response.data);
                //alert("Ok");
                //window.location.replace('/marijuanaClub/gbEditMode?mode_id='+response.data);
            }
        });
}
function lightModelEdit(){
    $(".mc-container-wrap.gbLights").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.post( "", "lightModelEdit=y&model_id="+$("#model_id").html()+"&modelName="+ $("#modelName").val()
        +"&lightStatus="+$("#activeFlag").is(':checked')
    +"&power="+$("#power").val()+"&colorT="+$("#colorT").val()
    +"&settle="+$("#settle").val()
    +"&lightType="+$("#lightType").val()
    +"&lightNote="+$("#lightNote").val())
        .done(function( data ) {
            $('.mc-container-wrap.gbLights').preloader('remove');
            var response=JSON.parse(data);
            if(response.err){
                $(".actLog").removeClass("well");
                $(".actLog").addClass("fail");
                $(".actLog").html(response.data);
            }else{
                $(".actLog").html(response.data);
                $(".actLog").addClass("well");
                $(".actLog").removeClass("fail");
            }
        });
}
function lightCreate(){

    $(".mc-container-wrap.gbLights").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.post( "", "lightCreate=y&model_id="+ $("#model_id").val()
    +"&lampNote="+$("#lampNote").is(':checked')
    +"&lightName="+$("#lightName").val()
    //+"&colorT="+$("#colorT").val()
    //+"&settle="+$("#settle").val()
    //+"&lightType="+$("#lightType").val()
    +"&dateEntered="+$("#dateEntered").val()
    +"&lightStatus="+$("#lightStatus").val())
        .done(function( data ) {

            $('.mc-container-wrap.gbLights').preloader('remove');
            var response=JSON.parse(data);
            if(response.err){
                $(".actLog").html(response.data);
            }else{
                $(".mc-container-wrap.gbLights").html(response.data);
                //alert("Ok");
                window.location.replace('/marijuanaClub/gbLamps');
            }
        });

}