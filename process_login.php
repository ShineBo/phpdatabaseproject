<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];


    $query = "SELECT id FROM voters WHERE email = '$email' AND password = '$password'";
    $adminQuery = "SELECT id FROM admins WHERE email = '$email' AND password = '$password'";


    $result = $conn->query($query);
    $adminResult = $conn->query($adminQuery);

    if ($result->num_rows > 0) {
        // Authentication successful
        session_start();
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["is_admin"] = false;
        header("Location: index.php"); // Redirect to the main page
    } 
    elseif ($adminResult->num_rows > 0) {
        // Authentication successful
        session_start();
        $user = $adminResult->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["is_admin"] = true;
        header("Location: admin_dashboard.php"); // Redirect to the admin main page
    } 
    else {
        // Authentication failed
        echo "Invalid email or password.";
    }
}
?>
