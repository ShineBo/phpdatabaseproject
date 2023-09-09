<?php
require 'db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {
    $voterID = $_SESSION["user_id"];
    $representativeID = $_POST["representative"];

    $insertQuery = "INSERT INTO votes (voter_id, representative_id) VALUES ('$voterID', '$representativeID')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Vote submitted successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
} else {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit Vote - Representative Voting</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-info">
    <div class="container mt-5">
        <?php
        session_start();
        if (isset($_SESSION["user_id"])) {
            echo '<p>Thank you for your time</p>';
            echo '<form action="logout.php" method="post">';
            echo '<button type="submit" class="btn btn-danger">Logout</button>';
            echo '</form>';
        } else {
            echo '<p>Please log in to vote.</p>';
            echo '<a href="login.php" class="btn btn-primary">Login</a>';
        }
        ?>
    </div>
</body>
</html>


