<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Mechanic</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        nav {
            text-align: right;
            margin-bottom: 20px;
        }

        nav a {
            margin-left: 15px;
            color: #007bff;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .submit-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="admin_dashboard.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
        
        <h2>Add New Mechanic</h2>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Get form data
            $mechanic_id = $_POST['mechanic_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            // SQL query to insert new mechanic
            $sql = "INSERT INTO mechanics (mechanic_id, username, password, email) VALUES ('$mechanic_id', '$username', '$password', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "New mechanic added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="mechanic_id">Mechanic ID:</label>
                <input type="text" id="mechanic_id" name="mechanic_id" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="submit-button">Add Mechanic</button>
        </form>
    </div>
</body>
</html>
