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

function updateTopTens(){
    var code_stations = [{id:420710,name:'Amritsar',lat: 31.633,lng: 74.867},{id:421110,name:'Dehradun',lat: 30.317,lng: 78.033},{id:421310,name:'Hissar',lat: 29.167,lng: 75.733},{id:421650,name:'Bikaner',lat: 28,lng: 73.3},{id:421810,name:'New Delhi/Palam',lat: 28.567,lng: 77.117},{id:421820,name:'New Delhi/Safdarjun',lat: 28.583,lng: 77.2},{id:422600,name:'Agra',lat: 27.15,lng: 77.967},{id:423280,name:'Jaisalmer',lat: 26.9,lng: 70.917},{id:423390,name:'Jodhpur',lat: 26.3,lng: 73.017},{id:423480,name:'Jaipur/Sanganer',lat: 26.817,lng: 75.8},{id:423690,name:'Lucknow/Amausi',lat: 26.75,lng: 80.883},{id:423790,name:'Gorakhpur',lat: 26.75,lng: 83.367},{id:424520,name:'Kota Aerodrome',lat: 25.15,lng: 75.85},{id:424750,name:'Allahabad/Bamhrauli',lat: 25.45,lng: 81.733},{id:425590,name:'Guna',lat: 24.65,lng: 77.317},{id:425910,name:'Gaya',lat: 24.75,lng: 84.95},{id:426340,name:'Bhuj-Rudramata',lat: 23.25,lng: 69.667},{id:426470,name:'Ahmadabad',lat: 23.067,lng: 72.633},{id:426670,name:'Bhopal/Bairagarh',lat: 23.283,lng: 77.35},{id:426750,name:'Jabalpur',lat: 23.2,lng: 79.95},{id:427010,name:'M.O. Ranchi',lat: 23.317,lng: 85.317},{id:427370,name:'Rajkot',lat: 22.3,lng: 70.783},{id:427540,name:'Indore',lat: 22.717,lng: 75.8},{id:428090,name:'Calcutta/Dum Dum',lat: 22.65,lng: 88.45},{id:428400,name:'Surat',lat: 21.2,lng: 72.833},{id:428670,name:'Nagpur Sonegaon',lat: 21.1,lng: 79.05},{id:428740,name:'Pbo Raipur',lat: 21.233,lng: 81.65},{id:428950,name:'Balasore',lat: 21.517,lng: 86.933},{id:429090,name:'Veraval',lat: 20.9,lng: 70.367},{id:429210,name:'Nasik',lat: 20,lng: 73.783},{id:429340,name:'Akola',lat: 20.7,lng: 77.067},{id:429710,name:'Bhubaneswar',lat: 20.25,lng: 85.833},{id:430030,name:'Bombay/Santacruz',lat: 19.117,lng: 72.85},{id:430140,name:'Aurangabad Chikalth',lat: 19.85,lng: 75.4},{id:430630,name:'Poona',lat: 18.533,lng: 73.85},{id:431100,name:'Ratnagiri',lat: 16.983,lng: 73.333},{id:431170,name:'Sholapur',lat: 17.667,lng: 75.9},{id:431280,name:'Hyderabad Airport',lat: 17.45,lng: 78.467},{id:431500,name:'Cwc Vishakhapatnam',lat: 17.7,lng: 83.3},{id:431850,name:'Machilipatnam',lat: 16.2,lng: 81.15},{id:431890,name:'Kakinada',lat: 16.95,lng: 82.233},{id:431920,name:'Goa/Panjim',lat: 15.483,lng: 73.817},{id:431980,name:'Belgaum/Sambra',lat: 15.85,lng: 74.617},{id:432010,name:'Gadag',lat: 15.417,lng: 75.633},{id:432130,name:'Kurnool',lat: 15.8,lng: 78.067},{id:432260,name:'Honavar',lat: 14.283,lng: 74.45},{id:432330,name:'Chitradurga',lat: 14.233,lng: 76.433},{id:432370,name:'Pbo Anantapur',lat: 14.583,lng: 77.633},{id:432450,name:'Nellore',lat: 14.45,lng: 79.983},{id:432790,name:'Madras/Minambakkam',lat: 13,lng: 80.183},{id:432840,name:'Mangalore/Bajpe',lat: 12.917,lng: 74.883},{id:432950,name:'Bangalore',lat: 12.967,lng: 77.583},{id:432960,name:'Bangalore/Hindustan',lat: 12.95,lng: 77.633},{id:433140,name:'Kozhikode',lat: 11.25,lng: 75.783},{id:433210,name:'Coimbatore/Peelamed',lat: 11.033,lng: 77.05},{id:433290,name:'Cuddalore',lat: 11.767,lng: 79.767},{id:433330,name:'Port Blair',lat: 11.667,lng: 92.717},{id:433440,name:'Tiruchchirapalli',lat: 10.767,lng: 78.717},{id:433460,name:'Karaikal',lat: 10.917,lng: 79.833},{id:433530,name:'Cochin/Willingdon',lat: 9.95,lng: 76.267},{id:433690,name:'Minicoy',lat: 8.3,lng: 73.15},{id:433710,name:'Thiruvananthapuram',lat: 8.483,lng: 76.95},{id:749238,name:'Ondal India',lat: 23.616,lng: 87.2}];
    let topTemps = {};
    let topRains = {};
    let topClouds= {};
    let date = new Date();
    let month = date.getMonth()+1;
    if(month.toString().length === 1){
        month = '0' + month;
    }
    var dateFormat = [date.getFullYear(), month, date.getDate()].join('-');
    console.log(dateFormat);
    // var url = 'http://localhost/project22/data/' + dateFormat + "/" + currentStationID + ".txt";
    let lineLength = 31;
    let varLengths = {temp: [0, 3], prcp: [19, 21], cldc: [25,28]};
    let calls = [];
    $.each(code_stations, function(i,v){
        let code = v.id;
        var url = 'http://localhost/project22/data/' + dateFormat + "/" + code + ".txt";


         let call = $.ajax({
            type: 'GET',
            url: url,
            dataType: 'text',
            success: function (data) {
                console.log("starting");
                let splitData = split(data, lineLength);
                let lastRecord = splitData[splitData.length - 1];

                let temp = lastRecord.substring(varLengths['temp'][0], varLengths['temp'][1]);
                let rain = lastRecord.substring(varLengths['prcp'][0], varLengths['prcp'][1]);
                let cloud = lastRecord.substring(varLengths['cldc'][0], varLengths['cldc'][1]);

                topTemps[v.name] = temp;
                topRains[v.name] = rain;
                topClouds[v.name] = cloud;
            }

        });
        calls.push(call);
    });

    $.when.apply(null, calls).then(function () {
        console.log("2");
        var tempItems = Object.keys(topTemps).map(function(key) {
            return [key, topTemps[key]];
        });
        var rainItems = Object.keys(topRains).map(function(key) {
            return [key, topRains[key]];
        });
        var cloudItems = Object.keys(topClouds).map(function(key) {
            return [key, topClouds[key]];
        });

        tempItems.sort(function(first, second) {
            return second[1] - first[1];
        });
        rainItems.sort(function(first, second) {
            return second[1] - first[1];
        });
        cloudItems.sort(function(first, second) {
            return second[1] - first[1];
        });
        let topTenTemp = tempItems.slice(0,10);
        let topTenRain = rainItems.slice(0,10);
        let topTenCloud = cloudItems.slice(0,10);

        showTopTen(topTenTemp, "temp");
        showTopTen(topTenRain, "rain");

        showTopTen(topTenCloud, "cloud");
    });

    function showTopTen(topTen, type){
        let topTenArrayNames = $("#top_ten_"+type+"_name").children();
        let topTenArrayValues = $("#top_ten_"+type+"_value").children();
        let index = 0;
        $.each(topTenArrayNames, function() {
            let name_li = topTenArrayNames[index];
            let value_li = topTenArrayValues[index];

            $(name_li).html(topTen[index][0]);
            let extension = (type === "temp") ? "F" : (type === "rain") ? " mm" : "%";
            let value = topTen[index][1]/10;
            value = (type === "temp") ? value-50 : value;
            $(value_li).html(value.toFixed(2)  + extension );
            index++;
        });
    }
}