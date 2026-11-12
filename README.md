# N.CO – Clothing E-commerce Website (PHP + MySQL)

A full-stack online clothing store built for a university web development module. Customers can browse the collection, register and log in, add products to a cart that is saved to their account, check out with shipping details, and view their order history.

> A static (front-end only) version of the same brand is live at **[dwong3393-creator.github.io/naeo-clothing-website](https://dwong3393-creator.github.io/naeo-clothing-website/)**. This repository is the PHP version with the shopping features, so it needs a PHP server and MySQL to run.

![Home page](screenshots/desktop-home.jpg)

## Features

- **Accounts:** register, log in and log out, change password. Passwords are stored as `password_hash()` hashes.
- **Shopping cart:** add and remove items, empty the cart. When logged in, the cart is saved in the database and restored at the next login.
- **Checkout:** shipping form, and the order plus its items saved in one database transaction.
- **My Account:** order history and the most recent shipping address.
- **Product pages:** 12 products with image galleries, plus showcase, about, FAQ and contact pages.
- **Responsive layout** for laptop, tablet and phone.

## Security

- Every database query uses **prepared statements** (`mysqli_prepare` and `bind_param`).
- Product names and prices come from a **server-side catalogue** (`products.php`). The "Add to cart" link sends only the product id, so prices can't be changed from the URL.
- User input is **escaped** with `htmlspecialchars()` before it is shown on a page.
- The session id is regenerated at login.

## Tech stack

PHP 8 · MySQL / MariaDB · HTML · CSS · JavaScript · SweetAlert2 · Font Awesome · Boxicons

## Run it locally with XAMPP

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL** in the XAMPP Control Panel.
2. Copy this folder into `C:\xampp\htdocs\`, so you have `C:\xampp\htdocs\nco-ecommerce-website\`.
3. Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin), go to the **Import** tab, choose `database.sql` and click **Import**. This creates the `accountdb` database and its tables.
4. Open [http://localhost/nco-ecommerce-website/](http://localhost/nco-ecommerce-website/) in your browser.
5. Register an account, log in, add a few products to the cart and place an order.

The database login is set in `db.php` (XAMPP's default user `root` with no password). Change it there if your MySQL setup is different.

## Database

| Table | What it stores |
|---|---|
| `users` | Customer name, email (unique) and hashed password |
| `cart_items` | Saved cart contents for each logged-in customer |
| `orders` | Each order's shipping details, total and date |
| `order_items` | The products, prices and quantities in each order |

## Project structure

```
├── index.php              Home page (also handles the login/register pop-up)
├── showcase.php, showcase2.php
├── single_product1–12.php Product pages
├── cart.php, cart_action.php, checkout.php, place_order.php
├── login.php, register.php, logout.php, account.php
├── about.php, faq.php, contact.php
├── header.php, footer.php Shared page parts
├── db.php                 Database connection and helper functions
├── products.php           Product catalogue (ids, names, prices, images)
├── database.sql           Database schema to import
├── style.css, script.js
├── Model/, img/, video/   Images and video
└── screenshots/
```

## Screenshots

| Product page | Cart on a phone |
|---|---|
| ![Product page](screenshots/desktop-product.jpg) | ![Mobile cart](screenshots/mobile-cart.jpg) |

## Author

**Dickson Wong** · BSc (Hons) Information Technology, Sunway University · [GitHub](https://github.com/dwong3393-creator)
