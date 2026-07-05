# LocalMart BD

LocalMart BD is a Laravel e-commerce platform for local retail businesses in Bangladesh. It supports customer shopping workflows and an admin panel for managing products, orders, payments, inventory, coupons, reviews, customers, and sales reports.

## Features

- Customer registration/login, product browsing, search, category/price filters, cart, wishlist, checkout, order tracking, cancellation before shipping, profile, and reviews after delivery.
- Admin dashboard with sales/order/product/customer/low-stock cards and Chart.js sales chart.
- Category, product, inventory, order, payment, customer, coupon, review, report, and invoice management.
- Bangladesh-focused features: ৳ currency, Cash on Delivery, bKash, Nagad, Card, manual transaction ID, local delivery charges, printable invoice, and low-stock alert.

## Technology Stack

- Laravel 10
- MySQL
- Blade templates
- Bootstrap 5
- JavaScript
- Chart.js

## Installation

1. Install PHP 8.1+, Composer, and MySQL.
2. From this folder, run `composer install`.
3. Copy `.env.example` to `.env`.
4. Create a MySQL database named `localmart_bd`.
5. Update `.env` database username/password.
6. Run `php artisan key:generate`.
7. Run `php artisan migrate --seed`.
8. Run `php artisan storage:link`.
9. Start the app with `php artisan serve`.
10. Open `http://localhost:8000`.

## Login Credentials

Admin:
- Email: `admin@localmartbd.com`
- Password: `password123`

Customer:
- Email: `customer@localmartbd.com`
- Password: `password123`

## Screens and Pages

Customer pages: home, products, product details, cart, wishlist, checkout, order confirmation, my orders, order details, login, register, profile, about, contact.

Admin pages: login, dashboard, categories, products, add/edit product, inventory/low stock, orders, order details, payment records, customers, coupons, reviews, sales report, printable invoice.

## Future Work

- Real bKash/Nagad payment gateway integration
- Mobile app version
- AI-based product recommendation
- Delivery tracking system
- Multi-vendor seller panel
