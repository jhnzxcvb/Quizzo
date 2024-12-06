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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $insti_email = $_POST['insti_email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.location.href='reg.php';</script>";
        exit;
    }

    // Validate first name, last name, email, and username in `admin_tbl`
    $sql = "SELECT * FROM admin_tbl WHERE username = ? AND insti_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $insti_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists in `admin_tbl`
        $admin = $result->fetch_assoc(); // Fetch admin data

        // Check if first name and last name match
        if ($firstname !== $admin['firstname']) {
            echo "<script>alert('First Name does not match our records.'); window.location.href='reg.php';</script>";
            exit;
        } elseif ($lastname !== $admin['lastname']) {
            echo "<script>alert('Last Name does not match our records.'); window.location.href='reg.php';</script>";
            exit;
        }

        // Determine user type based on username format
        if (preg_match("/^03-\d{4}-\d{4}$/", $username)) {
            $table = 'teacher'; // Teacher username format: 03-****-****
        } elseif (preg_match("/^03\d{2}-\d{4}$/", $username)) {
            $table = 'student'; // Student username format: 03**-****
        } else {
            $table = null; // Invalid username format
        }

        // If username doesn't match, provide an error message
        if ($table === null) {
            echo "<script>alert('Invalid username format. Teachers: 03-****-****, Students: 03**-****'); window.location.href='reg.php';</script>";
            exit;
        }

        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into `student` or `teacher` table with hashed password
        $sql = "INSERT INTO $table (admin_id, username, firstname, lastname, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $admin['id'], $admin['username'], $admin['firstname'], $admin['lastname'], $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Account created successfully! Please login.'); window.location.href='login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error: Unable to create account. Please try again later.'); window.location.href='reg.php';</script>";
        }
    } else {
        // If the username and email do not match the records
        echo "<script>alert('Username or Email does not match our records.'); window.location.href='reg.php';</script>";
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
