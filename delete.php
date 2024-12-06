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
if (isset($_GET['delete']) && isset($_GET['user_type'])) {
    $admin_id = $_GET['delete'];
    $user_type = $_GET['user_type'];

    // Fetch user data to confirm the deletion
    $edit_sql = "SELECT * FROM $user_type WHERE admin_id = ?";
    $stmt = $conn->prepare($edit_sql);
    $stmt->bind_param("i", $admin_id);
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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User - Admin Dashboard</title>
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
            text-align: center;
        }

        .form-container button {
            width: 150px;
            padding: 15px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .form-container button:hover {
            opacity: 0.8;
        }

        .form-container a {
            display: inline-block;
            padding: 10px;
            background-color: #3498DB;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .form-container a:hover {
            opacity: 0.8;
        }
        
        .cancelbtn{
            width: 128px;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Confirm Deletion</h1>
            <p>Are you sure you want to delete the user: <?php echo ucfirst($edit_user['firstname']) . " " . ucfirst($edit_user['lastname']); ?>?</p>
        </div>

        <!-- Confirm Deletion Form -->
        <div class="form-container">
            <form action="delete_process.php" method="POST">
                <input type="hidden" name="admin_id" value="<?php echo $edit_user['admin_id']; ?>">
                <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
                <button type="submit">Yes, Delete</button>
            </form>
            <a href="dashboard.php" class="cancelbtn">Cancel</a>
        </div>
    </div>
</body>
</html>
