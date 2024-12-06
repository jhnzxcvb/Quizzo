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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $admin_id = $_POST['admin_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Hash the password if it's provided
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    } else {
        $hashed_password = null; // If no new password, do not update it
    }

    // Begin transaction to ensure both updates are done together
    $conn->begin_transaction();

    try {
        // Update the admin_tbl without the password (since it doesn't have a password column)
        $update_admin_sql = "UPDATE admin_tbl SET firstname = ?, lastname = ?, username = ? WHERE id = ?";
        $stmt = $conn->prepare($update_admin_sql);
        $stmt->bind_param("sssi", $firstname, $lastname, $username, $admin_id);
        $stmt->execute();

        // Then, update the student or teacher table based on the user type
        if ($user_type === 'student') {
            if ($hashed_password) {
                $update_sql = "UPDATE student SET firstname = ?, lastname = ?, username = ?, password = ? WHERE admin_id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("ssssi", $firstname, $lastname, $username, $hashed_password, $admin_id);
            } else {
                $update_sql = "UPDATE student SET firstname = ?, lastname = ?, username = ? WHERE admin_id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("sssi", $firstname, $lastname, $username, $admin_id);
            }
        } elseif ($user_type === 'teacher') {
            if ($hashed_password) {
                $update_sql = "UPDATE teacher SET firstname = ?, lastname = ?, username = ?, password = ? WHERE admin_id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("ssssi", $firstname, $lastname, $username, $hashed_password, $admin_id);
            } else {
                $update_sql = "UPDATE teacher SET firstname = ?, lastname = ?, username = ? WHERE admin_id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("sssi", $firstname, $lastname, $username, $admin_id);
            }
        } else {
            die("Invalid user type");
        }

        // Execute the query to update the student or teacher table
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect to the admin dashboard after successful update
        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        // In case of error, rollback the transaction
        $conn->rollback();
        echo "Error updating record: " . $e->getMessage();
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
