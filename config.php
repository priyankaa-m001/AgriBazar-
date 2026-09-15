<?php
/**
 * Legacy entry point kept only so existing `include "config.php";`
 * statements keep working. It now just delegates to the single
 * canonical connection in config/db.php, which exposes $pdo.
 */
require_once __DIR__ . '/config/db.php';
