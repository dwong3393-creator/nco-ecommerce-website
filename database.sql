-- N.CO e-commerce website: database schema
-- Import this file in phpMyAdmin (XAMPP) using the Import tab.
-- It creates the "accountdb" database used by db.php.

CREATE DATABASE IF NOT EXISTS accountdb
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE accountdb;

-- Registered customers (passwords are stored as password_hash() hashes)
CREATE TABLE IF NOT EXISTS users (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  full_name  VARCHAR(100) NOT NULL,
  email      VARCHAR(255) NOT NULL UNIQUE,
  password   VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Saved shopping carts for logged-in customers
CREATE TABLE IF NOT EXISTS cart_items (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  user_id    INT NOT NULL,
  product_id INT NOT NULL,
  name       VARCHAR(150) NOT NULL,
  price      DECIMAL(10,2) NOT NULL,
  image      VARCHAR(255) NOT NULL,
  quantity   INT NOT NULL DEFAULT 1,
  UNIQUE KEY uniq_user_product (user_id, product_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Placed orders with the shipping details entered at checkout
CREATE TABLE IF NOT EXISTS orders (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  user_id     INT NOT NULL,
  name        VARCHAR(100) NOT NULL,
  email       VARCHAR(255) NOT NULL,
  phone       VARCHAR(30)  NOT NULL,
  address     VARCHAR(255) NOT NULL,
  city        VARCHAR(100) NOT NULL,
  state       VARCHAR(100) NOT NULL,
  postcode    VARCHAR(20)  NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  order_date  DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Products in each order
CREATE TABLE IF NOT EXISTS order_items (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  order_id     INT NOT NULL,
  product_id   INT NOT NULL,
  product_name VARCHAR(150) NOT NULL,
  price        DECIMAL(10,2) NOT NULL,
  quantity     INT NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
) ENGINE=InnoDB;
