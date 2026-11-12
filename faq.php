<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N.CO - FAQ</title>
    
    <!-- Icons & Fonts -->
    <script src="https://kit.fontawesome.com/c82f16d7a6.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

    <style>
        /* --- FAQ Specific Styles --- */
        body {
            background-color: #f9f9f9;
        }

        .faq-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 60px 20px;
            margin-top: 80px; /* Space for fixed header */
        }

        .faq-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .faq-header h2 {
            font-size: 36px;
            color: #222;
            margin-bottom: 10px;
        }

        .faq-header p {
            color: #666;
            font-size: 16px;
        }

        /* Accordion Item */
        .accordion-item {
            background: #fff;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            overflow: hidden;
            border: 1px solid #eee;
        }

        .accordion-header {
            padding: 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            transition: 0.3s;
        }

        .accordion-header:hover {
            background-color: #fcfcfc;
        }

        .accordion-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .accordion-header i {
            font-size: 18px;
            color: #088178;
            transition: 0.3s;
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            padding: 0 20px;
            background-color: #fff;
        }

        .accordion-content p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin: 20px 0;
        }

        /* Active State */
        .accordion-item.active .accordion-header i {
            transform: rotate(180deg);
        }

        .accordion-item.active .accordion-header {
            border-bottom: 1px solid #f0f0f0;
        }

        .accordion-item.active .accordion-content {
            max-height: 200px; /* Adjust if content is very long */
        }
    </style>
</head>

<body>

    <!-- MASTER HEADER -->
    <?php include 'header.php'; ?>

    <div class="faq-wrapper">
        
        <div class="faq-header">
            <h2>Frequently Asked Questions</h2>
            <p>Find answers to common questions about our products and services.</p>
        </div>

        <!-- FAQ 1 -->
        <div class="accordion-item">
            <div class="accordion-header" onclick="toggleFAQ(this)">
                <h3>How do I track my order?</h3>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="accordion-content">
                <p>Once your order is shipped, you will receive a confirmation email with a tracking number. You can also view your order status in the "My Orders" section of your account.</p>
            </div>
        </div>

        <!-- FAQ 2 -->
        <div class="accordion-item">
            <div class="accordion-header" onclick="toggleFAQ(this)">
                <h3>What is your return policy?</h3>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="accordion-content">
                <p>We accept returns within 30 days of purchase. Items must be unworn, unwashed, and in their original packaging with tags attached.</p>
            </div>
        </div>

        <!-- FAQ 3 -->
        <div class="accordion-item">
            <div class="accordion-header" onclick="toggleFAQ(this)">
                <h3>Do you ship internationally?</h3>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="accordion-content">
                <p>Yes, we ship worldwide! International shipping costs and delivery times vary depending on the destination.</p>
            </div>
        </div>

        <!-- FAQ 4 -->
        <div class="accordion-item">
            <div class="accordion-header" onclick="toggleFAQ(this)">
                <h3>Can I change or cancel my order?</h3>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="accordion-content">
                <p>Orders can be modified or canceled within 1 hour of placement. Please contact our support team immediately if you need assistance.</p>
            </div>
        </div>

        <!-- FAQ 5 -->
        <div class="accordion-item">
            <div class="accordion-header" onclick="toggleFAQ(this)">
                <h3>What payment methods do you accept?</h3>
                <i class='bx bx-chevron-down'></i>
            </div>
            <div class="accordion-content">
                <p>We accept all major credit cards (Visa, MasterCard, Amex), PayPal, and online banking transfers.</p>
            </div>
        </div>

    </div>

    <!-- MASTER FOOTER -->
    <?php include 'footer.php'; ?>

    <script>
        function toggleFAQ(header) {
            const item = header.parentElement;
            
            // Close other open items (Optional - Accordion Style)
            const allItems = document.querySelectorAll('.accordion-item');
            allItems.forEach(i => {
                if(i !== item) {
                    i.classList.remove('active');
                }
            });

            // Toggle current item
            item.classList.toggle('active');
        }
    </script>

</body>
</html>