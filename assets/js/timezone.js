function pad(number) {
    if (number < 10) {
        return '0' + number;
    }
    return number;
}

function setTimezoneCookie() {
    // Check if the user has given consent for the "timezone" cookie
    // NYI
    if (true) {
        var timezoneOffset = new Date().getTimezoneOffset() / -60;
        var timezoneOffsetString = pad(Math.abs(timezoneOffset)) + ':00';
        if (timezoneOffset >= 0) {
            timezoneOffsetString = '+' + timezoneOffsetString;
        } else {
            timezoneOffsetString = '-' + timezoneOffsetString;
        }
        document.cookie = 'timezone=' + timezoneOffsetString;
    }
}

setTimezoneCookie();
