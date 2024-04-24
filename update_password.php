<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Validate if new password and confirm new password match
    if ($new_password !== $confirm_new_password) {
        // Redirect back to profile page with error message
        header("Location: profile.php?error=1");
        exit();
    }

    // Check if the current password matches the one in the database
    $username = $_SESSION['username']; // Assuming username is stored in session
    $servername = "localhost";
    $username_db = "root"; // Replace with your MySQL username
    $password_db = ""; // Replace with your MySQL password
    $database = "vehicle_breakdown"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user data from database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Check if the current password matches
        if ($user['password'] === $current_password) {
            // Update password in database
            $sql_update = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
            if ($conn->query($sql_update) === TRUE) {
                // Redirect back to profile page with success message
                header("Location: profile.php?success=1");
                exit();
            } else {
                // Redirect back to profile page with error message
                header("Location: profile.php?error=2");
                exit();
            }
        } else {
            // Redirect back to profile page with error message
            header("Location: profile.php?error=3");
            exit();
        }
    } else {
        // Redirect back to profile page with error message
        header("Location: profile.php?error=4");
        exit();
    }

    $conn->close();
} else {
    header("Location: profile.php");
    exit();
}
?>
