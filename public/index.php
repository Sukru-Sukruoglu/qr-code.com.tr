<?php
// Bu dosya tüm isteklerin geçtiği ana giriş noktasıdır
session_start();

// Temel yapılandırma
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/backend/config/config.php';
require_once ROOT_PATH . '/backend/utils/helpers.php';

// URL'yi analiz et
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Basit yönlendirici
if ($path == '/' || $path == '/index.php') {
    require_once ROOT_PATH . '/frontend/views/home/index.php';
} elseif (strpos($path, '/dashboard') === 0) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /auth/login.php');
        exit;
    }
    require_once ROOT_PATH . '/frontend/views/dashboard/index.php';
} else {
    require_once ROOT_PATH . '/frontend/views/home/index.php';
}
