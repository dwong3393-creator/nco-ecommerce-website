<?php
session_start();
include("db.php");
include("products.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$action  = isset($_GET['action']) ? $_GET['action'] : '';
$id      = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

// ---- Add to cart ----
if ($action === 'add') {
    if (!isset($PRODUCTS[$id])) {
        js_alert('Sorry, that product was not found.', 'showcase.php');
        exit();
    }
    $product  = $PRODUCTS[$id];
    $quantity = 1;
    $found    = false;

    foreach ($_SESSION['cart'] as $key => $item) {
        if ((int)$item['id'] === $id) {
            $_SESSION['cart'][$key]['quantity'] += 1;
            $quantity = $_SESSION['cart'][$key]['quantity'];
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = array(
            'id'       => $id,
            'name'     => $product['name'],
            'price'    => $product['price'],
            'image'    => $product['image'],
            'quantity' => 1
        );
    }

    // Save to the database too when logged in
    if ($user_id) {
        if ($found) {
            $stmt = mysqli_prepare($conn, "UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?");
            mysqli_stmt_bind_param($stmt, "iii", $quantity, $user_id, $id);
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO cart_items (user_id, product_id, name, price, image, quantity) VALUES (?, ?, ?, ?, ?, 1)
                                           ON DUPLICATE KEY UPDATE quantity = quantity + 1");
            mysqli_stmt_bind_param($stmt, "iisds", $user_id, $id, $product['name'], $product['price'], $product['image']);
        }
        mysqli_stmt_execute($stmt);
    }

    echo "<script>alert('Item added to cart!'); window.history.back();</script>";
    exit();
}

// ---- Remove one product ----
if ($action === 'remove') {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ((int)$item['id'] === $id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    if ($user_id) {
        $stmt = mysqli_prepare($conn, "DELETE FROM cart_items WHERE user_id = ? AND product_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: cart.php");
    exit();
}

// ---- Empty the cart ----
if ($action === 'empty') {
    unset($_SESSION['cart']);

    if ($user_id) {
        $stmt = mysqli_prepare($conn, "DELETE FROM cart_items WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: cart.php");
    exit();
}

header("Location: cart.php");
exit();
