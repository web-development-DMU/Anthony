<?php
include ("staff_interface.php")
?> 
<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "student_course_hub";

//this will connect with the sql
$conn = new mysqli ($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database Connection Failed!"]));
}

// Get search query from URL
$query = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

$sql = "SELECT id, name FROM staff WHERE name LIKE '%$query%' LIMIT 5";
$result = $conn->query($sql);

$staff = [];
while ($row = $result->fetch_assoc()) {
    $staff[] = $row;
}

echo json_encode($staff);
$conn->close();
?>
