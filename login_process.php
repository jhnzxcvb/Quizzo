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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // First, check the student table
    $sql = "SELECT * FROM student WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        // If not found in student table, check the teacher table
        $sql = "SELECT * FROM teacher WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            // If username is not found in both tables
            echo "<script>alert('Username not found!'); window.location.href='login.php';</script>";
            exit;
        }
    }

    // Verify the password with the hashed password
    if (password_verify($password, $user['password'])) {
        // Start session
        session_start();
        $_SESSION['user_id'] = $user['admin_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];

        // Display the "Successfully Logged in" message with a redirect after a short delay
        echo "<script>
                alert('Successfully Logged in');
                setTimeout(function() {
                    var username = '$username'; // PHP value passed to JS
                    if (username.match(/^03-\\d{4}-\\d{4}$/)) {
                        window.location.href = 'teacher_home.php';
                    } else if (username.match(/^03\\d{2}-\\d{4}$/)) {
                        window.location.href = 'student_home.php';
                    }
                },10);
              </script>";
        exit;
    } else {
        // Incorrect password
        echo "<script>alert('Incorrect password!'); window.location.href='login.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
