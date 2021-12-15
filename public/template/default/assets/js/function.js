function countDownDiscount(time_discount, id) {
    time_discount = moment(time_discount).format('MM-DD-YYYY HH:mm:ss');
    let timeDc = moment(time_discount).valueOf();
    let currentTime = moment().valueOf();
    if (timeDc > currentTime) {
        let day = null,
            time = null,
            hms = null,
            hour = null,
            minute = null,
            second = null;

        setInterval(() => {

            currentTime = moment().valueOf();
            time = timeDc - currentTime;
            if (time > 1000) {
                hms = moment.duration(time);
                day = hms.days();
                if (day < 10) day = '0' + day;
                hour = hms.hours();
                if (hour < 10) hour = '0' + hour;
                minute = hms.minutes();
                if (minute < 10) minute = '0' + minute;
                second = hms.seconds();
                if (second < 10) second = '0' + second;


                $('#countdown__day__' + id).text(day)
                $('#countdown__hour__' + id).text(hour)
                $('#countdown__minute__' + id).text(minute)
                $('#countdown__seconds__' + id).text(second)
            } else {
                $('.slide_discount_item_' + id).parent().hide(300, function() {
                    this.remove();
                });
                return;
            }
        }, 1000);

    } else {
        // $('#time-discount-' + type + '-' + product.id).empty();
    }

}