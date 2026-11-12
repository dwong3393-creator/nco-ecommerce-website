<?php session_start(); ?>
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

    <section id="about-header">
        <br><br><br><br><br><br>
        <h2>N.CO</h2>
        <p>N.CO plays an important role in the creative process<br>every pieces are ethically crafted & essential for everyday living.</p>
    </section>

    <br>

    <section id="form-details">
        <form class="contact_form" method="post" name="form">
            <h3>WE WANT YOUR FEEDBACK</h3>
            <h2>Your feedback is greatly appreciated</h2>
            <input type="text" name="name" placeholder="Your Name" required oninvalid="this.setCustomValidity('Please enter your name')" oninput="this.setCustomValidity('')">
            <input type="text" name="email" placeholder="E-mail Address" required oninvalid="this.setCustomValidity('Please enter your Address')" oninput="this.setCustomValidity('')">
            <input type="text" name="subject" placeholder="Subject" required oninvalid="this.setCustomValidity('Please enter your Subject')" oninput="this.setCustomValidity('')">
            <textarea name="message" id="" cols="30" rows="10" placeholder="Your Message" required oninvalid="this.setCustomValidity('Please enter your Message')" oninput="this.setCustomValidity('')"></textarea>
            
            <button id="sweetalert3" type="button">Submit</button>
        </form>
    </section>

    <br>

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

    <br><br>

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
                <br><br><h4>Support</h4><p>Contact Us</p><p>About Page</p><p>Size Guide</p><p>Shopping & Returns</p><p>Privacy</p>
            </div>
            <div class="third-info">
                <br><br><h4>Shop</h4><p>Men's Shopping</p><p>Women's Shopping</p><p>Kids's Shopping</p><p>Accessories</p><p>Discount</p>
            </div>
            <div class="fourth-info">
                <br><br><h4>Company</h4><p>About</p><p>Blog</p><p>Affiliate</p><p>Login</p>
            </div>
            <div class="five">
                <br><br><h4>Subscribe</h4><p>Sign up and be the first-in the know about new arrivals, </p><p>promotions, in-store events and more. </p>
            </div>
        </div>
    </footer>

    <div class="end-text">
        <p>Copyright © @2023/9/12. All Rights Reserved. Designed by Dickson Wong.</p>
    </div>

    <script src="script.js"></script>

</body>
</html>