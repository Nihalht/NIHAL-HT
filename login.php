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

    // Check in users table
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $isValidUser = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
        header("Location: user_dashboard.php");
        exit();
    }

    // Check in admins table
    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $isValidUser = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        header("Location: admin_dashboard.php");
        exit();
    }

    // Check in mechanics table
    $sql = "SELECT * FROM mechanics WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $isValidUser = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'mechanic';
        header("Location: mechanic_dashboard.php");
        exit();
    }

    if (!$isValidUser) {
        // Redirect to login page with error if credentials are invalid
        $errorMessage = "Invalid username or password.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #271e3a, #4e3d6f, #8c6fc7);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        /* Login Container */
        .login-container {
            width: 350px;
            padding: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            text-align: center;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
            transform: rotate(45deg);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .login-container:hover::before {
            opacity: 1;
        }

        .login-container h2 {
            margin-bottom: 30px;
            color: #fff;
            font-size: 2.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            animation: glowText 4s infinite;
        }

        @keyframes glowText {
            0% {
                text-shadow: 0 0 10px rgba(255, 0, 255, 0.5);
            }
            25% {
                text-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
            }
            50% {
                text-shadow: 0 0 10px rgba(255, 255, 0, 0.5);
            }
            75% {
                text-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
            }
            100% {
                text-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
            }
        }

        /* Form Group */
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group label {
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 1rem;
            color: #aaa;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1.2rem;
            transition: border-color 0.3s ease;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .form-group input:focus {
            outline: none;
            border-color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: -18px;
            left: 10px;
            font-size: 0.8rem;
            color: #fff;
            background-color: transparent;
            padding: 0 5px;
            animation: labelSlide 0.3s ease;
        }

        @keyframes labelSlide {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Button */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: 600;
            text-decoration: none;
            background: linear-gradient(to right, #a67dff, #6f51b3);
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .btn::before {content: "";
           position: absolute;
           top: 50%;
           left: 50%;
           width: 0;
           height: 0;
           background-color: rgba(255, 255, 255, 0.2);
           border-radius: 50%;
           transform: translate(-50%, -50%);
           transition: width 0.5s, height 0.5s;
       }

       .btn:hover::before {
           width: 200%;
           height: 200%;
       }

       .btn:hover {
           background: linear-gradient(to left, #a67dff, #6f51b3);
       }

       /* Error Message */
       .error-message {
           color: #ff5c5c;
           margin-top: 10px;
           font-size: 1.2rem;
           text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
           animation: shake 0.5s ease;
       }

       @keyframes shake {
           0% {
               transform: translateX(0);
           }
           25% {
               transform: translateX(-10px);
           }
           50% {
               transform: translateX(10px);
           }
           75% {
               transform: translateX(-10px);
           }
           100% {
               transform: translateX(0);
           }
       }

       /* Login Container Link */
       .login-container p {
           margin-top: 20px;
           color: #aaa;
           font-size: 1.2rem;
       }

       .login-container p a {
           color: #ff9dff;
           text-decoration: none;
           font-weight: 600;
           transition: color 0.3s ease;
           position: relative;
       }

       .login-container p a::before {
           content: "";
           position: absolute;
           bottom: -2px;
           left: 0;
           width: 0;
           height: 2px;
           background-color: #ff9dff;
           transition: width 0.3s ease;
       }

       .login-container p a:hover {
           color: #fff;
       }

       .login-container p a:hover::before {
           width: 100%;
       }

       /* Background Particles */
       #particles-js {
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           z-index: -1;
       }

       /* Responsive Styles */
       @media (max-width: 480px) {
           .login-container {
               width: 90%;
               padding: 20px;
           }

           .login-container h2 {
               font-size: 2rem;
           }

           .form-group input {
               font-size: 1rem;
           }

           .btn {
               font-size: 1rem;
           }
       }


 /* Footer Styles */
    footer {
        width: 100%;
        background-color: #333; /* Dark background */
        color: #fff; /* Light text */
        padding: 20px 0;
        text-align: center;
        position: absolute;
        bottom: 0;
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

    /* Responsive Styles */
    @media (max-width: 480px) {
        /* ... (Keep other styles unchanged) ... */
        
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
               <input type="text" id="username" name="username" placeholder=" " required>
               <label for="username">Username</label>
           </div>
           <div class="form-group">
               <input type="password" id="password" name="password" placeholder=" " required>
               <label for="password">Password</label>
           </div>
           <button type="submit" class="btn">Login</button>
       </form>
       <p>New User? <a href="register.php">Register Here</a></p>
   </div>

   <!-- Background Particles -->
   <div id="particles-js"></div>
   <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
   <script>
       particlesJS.load('particles-js', 'particles.json', function() {
           console.log('Particles loaded');
       });
   </script>



   <footer>
    <p>Designed by <a href="https://example.com">Nihal</a></p>
</footer>
</body>
</html>