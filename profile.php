<?php
session_start();

// Establish database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "vehicle_breakdown"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user's information from the database
$username = $_SESSION['username'];

$sql = "SELECT name, phone_number, email FROM users WHERE username = '$username'";
$result = $conn->query($sql);

// Initialize variables
$name = $phone_number = $email = "";

// If data is found, assign it to variables
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $phone_number = $row["phone_number"];
    $email = $row["email"];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 15px 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .profile-info {
            margin-bottom: 30px;
            padding: 10px 20px;
            background-color: #f1f3f5;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-info label {
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .profile-info p {
            margin: 5px 0;
            font-size: 1.1rem;
            color: #555;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #007bff, #0056b3);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .btn:hover {
            background: linear-gradient(to left, #007bff, #0056b3);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

         /* Footer Styles */
        footer {
            width: 100%;
            background-color: #333; /* Dark background */
            color: #fff; /* Light text */
            padding: 20px 0;
            text-align: center;
           
            bottom: 0; /* Positioned at the bottom */
            z-index: 999; /* Ensuring it stays above other content */
        }

        footer p {
            margin: 0;
        }

        footer a {
            color: #ff512f; /* Vibrant orange */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #dd2476; /* Vibrant pink */
        }
    </style>
</head>
<body>
    <div class="w3-bar w3-black">
        <a href="user_dashboard.php" class="w3-bar-item w3-button"><i class="fas fa-home"></i> Home</a>
        <a href="login.php" class="w3-bar-item w3-button w3-right"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="container">
        <header>
            <h2>User Profile</h2>
        </header>
        <div class="profile-info">
            <label for="name">Name:</label>
            <p><?php echo $name; ?></p>
        </div>
        <div class="profile-info">
            <label for="phone_number">Phone Number:</label>
            <p><?php echo $phone_number; ?></p>
        </div>
        <div class="profile-info">
            <label for="email">Email:</label>
            <p><?php echo $email; ?></p>
        </div>

        <!-- Password change form -->
        <form action="update_password.php" method="post">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" id="confirm_new_password" name="confirm_new_password" required>
            </div>
            <button type="submit" class="btn">Change Password</button>
        </form>
        <div>
        </div>
        <br><br>
    </div>
<br><br>
<br><br><br>
      <footer>
        <p>Designed by <a href="https://example.com">Nihal</a></p>
    </footer>
</body>
</html>