<?php
$host = 'localhost'; // or your host
$dbname = 'student_course_hub'; // database name
$username = 'root'; // your MySQL username
$password = ''; // your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>