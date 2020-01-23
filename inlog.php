<?php
/**
 * User: irenanowak
 * Date: 17/01/2020
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load XML file
$xml = simplexml_load_file("data.xml"); // TODO May change .xml filename

// Check if login credentials are correct
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use username as index
    if($xml -> credential -> $username == $password) {
        // Create new session and redirect to new page
        session_start();
        $_SESSION['username'] = $username;
        header("Location: verified.php"); // TODO Change verified.php to index page
        exit();
    } else {
        echo '<script type="text/javascript">';
        echo ' alert("Incorrect login credentials. Please try again.")';  // Showing message box
        echo '</script>';
    }
}
?>
<html>
<head>
    <title></title>
        <link rel = "stylesheet" type = "text/css" href = "style/style.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="background-image: url('img/img_6093.jpg'); background-size: cover;">
<div class="container h-100" style="width: 250px;">
  <div class="row inlog-form">
    <img src="img/cstlogo176.png" class="logo logo-login" >
    <form class="col-12 ">
        <div class="form-group" id="login" action="" method="post">
            <label for="username"><b>Username</b></label>
            <input class="form-control" type="text" placeholder="Enter Username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input class="form-control" type="password" placeholder="Enter Password" name="password" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="login">Login</button>
            <button class="btn btn-secondary" type="submit" name="forgot">Forgot password?</button> <!-- TODO Forgot password doesn't do anything -->
        </div>
    </form>   
  </div>
</div>
</body>
</html>