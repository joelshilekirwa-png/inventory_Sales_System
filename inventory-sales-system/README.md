# Inventory & Sales Management System

A PHP + MySQL inventory and sales training project with an AdminLTE 3.2 interface.

## Features
- Session-based administrator login
- Dashboard metrics and low-stock alerts
- Product and category CRUD
- Customer CRUD
- Multi-item sales with stock validation and transactional stock reduction
- Printable invoice view
- Date-filtered sales report and top-selling products
- Prepared SQL statements, password hashing, CSRF tokens, output escaping

## Run locally
1. Copy this folder to `C:\xampp\htdocs\inventory_sales`.
2. Start Apache and MySQL in XAMPP.
3. Visit `http://localhost/inventory_sales/setup.php`.
4. Login using `admin` / `Admin@123`.
5. Remove `setup.php` after successful installation.

Default database settings are in `config/database.php`; setup credentials are at the top of `setup.php`.

**AdminLTE vendor CSS/JS are loaded from CDN**, so internet is required for the full AdminLTE appearance. The PHP application and database run locally.
