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
        /* Existing styles (same as your provided styles) */
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
