// developed by: Riduan van Noordt Wieringa

function loopToday() {
    var interval = setInterval(function () {
        updateToday();
    }, 10000);
}

function updateToday() {
    var url = 'http://localhost/project22/data/' + currentStationID + ".txt";
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'text',
        success: function (data) {
            let dayContainer = $('.dayContainer');
            let todayBlock = $(dayContainer).children()[0];
            let tempField = $(todayBlock).children()[3];
            let rainField = $(todayBlock).children()[4];
            let splitData = data.split("\n");
            var latestIndex = splitData.length - 1;
            let lastRecord = splitData[latestIndex];
            while(lastRecord.length < 1){
                latestIndex--;
                lastRecord = splitData[latestIndex];
            }
            let dataArray = lastRecord.split(",");
            let temp = dataArray[3];
            let rain = dataArray[9];

            console.log("TEMP:" + temp);
            $(tempField).html("Temperature: " + temp + " F");
            $(rainField).html("Rain: " + (rain * 10) + "mm/s");



        }
    });
}
