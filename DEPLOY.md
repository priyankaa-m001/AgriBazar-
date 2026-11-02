# Deploy AgriBazaar live

AgriBazaar is PHP + MySQL, so it cannot run on GitHub Pages or on Vercel
as-is (those serve static sites / serverless functions, not PHP + MySQL).
Use a PHP + MySQL host. The simplest free route is InfinityFree.

## Option A - InfinityFree (recommended for this project)

1. Create a free account at infinityfree.com (your own account - do not share
   its password in chat).
2. Create a hosting account, then in its control panel create TWO MySQL
   databases, e.g. `store` and `accounts` (InfinityFree prefixes the names -
   note the full names it gives you).
3. In phpMyAdmin, import `db/db_shopping_cart.sql` into the store database.
   Import your accounts schema (admin_login / registered users) into the
   accounts database. If you only have the store schema in this repo, export
   the `farmer` database from XAMPP and import that file here.
4. Upload all files from this repo to the `htdocs` folder (File Manager or FTP).
5. Create a `.env` file in `htdocs` (do NOT commit it to GitHub) with the
   values InfinityFree gave you, for example:
   ```
   DB_HOST=sqlXXX.epizy.com
   DB_NAME=<full store database name>
   DB_USER=<full database username>
   DB_PASS=<database password>
   DB_CHARSET=utf8mb4
   DB_AUTH_NAME=<full accounts database name>
   ```
   The app reads these in `config/db.php` / `config/auth_db.php`.
6. Open your site URL. The home page is `try.html`; the equipment listing
   is `index.php`; login/register is `indexx.php`.

## Option B - Docker host (Render / Railway / VPS)

1. Create the hosted MySQL database first and import the schemas as above.
2. Deploy this repo with the included `Dockerfile`.
3. Set the same environment variables as above in the host dashboard.
4. Open the deployed URL and check `try.html` first, then login and checkout.

## Before you deploy - notes

- `try.html` is the home page (almost every page links back to it).
  `index.php` is the farming-equipment listing, `indexx.php` is
  login/register, and `home.php` is the logged-in account page, despite
  the confusing names. Do not rename them without updating the links.
- `index1.php` was an exact duplicate of `index.php` and was removed.
- Product images for the database listings live in `images/` (1.jpg-20.jpg).
  The home-page images used by `try.html` / `agribazar.html` are still in
  the repo root - moving them would need every `src` in those two pages
  updated, so they were left in place for this cleanup.
- The repo is large (about 144 MB, mostly images). Uploads will take a
  while on a slow connection; compressing `home page.jpg` (24 MB) and
  `high quality seeds.jpg` (8.3 MB) would help a lot.
