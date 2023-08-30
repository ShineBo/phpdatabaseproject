<?php
session_start();
if (!isset($_SESSION["user_id"]) || !$_SESSION["is_admin"]) {
    header("Location: login.php");
    exit();
}

require 'db.php';

$query = "SELECT r.id, r.name, COUNT(v.id) AS vote_count FROM representatives r
          LEFT JOIN votes v ON r.id = v.representative_id
          GROUP BY r.id, r.name";
$result = $conn->query($query);
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
        <table class="table">
            <thead>
                <tr>
                    <th>Representative ID</th>
                    <th>Representative Name</th>
                    <th>Vote Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["vote_count"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No voting results available.</td></tr>";
                }
                ?>
            </tbody>
            <form action="admin_dashboard.php" method="post">
                <button type="submit" class="btn btn-secondary">Dashboard</button>
            </form>
        </table>
    </div>
</body>
</html>

