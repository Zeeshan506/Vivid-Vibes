<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';
    $email = $_POST["email"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        echo "<div class='alert alert-danger' role='alert'>This email is already in use. Please try another one.</div>";
    } else {
        if (isset($_POST["save"])) {
            include 'connection.php';
            $Fullname = $_POST["fullname"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];


            $sql =  "INSERT INTO `users` (`fullname`, `username`, `email`, `password`) VALUES ('$Fullname', '$username', '$email', '$password');";
            $result = mysqli_query($conn, $sql);
            header("home.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Signup Form</title>


    <script>
        function validateEmail() {
            var email = document.forms["signup-form"]["email"].value;
            var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!regex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }
            return true;
        }
    </script>

</head>

<body>
    <div class="navbar">
        <a href="login.php">Login</a>
        <a href="contact.html">Contact</a>
        <a href="about.html">About</a>
    </div>
    <div class="container">
        <div class="left">

        </div>
        <form action="index.php" method="post" class="signup-form">
            <h1>Sign up</h1>
            <p>Mobile Number or Email</p>
            <input type="text" name="fullname" placeholder="Full Name" /><br>
            <input type="text" name="username" placeholder="Username" /><br>
            <input type="email" name="email" placeholder="Email" /><br>
            <input type="password" name="password" placeholder="Password" /><br>
            <input type="submit" value="Sign up" name="save" /><br>
            <p>
                If You have a account. You can Login <a href="login.php"><b>HERE</b></a><br>
                <br>By signing up, you agree to our
                <a href="#"><b>Terms,<br> Privacy Policy and Cookies Policy</b></a>.
            </p>
        </form>
</body>

</html>