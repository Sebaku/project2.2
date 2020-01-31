<html>
<!--
 * User: Jeffrey Hamstra
 * Date: 20/01/2020
 *-->
<head>
	<title>Weatherweb IT</title>
    <link rel = "stylesheet" type = "text/css" href = "style/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ea578bbff6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<?php include('header.php');?>

<!-- <div id="map"></div> -->
<h1 class="wrapper wrapperDownload"><span id="cityTitle">Download</span></h1>


<section class="wrapper">
  <div class="row">
    <div class="col">
      <p>Select day from wich you want to download the data:</p>
      <form method="post">
        <input type="date" name="day">
        <input type="submit">
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <ul>
      <?php 
      $day = $_POST['day'];
      $dir = 'data/'.$day;
      $city = array(array(420710,'Amritsar'),array(421110,'Dehradun'),array(421310,'Hissar'),array(421650,'Bikaner'),array(421810,'New Delhi/Palam'),array(421820,'New Delhi/Safdarjun'),array(422600,'Agra'),array(423280,'Jaisalmer'),array(423390,'Jodhpur'),array(423480,'Jaipur/Sanganer'),array(423690,'Lucknow/Amausi'),array(423790,'Gorakhpur'),array(424520,'Kota Aerodrome'),array(424750,'Allahabad/Bamhrauli'),array(425590,'Guna'),array(425910,'Gaya'),array(426340,'Bhuj-Rudramata'),array(426470,'Ahmadabad'),array(426670,'Bhopal/Bairagarh'),array(426750,'Jabalpur'),array(427010,'M.O. Ranchi'),array(427370,'Rajkot'),array(427540,'Indore'),array(428090,'Calcutta/Dum Dum'),array(428400,'Surat'),array(428670,'Nagpur Sonegaon'),array(428740,'Pbo Raipur'),array(428950,'Balasore'),array(429090,'Veraval'),array(429210,'Nasik'),array(429340,'Akola'),array(429710,'Bhubaneswar'),array(430030,'Bombay/Santacruz'),array(430140,'Aurangabad Chikalth'),array(430630,'Poona'),array(431100,'Ratnagiri'),array(431170,'Sholapur'),array(431280,'Hyderabad Airport'),array(431500,'Cwc Vishakhapatnam'),array(431850,'Machilipatnam'),array(431890,'Kakinada'),array(431920,'Goa/Panjim'),array(431980,'Belgaum/Sambra'),array(432010,'Gadag'),array(432130,'Kurnool'),array(432260,'Honavar'),array(432330,'Chitradurga'),array(432370,'Pbo Anantapur'),array(432450,'Nellore'),array(432790,'Madras/Minambakkam'),array(432840,'Mangalore/Bajpe'),array(432950,'Bangalore'),array(432960,'Bangalore/Hindustan'),array(433140,'Kozhikode'),array(433210,'Coimbatore/Peelamed'),array(433290,'Cuddalore'),array(433330,'Port Blair'),array(433440,'Tiruchchirapalli'),array(433460,'Karaikal'),array(433530,'Cochin/Willingdon'),array(433690,'Minicoy'),array(433710,'Thiruvananthapuram'),array(749238,'Ondal India')); 


      if(empty($day) == False) {
      $fileArray = scandir($dir); //print_r($fileArray);
      $i = -2;
      foreach($fileArray as $filename): ?>
        <?php if($filename == '.' or $filename == '..'){} else { ?>
        <?php if($i == 20) {?> 
      </ul>
    </div>
    <div class="col">
      <ul>
      <?php $i = 0; }; ?>
          <li><a href="/site/data/<?= $day ?>/<?= $filename ?>" download><?php foreach ($city as $key) {
          if($key[0] == trim($filename,".txt")){ echo $key[1];}} ?></a></li>
        <?php };
        $i++; 
      endforeach; }?>
      </ul>
    </div>
  </div>
</section>
<?php include("footer.php") ?>
    <script type="text/javascript" src="map.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbd_QRIojcJoQt5tSlhSCDM6uQPPZYEaw&callback=initMap"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>