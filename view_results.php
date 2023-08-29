<?php
session_start();
if (!isset($_SESSION["user_id"]) || !$_SESSION["is_admin"]) {
    header("Location: login.php");
    exit();
}

require 'db.php'; // Include the database connection

// Fetch and display voting results here
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Voting Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>View Voting Results</h2>
        <!-- Display voting results here -->
        <form action="admin_dashboard.php" method="post">
            <button type="submit" class="btn btn-secondary">Dashboard</button>
        </form>
    </div>

</body>
</html>
