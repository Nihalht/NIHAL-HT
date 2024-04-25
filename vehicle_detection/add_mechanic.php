<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Mechanic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        nav {
            text-align: right;
            margin-bottom: 30px;
        }

        nav a {
            margin-left: 15px;
            color: #333;
            text-decoration: none;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #007bff;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .submit-button {
            padding: 12px 30px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 0 auto;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="admin_dashboard.php"><i class="fas fa-home"></i> Home</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
                echo "<p class='success-message'>New mechanic added successfully</p>";
            } else {
                echo "<p class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
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