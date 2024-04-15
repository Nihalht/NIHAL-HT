<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Dashboard</title>
    <style>
        /* Custom Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@600;800&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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

        nav {
            text-align: right;
            margin-bottom: 30px;
        }

        nav a {
            margin-left: 20px;
            color: #4c8bf5;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #2a5fb0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
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

        .status-button {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 700;
        }

        .status-pending {
            background-color: #ffc107;
            color: #fff;
        }

        .status-pending:hover {
            background-color: #d39e00;
        }

        .status-approved {
            background-color: #28a745;
            color: #fff;
        }

        .status-approved:hover {
            background-color: #1e7e34;
        }

        .status-rejected {
            background-color: #dc3545;
            color: #fff;
        }

        .status-rejected:hover {
            background-color: #b02a37;
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

$sql_requests = "SELECT * FROM request_details";
$result_requests = $conn->query($sql_requests);

if (!$result_requests) {
    die("Query failed: " . $conn->error);
}
?>

<div class="container">
    <header>
        <h1>Mechanic Dashboard</h1>
    </header>

    <nav>
        <a href="approved_lists.php">Approved Lists</a>
        <a href="login.php">Logout</a>
    </nav>

    <h3>All Requests</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Vehicle Number</th>
                <th>Vehicle Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_requests->num_rows > 0) {
                while ($row = $result_requests->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["location"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["vehicle_number"] . "</td>";
                    echo "<td>" . $row["vehicle_type"] . "</td>";

                    // Displaying status as buttons
                    echo "<td>";
                    echo "<form method='post' action='update_status.php'>";
                    echo "<input type='hidden' name='request_id' value='" . $row["id"] . "'>";
                    switch ($row["status"]) {
                        case "Pending":
                            echo "<button type='submit' name='approve' class='status-button status-pending'>Pending</button>";
                            break;
                        case "Approved":
                            echo "<button type='submit' name='approve' class='status-button status-approved'>Approved</button>";
                            break;
                        case "Rejected":
                            echo "<button type='submit' name='approve' class='status-button status-rejected'>Rejected</button>";
                            break;
                        default:
                            echo $row["status"];
                    }
                    echo "</form>";
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No requests found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>











<footer>
        <p>Designed by <a href="https://example.com">Nihal</a></p>
    </footer>








</body>
</html>