<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "vehicle_breakdown";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_approved = "SELECT * FROM request_details WHERE status = 'Approved'";
$result_approved = $conn->query($sql_approved);

if (!$result_approved) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Lists</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

        header {
            background-color: #4c8bf5;
            color: #fff;
            text-align: center;
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 10px 10px 0 0;
        }

        header h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 32px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background-color: #4c8bf5;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f4f4f4;
        }

        /* Navigation Styles */
        nav {
            background-color: #4c8bf5;
            padding: 10px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a {
            margin: 0 15px;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #dc2430;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .container {
                margin: 30px auto;
                padding: 20px;
            }

            table th, table td {
                padding: 12px 15px;
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
    <!-- Navbar -->
    <nav>
        <a href="mechanic_dashboard.php">Home</a>
        <a href="login.php">Logout</a>
    </nav>

    <div class="container">
        <header>
            <h1>Approved Lists</h1>
        </header>

        <h3>Approved Requests</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Phone</th>
                    <th>Vehicle Number</th>
                    <th>Vehicle Type</th>
                    <th>Mechanic Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_approved->num_rows > 0) {
                    while ($row = $result_approved->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>" . $row["vehicle_number"] . "</td>";
                        echo "<td>" . $row["vehicle_type"] . "</td>";
                        echo "<td>" . $row["mechanic_name"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No approved requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>








<footer>
        <p>Designed by <a href="https://github.com/Nihalht/NIHAL-HT">Nihal</a></p>
    </footer>











    
</body>
</html>