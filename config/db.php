<?php
// I made this file so I have only one database connection for the whole project.
// I used $pdo here because every page needs the same connection, and PDO lets me
// use prepared statements, so user input cannot break my SQL query.
// I kept the password and database name in a .env file, not in this code,
// because I do not want my real database details to go on GitHub.

if (!function_exists('agribazaar_load_env')) {
    function agribazaar_load_env(string $path): void
    {
        if (!is_readable($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            $parts = explode('=', $line, 2);
            if (count($parts) !== 2) {
                continue;
            }

            $key = trim($parts[0]);
            $value = trim($parts[1], " \t\n\r\0\x0B\"'");

            if ($key !== '' && getenv($key) === false) {
                putenv("{$key}={$value}");
            }
        }
    }
}

// I load the .env file from the project root (one folder up from /config).
agribazaar_load_env(__DIR__ . '/../.env');

// I used these variables so I can change the database name or password in one place.
// $dbHost is localhost on XAMPP, $dbName is db_shopping_cart for products and orders.
$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbName = getenv('DB_NAME') ?: 'db_shopping_cart';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';
$dbCharset = getenv('DB_CHARSET') ?: 'utf8mb4';

try {
    // I used PDO here because it works the same for MySQL and it supports prepared statements.
    $pdo = new PDO(
        "mysql:host={$dbHost};dbname={$dbName};charset={$dbCharset}",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    // I do not show the real error to the user, because it can show my database details.
    // I only save it in the error log and show a simple message.
    error_log('AgriBazaar DB connection failed: ' . $e->getMessage());
    http_response_code(500);
    die('Database connection failed. Please try again later.');
}
