<?php
session_start();
if (!isset($_SESSION["user_id"]) || !$_SESSION["is_admin"]) {
    header("Location: login.php");
    exit();
}

// Admin-only content
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-info">
    <div class="container mt-5">
        <h2>Welcome, Admin!</h2>
        <ul class="list-group mb-5 mt-3">
            <li class="list-group-item"><a href="manage_representatives.php">Manage Candidates</a></li>
            <li class="list-group-item"><a href="manage_voters.php">Manage Voters</a></li>
            <li class="list-group-item"><a href="view_results.php">View Voting Results</a></li>
        </ul>
        <form action="admin_logout.php" method="post">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>
</html>
