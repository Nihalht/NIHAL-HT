


<?php
session_start();

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "vehicle_breakdown";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $isValidUser = false;

    // Prepare statement for users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $isValidUser = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
        header("Location: user_dashboard.php");
        exit();
    }

    // Prepare statement for admins table
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $isValidUser = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        header("Location: admin_dashboard.php");
        exit();
    }

    // Prepare statement for mechanics table
    $stmt = $conn->prepare("SELECT * FROM mechanics WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $isValidUser = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'mechanic';
        header("Location: mechanic_dashboard.php");
        exit();
    }

    if (!$isValidUser) {
        $errorMessage = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>




















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
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

        /* Login Container */
        .login-container {
            width: 280px;
            padding: 50px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
            margin: auto;
        }

        .login-container:hover {
            transform: scale(1.05);
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px; /* Reduced padding */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.8rem; /* Reduced font size */
            transition: border-color 0.3s, box-shadow 0.3s;
            box-sizing: border-box; /* Added to include padding in width */
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
            padding: 12px 22px;
            border-radius: 5px;
            font-size: 0.9rem;
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
            font-size: 1rem;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-10px) rotate(-5deg); }
            50% { transform: translateX(10px) rotate(5deg); }
            75% { transform: translateX(-10px) rotate(-5deg); }
            100% { transform: translateX(0); }
        }

        /* Login Container Link */
        .login-container p {
            margin-top: 30px;
        }

        .login-container p a {
            color: #006341;
            text-decoration: none;
            transition: color 0.3s;
            position: relative;
        }

        .login-container p a::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #006341;
            transition: width 0.3s;
        }

        .login-container p a:hover::before {
            width: 100%;
        }

        .login-container p a:hover {
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
            .login-container {
                width: 90%;
                padding: 30px;
            }

            footer {
                position: relative;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php
        if ($errorMessage) {
            echo '<p class="error-message">' . $errorMessage . '</p>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>New User? <a href="register.php">Register Here</a></p>
    </div>

    <!-- Footer -->
    <footer>
        <p>Designed by <a href="https://github.com/Nihalht/NIHAL-HT">Nihal</a></p>
    </footer>

</body>
</html>
