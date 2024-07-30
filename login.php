<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';
    $email = $_POST["email"];
    $password = $_POST["password"];



    $sql = "Select * from users where email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $login = true;
        $user_data = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user_data['Userid'];
        header("location: home.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>Invalid Credentials. Please try Again.</div>";
        // header("location: login.php");
    }
}



?>

<!DOCTYPE html>
<html lang="en">





<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Login</title>

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
        <a href="index.php">Signup</a>
        <a href="contact.html">Contact</a>
        <a href="about.html">About</a>
    </div>
    <div class="container">
        <div class="left">

        </div>
        <form action="login.php" class="login-form" name="login-form" onsubmit="return validateEmail()" method="post">
            <h1>Login</h1>

            <p>Email</p>
            <input type="email" name="email" placeholder="Email" /><br>
            <input type="password" name="password" placeholder="Password" /><br>
            <input type="submit" value="Login" /><br>
            <p>
                If You dont have an account. You can Sign up <a href="index.php"><b>HERE</b></a><br>

            </p>
        </form>
</body>

</html>