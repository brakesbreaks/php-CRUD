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

// Check if the user is already logged in
if (isset($_SESSION["logged_inuser"])) {
    header("location: mainmenu.php");
    exit;
}

if (isset($_POST["login"])) {
    $txtusername = $_POST["username"];
    $txtpassword = $_POST["password"];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $txtusername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = md5($txtpassword);
        if ($hashedPassword === $row['password']) {
            // Login successful
            $_SESSION["logged_inuser"] = $txtusername;

            // Redirect to mainmenu.php
            header("location: mainmenu.php");
            exit;
        }
    }

    echo "<p>Invalid username or password entered. Please try again.</p>";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Login</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <center>
            <h2>Login Form</h2>
            <div class="container">
                <form method="POST" action="login.php">
                    <input type="text" id="username" name="username" placeholder="Username..." required><br>
                    <input type="password" id="password" name="password" placeholder="Password..." required><br>
                    <button type="submit" name="login">Login</button>
                    <p><a href="register.php">Register Here</a></p>
                </form>
            </div>
        </center>
    </body>
</html>
