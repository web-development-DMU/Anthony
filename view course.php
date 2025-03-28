<?php
session_start();
include('db.php');


if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit();
}

$student_id = $_SESSION['student_id'];


$sql = "SELECT p.ProgrammeName, m.ModuleName, s.Name as Teacher 
        FROM ProgrammeModules pm 
        JOIN Programmes p ON pm.ProgrammeID = p.ProgrammeID 
        JOIN Modules m ON pm.ModuleID = m.ModuleID 
        JOIN Staff s ON m.ModuleLeaderID = s.StaffID";
$stmt = $pdo->query($sql);
$courses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
</head>
<body>
    <h2>Available Courses</h2>
    <table>
        <tr>
            <th>Course Name</th>
            <th>Module Name</th>
            <th>Teacher</th>
            <th>Register</th>
        </tr>
        <?php foreach ($courses as $course): ?>
        <tr>
            <td><?php echo $course['ProgrammeName']; ?></td>
            <td><?php echo $course['ModuleName']; ?></td>
            <td><?php echo $course['Teacher']; ?></td>
            <td><a href="register_course.php?module_id=<?php echo $course['ModuleID']; ?>">Register</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>