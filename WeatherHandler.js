// Written by: Riduan van Noordt Wieringa

$(document).ready(function () {
    var tempFields = [];
    var rainFields = [];
    
    getLatestValues();

    for (var i = 1; i < 7; i++) {
        tempFields.push($("#temp" + i));
        rainFields.push($("#rain" + i));
    }


    function getLatestValues() {
        var url = 'http://localhost/project22/data/' + currentStationID + ".txt";
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'text',
            success: function (data) {
                let dayContainer = $('.dayContainer');
                let splitData = data.split("\n");
                let fields = [];
                for (var i = 0; i < dayContainer.children().length; i++) {

                    let colDay = dayContainer.children()[i];
                    let tempField = $(colDay).children()[3];
                    let rainField = $(colDay).children()[4];

                    fields.push([tempField, rainField]);
                }


                for (var x = 0; x < fields.length; x++) {
                    let date = new Date();
                    date.setDate(date.getDate() - x);

                    let month = (date.getMonth() + 1).toString();
                    if (month.length === 1) {
                        month = '0' + month;
                    }
                    var formattedDate = [date.getFullYear(), month, date.getDate().toString()].join("-")
                    var line = "";
                    var allTemps = [];
                    var allRains = [];
                    $.each(splitData, function (index, value) {
                        let dataArray = value.split(",");
                        let recordDate = dataArray[1];

                        if (formattedDate === recordDate) {
                            let recordTemp = dataArray[3];
                            let recordRain = dataArray[9];
                            line = value;
                            allTemps.push(recordTemp);
                            allRains.push(recordRain);
                        }
                    });


                    let averageTemp = getAverage(allTemps, 1);
                    let averageRain = getAverage(allRains, 2);
                    let fieldArray = fields[x];
                    let tempField = fieldArray[0];
                    let rainField = fieldArray[1];

                     if(!isNaN(averageTemp) ){
                        $(tempField).html("Temperature: " + averageTemp + " F");
                    }
                    if(!isNaN(averageRain) ){
                        $(rainField).html("Rain: " + (averageRain * 10) + "mm/s");
                    }

                }
            }
        });
    }
});


function getAverage(values, dec) {
    var counter = 0;
    var total = 0;
    $.each(values, function (index, value) {

        var intValue = parseFloat(value);
        total += intValue;
        counter++;
    });
    let average = total / counter;
    return average.toFixed(dec);
}


