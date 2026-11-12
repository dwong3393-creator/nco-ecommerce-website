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

    <style>
        /* --- IMAGE RESIZE FIX --- */
        .pro img {
            width: 100%;
            height: 400px; /* Fixed height for all images */
            object-fit: cover; /* Smart crop: Fills box without stretching */
            border-radius: 20px;
            margin-bottom: 10px;
        }

        /* Ensure card height is consistent */
        .pro {
            min-height: 550px; /* Gives enough room for image + text */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
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
                <img src="img/products/img-13.jpg" alt="Green Outfit">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>White Outfit</h5>
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
                    <a href="single_product7.php"><i class="fa-solid fa-bag-shopping"></i></a>
                </div>
            </div>

            <div class="pro">
                <img src="img/products/img-28.jpg" alt="Red Prom Dress">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>White Bra and Pleated Skirt</h5>
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
                    <a href="single_product8.php"><i class="fa-solid fa-bag-shopping"></i></a>
                </div>
            </div>

            <div class="pro">
                <img src="img/products/img-5.jpg" alt="Black Bra and Pants">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Black Bra and Pants</h5>
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
                    <a href="single_product9.php"><i class="fa-solid fa-bag-shopping"></i></a>
                </div>
            </div>

            <div class="pro">
                <img src="img/products/img-8.jpg" alt="Yellow Skirt">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Men Button Shirt</h5>
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
                    <a href="single_product10.php"><i class="fa-solid fa-bag-shopping"></i></a>
                </div>
            </div>

            <div class="pro">
                <img src="img/products/img-27.jpg" alt="Blue Dress">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Grey Dress</h5>
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
                    <a href="single_product11.php"><i class="fa-solid fa-bag-shopping"></i></a>
                </div>
            </div>

            <div class="pro">
                <img src="img/products/img-25.jpg" alt="Blue Outfit">
                <div class="des">   
                    <span>Déesse</span>
                    <h5>Grey Outfit</h5>
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
                    <a href="single_product12.php"><i class="fa-solid fa-bag-shopping"></i></a>
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

    <br><br>

    <?php include 'footer.php'; ?>

</body>
</html>