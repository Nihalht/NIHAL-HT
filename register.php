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

    // Check if username already exists
    $sql_check = "SELECT * FROM users WHERE username = '$username'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $errorMessage = "Username already exists.";
    } else {
        // Insert new user into users table
        $sql_insert = "INSERT INTO users (username, password, email, phone_number, name) VALUES ('$username', '$password', '$email', '$phone_number', '$name')";
        
        if ($conn->query($sql_insert) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $errorMessage = "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        /* Register Container */
        .register-container {
            width: 350px;
            padding: 40px;
            border-radius: 10px;
            background: linear-gradient(to right, #141e30, #243b55);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            text-align: center;
            position: relative;
            overflow: hidden;
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

        .register-container::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, #1b2735, #090a0f);
            transform: rotate(45deg);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .register-container:hover::before {
            opacity: 1;
        }

        .register-container h2 {
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
                text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
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
            background: linear-gradient(to right, #ff512f, #dd2476);
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .btn::before {
            content: "";
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
            background: linear-gradient(to left, #ff512f, #dd2476);
        }/* Error Message */
       .error-message {
           color: #ff512f;
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

       /* Register Container Link */
       .register-container p {
           margin-top: 20px;
           color: #aaa;
           font-size: 1.2rem;
       }

       .register-container p a {
           color: #ff512f;
           text-decoration: none;
           font-weight: 600;
           transition: color 0.3s ease;
           position: relative;
       }

       .register-container p a::before {
           content: "";
           position: absolute;
           bottom: -2px;
           left: 0;
           width: 0;
           height: 2px;
           background-color: #ff512f;
           transition: width 0.3s ease;
       }

       .register-container p a:hover {
           color: #fff;
       }

       .register-container p a:hover::before {
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
           .register-container {
               width: 90%;
               padding: 20px;
           }

           .register-container h2 {
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
            position: fixed; /* Fixed position */
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
   <div class="register-container">
       <h2>Register</h2>
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
           <div class="form-group">
               <input type="email" id="email" name="email" placeholder=" " required>
               <label for="email">Email</label>
           </div>
           <div class="form-group">
               <input type="tel" id="phone_number" name="phone_number" placeholder=" " required>
               <label for="phone_number">Phone Number</label>
           </div>
           <div class="form-group">
               <input type="text" id="name" name="name" placeholder=" " required>
               <label for="name">Name</label>
           </div>
           <button type="submit" class="btn">Register</button>
       </form>
       <p>Already have an account? <a href="login.php">Login Here</a></p>
       <br><br>
   </div>

   <br>
   <br>
   <br>

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