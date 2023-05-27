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

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Main Menu</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
            if(isset($_POST['create'])){
                header('location:create.php');
            }
            if(isset($_POST['search'])){
                header('location:search.php');
            }
            if(isset($_POST['list_all'])){
                header('location:list_all.php');
            }
        ?>
        <center>
            <h1>Welcome <?php echo $_SESSION["logged_inuser"]; ?></h1>
            <h2>MAIN MENU</h2>
            <form method="POST">
                <button type="submit" name="create">Add Item</button><br>
                <button type="submit" name="search">Search Item</button><br>
                <button type="submit" name="list_all">View Item</button>
                <p><a href="logout.php">Logout</a></p>
            </form>
        </center>
    </body>
</html>
