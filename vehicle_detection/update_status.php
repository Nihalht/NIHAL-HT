<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "vehicle_breakdown";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve'])) {
    $request_id = $_POST['request_id'];
    $sql_update = "UPDATE request_details SET status = 'Approved' WHERE id = $request_id AND status = 'Pending'";

    if ($conn->query($sql_update) === TRUE) {
        header("Location: mechanic_dashboard.php"); // Redirect back to the dashboard
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
