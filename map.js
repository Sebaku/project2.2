// Initialize and add the map
function initMap() {

	var map = new google.maps.Map(document.getElementById('map'), {zoom: 6, center: {lat: 21.1,lng: 79.05}});
  var city = [{name:'Amritsar',lat: 31.633,lng: 74.867},{name:'Dehradun',lat: 30.317,lng: 78.033},{name:'Hissar',lat: 29.167,lng: 75.733},{name:'Bikaner',lat: 28,lng: 73.3},{name:'New Delhi/Palam',lat: 28.567,lng: 77.117},{name:'New Delhi/Safdarjun',lat: 28.583,lng: 77.2},{name:'Agra',lat: 27.15,lng: 77.967},{name:'Jaisalmer',lat: 26.9,lng: 70.917},{name:'Jodhpur',lat: 26.3,lng: 73.017},{name:'Jaipur/Sanganer',lat: 26.817,lng: 75.8},{name:'Lucknow/Amausi',lat: 26.75,lng: 80.883},{name:'Gorakhpur',lat: 26.75,lng: 83.367},{name:'Kota Aerodrome',lat: 25.15,lng: 75.85},{name:'Allahabad/Bamhrauli',lat: 25.45,lng: 81.733},{name:'Guna',lat: 24.65,lng: 77.317},{name:'Gaya',lat: 24.75,lng: 84.95},{name:'Bhuj-Rudramata',lat: 23.25,lng: 69.667},{name:'Ahmadabad',lat: 23.067,lng: 72.633},{name:'Bhopal/Bairagarh',lat: 23.283,lng: 77.35},{name:'Jabalpur',lat: 23.2,lng: 79.95},{name:'M.O. Ranchi',lat: 23.317,lng: 85.317},{name:'Rajkot',lat: 22.3,lng: 70.783},{name:'Indore',lat: 22.717,lng: 75.8},{name:'Calcutta/Dum Dum',lat: 22.65,lng: 88.45},{name:'Surat',lat: 21.2,lng: 72.833},{name:'Nagpur Sonegaon',lat: 21.1,lng: 79.05},{name:'Pbo Raipur',lat: 21.233,lng: 81.65},{name:'Balasore',lat: 21.517,lng: 86.933},{name:'Veraval',lat: 20.9,lng: 70.367},{name:'Nasik',lat: 20,lng: 73.783},{name:'Akola',lat: 20.7,lng: 77.067},{name:'Bhubaneswar',lat: 20.25,lng: 85.833},{name:'Bombay/Santacruz',lat: 19.117,lng: 72.85},{name:'Aurangabad Chikalth',lat: 19.85,lng: 75.4},{name:'Poona',lat: 18.533,lng: 73.85},{name:'Ratnagiri',lat: 16.983,lng: 73.333},{name:'Sholapur',lat: 17.667,lng: 75.9},{name:'Hyderabad Airport',lat: 17.45,lng: 78.467},{name:'Cwc Vishakhapatnam',lat: 17.7,lng: 83.3},{name:'Machilipatnam',lat: 16.2,lng: 81.15},{name:'Kakinada',lat: 16.95,lng: 82.233},{name:'Goa/Panjim',lat: 15.483,lng: 73.817},{name:'Belgaum/Sambra',lat: 15.85,lng: 74.617},{name:'Gadag',lat: 15.417,lng: 75.633},{name:'Kurnool',lat: 15.8,lng: 78.067},{name:'Honavar',lat: 14.283,lng: 74.45},{name:'Chitradurga',lat: 14.233,lng: 76.433},{name:'Pbo Anantapur',lat: 14.583,lng: 77.633},{name:'Nellore',lat: 14.45,lng: 79.983},{name:'Madras/Minambakkam',lat: 13,lng: 80.183},{name:'Mangalore/Bajpe',lat: 12.917,lng: 74.883},{name:'Bangalore',lat: 12.967,lng: 77.583},{name:'Bangalore/Hindustan',lat: 12.95,lng: 77.633},{name:'Kozhikode',lat: 11.25,lng: 75.783},{name:'Coimbatore/Peelamed',lat: 11.033,lng: 77.05},{name:'Cuddalore',lat: 11.767,lng: 79.767},{name:'Port Blair',lat: 11.667,lng: 92.717},{name:'Tiruchchirapalli',lat: 10.767,lng: 78.717},{name:'Karaikal',lat: 10.917,lng: 79.833},{name:'Cochin/Willingdon',lat: 9.95,lng: 76.267},{name:'Minicoy',lat: 8.3,lng: 73.15},{name:'Thiruvananthapuram',lat: 8.483,lng: 76.95},{name:'Ondal India',lat: 23.616,lng: 87.2}]


  var marker, i;

  for (i = 0; i < city.length; i++) {
    var myLatLng = {lat: city[i].lat, lng: city[i].lng};
    var marker = new google.maps.Marker({
      position: myLatLng,
      name: city[i].name,
      map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        map.setZoom(6);
        map.setCenter(marker.getPosition());
        $('#cityTitle').text(marker.name);
      }
    })(marker,i));
  }
}
