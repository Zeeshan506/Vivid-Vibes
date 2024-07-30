<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';

    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {

        header("location: contact.html");
        echo "<div class='alert alert-success' role='alert'>Message sent successfully!</div>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
