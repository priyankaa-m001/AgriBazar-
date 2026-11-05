<?php
// I made this file for the second database, for user accounts.
// I used $pdoAuth here because login and signup use the "farmer" database,
// and the shop (products and orders) uses the other database, db_shopping_cart.
// I kept them separate because that is how I first made the project in college,
// and I did not want to break the login part by merging them now.
// If a page needs both, I include config/db.php first, then this file.

require_once __DIR__ . '/db.php'; // reuses agribazaar_load_env(), loads .env

// $dbAuthName is "farmer" because that database only stores user accounts.
$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbAuthName = getenv('DB_AUTH_NAME') ?: 'farmer';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';
$dbCharset = getenv('DB_CHARSET') ?: 'utf8mb4';

try {
    // I used $pdoAuth, not $pdo, so I do not mix up the accounts database with the shop database.
    $pdoAuth = new PDO(
        "mysql:host={$dbHost};dbname={$dbAuthName};charset={$dbCharset}",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    error_log('AgriBazaar auth DB connection failed: ' . $e->getMessage());
    http_response_code(500);
    die('Database connection failed. Please try again later.');
}
