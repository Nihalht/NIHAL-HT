<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanics Details</title>
    <style>
        /* ... (Styles remain unchanged) ... */

        .search-container {
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .search-container button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
        }

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
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background-color: #7b4397;
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f4f4f4;
        }

        /* Button Styles */
        .remove-button, .add-button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .remove-button {
            background-color: #dc3545;
            color: #fff;
        }

        .remove-button:hover {
            background-color: #c82333;
        }

        .add-button {
            background-color: #007bff;
            color: #fff;
        }

        .add-button:hover {
            background-color: #0056b3;
        }
















        /* Navigation Styles */
        nav {
            background-color: #7b4397;
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
                padding: 10px;
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
        <a href="admin_dashboard.php">Home</a>
        <a href="users_info.php">Users</a>
        <a href="feedback_info.php">Feedback</a>
        <a href="login.php">Logout</a>
    </nav>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by Username...">
        <button onclick="searchMechanic()">Search</button>
    </div>

    <div class="container">
        <h2>Mechanics Details</h2>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "vehicle_breakdown";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to fetch mechanic details
        $sql = "SELECT username, password, email, mechanic_id FROM mechanics";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output table header
            echo "<table>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Mechanic ID</th>
                        <th>Action</th>
                    </tr>";

            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["mechanic_id"] . "</td>";
                echo "<td>
                        <button class='remove-button' onclick='removeMechanic(" . $row["mechanic_id"] . ")'>Remove</button>
                        <button class='add-button' onclick='addMechanic(" . $row["mechanic_id"] . ")'>Add</button>
                      </td>";
                echo "</tr>";
            }

            // Close the table
            echo "</table>";
        } else {
            echo "<p>No mechanics found.</p>";
        }

        $conn->close();
        ?>

        <script>
            function removeMechanic(mechanicId) {
                if (confirm("Are you sure you want to remove this mechanic?")) {
                    window.location.href = "remove_mechanic.php?mechanic_id=" + mechanicId;
                }
            }

            function addMechanic(mechanicId) {
                if (confirm("Are you sure you want to add this mechanic?")) {
                    window.location.href = "add_mechanic.php?mechanic_id=" + mechanicId;
                }
            }

            function searchMechanic() {
                let searchValue = document.getElementById("searchInput").value.toLowerCase();
                let rows = document.querySelectorAll("table tr");

                rows.forEach((row, index) => {
                    if (index !== 0) { // Skip header row
                        let username = row.cells[0].textContent.toLowerCase();
                        
                        if (username.includes(searchValue)) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    }
                });
            }
        </script>
    </div>

    <!-- Footer -->
    <footer>
        <p>Designed by <a href="https://github.com/Nihalht/NIHAL-HT">Nihal</a></p>
    </footer>
</body>
</html>
