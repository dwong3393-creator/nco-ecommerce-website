<?php
session_start();
include("db.php");

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$user_id = (int)$_SESSION['user_id'];

// User details
$stmt = mysqli_prepare($conn, "SELECT id, full_name, email FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// Order history + most recent shipping address
$orders = [];
$address_display = "No address details found. Place an order to save your address.";
$contact_display = "";

$stmt = mysqli_prepare($conn, "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$order_result = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($order_result)) {
    $orders[] = $row;
}
if (!empty($orders)) {
    $latest = $orders[0];
    $address_display = e($latest['address']) . "<br>" . e($latest['city']) . ", " . e($latest['postcode']) . "<br>" . e($latest['state']);
    $contact_display = e($latest['phone']);
}

// Change password
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_password_btn'])) {
    $new_pass     = $_POST['password'] ?? '';
    $confirm_pass = $_POST['confirmpassword'] ?? '';

    if ($new_pass !== $confirm_pass) {
        js_alert('Error: Passwords do not match!');
    } elseif (strlen($new_pass) < 6) {
        js_alert('Error: Password must be at least 6 characters.');
    } else {
        $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $new_hash, $user_id);
        if (mysqli_stmt_execute($stmt)) {
            js_alert('Success! Your password has been changed.');
        } else {
            js_alert('Database error: could not update password.');
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
    <title>N.CO - My Account</title>
    <script src="https://kit.fontawesome.com/c82f16d7a6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

    <style>
        /* --- CUSTOM LAYOUT & TABS --- */
        body { background-color: #f9f9f9; }

        /* Full width background wrapper to fix "blue box" gaps */
        .account-wrapper-bg {
            width: 100%;
            background-color: #f9f9f9;
            padding-top: 120px;
            padding-bottom: 80px;
            min-height: 80vh;
        }

        .account-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        /* Sidebar */
        .sidebar {
            flex: 1;
            max-width: 300px;
            background: #fff;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .avatar-circle {
            width: 80px;
            height: 80px;
            background-color: #222;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 500;
            margin: 0 auto 15px auto;
        }

        .user-name { font-size: 16px; font-weight: 700; color: #222; margin-bottom: 5px; }
        .user-email { font-size: 13px; color: #777; margin-bottom: 30px; }

        /* Menu Links */
        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #555;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            margin-bottom: 5px;
            cursor: pointer;
            transition: 0.2s;
        }

        .menu-link i { margin-right: 10px; font-size: 18px; }
        .menu-link:hover { background-color: #f5f5f5; color: #000; }
        
        /* Active Tab Style */
        .menu-link.active {
            background-color: #eee;
            color: #000;
            font-weight: 700;
        }

        .menu-link.logout {
            color: #e74c3c;
            margin-top: 15px;
            border-top: 1px solid #f0f0f0;
            padding-top: 15px;
        }

        /* Content Area */
        .content-card {
            flex: 2.5;
            background: #fff;
            border-radius: 8px;
            padding: 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            min-height: 400px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            text-transform: uppercase;
        }

        /* TAB LOGIC: Hide all by default */
        .tab-content { display: none; }
        .tab-content.show { display: block; }

        /* Form Styles */
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #555; }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }
        .form-control:focus { border-color: #222; }

        .btn-update {
            background-color: #222; color: #fff; border: none; padding: 12px 30px;
            font-size: 13px; font-weight: 700; border-radius: 4px; cursor: pointer;
            text-transform: uppercase; margin-top: 10px;
        }
        .btn-update:hover { background-color: #088178; }

        /* Order Table */
        .order-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .order-table th { text-align: left; padding: 12px; background-color: #f9f9f9; font-size: 13px; color: #555; border-bottom: 2px solid #eee; }
        .order-table td { padding: 15px 12px; border-bottom: 1px solid #eee; font-size: 14px; color: #333; }
        
        /* Info Box */
        .info-box {
            background-color: #fcfcfc;
            border: 1px solid #f1f1f1;
            padding: 25px;
            border-radius: 8px;
        }
        .info-box p { margin: 5px 0; color: #555; font-size: 15px; line-height: 1.6; }
        .info-box strong { color: #222; }

        @media (max-width: 800px) {
            .account-container { flex-direction: column; }
            .sidebar, .content-card { width: 100%; max-width: none; box-sizing: border-box; }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <?php include 'header.php'; ?>

    <div class="account-wrapper-bg">
        <div class="account-container">
            
            <!-- SIDEBAR NAVIGATION -->
            <div class="sidebar">
                <div class="avatar-circle">
                    <?php echo e(strtoupper(substr($user['full_name'], 0, 1))); ?>
                </div>
                <div class="user-name"><?php echo htmlspecialchars($user['full_name']); ?></div>
                <div class="user-email"><?php echo htmlspecialchars($user['email']); ?></div>

                <nav>
                    <!-- JavaScript Tabs -->
                    <div class="menu-link active" onclick="openTab('security', this)"><i class='bx bx-lock-alt'></i> Security</div>
                    <div class="menu-link" onclick="openTab('orders', this)"><i class='bx bx-shopping-bag'></i> Your Orders</div>
                    <div class="menu-link" onclick="openTab('address', this)"><i class='bx bx-map'></i> Shipping Address</div>
                    
                    <a href="logout.php" class="menu-link logout"><i class='bx bx-log-out'></i> Logout</a>
                </nav>
            </div>

            <!-- CONTENT AREA -->
            <div class="content-card">
                
                <!-- TAB 1: SECURITY -->
                <div id="security" class="tab-content show">
                    <div class="section-title">Change Password</div>
                    <form action="account.php" method="POST">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm new password" required>
                        </div>
                        <button type="submit" name="update_password_btn" class="btn-update">Update Password</button>
                    </form>
                </div>

                <!-- TAB 2: ORDER HISTORY -->
                <div id="orders" class="tab-content">
                    <div class="section-title">Your Orders</div>
                    <?php if(count($orders) > 0): ?>
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $order): ?>
                                <tr>
                                    <td>#<?php echo (int)$order['id']; ?></td>
                                    <td><?php echo date('M d, Y', strtotime($order['order_date'])); ?></td>
                                    <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                                    <td><span style="color: green; font-weight:600;">Placed</span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div style="text-align:center; padding:40px; color:#888;">
                            <i class='bx bx-shopping-bag' style="font-size: 40px; margin-bottom:10px;"></i>
                            <p>You haven't placed any orders yet.</p>
                            <a href="showcase.php" style="color:#088178; font-weight:600; text-decoration:none;">Start Shopping</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- TAB 3: SHIPPING ADDRESS -->
                <div id="address" class="tab-content">
                    <div class="section-title">Default Shipping Address</div>
                    <div class="info-box">
                        <?php if(!empty($orders)): ?>
                            <p><strong><?php echo htmlspecialchars($user['full_name']); ?></strong></p>
                            <p><?php echo $address_display; ?></p>
                            <p>Phone: <?php echo $contact_display; ?></p>
                        <?php else: ?>
                            <p>No address saved yet. Your shipping details will be saved here automatically after you place your first order.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- Tab Script -->
    <script>
        function openTab(tabName, btn) {
            // Hide all tabs
            var contents = document.getElementsByClassName('tab-content');
            for (var i = 0; i < contents.length; i++) {
                contents[i].classList.remove('show');
            }
            
            // Deactivate all buttons
            var links = document.getElementsByClassName('menu-link');
            for (var i = 0; i < links.length; i++) {
                links[i].classList.remove('active');
            }

            // Show clicked tab and activate button
            document.getElementById(tabName).classList.add('show');
            btn.classList.add('active');
        }
    </script>

</body>
</html>