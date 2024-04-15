<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(135deg, #f9d976, #f39f86);
        }

        .w3-bar {
            background-color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .w3-bar a {
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .w3-bar a:hover {
            background-color: #555;
        }

        .container {
            flex: 1;
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-container {
            margin-top: 30px;
        }

        .form-container form:hover {
            transform: scale(0.98);
            transition: all 0.3s ease;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .form-container input[type="text"],
        .form-container select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
            font-size: 1rem;
        }

        .form-container input[type="text"]:focus,
        .form-container select:focus {
            border-color: #f39f86;
            outline: none;
        }

        .form-container button {
            background: linear-gradient(to right, #f9d976, #f39f86);
            color: #333;
            border: none;
            padding: 15px 30px;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .form-container button:hover {
            background: linear-gradient(to left, #f9d976, #f39f86);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .submit-message {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
            border-radius: 10px;
            display: none;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

         /* Footer Styles */
        footer {
            width: 100%;
            background-color: #333; /* Dark background */
            color: #fff; /* Light text */
            padding: 20px 0;
            text-align: center;
            /* Fixed position */
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
    <nav>
    <div class="w3-bar">
        <a href="#" class="w3-bar-item w3-button">Home</a>
        <a href="feedback.php" class="w3-bar-item w3-button">Feedback</a>
        <a href="profile.php" class="w3-bar-item w3-button">Profile</a>
        <a href="about.php" class="w3-bar-item w3-button">About us</a>

        <a href="login.php" class="w3-bar-item w3-button w3-right">Logout</a>
    </div>
</nav>
    <div class="container">
        <header>
            <h1>Customer Request Form</h1>
        </header>
        
        <div class="content">
            <div class="form-container">
                <form id="requestForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>

                    <label for="location">Location:</label>
                    <select id="location" name="location" required>
                        <option value="" disabled selected>Select location</option>
                        <option value="Bangalore">Bangalore</option>
                        <option value="Mangalore">Mangalore</option>
                        <option value="Hassan">Hassan</option>
                    </select>

                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

                    <label for="vehicle_number">Vehicle Number:</label>
                    <input type="text" id="vehicle_number" name="vehicle_number" placeholder="Enter your vehicle number" required>

                    <label for="vehicle_type">Vehicle Issue:</label>
                    <select id="vehicle_type" name="vehicle_type" required>
                        <option value="" disabled selected>Select vehicle issue</option>
                        <option value="Tire puncture">Tire puncture</option>
                        <option value="Engine failure">Engine failure</option>
                        <option value="Battery dead">Battery dead</option>
                        <option value="Towing">Towing</option>
                        <option value="Other">Other</option>
                    </select>

                    <label for="selected_mechanic">Select Mechanic:</label>
                    <select id="selected_mechanic" name="selected_mechanic" required>
                        <option value="" disabled selected>Select mechanic</option>
                        <?php
                        // Database connection
                        $servername = "localhost";
                        $username = "root";
                        $password = ""; // No password
                        $database = "vehicle_breakdown";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $database);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Retrieve mechanics
                        $sql = "SELECT username FROM mechanics";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["username"] . "'>" . $row["username"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No mechanics available</option>";
                        }
                        $conn->close();
                        ?>
                    </select>

                    <button type="submit">Send Request</button>
                    <div class="submit-message" id="submitMessage" style="display:none;">Request has been sent to our Mechanic and Mechanic is on the way.</div>
                </form>
            </div>
        </div>
    </div>

     <footer>
        <p>Designed by <a href="https://example.com">Nihal</a></p>
    </footer>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = ""; // No password
        $database = "vehicle_breakdown";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $name = $_POST["name"];
        $location = $_POST["location"];
        $phone = $_POST["phone"];
        $vehicle_number = $_POST["vehicle_number"];
        $vehicle_type = $_POST["vehicle_type"];
        $mechanic_name = $_POST["selected_mechanic"];

        // Insert data into the request_details table
        $sql = "INSERT INTO request_details (name, location, phone, vehicle_number, vehicle_type, mechanic_name) 
                VALUES ('$name', '$location', '$phone', '$vehicle_number', '$vehicle_type', '$mechanic_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>document.getElementById('submitMessage').style.display = 'block';</script>"; // Show the submit message
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>