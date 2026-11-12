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

        

    <section id="page-header">
        <div>
        <h4>Dress to Impress: Exclusive Discounts on Elegant Outfits</h4>
        <h2>Take a sneak peek on the latest</h2>
        <h1>new designs!</h1>
        <h3>Complimentary Shipping & Returns</h3>
        <br>
        <a href="showcase.php"><button class="btn">Shop Now</button></a>
        </div>
        
    </section>

    <br>

    <section id="product1" class="section-p1">
        <h2>Showcase Products</h2>
        <p>Latest Modern Designs</p>
        <div class="pro-container">
            <div class="pro">
                <img src="Model/showcase/1.4.jpg" alt="">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Green Outfit</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>$$$</h4>
                </div>
                <div class="shop">
                    <a href="single_product1.php", i class="fa-solid fa-bag-shopping"></a>
                </div>
            </div>
            <div class="pro">
                <img src="Model/showcase/6.5.jpg" alt="">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Red Prom Dress</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>$$$</h4>
                </div>
                <div class="shop">
                    <a href="single_product2.php", i class="fa-solid fa-bag-shopping"></a>
                </div>
            </div>
            <div class="pro">
                <img src="Model/showcase/5.1.jpg" alt="">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>White Shirt</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>$$$</h4>
                </div>
                <div class="shop">
                    <a href="single_product3.php", i class="fa-solid fa-bag-shopping"></a>
                </div>
            </div>
            <div class="pro">
                <img src="Model/showcase/4.1.jpg" alt="">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Yellow Skirt</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>$$$</h4>
                </div>
                <div class="shop">
                    <a href="single_product4.php", i class="fa-solid fa-bag-shopping"></a>
                </div>
            </div>
            <div class="pro">
                <img src="Model/showcase/3.1.jpg" alt="">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Blue Dress</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>$$$</h4>
                </div>
                <div class="shop">
                     <a href="single_product5.php", i class="fa-solid fa-bag-shopping"></a>
                </div>
            </div>
            <div class="pro">
                <img src="Model/showcase/2.1.jpg" alt="">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Blue Outfit</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>$$$</h4>
                </div>
                <div class="shop">
                    <a href="single_product6.php", i class="fa-solid fa-bag-shopping"></a>
                </div>
            </div>
            
        </div>
    </section>


    <section id="pagination" class="section-p1">
        <a href="showcase.php">1</a>
        <a href="showcase2.php">2</a>
        <a href="showcase2.php"><i class="fa-solid fa-right-long"></i></a>
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
                <br>
                <br>
                <h4>Support</h4>
                <p>Contact Us</p>
                <p>About Page</p>
                <p>Size Guide</p>
                <p>Shopping & Returns</p>
                <p>Privacy</p>
            </div>

            <div class="third-info">
                <br>
                <br>
                <h4>Shop</h4>
                <p>Men's Shopping</p>
                <p>Women's Shopping</p>
                <p>Kids's Shopping</p>
                <p>Accessories</p>
                <p>Discount</p>
            </div>

            <div class="fourth-info">
                <br>
                <br>
                <h4>Company</h4>
                <p>About</p>
                <p>Blog</p>
                <p>Affiliate</p>
                <p>Login</p>
            </div>

            <div class="five">
                <br>
                <br>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    
</body>
</html>