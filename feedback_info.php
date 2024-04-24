<?php
$host = 'localhost';
$db = 'vehicle_breakdown';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $stmt = $pdo->prepare('SELECT * FROM feedback WHERE name LIKE :search ORDER BY created_at DESC');
    $stmt->execute(['search' => '%' . $search . '%']);
    $feedbacks = $stmt->fetchAll();

    if (empty($feedbacks)) {
        $message = "Name not found";
    }
} else {
    $stmt = $pdo->query('SELECT * FROM feedback ORDER BY created_at DESC');
    $feedbacks = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            width: 100%;
            background-color: #7b4397;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #6a3b84;
        }

        .logout {
            background-color: #d9534f;
        }

        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: separate;
            border-spacing: 0 10px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #7b4397;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e6e6e6;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                margin: 5px 20px;
            }

            .logout {
                margin-top: 10px;
            }

            table {
                width: 100%;
                margin: 10px auto;
            }
        }

        footer {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            z-index: 999;
            margin-top: auto;
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

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-form input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .search-form input[type="submit"] {
            padding: 10px 20px;
            background-color: #7b4397;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-form input[type="submit"]:hover {
            background-color: #6a3b84;
        }
    </style>
</head>

<body>
    <div class="navbar">

        <a href="admin_dashboard.php">Home</a>
        <a href="users_info.php">Users</a>
        <a href="mechanics_info.php">Mechanics</a>

        <form action="" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search by Name..." value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Search">
        </form>

        <a href="login.php" class="logout">Logout</a>
    </div>

    <?php if (isset($message)): ?>
        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $feedback): ?>
            <tr>
                <td><?php echo htmlspecialchars($feedback['name']); ?></td>
                <td><?php echo htmlspecialchars($feedback['email']); ?></td>
                <td><?php echo htmlspecialchars($feedback['message']); ?></td>
                <td><?php echo htmlspecialchars($feedback['created_at']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <footer>
        <p>Designed by <a href="https://github.com/Nihalht/NIHAL-HT">Nihal</a></p>
    </footer>
</body>

</html>
