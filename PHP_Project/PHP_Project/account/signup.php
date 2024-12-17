<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do Website</title>
    <link rel = "stylesheet" href="../styles/styles.css">
    <link rel = "stylesheet" href="../styles/calendar.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        header {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }
        nav a:hover {
            text-decoration: underline;
        }

        /* Centered Login & Signup Forms */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            gap: 50px;
        }

        .form-box {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 300px;
            border-radius: 5px;
            text-align: center;
        }

        .form-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .form-box button {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-box button:hover {
            background-color: #0056b3;
        }

        .form-box p {
            margin-top: 15px;
            font-size: 14px;
        }

        .form-box a {
            color: #007BFF;
            text-decoration: none;
        }

        .form-box a:hover {
            text-decoration: underline;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
	<?php include_once '../home/heading.php';?>

	<div class="container">
	<div class="form-box">
        <h2>Sign Up</h2>
        <form action="create_user.php" method="post">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
             <input type="password" name="rePassword" placeholder="Re type Password" required>
            
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Log In</a></p>
    </div>
	</div>
    
</body>
</html>