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

// Fetch students
$students_sql = "SELECT * FROM student";
$students_result = $conn->query($students_sql);

// Fetch teachers
$teachers_sql = "SELECT * FROM teacher";
$teachers_result = $conn->query($teachers_sql);

// Edit user function
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $user_type = $_GET['user_type']; // 'student' or 'teacher'

    // Fetch user data to edit
    $edit_sql = "SELECT * FROM $user_type WHERE admin_id = ?";
    $stmt = $conn->prepare($edit_sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $edit_result = $stmt->get_result();
    $edit_user = $edit_result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Quizzo</title>
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
            background-color: #172540;
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

        .table-container {
            margin-top: 30px;
            background-color: #2C3E50;
            padding: 15px;
            border-radius: 10px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #7F8C8D;
        }

        th {
            background-color: #2980B9;
        }

        tr:hover {
            background-color: #34495E;
        }

        .btn {
            background-color: #3498DB;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #F39C12;
        }

        .btn-delete {
            background-color: #E74C3C;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .action-btns button {
            width: 100px;
        }

        .btn-container {
            text-align: right;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <p>Monitor and Edit Student and Teacher Information</p>
        </div>

        <!-- Button to Add a New User (optional) -->
        <div class="btn-container">
            <a href="add_user.php">
                <button class="btn">Add New User</button>
            </a>
        </div>

        <!-- Student Table -->
        <div class="table-container">
            <h2>Students</h2>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($students_result->num_rows > 0) {
                        while ($student = $students_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $student['firstname'] . "</td>";
                            echo "<td>" . $student['lastname'] . "</td>";
                            echo "<td>" . $student['username'] . "</td>";
                            echo "<td>" . $student['password'] . "</td>";
                            echo "<td class='action-btns'>
                                        <a href='edit_user.php?edit=" . $student['admin_id'] . "&user_type=student'>
                                            <button class='btn btn-edit'>Edit</button>
                                        </a>
                                        <a href='delete.php?delete=" . $student['admin_id'] . "&user_type=student'>
                                            <button class='btn btn-delete'>Delete</button>
                                        </a>
                                    </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No students found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Teacher Table -->
        <div class="table-container">
            <h2>Teachers</h2>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($teachers_result->num_rows > 0) {
                        while ($teacher = $teachers_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $teacher['firstname'] . "</td>";
                            echo "<td>" . $teacher['lastname'] . "</td>";
                            echo "<td>" . $teacher['username'] . "</td>";
                            echo "<td>" . $teacher['password'] . "</td>";
                            echo "<td class='action-btns'>
                                        <a href='edit_user.php?edit=" . $teacher['admin_id'] . "&user_type=teacher'>
                                            <button class='btn btn-edit'>Edit</button>
                                        </a>
                                        <a href='delete.php?delete=" . $teacher['admin_id'] . "&user_type=teacher'>
                                            <button class='btn btn-delete'>Delete</button>
                                        </a>
                                    </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No teachers found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
