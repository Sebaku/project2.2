function loopToday() {
    var interval = setInterval(function () {
        updateToday();
    }, 10000);
}

function updateToday() {
    let date = new Date();
    let month = date.getMonth()+1;
    if(month.toString().length === 1){
        month = '0' + month;
    }
    var dateFormat = [date.getFullYear(), month, date.getDate()].join('-');
    var url = 'http://localhost/project22/data/' + dateFormat + "/" + currentStationID + ".txt";
    let lineLength = 31;
    let varLengths = {temp: [0, 3], prcp: [19, 21]};

    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'text',
        success: function (data) {
            let splitData = split(data, lineLength);
            let lastRecord = splitData[splitData.length - 1];

            let temp = lastRecord.substring(varLengths['temp'][0], varLengths['temp'][1]);
            let rain = lastRecord.substring(varLengths['prcp'][0], varLengths['prcp'][1]);

            let dayContainer = $('.dayContainer');
            let todayBlock = $(dayContainer).children()[0];
            let tempField = $(todayBlock).children()[3];
            let rainField = $(todayBlock).children()[4];

            $(tempField).html("Temperature: " + (temp / 10) + " F");
            $(rainField).html("Rain: " + (rain / 10) + "mm");
        }
    });

}