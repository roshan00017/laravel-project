// Set current timer
onMenuDateTime();
function onMenuDateTime() {
    const me = this;
    let myVar = setInterval(me.myTimer, 1000);
}
function myTimer() {
    let hours;
    const me = this;
    //    menuTimeset = $('#timeser');
    currentTime = new Date();
    if(currentTime.getHours()>12){
        hours = currentTime.getHours()-12;
    } else {
        hours = currentTime.getHours();
    }
    var displayDateAd = hours + ":" + currentTime.getMinutes() + ":" + currentTime.getSeconds();
    // var displayDateAd = Date(currentTime, 'g:i:s');
    //    let options = {
    //     weekday: "long", year: "numeric", month: "short",
    //     day: "numeric", hour: "2-digit", minute: "2-digit"
    // };

    // console.log(currentTime.toLocaleTimeString("en-us", options));
    //    alert(displayDateAd);
    $('#timeset').html(displayDateAd);
    hours = currentTime.getHours();
    am = Date(currentTime, 'A');
    let text = "";
    // if (am == 'AM') {
    if (hours >= 0 && hours <= 4) {
        text = "रात्री";
        $('#timeset').html(displayDateAd + ' ' + text);
    }
    if (hours >= 5 && hours <= 11) {
        text = "बिहानी ";
        $('#timeset').html(displayDateAd + ' ' + text);
    }
    // } else {
    if (hours >= 12 && hours <= 16) {
        text = "अपरान्ह";
        $('#timeset').html(displayDateAd + ' ' + text);
    }
    if (hours >= 17 && hours <= 20) {
        text = "सन्ध्या";
        $('#timeset').html(displayDateAd + ' ' + text);
    }
    if (hours >= 21 && hours <= 23) {
        text = "रात्री";
        $('#timeset').html(displayDateAd + ' ' + text);
    }
    // }


}