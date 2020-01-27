$(document).ready(function () {
    const days = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var daysFieldsArray = [];
    var datesFieldsArray = [];

    for(var i = 1 ; i < 8; i++){
        daysFieldsArray.push($("#day" + i));
        datesFieldsArray.push($("#date" + i));
    }

    for (var i = 0; i < daysFieldsArray.length; i++) {
        let dayField = daysFieldsArray[i];
        let dateField = datesFieldsArray[i];

        let date = new Date();
        date.setDate(date.getDate()-i);
        dayField.html(days[date.getDay()]);

        dateField.html(months[date.getMonth()] + " " + (date.getDate()) + " " + date.getFullYear());
    }
});