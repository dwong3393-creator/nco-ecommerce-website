# N.CO – Clothing E-commerce Website (PHP + MySQL)

A full-stack online clothing store built for a university web development module. Customers can browse the collection, register and log in, add products to a cart that is saved to their account, check out with shipping details, and view their order history.

> This is a PHP + MySQL project, so it can't run on GitHub Pages. Screenshots of every page are below, and the setup steps show how to run it on your own computer.

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

### Shop pages

| Home | Showcase |
|---|---|
| ![Home](screenshots/desktop-home.jpg) | ![Showcase](screenshots/desktop-showcase.jpg) |

| Showcase (page 2) | Product page |
|---|---|
| ![Showcase page 2](screenshots/desktop-showcase-2.jpg) | ![Product page](screenshots/desktop-product.jpg) |

<details>
<summary><b>All 12 product pages</b> (click to expand)</summary>

| Product 2 | Product 3 | Product 4 |
|---|---|---|
| ![Product 2](screenshots/desktop-product-2.jpg) | ![Product 3](screenshots/desktop-product-3.jpg) | ![Product 4](screenshots/desktop-product-4.jpg) |

| Product 5 | Product 6 | Product 7 |
|---|---|---|
| ![Product 5](screenshots/desktop-product-5.jpg) | ![Product 6](screenshots/desktop-product-6.jpg) | ![Product 7](screenshots/desktop-product-7.jpg) |

| Product 8 | Product 9 | Product 10 |
|---|---|---|
| ![Product 8](screenshots/desktop-product-8.jpg) | ![Product 9](screenshots/desktop-product-9.jpg) | ![Product 10](screenshots/desktop-product-10.jpg) |

| Product 11 | Product 12 | |
|---|---|---|
| ![Product 11](screenshots/desktop-product-11.jpg) | ![Product 12](screenshots/desktop-product-12.jpg) | |

</details>

### Cart and checkout

| Cart | Checkout |
|---|---|
| ![Cart](screenshots/desktop-cart.jpg) | ![Checkout](screenshots/desktop-checkout.jpg) |

| Order confirmed | |
|---|---|
| ![Order confirmed](screenshots/desktop-order-confirmed.jpg) | |

### Accounts

| Log in | Register |
|---|---|
| ![Log in](screenshots/desktop-login.jpg) | ![Register](screenshots/desktop-register.jpg) |

| My Account – change password | My Account – order history |
|---|---|
| ![Account security tab](screenshots/desktop-account.jpg) | ![Account orders tab](screenshots/desktop-account-orders.jpg) |

| My Account – shipping address | |
|---|---|
| ![Account address tab](screenshots/desktop-account-address.jpg) | |

### Information pages

| About | FAQ | Contact |
|---|---|---|
| ![About](screenshots/desktop-about.jpg) | ![FAQ](screenshots/desktop-faq.jpg) | ![Contact](screenshots/desktop-contact.jpg) |

### On a phone

| Home | Showcase | Product |
|---|---|---|
| ![Mobile home](screenshots/mobile-home.jpg) | ![Mobile showcase](screenshots/mobile-showcase.jpg) | ![Mobile product](screenshots/mobile-product.jpg) |

| Log in | Cart | My Account |
|---|---|---|
| ![Mobile log in](screenshots/mobile-login.jpg) | ![Mobile cart](screenshots/mobile-cart.jpg) | ![Mobile account](screenshots/mobile-account.jpg) |

*The account, cart and order pages show sample data.*

## Author

**Dickson Wong** · BSc (Hons) Information Technology, Sunway University · [GitHub](https://github.com/dwong3393-creator)
