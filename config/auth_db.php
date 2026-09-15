<?php
/**
 * Second database connection — for the "accounts" database (admin_login,
 * registered user accounts). This is historically a SEPARATE database
 * from the storefront one (products/orders/checkout), which is why this
 * file is separate from config/db.php rather than merged into it.
 *
 * Exposes $pdoAuth. Include config/db.php first if a page also needs the
 * storefront database ($pdo).
 */

require_once __DIR__ . '/db.php'; // reuses agribazaar_load_env(), loads .env

$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbAuthName = getenv('DB_AUTH_NAME') ?: 'farmer';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';
$dbCharset = getenv('DB_CHARSET') ?: 'utf8mb4';

try {
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
