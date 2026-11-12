<?php
session_start();
include("db.php");

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = (int)$_SESSION['user_id'];

    $fields = array('name', 'phone', 'email', 'address', 'city', 'postcode', 'state');
    $in = array();
    foreach ($fields as $f) {
        $in[$f] = trim($_POST[$f] ?? '');
    }

    // HTML-safe copies for the receipt page
    $display_name  = e($in['name']);
    $display_email = e($in['email']);
    $display_phone = e($in['phone']);
    $full_address  = e($in['address'] . ", " . $in['city'] . ", " . $in['postcode'] . " " . $in['state']);

    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    if (empty($cart_items)) {
        js_alert('Your cart is empty!', 'cart.php');
        exit();
    }

    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += ($item['price'] * $item['quantity']);
    }

    // Save the order and its items in one transaction
    mysqli_begin_transaction($conn);
    try {
        $stmt = mysqli_prepare($conn, "INSERT INTO orders (user_id, name, email, phone, address, city, state, postcode, total_price)
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isssssssd", $user_id, $in['name'], $in['email'], $in['phone'],
                               $in['address'], $in['city'], $in['state'], $in['postcode'], $total_price);
        mysqli_stmt_execute($stmt);
        $order_id = mysqli_insert_id($conn);

        $stmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?)");
        foreach ($cart_items as $item) {
            $p_id = (int)$item['id']; $p_name = $item['name']; $p_price = (float)$item['price']; $p_qty = (int)$item['quantity'];
            mysqli_stmt_bind_param($stmt, "iisdi", $order_id, $p_id, $p_name, $p_price, $p_qty);
            mysqli_stmt_execute($stmt);
        }

        $stmt = mysqli_prepare($conn, "DELETE FROM cart_items WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);

        mysqli_commit($conn);
        unset($_SESSION['cart']);
        $order_ok = true;
    } catch (mysqli_sql_exception $ex) {
        mysqli_rollback($conn);
        error_log($ex->getMessage());
        $order_ok = false;
    }

    if ($order_ok) {
        // Show the success page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | N.CO</title>
    <script src="https://kit.fontawesome.com/c82f16d7a6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* Custom Success Page Styles */
        body { background-color: #f9f9f9; font-family: 'Lora', serif; }
        
        .success-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 60px 20px;
            margin-top: 80px; 
            text-align: center;
        }
        
        .success-card {
            background: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        .success-icon { font-size: 80px; color: #088178; margin-bottom: 20px; }
        .success-card h1 { font-size: 32px; color: #222; margin-bottom: 10px; }
        .success-card p { color: #666; font-size: 16px; }

        .order-details {
            text-align: left;
            margin-top: 40px;
            border-top: 2px solid #f1f1f1;
            padding-top: 30px;
        }

        .order-details h3 { font-size: 20px; margin-bottom: 20px; color: #333; }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f9f9f9;
            font-size: 15px;
        }

        .item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .item-info { display: flex; align-items: center; gap: 15px; text-align: left; }
        .item-info img { width: 60px; height: 60px; object-fit: cover; border-radius: 5px; }
        .item-name { font-weight: 600; color: #222; display: block; }
        .item-qty { font-size: 13px; color: #888; }

        .total-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-price { font-size: 28px; color: #088178; font-weight: 700; }

        .btn-home {
            display: inline-block;
            margin-top: 40px;
            padding: 15px 40px;
            background-color: #222;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-home:hover { background-color: #088178; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="success-wrapper">
        <div class="success-card">
            <i class="fa-solid fa-circle-check success-icon"></i>
            <h1>Thank You, <?php echo $display_name; ?>!</h1>
            <p>Your order #<?php echo (int)$order_id; ?> has been placed successfully.</p>
            
            <!-- SHIPPING INFO -->
            <div class="order-details">
                <h3>Shipping Details</h3>
                <div class="detail-row">
                    <strong>Delivering to:</strong>
                    <span><?php echo $full_address; ?></span>
                </div>
                <div class="detail-row">
                    <strong>Contact:</strong>
                    <span><?php echo $display_phone; ?></span>
                </div>
                <div class="detail-row">
                    <strong>Email Receipt:</strong>
                    <span><?php echo $display_email; ?></span>
                </div>
            </div>

            <!-- ORDER ITEMS -->
            <div class="order-details">
                <h3>Order Summary</h3>
                
                <div class="item-list">
                    <?php foreach ($cart_items as $item): ?>
                    <div class="item-row">
                        <div class="item-info">
                            <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>">
                            <div>
                                <span class="item-name"><?php echo htmlspecialchars($item['name']); ?></span>
                                <span class="item-qty">Qty: <?php echo (int)$item['quantity']; ?></span>
                            </div>
                        </div>
                        <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="total-section">
                    <h2>Total Paid</h2>
                    <div class="total-price">$<?php echo number_format($total_price, 2); ?></div>
                </div>
            </div>

            <a href="index.php" class="btn-home">Continue Shopping</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>

<?php
    } else {
        js_alert('Sorry, your order could not be placed. Please try again.', 'checkout.php');
    }
} else {
    header("Location: cart.php");
    exit();
}
?>