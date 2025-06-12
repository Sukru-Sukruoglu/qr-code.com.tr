<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "QR-CODE.COM.TR - Profesyonel QR Kod Çözümleri";
$baseURL = '/dashboard/qr-code.com.tr';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: #ffffff;
        }

        /* Header - sabit pozisyon */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }

        .logo i {
            font-size: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: #667eea;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline {
            color: #667eea;
            border: 2px solid #667eea;
            background: transparent;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .user-menu {
            position: relative;
            display: inline-block;
        }

        .user-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            padding: 0.5rem 0;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .user-menu:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: block;
            padding: 0.75rem 1.5rem;
            color: #4a5568;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .dropdown-item:hover {
            background: #f7fafc;
            color: #667eea;
        }

        /* Main Content - header yüksekliği kadar margin */
        .main-content {
            margin-top: 80px; /* Header yüksekliği */
            min-height: calc(100vh - 80px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 3rem;
            opacity: 0.9;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 1rem 2rem;
            font-size: 1.1rem;
        }

        .btn-white {
            background: white;
            color: #667eea;
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255,255,255,0.3);
        }

        /* QR Types Section */
        .qr-types {
            padding: 6rem 2rem;
            background: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #718096;
        }

        .category-section {
            margin-bottom: 4rem;
        }

        .category-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .qr-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .qr-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .qr-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .qr-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: white;
        }

        .qr-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.75rem;
        }

        .qr-description {
            color: #718096;
            margin-bottom: 1rem;
        }

        .qr-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .nav-menu {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .qr-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<!-- Ana sayfa içeriği -->
<main class="main-content">
    <!-- Hero section ve diğer içerikler -->
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <h1>QR Kod Çözümlerinin Lideri</h1>
            <p>21 farklı kategoride profesyonel QR kod çözümleri. Hızlı, güvenli ve kolay kullanım.</p>
            
            <div class="hero-buttons">
                <a href="<?php echo $isLoggedIn ? $baseURL . '/qr-olustur' : $baseURL . '/kayit'; ?>" class="btn btn-white btn-hero">
                    <i class="fas fa-rocket"></i>
                    Hemen Başla
                </a>
                <a href="<?php echo $baseURL; ?>/frontend/views/features" class="btn btn-outline btn-hero" style="color: white; border-color: white;">
                    <i class="fas fa-th-large"></i>
                    Özellikleri Keşfet
                </a>
            </div>
        </div>
    </section>

    <!-- QR Types Section -->
    <section class="qr-types">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">📱 Her Duruma Özel QR Çözümleri</h2>
                <p class="section-subtitle">İhtiyacınıza uygun QR kod türünü seçin - 21 farklı kategoride profesyonel çözümler</p>
            </div>

            <!-- En Popüler QR Türleri -->
            <div class="category-section">
                <h3 class="category-title">
                    ⭐ En Popüler QR Türleri
                </h3>
                <div class="qr-grid">
                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/url'">
                        <div class="qr-icon">
                            <i class="fas fa-link"></i>
                        </div>
                        <h4 class="qr-title">URL QR Kodu</h4>
                        <p class="qr-description">Web sitelerine hızlı erişim</p>
                        <span class="qr-badge">En Popüler</span>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/wifi'">
                        <div class="qr-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h4 class="qr-title">Wi-Fi QR Kodu</h4>
                        <p class="qr-description">Wi-Fi ağlarına kolay bağlantı</p>
                        <span class="qr-badge">Çok Kullanılan</span>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/vcard'">
                        <div class="qr-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h4 class="qr-title">vCard QR Kodu</h4>
                        <p class="qr-description">Dijital kartvizit paylaşımı</p>
                        <span class="qr-badge">İş Dünyası</span>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/whatsapp'">
                        <div class="qr-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h4 class="qr-title">WhatsApp QR Kodu</h4>
                        <p class="qr-description">WhatsApp mesaj gönderme</p>
                        <span class="qr-badge">Sosyal</span>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/menu'">
                        <div class="qr-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h4 class="qr-title">Menü QR Kodu</h4>
                        <p class="qr-description">Restoran menüsü paylaşımı</p>
                        <span class="qr-badge">Restoran</span>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/location'">
                        <div class="qr-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4 class="qr-title">Konum QR Kodu</h4>
                        <p class="qr-description">Konum paylaşımı</p>
                        <span class="qr-badge">Navigasyon</span>
                    </div>
                </div>
            </div>

            <!-- İletişim & Medya QR Türleri -->
            <div class="category-section">
                <h3 class="category-title">
                    📋 İletişim & Medya QR Türleri
                </h3>
                <div class="qr-grid">
                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/text'">
                        <div class="qr-icon">
                            <i class="fas fa-file-text"></i>
                        </div>
                        <h4 class="qr-title">Metin QR Kodu</h4>
                        <p class="qr-description">Metinleri QR koda dönüştür</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/email'">
                        <div class="qr-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4 class="qr-title">E-posta QR Kodu</h4>
                        <p class="qr-description">E-posta gönderimi için QR</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/phone'">
                        <div class="qr-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h4 class="qr-title">Telefon QR Kodu</h4>
                        <p class="qr-description">Telefon numarası paylaşımı</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/sms'">
                        <div class="qr-icon">
                            <i class="fas fa-sms"></i>
                        </div>
                        <h4 class="qr-title">SMS QR Kodu</h4>
                        <p class="qr-description">SMS mesajı gönderim</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/pdf'">
                        <div class="qr-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h4 class="qr-title">PDF QR Kodu</h4>
                        <p class="qr-description">PDF dosyası paylaşımı</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/images'">
                        <div class="qr-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <h4 class="qr-title">Görsel QR Kodu</h4>
                        <p class="qr-description">Resim galerisi paylaşımı</p>
                    </div>
                </div>
            </div>

            <!-- Gelişmiş QR Kategorileri -->
            <div class="category-section">
                <h3 class="category-title">
                    🚀 Gelişmiş QR Kategorileri
                </h3>
                
                <!-- Sosyal Medya Alt Kategorisi -->
                <h4 style="font-size: 1.3rem; color: #4a5568; margin: 2rem 0 1rem 0;">Sosyal Medya</h4>
                <div class="qr-grid">
                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/facebook'">
                        <div class="qr-icon">
                            <i class="fab fa-facebook"></i>
                        </div>
                        <h4 class="qr-title">Facebook</h4>
                        <p class="qr-description">Facebook profil paylaşımı</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/instagram'">
                        <div class="qr-icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <h4 class="qr-title">Instagram</h4>
                        <p class="qr-description">Instagram hesap bağlantısı</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/twitter'">
                        <div class="qr-icon">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <h4 class="qr-title">Twitter</h4>
                        <p class="qr-description">Twitter profil linkı</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/linkedin'">
                        <div class="qr-icon">
                            <i class="fab fa-linkedin"></i>
                        </div>
                        <h4 class="qr-title">LinkedIn</h4>
                        <p class="qr-description">LinkedIn profil bağlantısı</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/youtube'">
                        <div class="qr-icon">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <h4 class="qr-title">YouTube</h4>
                        <p class="qr-description">YouTube kanal linkı</p>
                    </div>
                </div>

                <!-- İş & Ticaret Alt Kategorisi -->
                <h4 style="font-size: 1.3rem; color: #4a5568; margin: 2rem 0 1rem 0;">İş & Ticaret</h4>
                <div class="qr-grid">
                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/business'">
                        <div class="qr-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4 class="qr-title">İşletme</h4>
                        <p class="qr-description">İşletme bilgileri</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/coupon'">
                        <div class="qr-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h4 class="qr-title">Kupon</h4>
                        <p class="qr-description">İndirim kuponları</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/app'">
                        <div class="qr-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="qr-title">Uygulama</h4>
                        <p class="qr-description">Mobil uygulama linkı</p>
                    </div>

                    <div class="qr-card" onclick="location.href='<?php echo $baseURL; ?>/qr/social'">
                        <div class="qr-icon">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <h4 class="qr-title">Sosyal Paket</h4>
                        <p class="qr-description">Tüm sosyal medya linkları</p>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div style="text-align: center; margin-top: 4rem;">
                <a href="<?php echo $isLoggedIn ? $baseURL . '/qr-olustur' : $baseURL . '/kayit'; ?>" class="btn btn-primary btn-hero">
                    <i class="fas fa-rocket"></i>
                    Tüm Özellikleri Keşfet
                </a>
            </div>
        </div>
    </section>
</main>

</body>
</html>