<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your XAMPP MySQL password (if any)
$dbname = "quizzo_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $insti_email = $_POST['insti_email'];
    $username = $_POST['username'];

    // Check if username already exists in the admin_tbl
    $sql = "SELECT * FROM admin_tbl WHERE username = ?"; // Using the common admin_tbl
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists!'); window.location.href='add_user.php';</script>";
        exit;
    }

    // Insert new user into the admin_tbl (all user types)
    $sql = "INSERT INTO admin_tbl (firstname, lastname, insti_email, username) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $firstname, $lastname, $insti_email, $username);

    if ($stmt->execute()) {
        echo "<script>alert('User added successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error adding user. Please try again.'); window.location.href='add_user.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
