<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the user is not logged in, redirect to login.php
if (!isset($_SESSION["logged_inuser"])) {
    header("location: login.php");
    exit;
}

// Destroy the session and logout the user
$_SESSION = array();
session_destroy();
unset($_SESSION);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form method="POST">
    <h1>Oopss, Sorry...! You are logged out :\</h1>
    <button  class="return_login" type="submit" name="login">Click here to login again</button>
    </form>
    <?php
        if(isset($_POST['login'])){
            header('location:login.php');
        }
    ?>
</body>
</html>
