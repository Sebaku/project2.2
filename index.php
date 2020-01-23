<html>
<head>
	<title>Weatherweb IT</title>
    <link rel = "stylesheet" type = "text/css" href = "style/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ea578bbff6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include('header.php');?>

<div id="map"></div>
<h1 class="wrapper" style="border-bottom: 5px solid #333;">Dehradun</h1>
<section class="wrapper">
		<div class=" dayContainer">
    		<div class="colDay">
    			<h1>Monday</h1>
    			<p>Januari 13 2020</p>
      			<i class="fas fa-cloud-sun"></i>
      			<p>Temperature: 68 F </p>
      			<p>Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1>Tuesday</h1>
    			<p>Januari 14 2020</p>
    			<i class="fas fa-cloud-sun-rain"></i>
    			<p>Temperature: 68 F </p>
      			<p>Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1>Wensday</h1>
    			<p>Januari 15 2020</p>
    			<i class="fas fa-cloud-rain"></i>
    			<p>Temperature: 68 F </p>
      			<p>Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1>Thursday</h1>
    			<p>Januari 16 2020</p>
    			<i class="fas fa-cloud-showers-heavy"></i>
      			<p>Temperature: 68 F </p>
      			<p>Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1>Friday</h1>
    			<p>Januari 17 2020</p>
    			<i class="fas fa-cloud-showers-heavy"></i>
      			<p>Temperature: 68 F </p>
      			<p>Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1>Saturday</h1>
    			<p>Januari 18 2020</p>
    			<i class="fas fa-cloud-sun"></i>
      			<p>Temperature: 68 F </p>
      			<p>Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1>Sunday</h1>
    			<p>Januari 19 2020</p>
    			<i class="fas fa-cloud-sun"></i>
    			<p>Temperature: 68 F </p>
      			<p>Rain: 5mm/s</p>
    		</div>
  		</div>
</section>
<?php include("footer.php") ?>
    <script>
		// Initialize and add the map
		function initMap() {
			// The location of Uluru
			var dehradun = {lat: 30.317, lng: 78.033};
			var Hissar = {lat: 29.167, lng:75.733}
			var Bikaner = {lat: 28, lng: 73.3}
			var NewDelhiPalam = {lat:28.567, lng:77.117}
			// The map, centered at Uluru
			var map = new google.maps.Map(document.getElementById('map'), {zoom: 4, center: dehradun});
			// The marker, positioned at DEHRADUN
			var markerDehradun = new google.maps.Marker({position: dehradun, map: map});
			var markerHissar = new google.maps.Marker({position: Hissar, map: map});
			var markerBikaner = new google.maps.Marker({position: Bikaner, map: map});
			var markerNewDelhiPalam = new google.maps.Marker({position: NewDelhiPalam, map: map});
		}
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbd_QRIojcJoQt5tSlhSCDM6uQPPZYEaw&callback=initMap"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>