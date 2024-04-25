<?php
// Database configuration
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

// Fetch data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare SQL statement to insert data into the database
$sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    ?>
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Feedback Submitted</title>
        <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
        <style>
            /* Import a Google Font */
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

            /* Reset some default styles */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            /* General Styles */
            body {
                font-family: 'Poppins', sans-serif;
                background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
                color: #333;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .popup {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
                padding: 30px;
                text-align: center;
                max-width: 500px;
            }

            .popup h2 {
                font-weight: 700;
                margin-bottom: 20px;
                color: #007bff;
            }

            .popup p {
                margin-bottom: 20px;
            }

            /* Buttons */
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .btn:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class='popup'>
            <h2>Feedback Submitted</h2>
            <p>Thank you for your feedback!</p>
            <a href='user_dashboard.php' class='btn' onclick='redirectToUserDashboard()'>OK</a>
        </div>

        <script>
            function redirectToUserDashboard() {
                setTimeout(function() {
                    window.location.href = 'user_dashboard.php';
                }, 2000); // Redirect after 2 seconds (2000 milliseconds)
            }
        </script>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
