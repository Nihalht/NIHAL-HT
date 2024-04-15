<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f9d976, #f39f86);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            padding: 40px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #f39f86;
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #f9d976, #f39f86);
            color: #333;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .btn:hover {
            background: linear-gradient(to left, #f9d976, #f39f86);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
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
    <div class="container">
        <header>
            <h2>Feedback Form</h2>
        </header>
        <form action="submit_feedback.php" method="POST">
            <div class="form-group">
                <label for="name"><i class="fas fa-user"></i> Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message"><i class="fas fa-comment-dots"></i> Message</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit" class="btn">Submit Feedback</button>
 <br><br>       </form>
 <br>

    </div>

<br><br><br><br><br>

    <footer>
        <p>Designed by <a href="https://example.com">Nihal</a></p>
    </footer>

</body>
</html>