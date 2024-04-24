<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        nav {
            background-color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        nav a {
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 16px;
        }

        nav a:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
        }

        form input[type="text"],
        form select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        form input[type="text"]:focus,
        form select:focus {
            border-color: #f39f86;
            outline: none;
        }

        form button {
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
        }

        form button:hover {
            background: linear-gradient(to left, #f9d976, #f39f86);
        }

        .info-section {
            margin-bottom: 50px;
        }

        .info-section h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .info-section-items {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .info-item {
            flex: 0 0 23%;
            max-width: 23%;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .info-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .info-item h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .info-item p {
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
        }

        .user-reviews {
            margin-bottom: 50px;
        }

        .user-reviews h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .review {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .review p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
            margin-bottom: 10px;
        }

        .review .author {
            font-weight: 600;
            color: #333;
        }

        .review-controls {
            text-align: center;
            margin-top: 20px;
        }

        .review-controls i {
            font-size: 1.5rem;
            color: #333;
            cursor: pointer;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .review-controls i:hover {
            color: #f39f86;
        }

        @media (max-width: 768px) {
            .info-item {
                flex: 0 0 48%;
                max-width: 48%;
            }
        }






.w3-bar {
    background-color: #333;
    color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    position: sticky;
    top: 0;
    z-index: 999;
}

.w3-bar a {
    color: #fff;
    font-weight: 600;
    transition: all 0.3s ease;
    padding: 16px;
    text-decoration: none; /* Ensure links are not underlined */
}

.w3-bar a:hover {
    background-color: #555;
    color: #f39f86; /* Highlight color on hover */
}

/* Adjusting for smaller screens */
@media (max-width: 768px) {
    .w3-bar {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .w3-bar a {
        padding: 12px 16px;
    }
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
    <nav>
        <div class="w3-bar">
            <a href="user_dashboard.php" class="w3-bar-item w3-button">
                <img src="logo.png" alt="Logo" width="30" height="30"> User Dashboard
            </a>
            <a href="feedback.php" class="w3-bar-item w3-button">Feedback</a>
            <a href="profile.php" class="w3-bar-item w3-button">Profile</a>
            <a href="about.php" class="w3-bar-item w3-button">About us</a>
            <a href="login.php" class="w3-bar-item w3-button w3-right">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="section-title">On Road Vehicle Assistance</div>

        <div class="form-container">
            <h2>Experience the Best Car Services with Us</h2>
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
            </form>
        </div>

        <div class="info-section">
            <h2>Why Choose Our Service?</h2>
            <div class="info-section-items">
                <div class="info-item">
                    <img src="step1.jpg" alt="Step 1">
                    <h3>24/7 Availability</h3>
                    <p>Our team is available round the clock to assist you whenever you need us.</p>
                </div>
                <div class="info-item">
                    <img src="step2.jpg" alt="Step 2">
                    <h3>Experienced Mechanics</h3>
                    <p>Our mechanics are highly skilled and trained to handle any vehicle issue.</p>
                </div>
                <div class="info-item">
                    <img src="step3.jpg" alt="Step 3">
                    <h3>Fast Response</h3>
                    <p>We pride ourselves on our fast response time, ensuring you're back on the road quickly.</p>
                </div>
                <div class="info-item">
                    <img src="step4.jpg" alt="Step 4">
                    <h3>Affordable Pricing</h3>
                    <p>Our services are competitively priced, making roadside assistance accessible to all.</p>
                </div>
            </div>
        </div>

        <div class="user-reviews">
            <h2>What Our Customers Say</h2>
            <div class="review">
                <p>"I was stranded on the highway with a flat tire, and your mechanic arrived within 30 minutes. Excellent service and a true lifesaver!"</p>
                <span class="author">- John Doe</span>
            </div>
            <div class="review">
                <p>"Your team went above and beyond to diagnose and fix my engine issue. Highly recommended for anyone in need of reliable roadside assistance."</p>
                <span class="author">- Jane Smith</span>
            </div>
            <div class="review">
                <p>"The mechanic was courteous, knowledgeable, and efficient. Thanks for getting me back on the road so quickly!"</p>
                <span class="author">- Michael Johnson</span>
            </div>
            <div class="review">
                <p>"I've used your services multiple times, and I'm always impressed by the professionalism and quality of work. Keep up the great job!"</p>
                <span class="author">- Emily Davis</span>
            </div>
            <div class="review">
                <p>"Your roadside assistance service is a lifesaver! I highly recommend it to anyone who values peace of mind while driving."</p>
                <span class="author">- David Wilson</span>
            </div>
            <div class="review-controls">
                <i class="fas fa-chevron-left" onclick="showPrevReview()"></i>
                <i class="fas fa-chevron-right" onclick="showNextReview()"></i>
            </div>
        </div>
    </div>

    <footer>
        <p>Designed by <a href="https://github.com/Nihalht/NIHAL-HT">Nihal</a></p>
    </footer>

    <script>
        // User reviews slider
        let currentReview = 0;
        const reviews = document.querySelectorAll('.review');

        function showReview(index) {
            reviews.forEach(review => review.style.display = 'none');
            reviews[index].style.display = 'block';
        }

        function showNextReview() {
            currentReview = (currentReview + 1) % reviews.length;
            showReview(currentReview);
        }

        function showPrevReview() {
            currentReview = (currentReview - 1 + reviews.length) % reviews.length;
            showReview(currentReview);
        }

        showReview(currentReview);
        setInterval(showNextReview, 3000);
    </script>

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
            echo "<script>alert('Request has been sent to our Mechanic and Mechanic is on the way.');</script>"; // Show the submit message
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>

</html>
