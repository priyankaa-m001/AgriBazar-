<?php
// I kept this file only because some old pages still write include "config.php".
// I did not want to change all those pages, so this file just loads config/db.php,
// and that file gives me $pdo, my one database connection.
require_once __DIR__ . '/config/db.php';
