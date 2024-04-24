<?php
session_start();

// Check if mechanic is logged in
if (!isset($_SESSION['mechanic_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "your_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tasks assigned to the mechanic
$mechanic_id = $_SESSION['mechanic_id'];
$sql = "SELECT * FROM tasks WHERE mechanic_id = $mechanic_id";
$result = $conn->query($sql);

$tasks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Mechanic Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <p><a href="logout.php">Logout</a></p>
    <h3>Assigned Tasks</h3>
    <?php if (!empty($tasks)) : ?>
    <table>
        <tr>
            <th>Task ID</th>
            <th>Description</th>
        </tr>
        <?php foreach ($tasks as $task) : ?>
        <tr>
            <td><?php echo $task['id']; ?></td>
            <td><?php echo $task['task_description']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p>No tasks assigned.</p>
    <?php endif; ?>
</body>
</html>
