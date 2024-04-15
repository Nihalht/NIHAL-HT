<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 30px;
            border-radius: 10px 10px 0 0;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, #007bff, #00d9ff);
            clip-path: circle(30% at 0% 50%);
            z-index: -1;
        }

        .content {
            margin-top: 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .team-members {
            text-align: center;
        }

        .team-members img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .team-members img:hover {
            transform: scale(1.1);
        }

        .services, .brands {
            background-color: #f2f2f2;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .services::before, .brands::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, #007bff, #00d9ff);
            clip-path: circle(20% at 100% 50%);
            z-index: -1;
            opacity: 0.2;
        }

        .services h2, .brands h2 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            position: relative;
        }

        .services h2::before, .brands h2::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: #00d9ff;
        }

        .services ul, .brands ul {
            list-style-type: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .services ul li, .brands ul li {
            background-color: #fff;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .services ul li:hover, .brands ul li:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .services ul li i, .brands ul li i {
            font-size: 24px;
            margin-right: 10px;
            color: #007bff;
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
        }    </style>
</head>
<body>
    <div class="w3-bar w3-black">
        <a href="user_dashboard.php" class="w3-bar-item w3-button">Home</a>
        <a href="login.php" class="w3-bar-item w3-button w3-right">Logout</a>
    </div>

    <div class="container">
        <header>
            <h1>About Us</h1>
        </header>

        <div class="content">
            <div class="team-members">
                <h2>Our Team</h2>
                <p>We are a team of dedicated professionals working round the clock to provide the best vehicle services to our customers.</p>
                <div>
                    <img src="img/mechanic1.jpg" alt="Mechanic 1">
                    <img src="img/mechanic2.jpg" alt="Mechanic 2">
                    <img src="img/mechanic3.jpg" alt="Mechanic 3">
                </div>
            </div>

            <div class="services">
                <h2>Our Services</h2>
                <ul>
                    <li><i class="fas fa-wrench"></i>Tire Puncture Repair</li>
                    <li><i class="fas fa-engine-warning"></i>Engine Diagnostics and Repair</li>
                    <li><i class="fas fa-battery-full"></i>Battery Replacement</li>
                    <li><i class="fas fa-truck-pickup"></i>Towing Service</li>
                    <li><i class="fas fa-tools"></i>Regular Maintenance Checks</li>
                    <li><i class="fas fa-ellipsis-h"></i>And much more...</li>
                </ul>
            </div>

            <div class="brands">
                <h2>Supported Car Brands</h2>
                <ul>
                    <li><i class="fab fa-toyota"></i>Toyota</li>
                    <li><i class="fab fa-honda"></i>Honda</li>
                    <li><i class="fab fa-bmw"></i>BMW</li>
                    <li><i class="fab fa-audi"></i>Audi</li>
                    <li><i class="fab fa-mercedes"></i>Mercedes-Benz</li>
                    <li><i class="fas fa-ellipsis-h"></i>And many others...</li>
                </ul>
            </div>
        </div>
    </div>

      <footer>
        <p>Designed by <a href="https://example.com">Nihal</a></p>
    </footer>
</body>
</html>
