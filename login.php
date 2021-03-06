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

<html lang="en">
<head>
    <title>Weather Application</title>
</head>

<body>

<!-- Login form -->
<form id="login" action="" method="post">
    <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
    </div>
    <div class="container">
        <button type="submit" name="login">Login</button>
        <button type="submit" name="forgot">Forgot password?</button> <!-- TODO Forgot password doesn't do anything -->
    </div>
</form>

</body>
</html>

