<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "vehicle_breakdown";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get mechanic_id from the URL
if (isset($_GET['mechanic_id'])) {
    $mechanic_id = $_GET['mechanic_id'];

    // SQL query to delete mechanic from database
    $sql = "DELETE FROM mechanics WHERE mechanic_id = '$mechanic_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Mechanic removed successfully";
    } else {
        echo "Error removing mechanic: " . $conn->error;
    }
} else {
    echo "Mechanic ID not provided";
}

$conn->close();

// Redirect to mechanics_info.php
header("Location: mechanics_info.php");
exit();
?>
