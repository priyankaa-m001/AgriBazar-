# AgriBazaar 🌾

AgriBazaar is a full-stack e-commerce web application I built for farmers to buy agricultural equipment, seeds, fertilizers, and pesticides online. I developed this project in my second year of college to show my practical skills in PHP and MySQL web development.

> This project runs locally on XAMPP. It is not live on the internet yet, because it needs a PHP + MySQL host. See [Deploy](#deploy) below.

## Screenshots

[AgriBazaar screenshots](https://github.com/priyankaa-m001/AgriBazar-/issues/1#issue-5211392794)

## Features

- **User Authentication** — Registration and login for customers, with passwords saved as hashes, not plain text
- **Product Catalog** — Browse farming equipment, seeds, fertilizers, and pesticides
- **Shopping Cart** — Add, update, and remove items, with real-time cart updates (AJAX)
- **Checkout System** — Complete order flow from cart to order confirmation, with invoice details saved in the database
- **Admin Panel** — Admin login, manage products, and view/delete user accounts
- **Responsive Design** — Custom CSS for a clean, farmer-friendly interface on mobile and desktop

## Tech Stack

- **Frontend:** HTML, CSS, JavaScript, jQuery (AJAX), Bootstrap
- **Backend:** PHP
- **Database:** MySQL (two databases, see below)
- **Environment:** XAMPP (local development)

## How It Works

1. A user signs up on `register.php` or logs in on `indexx.php`. Both forms send their data to `user-account.php`, which checks it and saves the login in `$_SESSION['user']`.
2. `index.php` shows all products from the `products` table. A user opens one product on `view_details.php` and adds it to the cart.
3. The cart is kept in the session by `cart.class.php`, so it does not get empty when the user goes to another page. Qty changes use `ajax_update_cart.php`, so the page does not reload.
4. On `checkout.php`, the user enters delivery details. I save the user, the order, and the order items together in one database transaction, so I do not get a half order if one step fails.
5. `complete.php` shows the order number after the order is placed.

## Project Structure

```
AgriBazaar/
├── try.html               # Home page (start here)
├── index.php              # Farming equipment listing
├── view_details.php       # Single product page + Add to Cart
├── view_cart.php          # Cart page
├── checkout.php           # Delivery details + place order
├── complete.php           # Order placed page
├── indexx.php             # Login page
├── register.php           # Signup page
├── user-account.php       # Handles login and signup (checks + saves)
├── home.php               # My Account page (logged-in users only)
├── logout.php             # Logout
├── admin.php              # Admin login
├── adindex.php            # Admin panel
├── delete.php             # Admin: view/delete user accounts
├── cart.class.php         # Cart logic (add, update, remove, total)
├── ajax_update_cart.php   # AJAX cart qty update, returns JSON
├── config.php             # Loads config/db.php, gives $pdo
├── config/
│   ├── db.php             # Shop database connection ($pdo, db_shopping_cart)
│   └── auth_db.php        # Accounts database connection ($pdoAuth, farmer)
├── db/
│   └── db_shopping_cart.sql # Database schema for products/orders
├── images/                # Product images (1.jpg-20.jpg)
├── .env.example           # Copy to .env and add your own database details
├── DEPLOY.md              # How to put this live on a PHP + MySQL host
└── Dockerfile             # PHP 8.2 + Apache, for Docker hosting
```

I used two databases because that is how I first made the project: `db_shopping_cart` for products, orders, and order details, and `farmer` for user accounts and admin login. `config/db.php` gives me `$pdo` for the shop, and `config/auth_db.php` gives me `$pdoAuth` for accounts. Both use PDO prepared statements, so user input cannot break my SQL.

## Getting Started (Local Setup)

1. Install [XAMPP](https://www.apachefriends.org/) and start Apache + MySQL.
2. Clone this repository into your `htdocs` folder:
   ```bash
   git clone https://github.com/priyankaa-m001/AgriBazar-.git
   ```
3. Copy `.env.example` to `.env` and check the database name, user, and password match your XAMPP setup.
4. In phpMyAdmin, create the two databases and import the schema:
   - `db_shopping_cart` — import `db/db_shopping_cart.sql`
   - `farmer` — create the `users` and `admin_login` tables used by `config/auth_db.php` (see `.env.example` for the names)
5. Visit `http://localhost/AgriBazar-/try.html` in your browser.

## Deploy

See [DEPLOY.md](DEPLOY.md). This is a PHP + MySQL app, so it needs a PHP + MySQL host (for example InfinityFree, free) or a Docker host with a hosted MySQL database. It will not run on GitHub Pages or Vercel as-is.

## Future Improvements

- Add payment gateway integration
- Add product search and filtering
- Use one database instead of two, so the setup is simpler
- Add stock quantity check at checkout, so a user cannot order more than what is left

## Author

**Priyanka Mhaske**
https://github.com/priyankaa-m001
