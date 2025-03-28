<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "";  // Change if needed
$database = "student_course_hub";  // Change if needed

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Programme
if (isset($_POST["add_programme"])) {
    $programme_name = $_POST["programme_name"];
    $programme_leader = $_POST["programme_leader"];

    $sql = "INSERT INTO programmes (programme_name, programme_leader) VALUES ('$programme_name', '$programme_leader')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Programme added successfully!'); window.location.href='manage_programmes_modules.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Add Module
if (isset($_POST["add_module"])) {
    $module_name = $_POST["module_name"];
    $module_code = $_POST["module_code"];
    $lecturer = $_POST["lecturer"];
    $credits = $_POST["credits"];
    $semester = $_POST["semester"];
    $programme_id = $_POST["programme_id"];

    $sql = "INSERT INTO modules (module_name, module_code, lecturer, credits, semester, programme_id)
            VALUES ('$module_name', '$module_code', '$lecturer', $credits, '$semester', $programme_id)";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Module added successfully!'); window.location.href='manage_programmes_modules.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch data
$programmes = $conn->query("SELECT * FROM programmes");
$modules = $conn->query("SELECT modules.*, programmes.programme_name FROM modules 
                         JOIN programmes ON modules.programme_id = programmes.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Programmes & Modules</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        input, select { padding: 8px; margin: 5px; width: 100%; }
        button { padding: 10px; background: blue; color: white; border: none; cursor: pointer; }
        button:hover { background: darkblue; }
    </style>
</head>
<body>

<h2>Programme & Module Management</h2>

<!-- Programme Form -->
<h3>Add New Programme</h3>
<form method="post">
    <label>Programme Name:</label>
    <input type="text" name="programme_name" required>

    <label>Programme Leader:</label>
    <input type="text" name="programme_leader" required>

    <button type="submit" name="add_programme">Add Programme</button>
</form>

<!-- Module Form -->
<h3>Add New Module</h3>
<form method="post">
    <label>Module Name:</label>
    <input type="text" name="module_name" required>

    <label>Module Code:</label>
    <input type="text" name="module_code" required>

    <label>Lecturer:</label>
    <input type="text" name="lecturer">

    <label>Credits:</label>
    <input type="number" name="credits" min="1" max="6" required>

    <label>Semester:</label>
    <select name="semester">
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
        <option value="Summer">Summer</option>
    </select>

    <label>Programme:</label>
    <select name="programme_id">
        <?php while ($prog = $programmes->fetch_assoc()): ?>
            <option value="<?php echo $prog["id"]; ?>"><?php echo $prog["programme_name"]; ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit" name="add_module">Add Module</button>
</form>

<!-- Programme List -->
<h3>Existing Programmes</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Programme Name</th>
        <th>Programme Leader</th>
    </tr>
    <?php
    $programmes->data_seek(0); // Reset pointer to start
    while ($row = $programmes->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["programme_name"]; ?></td>
        <td><?php echo $row["programme_leader"]; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- Module List -->
<h3>Existing Modules</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Module Name</th>
        <th>Module Code</th>
        <th>Lecturer</th>
        <th>Credits</th>
        <th>Semester</th>
        <th>Programme</th>
    </tr>
    <?php while ($row = $modules->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["module_name"]; ?></td>
        <td><?php echo $row["module_code"]; ?></td>
        <td><?php echo $row["lecturer"]; ?></td>
        <td><?php echo $row["credits"]; ?></td>
        <td><?php echo $row["semester"]; ?></td>
        <td><?php echo $row["programme_name"]; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

<?php $conn->close(); ?>
