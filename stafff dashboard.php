<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_course_hub";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Database Connection Failed!");
}

$staff_id = isset($_GET['staff_id']) ? (int) $_GET['staff_id'] : 0;
$sql = "SELECT * FROM staff WHERE id = $staff_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $staff = $result->fetch_assoc();
    echo "<h1>Staff Profile: " . $staff['name'] . "</h1>";
    echo "<p>Department: " . $staff['department'] . "</p>";
    echo "<p>Email: " . $staff['email'] . "</p>";
} else {
    echo "<h1>Staff Not Found</h1>";
}
$conn->close();
?>
