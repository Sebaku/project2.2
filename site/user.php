<!--
 * User: Jeffrey Hamstra
 * Date: 20/01/2020
 *-->
 <?php session_start(); 
 if(!isset($_SESSION['username'])){
   header("location: inlog.php");
}

if(isset($_GET['logout'])){
  session_destroy();
  unset($_SESSION['username']);
  header("location: inlog.php");
}?>
<html>
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
<h1 class="wrapper wrapperDownload"><span id="cityTitle">Change user passwords</span></h1>
<section class="wrapper">
  <div class="row">
        <?php
            $xml = simplexml_load_file("data.xml");
            foreach($xml -> credential as $user):
                foreach ($user as $key => $value):?>
                    <div class="col">
                        <h3> <?= $key ?></h3>
                        <form method="post" name="<?= $key?>">
                            <input type="text" name="password" placeholder="New password">
                            <input type="text" name="password2" placeholder="Repeat password">
                            <button class="btn btn-primary" type="submit" name="change" value="<?= $key?>">Change</button>
                        </form>
                    </div>
                <?php endforeach;
            endforeach;?>
  </div>
</section>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST["password"] == $_POST["password2"] && !empty($_POST["password"])) {
        $password = $_POST["password"];
        $user = $_POST["change"];
        $xml -> credential -> $user -> password = $password;
        echo $xml -> asXML("data.xml");
        echo '<script type="text/javascript">';
        echo ' alert("Password of ' . $_POST["change"] . ' has been changed!")';  // Showing message box
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo ' alert("Password do not match. Please try again.")';  // Showing message box
        echo '</script>';
    }

}?>
<?php include("footer.php") ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
