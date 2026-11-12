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
    <link rel="stylesheet" href="style.css">

    <style>
        /* --- CUSTOM PRODUCT PAGE CSS (No Bootstrap) --- */
        
        .product-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px;
            margin-top: 100px; /* Clear fixed header */
            display: flex;
            gap: 50px;
            align-items: flex-start;
        }

        /* Left Column: Images */
        .product-left {
            flex: 1;
            min-width: 300px;
        }

        .main-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .thumbnail-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .thumbnail-col {
            flex: 1;
            cursor: pointer;
        }

        .thumbnail-col img {
            width: 100%;
            border-radius: 5px;
            border: 1px solid transparent;
            transition: 0.3s;
        }

        .thumbnail-col img:hover {
            border-color: #088178;
            opacity: 0.8;
        }

        /* Right Column: Details */
        .product-right {
            flex: 1.2;
            padding-top: 10px;
        }

        .bread-crumb {
            font-size: 14px;
            color: #888;
            margin-bottom: 15px;
        }

        .product-title {
            font-size: 32px;
            color: #222;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 28px;
            color: #088178;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .product-form {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .qty-input {
            width: 60px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
        }

        .add-cart-btn {
            background-color: #088178;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 4px;
            transition: 0.3s;
            border: none;
            font-size: 15px;
        }

        .add-cart-btn:hover {
            background-color: #066c63;
        }

        .product-details-header {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            color: #333;
        }

        .product-desc {
            color: #666;
            line-height: 1.6;
            font-size: 15px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
            }
            .product-left, .product-right {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="product-container">
        
        <div class="product-left">
            <img src="img/products/img-8.jpg" class="main-img" alt="Yellow Skirt">
            
            <div class="thumbnail-row">
                <div class="thumbnail-col">
                    <a href="single_product1.php"><img src="Model/showcase/1.4.jpg" alt="Thumb 1"></a>
                </div>
                <div class="thumbnail-col">
                    <a href="single_product2.php"><img src="Model/showcase/6.5.jpg" alt="Thumb 1"></a>
                </div>
                <div class="thumbnail-col">
                    <a href="single_product3.php"><img src="Model/showcase/5.1.jpg" alt="Thumb 2"></a>
                </div>
                <div class="thumbnail-col">
                    <a href="single_product4.php"><img src="Model/showcase/4.1.jpg" alt="Thumb 3"></a>
                </div>
            </div>
        </div>

        <div class="product-right">
            <div class="bread-crumb">Home / Clothing / Female</div>
            <h1 class="product-title">Men Button Shirt</h1>
            <div class="product-price">RM95.00</div>

            <div class="product-form">
                <input type="number" value="1" min="1" class="qty-input">
                
                <a href="cart_action.php?action=add&id=110" class="add-cart-btn">
                    Add To Cart
                </a>
            </div>

            <h3 class="product-details-header">Product Details</h3>
            <p class="product-desc">
                A lovely Yellow Skirt that brings a sunny vibe to your wardrobe. Comfortable, stylish, and perfect for casual or dressy occasions.
            </p>
        </div>

    </div>

    <?php include 'footer.php'; ?>

</body>
</html>