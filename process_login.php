<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // You should perform validation and security checks here

    $query = "SELECT id FROM voters WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Authentication successful
        session_start();
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        header("Location: index.php"); // Redirect to the main page
    } else {
        // Authentication failed
        echo "Invalid email or password.";
    }
}
?>
