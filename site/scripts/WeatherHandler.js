function setWeatherValues() {
    let averageTemps = [];
    let averageRains = [];
    let calls = [];
    for (let i = 1; i < 7; i++) {
        let dayTemps = [];
        let dayRain = [];
        let date = new Date();
        date.setDate(date.getDate() - i);
        let month = date.getMonth() + 1;
        if (month.toString().length === 1) {
            month = '0' + month;
        }
        let dateFormat = [date.getFullYear(), month, date.getDate()].join('-');
        var url = 'http://localhost/project22/data/' + dateFormat + "/" + currentStationID + ".txt";
        let lineLength = 31;
        let varLengths = {temp: [0, 3], prcp: [19, 21]};

        let call = $.ajax({
            type: 'GET',
            url: url,
            dataType: 'text',
            success: function (data) {
                var splitData = split(data, lineLength);
                $.each(splitData, function (i, v) {
                    let temp = v.substring(varLengths['temp'][0], varLengths['temp'][1]);
                    dayTemps.push(temp / 10);
                    let rain = v.substring(varLengths['prcp'][0], varLengths['prcp'][1]);
                    dayRain.push(rain / 10);
                });
                aTemp = getAverage(dayTemps, 1);
                aRain = getAverage(dayRain, 1);
                averageRains.push(aRain);
                averageTemps.push(aTemp);

            }
        });
        calls.push(call);

    }


    $.when.apply(null, calls).then(function () {
        for (var i = 0; i < 6; i++) {
            let average_temp = averageTemps[i];
            let average_rain = averageRains[i];

            let icon = $("#icon" + (i + 1));

            if (average_rain < 0.6) {
                $(icon).removeClass();
                $(icon).attr('class', 'fas fa-sun');
            } else if (average_rain < 1.2) {
                $(icon).removeClass();
                $(icon).attr('class', 'fas fa-cloud-sun');
            } else if (average_rain < 1.8) {
                $(icon).removeClass();
                $(icon).attr('class', 'fas fa-cloud-rain');
            } else {
                $(icon).removeClass();
                $(icon).attr('class', 'fas fa-cloud-showers-heavy');
            }

            $("#temp" + (i + 1)).html("Temperature: " + (average_temp) + " F");
            $("#rain" + (i + 1)).html("Rain: " + (average_rain) + "mm/s");
        }
    });
}


function getAverage(values, dec) {
    let counter = 0;
    let total = 0;

    $.each(values, function (index, value) {

        var intValue = parseFloat(value);
        total += intValue;
        counter++;
    });


    let average = total / counter;
    return average.toFixed(dec);
}

function split(input, len) {
    return input.match(new RegExp('.{1,' + len + '}(?=(.{' + len + '})+(?!.))|.{1,' + len + '}$', 'g'))
}


