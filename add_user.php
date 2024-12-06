<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your XAMPP MySQL password (if any)
$dbname = "quizzo_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="addstyle.css">
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Add New User</h1>
            <p>Fill in the details to add a new user</p>
        </div>

        <div class="form-container">
            <form action="add_process.php" method="POST">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="insti_email">Institution Email:</label>
                    <input type="email" id="insti_email" name="insti_email" required>
                </div>
                <button type="submit" class="submit-btn">Add User</button>
            </form>
        </div>

        <div class="back-btn">
            <a href="dashboard.php">Back to Dashboard</a>
        </div>
    </div>

</body>
</html>

<?php
$conn->close();
?>
