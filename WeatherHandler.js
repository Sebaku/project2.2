$(document).ready(function(){



    var tempFields = [];
    var resultField = $("#result");
    var sequence = ["stn", "date", "time", "temp", "dewp", "stp", "slp", "visib", "wdsp", "prcp", "sndp", "frshtt", "cldc", "winddir"];
    getLatestValues(10010);

    for(var i = 1;i < 7; i++){
        tempFields.push($("#temp" + i));
    }

    function Record(stn, date, time, temp, prcp ){
        this.stn = stn;
        this.date = date;
        this.time = time;
        this.temp = temp;
        this.prcp = prcp;
    }



    function getLatestValues(stn) {
        var url = 'http://localhost/project22/' + stn + ".txt";
        console.log(url);
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'text',
            success: function (data) {
                console.log("HOEDEDAG");
                var newData = data.split("\n");
                var lastLine = newData[newData.length - 1];
                var seperatedData = lastLine.split(",");
                var record = {};
                for (var i = 0; i < sequence.length; i++) {
                    record[sequence[i]] = seperatedData[i];
                }

                let this_record = new Record(record["stn"],record["date"],record["time"],record["temp"],record["prcp"]);



                tempFields[0].html("Temperature: " + this_record["temp"] + " F");
                var today = new Date();
                let month =  (today.getMonth()+1).toString();
                if(month.length === 1){
                    month = '0' + month;
                }

                // DIT IS DE DATUM VAN DE OPGEHAALDE RECORD. IN DIT GEVAL DE LAATSTE RECORD UIT HET BESTAND
                var formattedDate = [today.getFullYear(), month, today.getDate().toString()].join("-")

            }
        });
    }
});
