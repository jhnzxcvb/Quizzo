<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your XAMPP MySQL password (if any)
$dbname = "quizzo_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if edit_id and user_type are passed in the URL
if (isset($_GET['edit']) && isset($_GET['user_type'])) {
    $edit_id = $_GET['edit'];
    $user_type = $_GET['user_type'];

    // Fetch user data to edit based on user_type (student or teacher)
    $edit_sql = "SELECT * FROM $user_type WHERE admin_id = ?";
    $stmt = $conn->prepare($edit_sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $edit_result = $stmt->get_result();

    if ($edit_result->num_rows > 0) {
        $edit_user = $edit_result->fetch_assoc();
    } else {
        echo "No user found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #2C3E50;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            background-color: #34495E;
            min-height: 100vh;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1rem;
            color: #BDC3C7;
        }

        .form-container {
            margin-top: 20px;
            background-color: #34495E;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 0 auto;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            background-color: #2C3E50;
            color: white;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #3498DB;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .form-container button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Edit User</h1>
            <p>Edit user details for <?php echo ucfirst($user_type); ?>.</p>
        </div>

        <!-- Edit Form -->
        <div class="form-container">
            <form action="edit_process.php" method="POST">
                <input type="hidden" name="admin_id" value="<?php echo $edit_user['admin_id']; ?>">
                <input type="hidden" name="user_type" value="<?php echo $user_type; ?>"> <!-- Hidden user_type field -->
                <input type="text" name="firstname" value="<?php echo $edit_user['firstname']; ?>" required>
                <input type="text" name="lastname" value="<?php echo $edit_user['lastname']; ?>" required>
                <input type="text" name="username" value="<?php echo $edit_user['username']; ?>" required>
                <input type="password" name="password" placeholder="Enter new password (leave blank to keep old password)">
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
