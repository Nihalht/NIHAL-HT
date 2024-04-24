<?php
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $name = $_POST['name'];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "vehicle_breakdown";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_check = "SELECT * FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $errorMessage = "Username already exists.";
        $stmt_check->close();
    } else {
        $sql_insert = "INSERT INTO users (username, password, email, phone_number, name) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssss", $username, $password, $email, $phone_number, $name);

        if ($stmt_insert->execute()) {
            $stmt_insert->close();
            $conn->close();
            header("Location: login.php");
            exit();
        } else {
            $errorMessage = "Error: " . $stmt_insert->error;
            $stmt_insert->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Your CSS styles here -->
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0d8a8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Register Container */
        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
            margin: auto;
        }

        .register-container:hover {
            transform: scale(1.05);
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #006341;
            font-weight: 600;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            box-sizing: border-box;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #006341;
            transition: transform 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #006341;
            box-shadow: 0 0 5px rgba(0, 99, 65, 0.3);
        }

        .form-group input:focus + i {
            transform: translateY(-50%) rotate(360deg);
        }

        /* Button */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            background-color: #006341;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #004c32;
            box-shadow: 0 4px 10px rgba(0, 99, 65, 0.3);
            transform: translateY(-3px);
        }

        /* Error Message */
        .error-message {
            color: #ff0000;
            margin-top: 10px;
            font-size: 0.9rem;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-10px) rotate(-5deg); }
            50% { transform: translateX(10px) rotate(5deg); }
            75% { transform: translateX(-10px) rotate(-5deg); }
            100% { transform: translateX(0); }
        }

        /* Register Container Link */
        .register-container p {
            margin-top: 20px;
        }

        .register-container p a {
            color: #006341;
            text-decoration: none;
            transition: color 0.3s;
            position: relative;
        }

        .register-container p a::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #006341;
            transition: width 0.3s;
        }

        .register-container p a:hover::before {
            width: 100%;
        }

        .register-container p a:hover {
            color: #004c32;
        }

        /* Footer Styles */
        footer {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            z-index: 999;
        }

        footer p {
            margin: 0;
        }

        footer a {
            color: #ff512f;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #dd2476;
        }

        /* Responsive Styles */
        @media (max-width: 480px) {
            .register-container {
                padding: 30px;
            }

            footer {
                position: relative;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Register</h2>
    <?php
    if ($errorMessage) {
        echo '<p class="error-message">' . $errorMessage . '</p>';
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!-- Form fields here -->
        <div class="form-group">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <i class="fas fa-user"></i>
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <i class="fas fa-lock"></i>
        </div>
        <div class="form-group">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <i class="fas fa-envelope"></i>
        </div>
        <div class="form-group">
            <input type="tel" id="phone_number" name="phone_number" placeholder="Phone Number" required>
            <i class="fas fa-phone"></i>
        </div>
        <div class="form-group">
            <input type="text" id="name" name="name" placeholder="Name" required>
            <i class="fas fa-user-alt"></i>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login Here</a></p>
</div>

<!-- Footer from login page -->
<footer>
    <p>Designed by <a href="https://github.com/Nihalht/NIHAL-HT">Nihal</a></p>
</footer>

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>

</body>
</html>
