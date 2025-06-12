<?php
// Site yapılandırması
define('SITE_NAME', 'QR-CODE.COM.TR');
define('SITE_EMAIL', 'info@qr-code.com.tr');

// Veritabanı yapılandırması
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'qr_code_db');

// Hata raporlama
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Zaman dilimi
date_default_timezone_set('Europe/Istanbul');