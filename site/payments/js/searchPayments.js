/*
function func(count) {

    if(count==0){
        count = 1;
    }else{
        $(".update span").html(count.toString()+" мин. назад");
        count++;
    }
}
*/
var updatedMin=1;
var timerId = setInterval(function() {
    $(".update span").html(updatedMin+" мин. назад");
    updatedMin++;
    //alert( "тик" );
}, 60000);