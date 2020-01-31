<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: inlog.php");
    }
    if(isset($_GET['logout'])){
            session_destroy();
            unset($_SESSION['username']);
            header("Location: inlog.php");
        }
        if($_SESSION['role'] == 3){
            header("Location: download.php");
        }

?>

<html>
<head>
	<title>Weatherweb IT</title>
    <link rel = "stylesheet" type = "text/css" href = "style/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/WeatherHandler.js" type="text/javascript"></script>
    <script src="scripts/Init.js" type="text/javascript"></script>
    <script src="scripts/update.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/ea578bbff6.js" crossorigin="anonymous"></script>



</head>
<body>
<?php include('header.php');?>

<div id="map"></div>
<h1 class="wrapper" style="border-bottom: 5px solid #333;"><span id="cityTitle" class=" ">India</span></h1>
<section class="wrapper wrapperScroll">
		<div class="dayContainer">
    		<div class="colDay">
    			<h1 >Monday</h1>
    			<p >Januari 13 2020</p>
      			<i class="fas fa-cloud-sun"></i>
      			<p >Temperature: 68 F </p>
      			<p >Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1>Tuesday</h1>
    			<p >Januari 14 2020</p>
    			<i id="icon1" class="fas fa-cloud-sun-rain"></i>
    			<p id="temp1">Temperature: 68 F </p>
      			<p id="rain1">Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1 >Wensday</h1>
    			<p>Januari 15 2020</p>
    			<i  id="icon2" class="fas fa-cloud-rain"></i>
    			<p id="temp2">Temperature: 68 F </p>
      			<p id="rain2">Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1 >Thursday</h1>
    			<p >Januari 16 2020</p>
    			<i  id="icon3" class="fas fa-cloud-showers-heavy"></i>
      			<p id="temp3">Temperature: 68 F </p>
      			<p id="rain3">Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1 >Friday</h1>
    			<p > Januari 17 2020</p>
    			<i id="icon4" class="fas fa-sun"></i>
      			<p id="temp4">Temperature: 68 F </p>
      			<p id="rain4">Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1 >Saturday</h1>
    			<p >Januari 18 2020</p>
    			<i id="icon5" class="fas fa-cloud-sun"></i>
      			<p id="temp5">Temperature: 68 F </p>
      			<p id="rain5">Rain: 5mm/s</p>
    		</div>
    		<div class="colDay">
    			<h1 >Sunday</h1>
    			<p >Januari 19 2020</p>
    			<i id="icon6"  class="fas fa-cloud-sun"></i>
    			<p id="temp6">Temperature: 68 F </p>
      			<p id="rain6">Rain: 5mm/s</p>
    		</div>
  		</div>
</section>
<section class="wrapper top10">
  <div class="row">
    <div class="col">
      <h3>Top 10 Rainfall</h3>
      <ol>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ol>
    </div>
    <div class="col">
      <h3>Top 10 Tempature</h3>
      <ol>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ol>
    </div>
    <div class="col">
      <h3>Top 10 Cloudiness</h3>
      <ol>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ol>
    </div>
  </div>


</section>
<script type="text/javascript">
const slider = document.querySelector('.wrapperScroll');
var currentStationID = 428670;
var currentStationRecords = [];

let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
  isDown = true;
  slider.classList.add('active');
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const walk = (x - startX) * 2; //scroll-fast
  slider.scrollLeft = scrollLeft - walk;
});
$(document).ready(function(){
    initDates();
    setWeatherValues();
    updateToday();
    loopToday();
});
function setCurrentStation(id){
    currentStationID = id;
}

</script>
<?php include("footer.php") ?>
    <script type="text/javascript" src="scripts/map.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbd_QRIojcJoQt5tSlhSCDM6uQPPZYEaw&callback=initMap"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
