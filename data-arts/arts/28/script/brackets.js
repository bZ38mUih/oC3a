function checkBrackets() {
    $('form.brackets').preloader({
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
    }
);
    $.post("", $('form.brackets').serialize(), function (data) {
        $('form.brackets').preloader("remove");
        $(".brackets-result").html(data);
    });
}