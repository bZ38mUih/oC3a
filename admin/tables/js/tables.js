
$(document).ready(function(){
    $('.modal-right').click(function (){
        $('.modal, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
    });
})
function tables(action, tableName)
{
    if (tableName === undefined) {
        tableName='';
    }
    if(action=='download'){
        tableName=($(tableName).parent().parent().find("option:selected").val());
    }
    $.get( "?action="+action+"&tableName="+tableName+
    "&prefixTag="+$(".optionsPanel [name='prefixTag']").val()+"&dateTag="+$(".optionsPanel [name='dateTag']").prop("checked") )
        .done(function( data ) {
            var response=JSON.parse(data);
            if(response.err==false){
                $('.logPanel h3').after("<div class='success'>"+response.log+"</div>");
            }else{
                $('.logPanel h3').after("<div class='fail'>"+response.log+"<span>"+response.err+"</span></div>");
            }
        });
}

function refreshTables()
{
    $('.tablesList').preloader({
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
    $.get( "", {action: "refreshTables"} )
        .done(function( data ) {
            var response=JSON.parse(data);
            $('.tablesList').html(response.log);
            $('.tablesList').preloader('remove');
        });
}

function showLog()
{
    $('.modal, .modal .overlay').css({'opacity': 1, 'visibility': 'visible'});
}