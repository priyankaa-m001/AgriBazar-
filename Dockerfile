# AgriBazaar - PHP + Apache, for Docker-based hosts (e.g. Render).
# NOTE: This image does NOT include MySQL. Point DB_HOST / DB_NAME /
# DB_USER / DB_PASS / DB_AUTH_NAME at a hosted MySQL database, and import
# db/db_shopping_cart.sql plus the accounts (farmer) schema into it.
# The app reads credentials from environment variables (see .env.example
# and config/db.php); do not commit a real .env file.
FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql mysqli
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
