<?php
// Header bileşeni - Sayfa başlığı ve navigasyon
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'QR Code Generator'; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/frontend/assets/css/main.css">
    <?php if (isset($pageStylesheet)): ?>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/frontend/assets/css/<?php echo $pageStylesheet; ?>.css">
    <?php endif; ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="<?php echo $pageClass ?? ''; ?>">

<header class="main-header">
    <div class="container">
        <div class="logo">
            <a href="<?php echo SITE_URL; ?>">
                <h1>QR-CODE.COM.TR</h1>
            </a>
        </div>
        
        <nav class="main-nav">
            <ul>
                <li><a href="<?php echo SITE_URL; ?>/qr-generator/url">URL QR</a></li>
                <li><a href="<?php echo SITE_URL; ?>/qr-generator/text">Metin QR</a></li>
                <li><a href="<?php echo SITE_URL; ?>/qr-generator/wifi">WiFi QR</a></li>
                <li><a href="<?php echo SITE_URL; ?>/pricing">Fiyatlandırma</a></li>
                <li><a href="<?php echo SITE_URL; ?>/contact">İletişim</a></li>
            </ul>
        </nav>
        
        <div class="user-actions">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="<?php echo SITE_URL; ?>/dashboard" class="btn btn-primary">
                    <i class="fas fa-tachometer-alt"></i> Panelim
                </a>
            <?php else: ?>
                <a href="<?php echo SITE_URL; ?>/auth/login" class="btn btn-outline">Giriş</a>
                <a href="<?php echo SITE_URL; ?>/auth/register" class="btn btn-primary">Kayıt Ol</a>
            <?php endif; ?>
        </div>
        
        <div class="mobile-menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>