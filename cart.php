<?php 
session_start(); 

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
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
        /* --- CUSTOM CART DESIGN (No Bootstrap) --- */
        .cart-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px;
            margin-top: 100px; /* Space for fixed header */
            min-height: 60vh;
        }

        .cart-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .cart-header h2 {
            font-size: 36px;
            margin-bottom: 10px;
            color: #222;
        }

        /* Table Styling */
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .cart-table th {
            text-align: left;
            padding: 15px;
            background-color: #f8f9fa;
            color: #444;
            font-weight: 600;
            border-bottom: 2px solid #ddd;
        }

        .cart-table td {
            padding: 20px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        /* Product Info Cell */
        .product-item {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .product-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-details p {
            margin: 0 0 5px 0;
            font-weight: 600;
            font-size: 16px;
            color: #222;
        }

        .remove-link {
            font-size: 13px;
            color: #d63031;
            text-decoration: none;
            font-weight: 500;
        }

        .remove-link:hover {
            text-decoration: underline;
        }

        /* Quantity Input */
        .qty-input {
            width: 50px;
            padding: 5px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Cart Totals Section */
        .cart-summary {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .totals-box {
            width: 350px;
            background: #fdfdfd;
            border: 1px solid #e1e1e1;
            padding: 25px;
            border-radius: 8px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 15px;
            color: #555;
        }

        .totals-row.final {
            border-top: 1px solid #ddd;
            padding-top: 15px;
            margin-bottom: 0;
            font-weight: 700;
            font-size: 18px;
            color: #222;
        }

        .btn-checkout {
            display: block;
            width: 100%;
            background-color: #088178;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: 20px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-checkout:hover {
            background-color: #066c63;
        }
        
        .empty-cart-msg {
            text-align: center;
            padding: 50px 0;
            color: #777;
        }

        @media (max-width: 768px) {
            .product-item { flex-direction: column; align-items: flex-start; }
            .cart-table th { display: none; } /* Hide headers on mobile */
            .cart-table td { display: block; text-align: right; }
            .product-item { align-items: flex-end; }
            .totals-box { width: 100%; }
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="cart-wrapper">
        
        <div class="cart-header">
            <h2>Your Shopping Cart</h2>
            <hr style="width: 50px; border: 2px solid #088178; margin: 0 auto;">
        </div>

        <?php if(!empty($_SESSION['cart'])): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th width="50%">Product</th>
                        <th width="20%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="15%" style="text-align:right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total = 0;
                        // LOOP THROUGH SESSION CART ITEMS
                        foreach($_SESSION['cart'] as $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                    ?>
                    <tr>
                        <td>
                            <div class="product-item">
                                <img src="<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                <div class="product-details">
                                    <p><?php echo htmlspecialchars($item['name']); ?></p>
                                    <a href="cart_action.php?action=remove&id=<?php echo (int)$item['id']; ?>" class="remove-link">
                                        <i class='bx bx-trash'></i> Remove
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><input type="number" value="<?php echo (int)$item['quantity']; ?>" class="qty-input" readonly></td>
                        <td style="text-align:right;">$<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <div class="totals-box">
                    <h3>Cart Totals</h3>
                    <div class="totals-row">
                        <span>Subtotal</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    <div class="totals-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="totals-row final">
                        <span>Total</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    
                    <a href="checkout.php" class="btn-checkout">PROCEED TO CHECKOUT</a>
                </div>
            </div>
            
        <?php else: ?>
            <div class="empty-cart-msg">
                <h3>Your cart is empty!</h3>
                <p>Go to <a href="showcase.php" style="color:#088178; text-decoration:none;">Showcase</a> to add some items.</p>
            </div>
        <?php endif; ?>

    </div>

    <?php include 'footer.php'; ?>

</body>
</html>