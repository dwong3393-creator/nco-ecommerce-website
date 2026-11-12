<?php
session_start();
include("db.php");

// Already logged in? Go to the account page
if (isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register_btn'])) {
    $password = $_POST['password'] ?? '';
    if ($password !== ($_POST['confirmPassword'] ?? '')) {
        js_alert('Passwords do not match!');
    } else {
        $result = register_user($conn, $_POST['name'] ?? '', $_POST['email'] ?? '', $password);
        if ($result === true) {
            js_alert('Registration successful! Please log in.', 'login.php');
        } else {
            js_alert('Error: ' . $result);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N.CO</title>
    <script src="https://kit.fontawesome.com/c82f16d7a6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

    <style>
        /* --- CUSTOM REGISTER PAGE STYLES --- */
        
        .register-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 85vh;
            padding: 120px 20px 60px 20px; /* Top padding for fixed header */
            background-color: #fff;
        }

        .register-card {
            width: 100%;
            max-width: 500px;
            background: #fff;
            padding: 40px;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            text-align: center;
        }

        .register-card h2 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #222;
        }

        .register-card p {
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 13px;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #088178;
            box-shadow: 0 0 5px rgba(8, 129, 120, 0.1);
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background-color: #222;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #088178;
        }

        .login-redirect {
            margin-top: 25px;
            font-size: 14px;
            color: #555;
        }

        .login-redirect a {
            color: #088178;
            text-decoration: none;
            font-weight: 600;
        }

        .login-redirect a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="register-wrapper">
        <div class="register-card">
            <h2>Create Account</h2>
            <p>Join us to get exclusive offers and updates</p>

            <form action="register.php" method="POST">
                
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a password" required>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirmPassword" placeholder="Repeat your password" required>
                </div>

                <button type="submit" name="register_btn" class="btn-register">Sign Up</button>

                <div class="login-redirect">
                    Already have an account? <a href="login.php">Log In</a>
                </div>

            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>