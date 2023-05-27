<?php
    $con = mysqli_connect("localhost", "root", "", "market");
    if(isset($_POST['register'])){
        $user_registry = $_POST['user_registry'];
        $pass_registry = md5($_POST['pass_registry']);
        $lastname_registry = $_POST['lastname_registry'];
        $firstname_registry = $_POST['firstname_registry'];

        

        $sql = "insert into user (username, password, lastname, firstname) 
                value('$user_registry','$pass_registry','$lastname_registry','$firstname_registry')";
        $result = mysqli_query($con,$sql);

        if($result){
            echo "<center><p>Registration is successfull</p></center>";
        }else{
            die(mysqli_erro($result));
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <center>
        <h2>Account Registration</h2>
        <form method="POST">
            <input type="text" name="user_registry" placeholder="Enter username..." required><br>
            <input type="text" name="pass_registry" placeholder="Enter password..." required><br>
            <input type="text" name="lastname_registry" placeholder="Enter lastname..." required><br>
            <input type="text" name="firstname_registry" placeholder="Enter firstname..." required><br><br>
            <button class="button-register" type="submit" name="register">Register</button>
        </form>
        <form method="POST">
            <button class="button-login" type="Login" name=login>Login</button>
        </form>
        <?php 
            if(isset($_POST['login'])){
                header('location:login.php');
            }
        ?>
        </center>
    </body>
</html>