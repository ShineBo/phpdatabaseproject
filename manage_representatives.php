<?php
session_start();
if (!isset($_SESSION["user_id"]) || !$_SESSION["is_admin"]) {
    header("Location: login.php");
    exit();
}

require 'db.php';

// Handle adding a representative
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_representative"])) {
    $name = $_POST["name"];

    $insertQuery = "INSERT INTO representatives (name) VALUES ('$name')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Representative added successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

// Handle updating a representative
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_representative"])) {
    $representativeID = $_POST["representative_id"];
    $newName = $_POST["new_name"];

    $updateQuery = "UPDATE representatives SET name = '$newName' WHERE id = '$representativeID'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Representative updated successfully!";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
}

// Handle deleting a representative
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_representative"])) {
    $representativeID = $_POST["representative_id"];

    $deleteQuery = "DELETE FROM representatives WHERE id = '$representativeID'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "Representative deleted successfully!";
    } else {
        echo "Error: " . $deleteQuery . "<br>" . $conn->error;
    }
}

$query = "SELECT id, name FROM representatives";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Representatives</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-info">
    <div class="container mt-5">
        <h2>Manage Representatives</h2>
        
        <!-- Add Representative Form -->
        <form action="manage_representatives.php" method="post">
            <input type="text" name="name" placeholder="Representative Name" required>
            <button type="submit" name="add_representative" class="btn btn-primary">Add Representative</button>
        </form>
        
        <!-- Update Representative Form -->
        <form action="manage_representatives.php" method="post">
            <select name="representative_id">
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                ?>
            </select>
            <input type="text" name="new_name" placeholder="New Name" required>
            <button type="submit" name="update_representative" class="btn btn-success">Update Representative</button>
        </form>
        
        <!-- Delete Representative Form -->
        <form action="manage_representatives.php" method="post">
            <select name="representative_id">
                <?php
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                ?>
            </select>
            <button type="submit" name="delete_representative" class="btn btn-danger">Delete Representative</button>
        </form>
        <form action="admin_dashboard.php" method="post">
            <button type="submit" class="btn btn-secondary">Dashboard</button>
        </form>
    </div>
</body>
</html>
