<?php

include('connect.php'); // Include the database connection

// Fetch all programmes and their associated modules
$sql = "SELECT pi.StudentName, pi.Email, pr.ProgrammeName, m.ModuleName, s.Name AS ModuleLeader
        FROM InterestedStudents pi
        JOIN Programmes pr ON pi.ProgrammeID = pr.ProgrammeID
        JOIN ProgrammeModules pm ON pr.ProgrammeID = pm.ProgrammeID
        JOIN Modules m ON pm.ModuleID = m.ModuleID
        LEFT JOIN Staff s ON m.ModuleLeaderID = s.StaffID
        ORDER BY pi.StudentName";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <p><a href="logout.php">Logout</a></p>

    <h2>Your Modules</h2>
    <ul>
        <?php foreach ($modules as $module): ?>
            <li>
                <strong><?php echo htmlspecialchars($module['ModuleName']); ?></strong>
                <ul>
                    <li>Programmes:
                        <ul>
                            <?php
                            if ($module['ProgrammeID']) {
                                echo "<li>" . htmlspecialchars($module['ProgrammeName']) . "</li>";
                            } else {
                                echo "<li>No programmes linked</li>";
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Add a Module to a Programme</h2>
    <form action="add_module_to_program.php" method="POST">
        <label for="module_id">Module:</label>
        <select name="module_id" id="module_id" required>
            <?php foreach ($modules as $module): ?>
                <option value="<?php echo $module['ModuleID']; ?>"><?php echo htmlspecialchars($module['ModuleName']); ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="programme_id">Programmes:</label>
        <select name="programme_id" id="programme_id" required>
            <?php foreach ($programmes as $programme): ?>
                <option value="<?php echo $programme['ProgrammeID']; ?>"><?php echo htmlspecialchars($programme['ProgrammeName']); ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Add Module to Programme</button>
    </form>

</body>
</html>


-- Create the database
CREATE DATABASE student_course_hub;

-- Use the database
USE student_course_hub;

-- Create the 'users' table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'staff') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the 'courses' table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the 'enrollments' table (Many-to-Many relationship between users & courses)
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    course_id INT,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Insert some sample data
INSERT INTO users (name, email, password, role) 
VALUES 
('John Doe', 'john@example.com', MD5('password123'), 'student'),
('Jane Smith', 'jane@example.com', MD5('admin123'), 'staff');

INSERT INTO courses (course_name, description) 
VALUES 
('Web Development', 'Learn HTML, CSS, and JavaScript'),
('Database Management', 'Learn SQL and database administration');



