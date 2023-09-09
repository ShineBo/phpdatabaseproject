<!DOCTYPE html>
<html>
<head>
    <title>Representative Voting</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-info">
    <div class="container mt-5">
        <h2>Vote for Your Representative</h2>
        <?php
        require 'db.php';
        session_start();

        if (isset($_SESSION["user_id"])) {
            $voterID = $_SESSION["user_id"];

            $checkVoteQuery = "SELECT id FROM votes WHERE voter_id = '$voterID'";
            $voteResult = $conn->query($checkVoteQuery);

            if ($voteResult->num_rows > 0) {
                echo '<p>You have already voted. Thank you for your participation!</p>';
            } else {
                echo '<form action="submit_vote.php" method="post">';
                $query = "SELECT id, name FROM representatives";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="form-check">';
                        echo '<input type="radio" class="form-check-input" name="representative" value="' . $row['id'] . '">';
                        echo '<label class="form-check-label">' . $row['name'] . '</label>';
                        echo '</div>';
                    }
                }
                echo '<button type="submit" class="btn btn-primary mt-3">Vote</button>';
                echo '</form>';
            }
            echo '<form action="logout.php" method="post">';
            echo '<button type="submit" class="btn btn-danger mt-3">Logout</button>';
            echo '</form>';
        } else {
            echo '<p>Please log in to vote.</p>';
            echo '<a href="login.php" class="btn btn-primary">Login</a>';
        }
        ?>
    </div>
</body>
</html>

