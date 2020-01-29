function initDates(){
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let dayContainer = $('.dayContainer');

    for (var i = 0; i < dayContainer.children().length; i++) {
        let date = new Date();
        date.setDate(date.getDate() - i);

        let colDay = dayContainer.children()[i];
        let dayField = $(colDay).children()[0];
        let dateField = $(colDay).children()[1];


        $(dayField).html(days[date.getDay()]);
        $(dateField).html(months[date.getMonth()] + " " + (date.getDate()) + " " + date.getFullYear());
    }
}