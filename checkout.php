<?php 
session_start(); 

// Optional: Redirect to Home/Login if user is not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

// Nothing to check out? Go back to the cart
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
if (empty($cart_items)) {
    header("Location: cart.php");
    exit();
}
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
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
        /* --- CUSTOM CHECKOUT DESIGN (No Bootstrap) --- */
        
        .checkout-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            margin-top: 100px; /* Space for fixed header */
            display: flex;
            gap: 50px;
            align-items: flex-start;
        }

        /* Left Column: Billing Form */
        .checkout-form-container {
            flex: 1.5; /* Takes up 60% width */
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 25px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            color: #222;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #444;
        }

        .form-group input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #088178;
        }

        /* Right Column: Order Summary */
        .order-summary {
            flex: 1; /* Takes up 40% width */
            background: #fdfdfd;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 30px;
            position: sticky;
            top: 120px; /* Sticks when scrolling */
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 15px;
            color: #555;
        }

        .summary-total {
            border-top: 2px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
            font-weight: 700;
            font-size: 20px;
            color: #222;
            display: flex;
            justify-content: space-between;
        }

        .btn-place-order {
            display: block;
            width: 100%;
            background-color: #088178;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: 25px;
            border: none;
            font-weight: 600;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-place-order:hover {
            background-color: #066c63;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .checkout-wrapper {
                flex-direction: column;
            }
            .checkout-form-container, .order-summary {
                width: 100%;
            }
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="checkout-wrapper">
        
        <div class="checkout-form-container">
            <h2 class="section-title">Billing Details</h2>
            
            <form id="checkout-form" action="place_order.php" method="POST">
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" placeholder="+60 123 456 789" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="john@example.com" required>
                </div>

                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" name="address" placeholder="123 Fashion St, Subang Jaya" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" placeholder="Subang Jaya" required>
                    </div>
                    <div class="form-group">
                        <label>Postcode</label>
                        <input type="text" name="postcode" placeholder="47500" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>State</label>
                    <input type="text" name="state" placeholder="Selangor" required>
                </div>

                <input type="hidden" name="place_order" value="1">
                
                </form>
        </div>

        <div class="order-summary">
            <h2 class="section-title">Your Order</h2>
            
            <div class="summary-row">
                <span>Product</span>
                <span>Subtotal</span>
            </div>
            
            <?php foreach ($cart_items as $item): ?>
            <div class="summary-row">
                <span><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?> x <?php echo (int)$item['quantity']; ?></span>
                <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
            </div>
            <?php endforeach; ?>
            
            <div class="summary-row">
                <span>Shipping</span>
                <span>Free</span>
            </div>

            <div class="summary-total">
                <span>Total</span>
                <span>$<?php echo number_format($total, 2); ?></span>
            </div>

            <button type="submit" form="checkout-form" class="btn-place-order">PLACE ORDER</button>
        </div>

    </div>

    <?php include 'footer.php'; ?>

</body>
</html>