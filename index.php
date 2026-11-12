<?php
    session_start();
    include("db.php");

    // --- REGISTER ---
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register_btn'])) {
        $result = register_user($conn, $_POST['fullname'] ?? '', $_POST['email'] ?? '', $_POST['password'] ?? '');
        js_alert($result === true ? 'Registration successful! Please log in.' : 'Error: ' . $result);
    }

    // --- LOGIN ---
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['loginbutton'])) {
        $result = attempt_login($conn, $_POST['email'] ?? '', $_POST['password'] ?? '');
        if (is_array($result)) {
            js_alert('Login successful! Welcome ' . $result['full_name'], 'index.php');
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
</head>

<body>

    <?php include 'header.php'; ?>

    <section class="section">
        <div class="wrapper">
            <span class="icon-close">
                <i class="fa-solid fa-x"></i>
            </span>

            <div class="logreg-box">
                <div class="form-box login">
                    <div class="logreg-title">
                        <h2>Login</h2>
                        <p>Please login to use the platform</p>
                    </div>

                    <form action="index.php" method="POST">
                        <div class="input-box">
                            <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" required>
                            <label>Email</label>
                        </div>

                        <div class="input-box">
                            <span class="icon"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" required>
                            <label>Password</label>
                        </div>

                        <div class="remember-forgot">
                            <label><input type="checkbox">Remember me</label>
                            <a href="#">Forgot password?</a>
                        </div>

                        <button type="submit" class="but_ton" id="sweetalert2" name="loginbutton">Login</button>
                        
                        <div class="logreg-link">
                            <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                        </div>
                    </form>
                </div>


                <div class="form-box register">
                    <div class="logreg-title">
                        <h2>Register</h2>
                        <p>Please provide the following information to create an account</p>
                    </div>

                    <form action="index.php" method="POST">
                        <div class="input-box">
                            <span class="icon"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="fullname" required>
                            <label>Full Name</label>
                        </div>

                        <div class="input-box">
                            <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" required>
                            <label>Email</label>
                        </div>

                        <div class="input-box">
                            <span class="icon"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" required>
                            <label>Password</label>
                        </div>

                        <div class="remember-forgot">
                            <label><input type="checkbox" required>I agree to the terms & conditions</label>
                        </div>

                        <button type="submit" class="but_ton" name="register_btn">Register</button>

                        <div class="logreg-link">
                            <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="media-options">
                <a href="#">
                    <i class="fa-brands fa-google"></i>
                    <span>Login With Google</span>
                </a>
                <a href="#">
                    <i class="fa-brands fa-instagram"></i>
                    <span>Login With Instagram</span>
                </a>
            </div>
        </div>
    </section>

    <section id="hero">
        <div>
        <h3>Style Upgrade: Revitalize Your Look with Our Fashion Essentials!</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <h3>Black-Friday deals</h3>
        <br>
        <a href="showcase.php"><button class="btn">Shop Now</button></a>
        </div>
    </section>

    <section id="feature" class="container">
        <div class="center-text">
            <h1><i><b>FEATURING</b></i></h1>
        </div>
    </section>

    <section class="section__container sale__container">
        <div class="sale__grid">
            <div class="sale__card">
                <img src="Model/featured/neeco0039.jpg" alt="sale" />
            </div>
            <div class="sale__card">
                <img src="Model/featured/neeco0040.jpg" alt="sale" />
            </div>
            <div class="sale__card">
                <img src="Model/featured/neeco0041.jpg" alt="sale" />
            </div>
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Newest Launch </h4>
        <h2>Up to <span>70% Off</span> - All clothing</h2>
        <a href="showcase.php"><button class="normal">Find Out More</button></a>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4><b>Crazy Deals</b></h4>
            <h2>Buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at N.CO</span>
            <a href="showcase.php"><button class="white">Learn More</button></a>
        </div>
        <div class="banner-box banner-box2">
            <h4><b>Crazy Deals</b></h4>
            <h2>Buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at N.CO</span>
            <a href="showcase.php"><button class="white">Learn More</button></a>
        </div>
    </section>

    <section id="newsletter" class="section-p1">
        <div class="newstext">
            <h4>Sign Up for Newsletters</h4>
            <p>Get E-mail updates on our latest shop</p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <br>
    <br>

    <footer class="contact">
        <div class="contact-info">
            <div class="first-info">
                <br>
                <img src="img/New.png" alt="">
                <p>No.5, Jalan Universiti, <br> Bandar Sunway, <br> 47500 Selangor Darul Ehsan <br> Malaysia</p>
                <p>+60-174891111</p>
                <p>21081682@imail.sunway.edu.my</p>

                <div class="social-icon">
                    <a href="#"><i class='bx bxl-facebook' ></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-youtube'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </div>

            <div class="second-info">
                <br><br>
                <h4>Support</h4>
                <p>Contact Us</p>
                <p>About Page</p>
                <p>Size Guide</p>
                <p>Shopping & Returns</p>
                <p>Privacy</p>
            </div>

            <div class="third-info">
                <br><br>
                <h4>Shop</h4>
                <p>Men's Shopping</p>
                <p>Women's Shopping</p>
                <p>Kids's Shopping</p>
                <p>Accessories</p>
                <p>Discount</p>
            </div>

            <div class="fourth-info">
                <br><br>
                <h4>Company</h4>
                <p>About</p>
                <p>Blog</p>
                <p>Affiliate</p>
                <p>Login</p>
            </div>

            <div class="five">
                <br><br>
                <h4>Subscribe</h4>
                <p>Sign up and be the first-in the know about new arrivals, </p>
                <p>promotions, in-store events and more. </p>
            </div>
        </div>
    </footer>

    <div class="end-text">
        <p>Copyright © @2023/9/12. All Rights Reserved. Designed by Dickson Wong.</p>
    </div>

    <script src="script.js"></script>

</body>
</html>