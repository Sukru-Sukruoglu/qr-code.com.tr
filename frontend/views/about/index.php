<?php
// Session kontrolü
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Hakkımızda | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';

// Kullanıcı girişi varsa dashboard layout, yoksa public layout
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #2d3748;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
            font-family: 'Orbitron', monospace;
        }

        .logo i {
            font-size: 2rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav a {
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav a:hover {
            color: #667eea;
        }

        .nav a.active {
            color: #667eea;
            font-weight: 600;
        }

        .nav a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 2px;
            background: #667eea;
            border-radius: 1px;
        }

        .mobile-menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #374151;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
            text-align: center;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: #667eea;
            border-color: #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 2rem 0;
        }

        /* Navigation Breadcrumb */
        .nav-breadcrumb {
            margin-bottom: 2rem;
            padding: 1rem 2rem;
            background: rgba(255,255,255,0.7);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .breadcrumb {
            color: #718096;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Header Section */
        .page-header {
            text-align: center;
            margin-bottom: 4rem;
            padding: 3rem 0;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
            animation: shimmer 3s linear infinite;
        }

        .header-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            font-family: 'Orbitron', monospace;
        }

        .qr-pattern-header {
            width: 80px;
            height: 80px;
            background: radial-gradient(circle, #001122 0%, #000000 100%);
            border-radius: 16px;
            position: relative;
            box-shadow: 0 0 30px rgba(0, 123, 255, 0.3);
        }

        .qr-pattern-header::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #007bff, #00d4ff, #007bff);
            border-radius: 18px;
            z-index: -1;
            animation: borderGlow 3s linear infinite;
        }

        .qr-pattern-header::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, #00d4ff 0%, #007bff 70%);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.6);
            animation: pulse 2s ease-in-out infinite;
        }

        .header-title {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(45deg, #00d4ff 0%, #ffffff 50%, #007bff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            font-family: 'Orbitron', monospace;
        }

        .header-subtitle {
            font-size: 1.3rem;
            color: #4a5568;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .header-tagline {
            font-size: 1rem;
            color: #667eea;
            font-weight: 600;
            font-style: italic;
        }

        /* Experience Stats */
        .experience-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 2rem 0 4rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            font-family: 'Orbitron', monospace;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Content Sections */
        .content-section {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            padding: 3rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-title i {
            color: #667eea;
            font-size: 1.5rem;
        }

        .section-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #4a5568;
        }

        .section-content p {
            margin-bottom: 1.5rem;
        }

        .section-content strong {
            color: #2d3748;
            font-weight: 600;
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .feature-card {
            background: rgba(255,255,255,0.7);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: #4a5568;
            line-height: 1.6;
        }

        /* Target Audience */
        .audience-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .audience-card {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 16px;
            padding: 2rem;
            border: 2px solid rgba(102, 126, 234, 0.2);
            transition: all 0.3s ease;
        }

        .audience-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .audience-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .audience-title i {
            color: #667eea;
        }

        .audience-list {
            list-style: none;
            padding: 0;
        }

        .audience-list li {
            padding: 0.5rem 0;
            color: #4a5568;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .audience-list li::before {
            content: '✨';
            font-size: 0.9rem;
        }

        /* Why Choose Us */
        .why-choose-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .why-item {
            text-align: center;
            padding: 2rem 1rem;
            background: rgba(255,255,255,0.7);
            border-radius: 16px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .why-item:hover {
            border-color: #667eea;
            transform: translateY(-3px);
        }

        .why-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .why-description {
            font-size: 0.95rem;
            color: #4a5568;
            line-height: 1.5;
        }

        /* Contact CTA */
        .contact-cta {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 3rem;
            border-radius: 24px;
            margin-top: 3rem;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .cta-button:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        /* Footer Styles */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #667eea;
        }

        .footer-section p {
            opacity: 0.8;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #667eea;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: #374151;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #667eea;
            transform: translateY(-2px);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .contact-item i {
            color: #667eea;
            width: 20px;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 2rem;
            text-align: center;
            opacity: 0.8;
        }

        /* Animations */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes borderGlow {
            0%, 100% { background: linear-gradient(45deg, #007bff, #00d4ff, #007bff); }
            33% { background: linear-gradient(45deg, #00d4ff, #ffffff, #00d4ff); }
            66% { background: linear-gradient(45deg, #ffffff, #007bff, #ffffff); }
        }

        @keyframes pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
            50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .header-title {
                font-size: 2rem;
            }

            .header-subtitle {
                font-size: 1.1rem;
            }

            .content-section {
                padding: 2rem;
            }

            .section-title {
                font-size: 1.5rem;
                flex-direction: column;
                gap: 0.5rem;
            }

            .experience-stats {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }

            .stat-item {
                padding: 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .qr-pattern-header {
                width: 60px;
                height: 60px;
            }

            .qr-pattern-header::after {
                width: 30px;
                height: 30px;
            }

            .main-content {
                padding: 1rem 0;
            }

            .nav-breadcrumb {
                padding: 1rem;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-qrcode"></i>
                <span>QR-CODE.COM.TR</span>
            </div>
            
            <nav class="nav">
                <a href="<?php echo $baseURL; ?>/">Ana Sayfa</a>
                <a href="<?php echo $baseURL; ?>/pages/features">Özellikler</a>
                <a href="<?php echo $baseURL; ?>/pages/how-to-use">Nasıl Kullanılır</a>
                <a href="<?php echo $baseURL; ?>/pages/about" class="active">Hakkımızda</a>
                <a href="<?php echo $baseURL; ?>/frontend/views/contact">İletişim</a>
                <?php if ($isLoggedIn): ?>
                    <a href="<?php echo $baseURL; ?>/dashboard" class="btn btn-primary">Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo $baseURL; ?>/giris" class="btn btn-outline">Giriş Yap</a>
                    <a href="<?php echo $baseURL; ?>/kayit" class="btn btn-primary">Kayıt Ol</a>
                <?php endif; ?>
            </nav>

            <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
</header>

<div class="main-content">
    <div class="container">
        <!-- Navigation Breadcrumb -->
        <div class="nav-breadcrumb">
            <div class="breadcrumb">
                <a href="<?php echo $baseURL; ?>"><i class="fas fa-home"></i> Ana Sayfa</a>
                <i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i>
                <span>Hakkımızda</span>
            </div>
        </div>

        <!-- Header -->
        <div class="page-header">
            <div class="header-logo">
                <div class="qr-pattern-header"></div>
                <h1 class="header-title">QR-CODE.COM.TR</h1>
            </div>
            <h2 class="header-subtitle">Dijital Dünyaya Açılan Kapınız</h2>
            <p class="header-tagline">2006 yılından bu yana teknoloji alanında hizmet</p>
        </div>

        <!-- Experience Stats -->
        <div class="experience-stats">
            <div class="stat-item">
                <div class="stat-number">18</div>
                <div class="stat-label">Yıl Deneyim</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">21</div>
                <div class="stat-label">QR Türü</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">∞</div>
                <div class="stat-label">Sınırsız QR</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">7/24</div>
                <div class="stat-label">Destek</div>
            </div>
        </div>

        <!-- Vision Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-eye"></i>
                Vizyonumuz
            </h2>
            <div class="section-content">
                <p>QR kod teknolojisini sadece bir araç olarak değil, <strong>işletmelerin dijital dönüşümünün</strong> ve <strong>günlük hayatın kolaylaştırılmasının</strong> bir parçası olarak görüyoruz. Her QR kod, fiziksel ve dijital dünya arasında kurulan bir köprüdür.</p>
            </div>
        </div>

        <!-- Experience Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-trophy"></i>
                Deneyimimiz ve Uzmanlığımız
            </h2>
            <div class="section-content">
                <p><strong>2006 yılından bu yana</strong> teknoloji alanında edindiğimiz deneyim ve uzmanlığımızla, QR kod teknolojisinin gücünü herkesin kullanımına sunmak üzere <strong>QR-CODE.COM.TR</strong> projesini hayata geçirdik.</p>
                
                <p>Ana firmamız olarak yıllardır <strong>toplantı ve etkinlik teknolojileri</strong>, <strong>kablosuz oylama sistemleri</strong> ve <strong>interaktif çözümler</strong> geliştiren deneyimli ekibimiz, artık bu birikimini QR kod dünyasına taşıyarak sizlere en gelişmiş QR kod çözümlerini sunuyor.</p>

                <h3 style="color: #667eea; margin: 2rem 0 1rem 0;">Ana Firmamızın Uzmanlık Alanları:</h3>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-poll"></i>
                        </div>
                        <div class="feature-title">Kablosuz Oylama Sistemleri</div>
                        <div class="feature-description">İnteraktif oylama ve geri bildirim çözümleri</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <div class="feature-title">İnteraktif Toplantı Çözümleri</div>
                        <div class="feature-description">Akıllı toplantı ve sunum teknolojileri</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="feature-title">Mobil Etkinlik Uygulamaları</div>
                        <div class="feature-description">Etkinlik yönetimi ve katılımcı deneyimi</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="feature-title">Özel Yazılım Geliştirme</div>
                        <div class="feature-description">İhtiyaçlara özel teknolojik çözümler</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Features Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-qrcode"></i>
                QR-CODE.COM.TR Özellikleri
            </h2>
            <div class="section-content">
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="feature-title">Kapsamlı QR Çözümleri</div>
                        <div class="feature-description">
                            <strong>21 farklı QR türü</strong> desteği<br>
                            Sınırsız QR kod oluşturma<br>
                            Dinamik QR kod yönetimi<br>
                            Analitik ve raporlama
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div class="feature-title">Profesyonel Tasarım</div>
                        <div class="feature-description">
                            Özelleştirilebilir QR kodlar<br>
                            Logo ekleme özelliği<br>
                            Yüksek çözünürlük çıktılar<br>
                            Baskıya hazır formatlar
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="feature-title">İş Odaklı Çözümler</div>
                        <div class="feature-description">
                            Toplu QR kod oluşturma<br>
                            API entegrasyonu desteği<br>
                            Kurumsal hesap yönetimi<br>
                            Özel geliştirme hizmetleri
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Target Audience Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-users"></i>
                Kimler İçin?
            </h2>
            <div class="section-content">
                <div class="audience-grid">
                    <div class="audience-card">
                        <div class="audience-title">
                            <i class="fas fa-user"></i>
                            Bireysel Kullanıcılar
                        </div>
                        <ul class="audience-list">
                            <li>Sosyal medya paylaşımları</li>
                            <li>Kişisel kartvizitler</li>
                            <li>Etkinlik davetiyeleri</li>
                            <li>WiFi paylaşımı</li>
                        </ul>
                    </div>
                    <div class="audience-card">
                        <div class="audience-title">
                            <i class="fas fa-building"></i>
                            İşletmeler
                        </div>
                        <ul class="audience-list">
                            <li>Dijital menüler</li>
                            <li>Ürün bilgi paylaşımı</li>
                            <li>Pazarlama kampanyaları</li>
                            <li>Müşteri geri bildirimleri</li>
                        </ul>
                    </div>
                    <div class="audience-card">
                        <div class="audience-title">
                            <i class="fas fa-calendar-alt"></i>
                            Etkinlik Organizatörleri
                        </div>
                        <ul class="audience-list">
                            <li><strong>Ana uzmanlık alanımız!</strong></li>
                            <li>Etkinlik check-in sistemleri</li>
                            <li>Anında geri bildirim toplama</li>
                            <li>İnteraktif sunumlar</li>
                        </ul>
                    </div>
                    <div class="audience-card">
                        <div class="audience-title">
                            <i class="fas fa-graduation-cap"></i>
                            Eğitim Kurumları
                        </div>
                        <ul class="audience-list">
                            <li>Ödev ve proje paylaşımı</li>
                            <li>Online kaynak erişimi</li>
                            <li>Sınav ve değerlendirme</li>
                            <li>Kampüs bilgi paylaşımı</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-shield-alt"></i>
                Güvenlik ve Kalite
            </h2>
            <div class="section-content">
                <p><strong>18 yıllık deneyimimizle</strong> geliştirdiğimiz güvenlik standartları:</p>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="feature-title">SSL Şifreleme</div>
                        <div class="feature-description">Güvenli veri iletimi</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="feature-title">GDPR Uyumlu</div>
                        <div class="feature-description">Veri koruma standartları</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-server"></i>
                        </div>
                        <div class="feature-title">Yüksek Performans</div>
                        <div class="feature-description">Güçlü sunucu altyapısı</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="feature-title">7/24 Destek</div>
                        <div class="feature-description">Sürekli sistem izleme</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-star"></i>
                Neden QR-CODE.COM.TR?
            </h2>
            <div class="section-content">
                <div class="why-choose-grid">
                    <div class="why-item">
                        <div class="why-title">Deneyim</div>
                        <div class="why-description">2006'dan bu yana teknoloji sektöründe kazandığımız deneyim</div>
                    </div>
                    <div class="why-item">
                        <div class="why-title">Uzmanlık</div>
                        <div class="why-description">Etkinlik ve interaktif sistemlerdeki uzmanlığımızı QR teknolojisine aktardık</div>
                    </div>
                    <div class="why-item">
                        <div class="why-title">Güvenilirlik</div>
                        <div class="why-description">Yıllardır büyük kurumsal projelerde kanıtladığımız güvenilirlik</div>
                    </div>
                    <div class="why-item">
                        <div class="why-title">İnovasyon</div>
                        <div class="why-description">Sürekli güncellenen ürün ve hizmetlerimizle teknolojik gelişmeleri takip ediyoruz</div>
                    </div>
                    <div class="why-item">
                        <div class="why-title">Destek</div>
                        <div class="why-description">Proje planlamasından uygulamaya kadar her aşamada yanınızdayız</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Goals Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-bullseye"></i>
                Hedefimiz
            </h2>
            <div class="section-content">
                <p><strong>QR-CODE.COM.TR</strong> ile amacımız, QR kod teknolojisini Türkiye'de daha yaygın ve etkili kullanılmasını sağlamak. Ana firmamızın <strong>toplantı ve etkinlik teknolojilerindeki</strong> başarısını, QR kod dünyasına taşıyarak:</p>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-digital-tachograph"></i>
                        </div>
                        <div class="feature-title">Dijital Dönüşüm</div>
                        <div class="feature-description">İşletmelerin dijital dönüşümüne katkıda bulunmak</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-smile"></i>
                        </div>
                        <div class="feature-title">Kullanıcı Dostu</div>
                        <div class="feature-description">Herkesin kolayca kullanabileceği çözümler sunmak</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div class="feature-title">Yenilikçi Teknoloji</div>
                        <div class="feature-description">En güncel teknolojilerle çözümler geliştirmek</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="feature-title">Müşteri Memnuniyeti</div>
                        <div class="feature-description">Müşteri memnuniyetini en üst seviyede tutmak</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="contact-cta">
            <h2 class="cta-title">İletişim</h2>
            <p class="cta-description">
                Sorularınız, özel projeleriniz veya kurumsal çözüm ihtiyaçlarınız için bizimle iletişime geçin. 
                <strong>18 yıllık tecrübemiz</strong> ve <strong>uzman ekibimizle</strong> projenizin başarısı için buradayız.
            </p>
            <a href="<?php echo $baseURL; ?>/iletisim" class="cta-button">
                <i class="fas fa-envelope"></i>
                İletişime Geçin
            </a>
        </div>

        <!-- Footer Info -->
        <div style="text-align: center; margin-top: 3rem; padding: 2rem; color: #718096; font-style: italic;">
            <p><strong>QR-CODE.COM.TR</strong> - <em>Fiziksel ve dijital dünya arasındaki köprü</em></p>
            <p style="margin-top: 1rem; font-size: 0.9rem;">2006 yılından bu yana teknoloji alanında hizmet veren deneyimli ekibimizin bir projesidir.</p>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('✨ Hakkımızda sayfası yüklendi');
    
    // Mobile menu toggle
    window.toggleMobileMenu = function() {
        const nav = document.querySelector('.nav');
        nav.classList.toggle('mobile-open');
    };
    
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Animate content sections
    const contentSections = document.querySelectorAll('.content-section');
    contentSections.forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(section);
    });
    
    // Counter animation for stats
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const finalValue = stat.textContent;
        if (finalValue !== '∞' && finalValue !== '7/24') {
            stat.textContent = '0';
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateNumber(stat, parseInt(finalValue));
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            observer.observe(stat);
        }
    });
});

function animateNumber(element, target) {
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 40);
}
</script>

</body>
</html>