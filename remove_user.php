<?php
// Database connection
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

// Check if user id is provided in the request
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize user input to prevent SQL injection
    $user_id = $_GET['id'];

    // SQL query to delete user from the database
    $sql = "DELETE FROM users WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // If deletion is successful, redirect back to the user_info.php page with a slight delay
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'users_info.php';
                }, 100);
              </script>";
        exit();
    } else {
        echo "Error deleting users: " . $conn->error;
    }
}

$conn->close();
?>
