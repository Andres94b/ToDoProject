<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | To-Do Website</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
    /* Global Box-Sizing Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* General Styles */
    body {
        font-family: 'Poppins', sans-serif;
        background: url('../assets/background.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
        height: 100vh;
    }

    /* Header */
    header {
        position: sticky;
        top: 0;
        background-color: #333;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        border-bottom: 1px solid #444;
    }

    header h1 {
        margin: 0 auto;
        font-size: 28px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    nav {
        display: flex;
        gap: 15px;
    }

    nav a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    nav a:hover {
        background-color: #007BFF;
        color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Centered Signup Form */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
    }

    .form-box {
        background-color: rgba(255, 255, 255, 0.95);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        padding: 40px;
        width: 350px;
        border-radius: 10px;
        text-align: center;
        backdrop-filter: blur(10px);
        animation: fadeIn 0.8s ease-in-out;
    }

    .form-box img {
        width: 80px;
        margin-bottom: 20px;
        transition: transform 0.3s ease-in-out;
    }

    .form-box img:hover {
        transform: scale(1.1);
    }

    .form-box h2 {
        margin-bottom: 20px;
        color: #333;
        font-size: 22px;
        font-weight: 600;
    }

    /* Input Fields and Button */
    .form-box input,
    .form-box button {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .form-box input:focus {
        outline: none;
        border-color: #007BFF;
        box-shadow: 0 0 5px #007BFF;
    }

    .form-box button {
        background-color: #007BFF;
        color: white;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
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
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding: 10px;
        background-color: #222;
        color: #ddd;
        font-size: 14px;
        letter-spacing: 1px;
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        header {
            flex-direction: column;
            text-align: center;
        }

        .form-box {
            width: 90%;
        }
    }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>NOT-IT : A TO-DO List WebApp</h1>
        <nav>
            <a href="#home">Home</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <!-- Sign-Up Form -->
    <div class="container">
        <div class="form-box">
            <!-- Logo -->
            <img src="../assets/Logo.png" alt="Website Logo">
            <h2>Sign Up</h2>
            <form action="create_user.php" method="post">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="rePassword" placeholder="Re-type Password" required>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 To-Do Website. All rights reserved.
    </footer>
</body>
</html>
