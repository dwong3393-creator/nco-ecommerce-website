<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<section id="header">
    <a href="index.php"><img src="img/New.png" class="logo" alt="N.CO"></a>

    <div>
        <ul id="navbar">
            <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
            
            <li><a href="showcase.php" class="<?php echo ($current_page == 'showcase.php' || $current_page == 'showcase2.php' || strpos($current_page, 'single') !== false) ? 'active' : ''; ?>">Showcase</a></li>
            
            <li><a href="about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">About</a></li>

            <li><a href="faq.php" class="<?php echo ($current_page == 'faq.php') ? 'active' : ''; ?>">FAQ</a></li>
            
            <li><a href="contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">Contact</a></li>

            <?php if(isset($_SESSION['user_name'])): ?>
                <li><a href="account.php" class="user-link <?php echo ($current_page == 'account.php') ? 'active' : ''; ?>"><?php echo htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8'); ?></a></li>
            <?php else: ?>
                <li><a href="login.php"><button class="btn-login">LOG IN</button></a></li>
            <?php endif; ?>

            <?php if(isset($_SESSION['user_name'])): ?>
                <li id="lg-cart">
                    <a href="cart.php" class="<?php echo ($current_page == 'cart.php' || $current_page == 'checkout.php') ? 'active' : ''; ?>">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </li>
            <?php endif; ?>
            
            <a href="#" id="close"><i class="fa-solid fa-x"></i></a>
        </ul>
    </div>

    <div id="mobile">
        <?php if(isset($_SESSION['user_name'])): ?>
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <?php endif; ?>
        
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>