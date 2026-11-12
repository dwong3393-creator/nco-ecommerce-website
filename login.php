<?php
session_start();
include("db.php");

// Already logged in? Go to the account page
if (isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['loginbutton'])) {
    $result = attempt_login($conn, $_POST['email'] ?? '', $_POST['password'] ?? '');
    if (is_array($result)) {
        js_alert('Login successful!', 'index.php');
    } else {
        js_alert($result);
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
        /* --- CUSTOM LOGIN DESIGN --- */
        
        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 85vh; /* Full screen height minus header/footer approx */
            padding-top: 100px; /* Avoid header overlap */
            background-color: #fff;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            text-align: center;
            background: #fff;
        }

        .login-card h2 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #222;
        }

        .login-card p {
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

        .btn-login-submit {
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

        .btn-login-submit:hover {
            background-color: #088178;
        }

        .register-link {
            margin-top: 25px;
            font-size: 14px;
            color: #555;
        }

        .register-link a {
            color: #088178;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- MASTER HEADER -->
    <?php include 'header.php'; ?>

    <div class="login-wrapper">
        <div class="login-card">
            <h2>Welcome Back</h2>
            <p>Please enter your details to sign in</p>

            <form action="login.php" method="POST">
                
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" name="loginbutton" class="btn-login-submit">Sign In</button>

                <div class="register-link">
                    Don't have an account yet? <a href="register.php">Create Account</a>
                </div>

            </form>
        </div>
    </div>

    <!-- MASTER FOOTER -->
    <?php include 'footer.php'; ?>

</body>
</html>