<?php
// Session kontrolü
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// BaseURL kontrolü
if (!isset($baseURL)) {
    $baseURL = '/dashboard/qr-code.com.tr';
}

// Kullanıcı giriş kontrolü
$isLoggedIn = isset($_SESSION['user_id']);

// Aktif sayfa belirleme
$currentPage = $_SERVER['REQUEST_URI'];
$currentPath = parse_url($currentPage, PHP_URL_PATH);
$basePath = '/dashboard/qr-code.com.tr';
if (strpos($currentPath, $basePath) === 0) {
    $currentPath = substr($currentPath, strlen($basePath));
}
$currentPath = ltrim($currentPath, '/');
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR-CODE.COM.TR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body>

<!-- Header - Ana sayfadaki stil -->
<header class="header">
    <nav class="navbar">
        <a href="<?php echo $baseURL; ?>/" class="logo">
            <i class="fas fa-qrcode"></i>
            <span>QR-CODE.COM.TR</span>
        </a>

        <ul class="nav-menu">
            <li><a href="<?php echo $baseURL; ?>/" class="nav-link">Ana Sayfa</a></li>
            <li><a href="<?php echo $baseURL; ?>/frontend/views/features" class="nav-link">Özellikler</a></li>
            <li><a href="<?php echo $baseURL; ?>/frontend/views/how-to-use" class="nav-link">Nasıl Kullanılır</a></li>
            <li><a href="<?php echo $baseURL; ?>/frontend/views/about" class="nav-link">Hakkımızda</a></li>
            <li><a href="<?php echo $baseURL; ?>/frontend/views/contact" class="nav-link">İletişim</a></li>
        </ul>

        <div class="nav-buttons">
            <?php if ($isLoggedIn): ?>
                <a href="<?php echo $baseURL; ?>/dashboard" class="btn btn-primary">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            <?php else: ?>
                <a href="<?php echo $baseURL; ?>/giris" class="btn btn-outline">
                    <i class="fas fa-sign-in-alt"></i>
                    Giriş Yap
                </a>
                <a href="<?php echo $baseURL; ?>/kayit" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    Kayıt Ol
                </a>
            <?php endif; ?>
        </div>

        <div class="hamburger" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
</header>

<!-- QR Types Section - TÜM KARTLAR BEYAZ BAND STİLİNDE BİRLEŞTİRİLDİ -->
<section class="qr-types">
    <div class="container">
        <div class="section-header">
            <h2>21 Farklı QR Türü ile Her İhtiyacınıza Çözüm</h2>
            <p>Profesyonel QR kod çözümleri ile işinizi dijitalleştirin</p>
        </div>

        <!-- Premium QR Türleri -->
        <div class="premium-qr-section">
            <h3 class="section-subtitle">
                <i class="fas fa-crown"></i>
                Premium QR Türleri
            </h3>
            <div class="premium-qr-grid">
                <div class="type-card-premium facebook">
                    <div class="premium-icon">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <h4>Facebook QR</h4>
                    <p>Facebook sayfanızı veya profilinizi kolayca paylaşın. Takipçi sayınızı artırın.</p>
                    <span class="premium-badge">Premium</span>
                </div>

                <div class="type-card-premium instagram">
                    <div class="premium-icon">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <h4>Instagram QR</h4>
                    <p>Instagram hesabınızı QR kod ile tanıtın. Sosyal medya etkileşiminizi artırın.</p>
                    <span class="premium-badge">Premium</span>
                </div>

                <div class="type-card-premium business">
                    <div class="premium-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h4>Business QR</h4>
                    <p>Şirket bilgilerinizi, iletişim detaylarınızı ve hizmetlerinizi tek QR'da toplayın.</p>
                    <span class="premium-badge">Premium</span>
                </div>

                <div class="type-card-premium coupon">
                    <div class="premium-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <h4>Kupon QR</h4>
                    <p>Dijital kuponlar oluşturun. Müşteri sadakatini artırın ve satışları destekleyin.</p>
                    <span class="premium-badge">Premium</span>
                </div>

                <div class="type-card-premium app">
                    <div class="premium-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>App Store QR</h4>
                    <p>Mobil uygulamanızı App Store ve Google Play'de tanıtın. İndirme sayısını artırın.</p>
                    <span class="premium-badge">Premium</span>
                </div>

                <div class="type-card-premium social-pack">
                    <div class="premium-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h4>Sosyal Medya Paketi</h4>
                    <p>Tüm sosyal medya hesaplarınızı tek QR'da birleştirin. Kapsamlı sosyal varlık.</p>
                    <span class="premium-badge">Premium</span>
                </div>
            </div>
        </div>

        <!-- Standart QR Türleri -->
        <div class="standard-qr-section">
            <h3 class="section-subtitle">
                <i class="fas fa-star"></i>
                Popüler QR Türleri
            </h3>
            <div class="standard-qr-grid">
                <div class="type-card-premium standard-size">
                    <div class="premium-icon">
                        <i class="fas fa-link"></i>
                    </div>
                    <h4>URL QR Kodu</h4>
                    <p>Web sitelerinizi hızlı paylaşım için QR koda dönüştürün.</p>
                </div>

                <div class="type-card-premium standard-size">
                    <div class="premium-icon">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h4>WiFi QR Kodu</h4>
                    <p>Misafirleriniz şifre girmeden WiFi ağınıza bağlansın.</p>
                </div>

                <div class="type-card-premium standard-size">
                    <div class="premium-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h4>vCard QR Kodu</h4>
                    <p>Dijital kartvizit oluşturun. İletişim bilgilerini kolayca paylaşın.</p>
                </div>

                <div class="type-card-premium standard-size twitter">
                    <div class="premium-icon">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <h4>Twitter QR</h4>
                    <p>Twitter profilinizi ve tweetlerinizi QR kod ile paylaşın.</p>
                </div>

                <div class="type-card-premium standard-size linkedin">
                    <div class="premium-icon">
                        <i class="fab fa-linkedin"></i>
                    </div>
                    <h4>LinkedIn QR</h4>
                    <p>Profesyonel ağınızı genişletin. LinkedIn profilinizi paylaşın.</p>
                </div>

                <div class="type-card-premium standard-size youtube">
                    <div class="premium-icon">
                        <i class="fab fa-youtube"></i>
                    </div>
                    <h4>YouTube QR</h4>
                    <p>Video içeriklerinizi ve kanalınızı QR kod ile tanıtın.</p>
                </div>
            </div>
        </div>

        <!-- Kompakt QR Türleri Grupları -->
        <div class="compact-qr-section">
            <!-- İletişim Grubu -->
            <div class="qr-category-group">
                <h4 class="category-title">
                    <i class="fas fa-phone"></i>
                    İletişim QR Türleri
                </h4>
                <div class="compact-qr-grid">
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h4>Telefon QR</h4>
                        <p>Direkt arama başlatın</p>
                    </div>
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4>Email QR</h4>
                        <p>Otomatik email oluşturun</p>
                    </div>
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fas fa-sms"></i>
                        </div>
                        <h4>SMS QR</h4>
                        <p>Hazır mesaj gönderin</p>
                    </div>
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h4>WhatsApp QR</h4>
                        <p>WhatsApp sohbeti başlatın</p>
                    </div>
                </div>
            </div>

            <!-- İş Dünyası Grubu -->
            <div class="qr-category-group">
                <h4 class="category-title">
                    <i class="fas fa-building"></i>
                    İş Dünyası QR Türleri
                </h4>
                <div class="compact-qr-grid">
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h4>Menü QR</h4>
                        <p>Dijital restoran menüsü</p>
                    </div>
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <h4>Etkinlik QR</h4>
                        <p>Takvime etkinlik ekleyin</p>
                    </div>
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h4>PDF QR</h4>
                        <p>Dosyaları direkt indirin</p>
                    </div>
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4>Konum QR</h4>
                        <p>Harita konumu paylaşın</p>
                    </div>
                </div>
            </div>

            <!-- Özel Türler -->
            <div class="qr-category-group">
                <h4 class="category-title">
                    <i class="fas fa-magic"></i>
                    Özel QR Türleri
                </h4>
                <div class="compact-qr-grid">
                    <div class="type-card-premium compact-size">
                        <div class="premium-icon">
                            <i class="fas fa-font"></i>
                        </div>
                        <h4>Metin QR</h4>
                        <p>Düz metin paylaşın</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tüm QR Türlerini Görüntüle CTA -->
        <div class="all-qr-cta">
            <a href="<?php echo $baseURL; ?>/qr-turleri" class="btn-cta-large">
                <i class="fas fa-th-large"></i>
                Tüm 21 QR Türünü Keşfedin
                <small>Detaylı özellikler ve örneklerle</small>
            </a>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Logo ve Açıklama -->
            <div class="footer-section">
                <div class="footer-logo">
                    <i class="fas fa-qrcode"></i>
                    <span>QR-CODE.COM.TR</span>
                </div>
                <p class="footer-description">
                    Türkiye'nin en gelişmiş QR kod platformu. 21 farklı kategoride profesyonel QR kod çözümleri sunuyoruz.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link linkedin">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>

            <!-- QR Türleri -->
            <div class="footer-section">
                <h4 class="footer-title">Popüler QR Türleri</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo $baseURL; ?>/qr/url"><i class="fas fa-link"></i> URL QR Kodu</a></li>
                    <li><a href="<?php echo $baseURL; ?>/qr/wifi"><i class="fas fa-wifi"></i> WiFi QR Kodu</a></li>
                    <li><a href="<?php echo $baseURL; ?>/qr/vcard"><i class="fas fa-id-card"></i> vCard QR Kodu</a></li>
                    <li><a href="<?php echo $baseURL; ?>/qr/whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp QR</a></li>
                    <li><a href="<?php echo $baseURL; ?>/qr/menu"><i class="fas fa-utensils"></i> Menü QR Kodu</a></li>
                </ul>
            </div>

            <!-- Hızlı Linkler -->
            <div class="footer-section">
                <h4 class="footer-title">Hızlı Linkler</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo $baseURL; ?>">Ana Sayfa</a></li>
                    <li><a href="<?php echo $baseURL; ?>/hakkimizda">Hakkımızda</a></li>
                    <li><a href="<?php echo $baseURL; ?>/fiyatlandirma">Fiyatlandırma</a></li>
                    <li><a href="<?php echo $baseURL; ?>/iletisim">İletişim</a></li>
                    <li><a href="<?php echo $baseURL; ?>/qr-turleri">Tüm QR Türleri</a></li>
                </ul>
            </div>

            <!-- Hesap -->
            <div class="footer-section">
                <h4 class="footer-title">Hesap</h4>
                <ul class="footer-links">
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                        <li><a href="<?php echo $baseURL; ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="<?php echo $baseURL; ?>/qr-olustur"><i class="fas fa-plus"></i> QR Oluştur</a></li>
                        <li><a href="<?php echo $baseURL; ?>/profile"><i class="fas fa-user"></i> Profil</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo $baseURL; ?>/giris"><i class="fas fa-sign-in-alt"></i> Giriş Yap</a></li>
                        <li><a href="<?php echo $baseURL; ?>/kayit"><i class="fas fa-user-plus"></i> Kayıt Ol</a></li>
                        <li><a href="<?php echo $baseURL; ?>/sifremi-unuttum">Şifremi Unuttum</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- İletişim -->
            <div class="footer-section">
                <h4 class="footer-title">İletişim</h4>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@qr-code.com.tr</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+90 (212) 555 0123</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>İstanbul, Türkiye</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> QR-CODE.COM.TR. Tüm hakları saklıdır.</p>
                </div>
                <div class="footer-bottom-links">
                    <a href="<?php echo $baseURL; ?>/gizlilik-politikasi">Gizlilik Politikası</a>
                    <a href="<?php echo $baseURL; ?>/kullanim-kosullari">Kullanım Koşulları</a>
                    <a href="<?php echo $baseURL; ?>/cerez-politikasi">Çerez Politikası</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Ana sayfadaki header stilleri */
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
    height: 80px;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
    text-decoration: none;
    transition: all 0.3s ease;
}

.logo:hover {
    color: #667eea;
    text-decoration: none;
    transform: scale(1.05);
}

.logo i {
    font-size: 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.nav-menu {
    display: flex;
    list-style: none;
    gap: 2rem;
    margin: 0;
    padding: 0;
}

.nav-menu li {
    margin: 0;
}

.nav-link {
    text-decoration: none;
    color: #64748b;
    font-weight: 500;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link:hover {
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
    text-decoration: none;
}

.nav-link.active {
    color: #667eea;
    background: rgba(102, 126, 234, 0.15);
    font-weight: 600;
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
    border: none;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    color: white;
    text-decoration: none;
}

.btn-outline {
    background: transparent;
    color: #667eea;
    border: 2px solid #667eea;
}

.btn-outline:hover {
    background: #667eea;
    color: white;
    text-decoration: none;
}

.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    gap: 4px;
}

.hamburger span {
    width: 25px;
    height: 3px;
    background: #667eea;
    border-radius: 2px;
    transition: all 0.3s ease;
}

/* Body - header için padding eklendi */
body {
    margin: 0;
    padding: 80px 0 0 0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: #f8fafc;
    line-height: 1.6;
}

/* QR Types Section - TÜM KARTLAR BEYAZ BAND STİLİNDE BİRLEŞTİRİLDİ */
.qr-types {
    padding: 5rem 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-header h2 {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.section-header p {
    font-size: 1.2rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}

.section-subtitle {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2.5rem;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

/* TÜM KARTLAR İÇİN TEK BİRLEŞİK STİL */
.premium-qr-section, .standard-qr-section {
    margin-bottom: 5rem;
}

.premium-qr-grid, .standard-qr-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.compact-qr-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 2rem;
}

/* ANA KART STİLİ - HERKESTE AYNI */
.type-card-premium {
    background: white;
    border-radius: 24px;
    padding: 2.5rem 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.4s ease;
    border: 3px solid transparent;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

/* BOYUT VARYANTLARı */
.type-card-premium.standard-size {
    padding: 2rem 1.2rem;
}

.type-card-premium.compact-size {
    padding: 1.8rem 1rem;
}

/* ÜST ÇİZGİ EFEKTİ */
.type-card-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.type-card-premium:hover::before {
    transform: scaleX(1);
}

.type-card-premium:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 50px rgba(102, 126, 234, 0.25);
    border-color: rgba(102, 126, 234, 0.2);
}

/* İKON STİLİ */
.premium-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    transition: all 0.4s ease;
}

.compact-size .premium-icon {
    width: 70px;
    height: 70px;
}

.type-card-premium:hover .premium-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.premium-icon i {
    font-size: 2.2rem;
    color: white;
}

.compact-size .premium-icon i {
    font-size: 2rem;
}

/* BAŞLIK VE METİN */
.type-card-premium h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.8rem;
}

.compact-size h4 {
    font-size: 1.1rem;
    margin-bottom: 0.6rem;
}

.type-card-premium p {
    color: #64748b;
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.compact-size p {
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

/* PREMIUM BADGE */
.premium-badge {
    background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-block;
}

/* SOSYAL MEDYA RENK EFEKTLERİ */
.type-card-premium.facebook:hover::before { background: linear-gradient(90deg, #1877f2, #1877f2); }
.type-card-premium.facebook:hover .premium-icon { background: linear-gradient(135deg, #1877f2, #1560d3); }

.type-card-premium.instagram:hover::before { background: linear-gradient(90deg, #e4405f, #fd5949); }
.type-card-premium.instagram:hover .premium-icon { background: linear-gradient(135deg, #e4405f, #fd5949); }

.type-card-premium.twitter:hover::before { background: linear-gradient(90deg, #1da1f2, #0d8bd9); }
.type-card-premium.twitter:hover .premium-icon { background: linear-gradient(135deg, #1da1f2, #0d8bd9); }

.type-card-premium.linkedin:hover::before { background: linear-gradient(90deg, #0077b5, #005885); }
.type-card-premium.linkedin:hover .premium-icon { background: linear-gradient(135deg, #0077b5, #005885); }

.type-card-premium.youtube:hover::before { background: linear-gradient(90deg, #ff0000, #cc0000); }
.type-card-premium.youtube:hover .premium-icon { background: linear-gradient(135deg, #ff0000, #cc0000); }

.type-card-premium.business:hover::before { background: linear-gradient(90deg, #059669, #047857); }
.type-card-premium.business:hover .premium-icon { background: linear-gradient(135deg, #059669, #047857); }

.type-card-premium.coupon:hover::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
.type-card-premium.coupon:hover .premium-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }

.type-card-premium.app:hover::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
.type-card-premium.app:hover .premium-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.type-card-premium.social-pack:hover::before { background: linear-gradient(90deg, #ec4899, #db2777); }
.type-card-premium.social-pack:hover .premium-icon { background: linear-gradient(135deg, #ec4899, #db2777); }

/* KATEGORİ GRUPLARı */
.compact-qr-section {
    background: white;
    border-radius: 30px;
    padding: 4rem 3rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    margin-bottom: 4rem;
}

.qr-category-group {
    margin-bottom: 3rem;
}

.qr-category-group:last-child {
    margin-bottom: 0;
}

.category-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.category-title i {
    color: #667eea;
}

/* CTA BUTTON */
.all-qr-cta {
    text-align: center;
    margin-top: 3rem;
}

.btn-cta-large {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 2rem 4rem;
    border-radius: 25px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.4s ease;
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    flex-direction: column;
    text-decoration: none;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-cta-large:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

.btn-cta-large i {
    font-size: 1.5rem;
}

.btn-cta-large small {
    font-size: 0.9rem;
    opacity: 0.9;
    font-weight: 500;
}

/* Footer Styles - Güncellenmiş */
.footer {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: white;
    padding: 3rem 0 0;
    margin-top: 4rem;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1.2fr;
    gap: 2rem;
    margin-bottom: 2rem;
    align-items: start;
}

.footer-section {
    min-height: 200px;
}

.footer-section h4.footer-title {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 1.2rem;
    color: #f1f5f9;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.4rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 1rem;
}

.footer-logo i {
    font-size: 1.8rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.footer-description {
    color: #cbd5e1;
    line-height: 1.5;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.social-links {
    display: flex;
    gap: 0.8rem;
}

.social-link {
    width: 36px;
    height: 36px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.social-link:hover {
    transform: translateY(-2px);
    color: white;
}

.social-link.facebook:hover { background: #1877f2; }
.social-link.twitter:hover { background: #1da1f2; }
.social-link.instagram:hover { background: linear-gradient(45deg, #e4405f, #fd5949); }
.social-link.linkedin:hover { background: #0077b5; }

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 0.6rem;
}

.footer-links a {
    color: #cbd5e1;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: color 0.3s ease;
    font-size: 0.9rem;
}

.footer-links a:hover {
    color: #667eea;
}

.footer-links i {
    font-size: 0.8rem;
    width: 14px;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #cbd5e1;
    font-size: 0.9rem;
}

.contact-item i {
    color: #667eea;
    width: 16px;
    font-size: 0.9rem;
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding: 1.5rem 0;
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.copyright p {
    color: #94a3b8;
    font-size: 0.85rem;
    margin: 0;
}

.footer-bottom-links {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.footer-bottom-links a {
    color: #94a3b8;
    text-decoration: none;
    font-size: 0.85rem;
    transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #667eea;
}

/* RESPONSIVE DESIGN - Mobile Menu */
@media (max-width: 968px) {
    .navbar {
        padding: 1rem;
    }

    .nav-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        flex-direction: column;
        padding: 2rem;
        border-top: 1px solid rgba(102, 126, 234, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        gap: 0;
    }

    .nav-menu.mobile-active {
        display: flex;
    }

    .nav-menu li {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .nav-link {
        display: block;
        width: 100%;
        text-align: center;
        padding: 1rem;
    }

    .nav-buttons {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        flex-direction: column;
        padding: 1rem 2rem 2rem;
        border-top: 1px solid rgba(102, 126, 234, 0.1);
        gap: 1rem;
    }

    .nav-buttons.mobile-active {
        display: flex;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }

    .hamburger {
        display: flex;
    }

    .hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(6px, 6px);
    }

    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(6px, -6px);
    }

    .logo span {
        display: none;
    }

    .premium-qr-grid, .standard-qr-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .compact-qr-grid {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.2rem;
    }
    
    .section-header h2 {
        font-size: 2rem;
    }
    
    .section-subtitle {
        font-size: 1.5rem;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .type-card-premium {
        padding: 2rem 1.2rem;
    }
    
    .compact-qr-section {
        padding: 3rem 2rem;
    }
    
    .btn-cta-large {
        padding: 1.5rem 3rem;
        font-size: 1.1rem;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .footer-section {
        min-height: auto;
    }
}

@media (max-width: 480px) {
    .navbar {
        height: 70px;
    }

    .logo {
        font-size: 1.3rem;
    }

    .logo i {
        font-size: 1.8rem;
    }

    body {
        padding-top: 70px;
    }

    .compact-qr-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header h2 {
        font-size: 1.8rem;
    }
    
    .premium-icon {
        width: 70px;
        height: 70px;
    }
    
    .premium-icon i {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .compact-qr-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header h2 {
        font-size: 1.8rem;
    }
    
    .premium-icon {
        width: 70px;
        height: 70px;
    }
    
    .premium-icon i {
        font-size: 2rem;
    }
}
</style>

<script>
<script>
// Mobile Menu Toggle
function toggleMobileMenu() {
    const navMenu = document.querySelector('.nav-menu');
    const navButtons = document.querySelector('.nav-buttons');
    const hamburger = document.querySelector('.hamburger');
    
    navMenu.classList.toggle('mobile-active');
    navButtons.classList.toggle('mobile-active');
    hamburger.classList.toggle('active');
}

// Mobile link'e tıklandığında menüyü kapat
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link, .btn');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            const navMenu = document.querySelector('.nav-menu');
            const navButtons = document.querySelector('.nav-buttons');
            const hamburger = document.querySelector('.hamburger');
            
            if (navMenu.classList.contains('mobile-active')) {
                navMenu.classList.remove('mobile-active');
                navButtons.classList.remove('mobile-active');
                hamburger.classList.remove('active');
            }
        });
    });

    // Sayfa yüklendiğinde aktif menüyü belirle
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        const linkPath = new URL(link.href).pathname;
        
        if (currentPath === linkPath || 
            (currentPath.includes('features') && link.textContent.includes('Özellikler')) ||
            (currentPath.includes('about') && link.textContent.includes('Hakkımızda')) ||
            (currentPath.includes('contact') && link.textContent.includes('İletişim')) ||
            (currentPath.includes('how-to-use') && link.textContent.includes('Nasıl'))) {
            link.classList.add('active');
        }
    });

    console.log('✨ Header\'lı QR Cards interface loaded');
    
    // Card hover effects with enhanced animations
    const typeCards = document.querySelectorAll('.type-card-premium');
    typeCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
        
        // Click effect
        card.addEventListener('click', function() {
            this.style.transform = 'translateY(-8px) scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'translateY(-12px) scale(1.02)';
            }, 150);
        });
    });
    
    // Smooth scroll to sections
    const sectionLinks = document.querySelectorAll('a[href^="#"]');
    sectionLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }
        });
    });
});
</script>

</body>
</html>