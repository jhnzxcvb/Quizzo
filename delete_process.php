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

// Check if admin_id and user_type are passed via POST
if (isset($_POST['admin_id']) && isset($_POST['user_type'])) {
    $admin_id = $_POST['admin_id'];
    $user_type = $_POST['user_type'];

    // Begin transaction to ensure both deletions are done together
    $conn->begin_transaction();

    try {
        // Delete from the student or teacher table
        if ($user_type === 'student') {
            $delete_sql = "DELETE FROM student WHERE admin_id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $admin_id);
            $stmt->execute();
        } elseif ($user_type === 'teacher') {
            $delete_sql = "DELETE FROM teacher WHERE admin_id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $admin_id);
            $stmt->execute();
        } else {
            die("Invalid user type");
        }

        // Delete from admin_tbl
        $delete_admin_sql = "DELETE FROM admin_tbl WHERE id = ?";
        $stmt = $conn->prepare($delete_admin_sql);
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect to the admin dashboard after successful deletion
        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        // In case of error, rollback the transaction
        $conn->rollback();
        echo "Error deleting record: " . $e->getMessage();
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request!";
}

// Close the connection
$conn->close();
?>
