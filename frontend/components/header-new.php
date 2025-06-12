<?php
$pageTitle = $pageTitle ?? "QR Kod Oluşturucu | QR-CODE.COM.TR";
$pageClass = $pageClass ?? "";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1a1a1a;
            line-height: 1.6;
            padding-top: 0 !important; /* Reset any conflicting padding */
            margin-top: 0 !important;
        }

        /* Top Bar Styles - FIX: Added !important for positioning */
        .top-bar {
            background: #1a1a1a;
            color: white;
            padding: 0.5rem 0;
            font-size: 0.9rem;
            position: fixed !important; /* FIXED: Added !important */
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 1001 !important;
        }

        /* Header Styles - FIX: Added !important for positioning */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            position: fixed !important; /* FIXED: Added !important */
            top: 0 !important; /* HER SAYFADA TOP: 0 */
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 1000 !important;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
        }

        .logo a {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: #1a1a1a;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-main {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1a1a1a;
        }

        .logo-sub {
            font-size: 0.9rem;
            color: #667eea;
            font-weight: 600;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #4b5563;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .nav-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            padding: 1rem 0;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .nav-dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover, .dropdown-item.active {
            background: #f8fafc;
            color: #667eea;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            justify-content: center;
        }

        .btn-outline {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .mobile-menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #4b5563;
        }

        /* Main Content Container */
        .main-content {
            min-height: calc(100vh - 200px);
        }

        /* Page specific padding */
        .contact-page,
        .qr-generator-page,
        body {
            padding-top: 100px !important; /* Sadece header height */
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                display: none;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .header-content {
                padding: 0.5rem 0;
            }
        }
    </style>
</head>
<body class="<?php echo $pageClass; ?>">

<!-- Header Navigation -->
<header class="header">
    <div class="header-container">
        <div class="header-content">
            <!-- Logo -->
            <div class="logo">
                <a href="<?php echo SITE_URL; ?>">
                    <div class="logo-icon">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">QR-CODE</span>
                        <span class="logo-sub">.COM.TR</span>
                    </div>
                </a>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="nav">
                <div class="nav-links">
                    <a href="<?php echo SITE_URL; ?>" class="nav-link">
                        <i class="fas fa-home"></i>
                        Ana Sayfa
                    </a>
                    <div class="nav-dropdown">
                        <a href="#" class="nav-link dropdown-toggle">
                            <i class="fas fa-plus"></i>
                            QR Oluştur
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?php echo SITE_URL; ?>/qr/url" class="dropdown-item">
                                <i class="fas fa-link"></i>
                                URL QR
                            </a>
                            <a href="<?php echo SITE_URL; ?>/qr/wifi" class="dropdown-item">
                                <i class="fas fa-wifi"></i>
                                WiFi QR
                            </a>
                            <a href="<?php echo SITE_URL; ?>/qr/vcard" class="dropdown-item">
                                <i class="fas fa-id-card"></i>
                                vCard QR
                            </a>
                            <a href="<?php echo SITE_URL; ?>/qr/whatsapp" class="dropdown-item">
                                <i class="fab fa-whatsapp"></i>
                                WhatsApp QR
                            </a>
                            <a href="<?php echo SITE_URL; ?>/qr/email" class="dropdown-item">
                                <i class="fas fa-envelope"></i>
                                E-posta QR
                            </a>
                            <a href="<?php echo SITE_URL; ?>/qr/text" class="dropdown-item">
                                <i class="fas fa-file-text"></i>
                                Metin QR
                            </a>
                        </div>
                    </div>
                    <a href="<?php echo SITE_URL; ?>/hakkimizda" class="nav-link">
                        <i class="fas fa-info-circle"></i>
                        Hakkımızda
                    </a>
                    <a href="<?php echo SITE_URL; ?>/iletisim" class="nav-link">
                        <i class="fas fa-phone"></i>
                        İletişim
                    </a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="auth-buttons">
                    <a href="<?php echo SITE_URL; ?>/giris" class="btn btn-outline">
                        <i class="fas fa-sign-in-alt"></i>
                        Giriş Yap
                    </a>
                    <a href="<?php echo SITE_URL; ?>/kayit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Kayıt Ol
                    </a>
                </div>
            </nav>
            
            <!-- Mobile Menu Toggle -->
            <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
</header>

<div class="main-content">