<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', __DIR__);
define('SITE_URL', 'http://localhost/dashboard/qr-code.com.tr');

// Base URL tanımlaması
$baseURL = '/dashboard/qr-code.com.tr';

// URL'yi parse et
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Base path'i çıkar
$basePath = '/dashboard/qr-code.com.tr';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

// Başlangıçtaki / işaretini kaldır
$path = ltrim($path, '/');

// Debug log - API çağrılarında da görebilmek için
if (strpos($path, 'api/') === 0) {
    error_log("🔧 API Debug - Request URI: $request");
    error_log("🔧 API Debug - Parsed Path: $path");
    error_log("🔧 API Debug - Method: " . $_SERVER['REQUEST_METHOD']);
    error_log("🔧 API Debug - POST Data: " . print_r($_POST, true));
}

// Route'ları tanımla
$routes = [
    // Ana sayfalar (public) - GÜNCELLENMİŞ LINKLER
    '' => 'frontend/views/home/index.php',
    'frontend/views/features' => 'frontend/views/features/index.php',
    'frontend/views/how-to-use' => 'frontend/views/how-to-use/index.php',
    'frontend/views/about' => 'frontend/views/about/index.php',
    'frontend/views/contact' => 'frontend/views/contact/index.php',
    
    // Eski route'lar - geriye uyumluluk için
    'qr-turleri' => 'frontend/views/qr/types.php',
    'iletisim' => 'frontend/views/contact/index.php',
    'nasilkullanilir' => 'frontend/views/features/index.php',
    'hakkimizda' => 'frontend/views/about/index.php',
    
    // Test dosyaları - GELİŞTİRME İÇİN
    'direct-api-test.php' => 'direct-api-test.php',
    'test-api.php' => 'test-api.php',
    
    // Auth sayfaları (public)
    'kayit' => 'frontend/views/auth/register.php',
    'giris' => 'frontend/views/auth/login.php',
    'cikis' => 'frontend/views/auth/logout.php',
    'sifremi-unuttum' => 'frontend/views/auth/forgot-password.php',
    'email-dogrula' => 'frontend/views/auth/verify-email.php',
    
    // API endpoints - BURASI ÖNEMLİ!
    'api/login' => 'backend/api/login.php',
    'api/register' => 'backend/api/register.php',
    'api/logout' => 'backend/api/logout.php',
    'api/forgot-password' => 'backend/api/forgot-password.php',
    'api/qr-generate' => 'backend/api/qr-generate.php',
    
    // Dashboard alanı (giriş gerektirir)
    'dashboard' => 'frontend/views/dashboard/index.php',
    'analytics' => 'frontend/views/analytics/index.php',
    'qr-olustur' => 'frontend/views/qr-create/index.php',
    'qr-listesi' => 'frontend/views/qr-list/index.php',
    'profile' => 'frontend/views/profile/index.php',
    'pricing' => 'frontend/views/pricing/index.php',
    
    // Pages klasörü için route'lar - ESKİ SİSTEM (kaldırılacak)
    'pages/features' => 'pages/features.php',
    'pages/about' => 'pages/about.php',
    'pages/how-to-use' => 'pages/how-to-use.php',
    'pages/contact' => 'pages/contact.php',
];

// Route kontrolü
if (array_key_exists($path, $routes)) {
    $file = $routes[$path];
    
    // API çağrısı ise özel işlem
    if (strpos($path, 'api/') === 0) {
        error_log("✅ API Route found: $path -> $file");
        
        if (file_exists($file)) {
            error_log("✅ API File exists: $file");
            include $file;
        } else {
            error_log("❌ API File not found: $file");
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'API dosyası bulunamadı',
                'debug' => [
                    'path' => $path,
                    'file' => $file,
                    'exists' => file_exists($file),
                    'full_path' => realpath($file)
                ]
            ]);
        }
        exit;
    }
    
    // Normal sayfa işlemi
    // Giriş gerektirir kontrolü
    $protectedPages = ['dashboard', 'analytics', 'qr-olustur', 'qr-listesi', 'profile'];
    if (in_array($path, $protectedPages)) {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header('Location: ' . $baseURL . '/giris');
            exit;
        }
    }
    
    // Dosya var mı kontrol et
    if (file_exists($file)) {
        include $file;
    } else {
        // 404 sayfası
        http_response_code(404);
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>404 - Sayfa Bulunamadı</title>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                h1 { color: #e74c3c; }
            </style>
        </head>
        <body>
            <h1>404 - Sayfa Bulunamadı</h1>
            <p>Aradığınız sayfa bulunamadı: <code>$file</code></p>
            <a href='$baseURL'>Ana Sayfaya Dön</a>
        </body>
        </html>";
    }
} else {
    // 404 - Route bulunamadı
    error_log("❌ Route not found: $path");
    
    if (strpos($path, 'api/') === 0) {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'API endpoint bulunamadı',
            'debug' => [
                'path' => $path,
                'available_api_routes' => array_filter(array_keys($routes), function($route) {
                    return strpos($route, 'api/') === 0;
                })
            ]
        ]);
    } else {
        http_response_code(404);
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>404 - Sayfa Bulunamadı</title>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                h1 { color: #e74c3c; }
            </style>
        </head>
        <body>
            <h1>404 - Sayfa Bulunamadı</h1>
            <p>Aradığınız sayfa bulunamadı.</p>
            <p><strong>Path:</strong> " . htmlspecialchars($path) . "</p>
            <a href='$baseURL'>Ana Sayfaya Dön</a>
        </body>
        </html>";
    }
}
?>

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
    grid-template-columns: 2fr 1fr 1fr 1fr 1.2fr; /* Logo bölümü daha geniş */
    gap: 2rem;
    margin-bottom: 2rem;
    align-items: start;
}

.footer-section {
    min-height: 200px; /* Tüm bölümler aynı yükseklik */
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

.footer-bottom_links {
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

/* RESPONSIVE DESIGN */
@media (max-width: 768px) {
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
document.addEventListener('DOMContentLoaded', function() {
    console.log('✨ Unified QR Cards interface loaded');
    
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

<nav class="nav">
    <a href="<?php echo $baseURL; ?>/">Ana Sayfa</a>
    <a href="<?php echo $baseURL; ?>/frontend/views/features">Özellikler</a>
    <a href="<?php echo $baseURL; ?>/frontend/views/how-to-use">Nasıl Kullanılır</a>
    <a href="<?php echo $baseURL; ?>/frontend/views/about">Hakkımızda</a>
    <a href="<?php echo $baseURL; ?>/frontend/views/contact">İletişim</a>
    <?php if ($isLoggedIn): ?>
        <a href="<?php echo $baseURL; ?>/dashboard" class="btn btn-primary">Dashboard</a>
    <?php else: ?>
        <a href="<?php echo $baseURL; ?>/giris" class="btn btn-outline">Giriş Yap</a>
        <a href="<?php echo $baseURL; ?>/kayit" class="btn btn-primary">Kayıt Ol</a>
    <?php endif; ?>
</nav>



