<?php
// Database connection (XAMPP defaults: user "root", empty password).
// Import database.sql in phpMyAdmin first – it creates the "accountdb" database.
$db_server = "localhost";
$db_user   = "root";
$db_pass   = "";
$db_name   = "accountdb";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    mysqli_set_charset($conn, "utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    die("Could not connect to the database. Make sure MySQL is running in XAMPP and database.sql has been imported.");
}

// Escape text before printing it into HTML
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Load a logged-in user's saved cart from the database into the session
function load_cart_from_db($conn, $user_id) {
    $stmt = mysqli_prepare($conn, "SELECT product_id, name, price, image, quantity FROM cart_items WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $_SESSION['cart'] = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['cart'][] = array(
            'id'       => (int)$row['product_id'],
            'name'     => $row['name'],
            'price'    => (float)$row['price'],
            'image'    => $row['image'],
            'quantity' => (int)$row['quantity']
        );
    }
}

// Check an email + password. Returns the user row on success, or an error string.
function attempt_login($conn, $email, $password) {
    $stmt = mysqli_prepare($conn, "SELECT id, full_name, password FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$row) {
        return 'User not found. Please register first.';
    }
    if (!password_verify($password, $row['password'])) {
        return 'Incorrect password!';
    }
    session_regenerate_id(true);
    $_SESSION['user_id']   = (int)$row['id'];
    $_SESSION['user_name'] = $row['full_name'];
    load_cart_from_db($conn, (int)$row['id']);
    return $row;
}

// Create a new account. Returns true on success, or an error string.
function register_user($conn, $fullname, $email, $password) {
    $fullname = trim($fullname);
    $email    = trim($email);
    if ($fullname === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        return 'Please enter your name, a valid email and a password of at least 6 characters.';
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    try {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $hash);
        mysqli_stmt_execute($stmt);
        return true;
    } catch (mysqli_sql_exception $e) {
        return 'This email is already registered!';
    }
}

// Show a browser alert, optionally followed by a redirect
function js_alert($message, $redirect = null) {
    $js = "alert(" . json_encode($message) . ");";
    if ($redirect !== null) {
        $js .= " window.location.href = " . json_encode($redirect) . ";";
    }
    echo "<script>$js</script>";
}
