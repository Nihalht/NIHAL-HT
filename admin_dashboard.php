<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
        }

        /* Header */
        header {
            background: linear-gradient(to right, #7b4397, #dc2430);
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Navigation Bar */
        .navbar {
            background-color: #7b4397;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            font-weight: 500;
        }

        .navbar a:hover {
            background-color: #dc2430;
        }

        .navbar a.right {
            float: right;
        }

        /* Content Area */
        .content {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .content h2 {
            color: #7b4397;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .content p {
            line-height: 1.6;
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

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .container {
                margin: 30px auto;
                padding: 20px;
            }

            .navbar a {
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">Home</a>
        <a href="users_info.php">Users</a>
        <a href="mechanics_info.php">Mechanics</a>
        <a href="login.php" class="right">Logout</a>
    </div>

    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>

        <div class="content">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>This is the main area where you can manage various aspects of the application.</p>
            <p>You can view user information, monitor mechanic activities, and perform other administrative tasks.</p>
        </div>
    </div>

<footer>
        <p>Designed by <a href="https://example.com">Nihal</a></p>
    </footer>
</body>
</html>