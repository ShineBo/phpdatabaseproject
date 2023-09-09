<?php
session_start();
if (!isset($_SESSION["user_id"]) || !$_SESSION["is_admin"]) {
    header("Location: login.php");
    exit();
}

require 'db.php'; 

// Handle adding voter
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_voter"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $insertQuery = "INSERT INTO voters (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Voter added successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

// Handle deleting voter
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_voter"])) {
    $voterID = $_POST["voter_id"];

    $deleteQuery = "DELETE FROM voters WHERE id = '$voterID'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "Voter deleted successfully!";
    } else {
        echo "Error: " . $deleteQuery . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Voters</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-info">
    <div class="container mt-5">
        <h2>Manage Voters</h2>
        
        <!-- Add Voter Form -->
        <form action="manage_voters.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="add_voter" class="btn btn-success">Add Voter</button>
        </form>
        
        <!-- Delete Voter Form -->
        <form action="manage_voters.php" method="post">
            <select name="voter_id">
                <?php
                $voterQuery = "SELECT id, name FROM voters";
                $voterResult = $conn->query($voterQuery);
                while ($voter = $voterResult->fetch_assoc()) {
                    echo '<option value="' . $voter['id'] . '">' . $voter['name'] . '</option>';
                }
                ?>
            </select>
            <button type="submit" name="delete_voter" class="btn btn-danger">Delete Voter</button>
        </form>
        <form action="admin_dashboard.php" method="post">
            <button type="submit" class="btn btn-secondary">Dashboard</button>
        </form>
    </div>
</body>
</html>

