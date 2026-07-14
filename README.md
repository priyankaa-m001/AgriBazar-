# AgriBazaar 🌾

Agribazar is full-stack e-commerce web application built for farmers to buy agricultural equipment, seeds, fertilizers, and pesticides online. i developed this project in my second year of collage  to demonstrate practical skills in PHP and MySQL-based web development.

## Features

- **User Authentication** — Registration and login system for customers
- **Product Catalog** — Browse categorized products including farming equipment, seeds, fertilizers, and pesticides
- **Shopping Cart** — Add, update, and remove items with real-time cart updates (AJAX)
- **Checkout System** — Complete order flow from cart to order confirmation
- **Admin Panel** — Manage products and view orders
- **Responsive Design** — Custom CSS styling for a clean, farmer-friendly interface

## Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Environment:** XAMPP (local development)

## Project Structure

```
AgriBazaar/
├── index.php              # Homepage
├── register.php           # User registration
├── in.php                 # Login handler
├── logout.php             # Logout handler
├── cart.class.php         # Cart logic
├── ajax_update_cart.php   # AJAX cart updates
├── checkout.php           # Checkout flow
├── complete.php           # Order completion
├── admin.php               # Admin panel
├── connection.php          # Database connection
├── config.php               # App configuration
├── db/
│   └── db_shopping_cart.sql # Database schema
├── images/                  # Product images
└── style.css / mycss.css    # Stylesheets
```

## Getting Started (Local Setup)

1. Install [XAMPP](https://www.apachefriends.org/) and start Apache + MySQL
2. Clone this repository into your `htdocs` folder:
   ```bash
   git clone https://github.com/priyankaa-m001/AgriBazar-.git
   ```
3. Create a MySQL database and import the schema:
   ```
   db/db_shopping_cart.sql
   ```
4. Update database credentials in `config.php` / `connection.php` to match your local setup
5. Visit `http://localhost/AgriBazar-/` in your browser

## Future Improvements

- Add payment gateway integration
- Improve mobile responsiveness
- Add product search and filtering
- Migrate to a more secure authentication system (password hashing improvements)

## Author

**Priyanka Mhaske**
[GitHub](https://github.com/priyankaa-m001)
