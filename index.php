<?php
include "config.php";
session_start();

include "cart.class.php";
$cart = new Cart();

$data = [];
$sql = "SELECT * FROM products";
$res = $con->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farming Equipment - AgriBazaar</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #287233;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            position: relative;
        }

        .back-button {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            background-color: white;
            color: #287233;
            padding: 8px 16px;
            border: 1px solid #287233;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #287233;
            color: white;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .equipment-card {
            background: white;
            padding: 15px;
            margin: 10px;
            width: 300px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-radius: 5px;
            transition: transform 0.2s;
        }

        .equipment-card:hover {
            transform: translateY(-5px);
        }

        .equipment-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .equipment-card h3 {
            margin: 10px 0;
            font-size: 20px;
            color: #333;
        }

        .equipment-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .price {
            font-size: 18px;
            color: #287233;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 10px;
        }

        .buttons button {
            background: #287233;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            flex: 1;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .buttons button:hover {
            background: #1f5826;
        }

        .wishlist-btn {
            background-color: #f39c12;
        }

        .wishlist-btn:hover {
            background-color: #e67e22;
        }

        /* Footer Styles */
        .footer {
            background: #1a4628;
            color: #fff;
            padding: 20px 40px;
            margin-top: 40px;
        }

        .features {
            background: #2d7c10;
            display: flex;
            justify-content: space-around;
            padding: 15px;
            text-align: center;
            font-weight: bold;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 20px 0;
        }

        .payments, .branding, .links {
            flex: 1;
            min-width: 250px;
            margin: 10px;
        }

        .links ul {
            list-style: none;
            padding: 0;
        }

        .links li {
            margin: 5px 0;
            cursor: pointer;
        }

        .links li:hover {
            text-decoration: underline;
        }

        .branding h2 {
            font-size: 24px;
            color: #fff;
        }

        .branding span {
            color: #7cc144;
        }

        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 10px;
            text-align: center;
            font-size: 14px;
        }

        .social-icons span {
            margin: 0 10px;
            cursor: pointer;
        }

        .social-icons span:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="header">
        <a href="try.html" class="back-button">← Back to Home</a>
        Farming Equipment
    </div>

    <div class="container">
        <?php foreach ($data as $row): ?>
            <div class="equipment-card">
                <img src="images/<?php echo $row['IMAGE']; ?>" alt="<?php echo $row['PRODUCT']; ?>">
                <h3><?php echo $row['PRODUCT']; ?></h3>
                <p><?php echo $row['DESCRIPTION']; ?></p> <!-- Assuming there's a DESCRIPTION field in the DB -->
                <div class="price">₹<?php echo $row['PRICE']; ?></div>
                <div class="buttons">
                    <button class="wishlist-btn">Add to Wishlist</button>
                    <a href="view_details.php?id=<?php echo $row['PID']; ?>"><button>Buy Now</button></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="features">
            <div>FAST SHIPPING</div>
            <div>BEST QUALITY PRODUCT</div>
            <div>POST DELIVERY SUPPORT</div>
            <div>HUGE SAVINGS</div>
        </div>

        <div class="footer-content">
            <div class="payments">
                <h3>We accept all major payments methods</h3>
                <p>Payments to the website can be made by net banking, credit/debit cards, UPI, and wallets</p>
                <img src="payment-methods.png" alt="Payment Methods" width="200">
            </div>

            <div class="branding">
                <h2>AGRI<span>BAZAAR</span></h2>
                <p>Your trusted platform for farming equipment and products</p>
            </div>

            <div class="links">
                <div>
                    <h4>Quick Links</h4>
                    <ul>
                        <li>About Us</li>
                        <li>Visit Store</li>
                        <li>Contact Us</li>
                        <li>Login / Register</li>
                        <li>Sell With Us</li>
                    </ul>
                </div>
                <div>
                    <h4>Site Links</h4>
                    <ul>
                        <li>Privacy Policy</li>
                        <li>Shipping Details</li>
                        <li>Offers & Coupons</li>
                        <li>FAQ</li>
                        <li>Terms & Conditions</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>Copyright © 2025 | AgriBazaar</p>
            <div class="social-icons">
                <span>YouTube</span>
                <span>Facebook</span>
                <span>Twitter</span>
                <span>Instagram</span>
            </div>
        </div>
    </footer>

</body>
</html>
