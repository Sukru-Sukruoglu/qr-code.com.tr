<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\qr-generator\url.php
$pageTitle = "URL QR Kod Oluşturucu | QR-CODE.COM.TR";
$pageClass = "qr-generator-page";

// Config dosyalarını dahil et
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(__DIR__ . '/../../..'));
}
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/dashboard/qr-code.com.tr');
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

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
                            <a href="<?php echo SITE_URL; ?>/qr/url" class="dropdown-item active">
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

<div class="qr-generator-container">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="<?php echo SITE_URL; ?>">Ana Sayfa</a>
            <span>/</span>
            <a href="<?php echo SITE_URL; ?>/qr">QR Oluştur</a>
            <span>/</span>
            <span>URL QR</span>
        </div>
        
        <!-- Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-link"></i>
                </div>
                <div class="title-content">
                    <h1>URL QR Kod Oluşturucu</h1>
                    <p>Web sitesi, sosyal medya veya herhangi bir URL için QR kod oluşturun</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>🔗 URL Bilgileri</h3>
                
                <div class="form-group">
                    <label for="url">Website URL'si</label>
                    <input type="url" id="url" placeholder="https://example.com" required>
                    <small>Tam URL'yi girin (https:// dahil)</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="Website QR Kodum">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        QR Kod Oluştur
                    </button>
                    
                    <button type="button" class="btn btn-secondary" onclick="clearForm()">
                        <i class="fas fa-eraser"></i>
                        Temizle
                    </button>
                </div>
            </div>
            
            <!-- QR Preview - Her zaman görünür -->
            <div class="qr-preview" id="qrPreview">
                <h3>📱 QR Kod Önizleme</h3>
                
                <!-- Placeholder - QR oluşturulmadığında gösterilir -->
                <div class="qr-preview-placeholder" id="qrPlaceholder">
                    <i class="fas fa-qrcode"></i>
                    <h4>QR Kod Burada Görünecek</h4>
                    <p>URL bilgilerini girin ve "QR Kod Oluştur" butonuna tıklayın</p>
                </div>
                
                <!-- QR Display - QR oluşturulduğunda gösterilir -->
                <div class="qr-display" id="qrDisplay" style="display: none;"></div>
                
                <div class="qr-actions" id="qrActions" style="display: none;">
                    <button class="btn btn-download" onclick="downloadQR()">
                        <i class="fas fa-download"></i>
                        PNG İndir (512x512)
                    </button>
                    <button class="btn btn-copy" onclick="copyQRLink()">
                        <i class="fas fa-copy"></i>
                        QR Link Kopyala
                    </button>
                    <button class="btn btn-save" onclick="saveQR()">
                        <i class="fas fa-save"></i>
                        Kaydet
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Quick Access to Other QR Types -->
        <div class="other-qr-types">
            <h3>📱 Diğer QR Türleri</h3>
            <div class="quick-qr-grid">
                <a href="<?php echo SITE_URL; ?>/qr/wifi" class="quick-qr-card">
                    <i class="fas fa-wifi"></i>
                    <span>WiFi QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/vcard" class="quick-qr-card">
                    <i class="fas fa-id-card"></i>
                    <span>vCard QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/whatsapp" class="quick-qr-card">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/email" class="quick-qr-card">
                    <i class="fas fa-envelope"></i>
                    <span>E-posta QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/text" class="quick-qr-card">
                    <i class="fas fa-file-text"></i>
                    <span>Metin QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/#qr-turleri" class="quick-qr-card all-types">
                    <i class="fas fa-plus"></i>
                    <span>Tümünü Gör</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <!-- Footer Logo & Info -->
            <div class="footer-section">
                <div class="footer-logo">
                    <div class="logo-icon">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">QR-CODE</span>
                        <span class="logo-sub">.COM.TR</span>
                    </div>
                </div>
                <p class="footer-description">
                    Türkiye'nin en gelişmiş QR kod oluşturucu platformu. 
                    Ücretsiz, hızlı ve güvenli QR kod çözümleri.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
            
            <!-- QR Types -->
            <div class="footer-section">
                <h4>QR Kod Türleri</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo SITE_URL; ?>/qr/url">URL QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/wifi">WiFi QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/vcard">vCard QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/whatsapp">WhatsApp QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/email">E-posta QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/text">Metin QR Kodu</a></li>
                </ul>
            </div>
            
            <!-- Company -->
            <div class="footer-section">
                <h4>Şirket</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo SITE_URL; ?>/hakkimizda">Hakkımızda</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/iletisim">İletişim</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/gizlilik">Gizlilik Politikası</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/kullanim-sartlari">Kullanım Şartları</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/sss">Sık Sorulan Sorular</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/api">API Dokümantasyonu</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div class="footer-section">
                <h4>İletişim</h4>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kavacık Mh. Fatih Sultan Mehmet Cd. Tonoğlu Plaza No:3 Kat:4<br>Beykoz/İstanbul</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+90 (532) 226-8040</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@qr-code.com.tr</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span>Pazartesi - Cuma: 09:00 - 18:00</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; 2024 QR-CODE.COM.TR - Tüm hakları saklıdır.</p>
                <div class="footer-bottom-links">
                    <a href="<?php echo SITE_URL; ?>/gizlilik">Gizlilik</a>
                    <a href="<?php echo SITE_URL; ?>/kullanim-sartlari">Şartlar</a>
                    <a href="<?php echo SITE_URL; ?>/cerez-politikasi">Çerezler</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
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
}

/* Header Styles */
.header {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
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

.nav-link:hover {
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
}

.nav-link.active {
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
}

.nav-dropdown {
    position: relative;
}

.dropdown-toggle {
    cursor: pointer;
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

.dropdown-item:hover {
    background: #f8fafc;
    color: #667eea;
}

.dropdown-item.active {
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
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

/* Breadcrumb */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    padding: 1rem 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.breadcrumb a {
    color: #667eea;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.breadcrumb span:last-child {
    color: #1a1a1a;
    font-weight: 500;
}

/* Main Content */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.qr-generator-container {
    min-height: 100vh;
    padding: 2rem 0;
}

.page-header {
    margin-bottom: 3rem;
}

.page-title {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

.title-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.title-content p {
    color: #6b7280;
    font-size: 1.1rem;
}

.generator-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    background: white;
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.form-section h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-group {
    margin-bottom: 2rem;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-group input {
    width: 100%;
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-group small {
    color: #6b7280;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    display: block;
}

.btn-secondary {
    background: #6b7280;
    color: white;
    width: 100%;
    margin-top: 0.5rem;
}

.btn-secondary:hover {
    background: #4b5563;
    transform: translateY(-1px);
}

.btn-download {
    background: #10b981;
    color: white;
}

.btn-copy {
    background: #6366f1;
    color: white;
}

.btn-save {
    background: #f59e0b;
    color: white;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-top: 1rem;
}

.btn-generate {
    width: 100%;
}

.qr-preview {
    background: #f8fafc;
    padding: 2rem;
    border-radius: 16px;
    border: 2px dashed #d1d5db;
    text-align: center;
}

.qr-preview h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.qr-preview-placeholder {
    padding: 3rem 2rem;
    text-align: center;
    color: #6b7280;
}

.qr-preview-placeholder i {
    font-size: 4rem;
    color: #d1d5db;
    margin-bottom: 1rem;
    display: block;
}

.qr-preview-placeholder h4 {
    color: #9ca3af;
    margin-bottom: 0.5rem;
}

.qr-preview-placeholder p {
    color: #6b7280;
    font-size: 0.9rem;
}

.qr-display {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.qr-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Other QR Types Section */
.other-qr-types {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.other-qr-types h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-qr-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.quick-qr-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    padding: 1.5rem;
    background: #f8fafc;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    text-decoration: none;
    color: #4b5563;
    transition: all 0.3s ease;
}

.quick-qr-card:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.quick-qr-card.all-types {
    border-color: #667eea;
    color: #667eea;
}

.quick-qr-card.all-types:hover {
    background: #667eea;
    color: white;
}

.quick-qr-card i {
    font-size: 1.5rem;
}

.quick-qr-card span {
    font-weight: 500;
    font-size: 0.9rem;
}

/* Footer Styles */
.footer {
    background: #1a1a1a;
    color: #e5e7eb;
    margin-top: 4rem;
}

.footer-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    padding: 3rem 0;
}

.footer-section h4 {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.footer-logo .logo-main {
    color: white;
}

.footer-description {
    color: #9ca3af;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 40px;
    height: 40px;
    background: #374151;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e5e7eb;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: #9ca3af;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #667eea;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    color: #9ca3af;
}

.contact-item i {
    color: #667eea;
    margin-top: 0.25rem;
    flex-shrink: 0;
}

.footer-bottom {
    border-top: 1px solid #374151;
    padding: 2rem 0;
}

.footer-bottom-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #9ca3af;
    font-size: 0.9rem;
}

.footer-bottom-links {
    display: flex;
    gap: 2rem;
}

.footer-bottom-links a {
    color: #9ca3af;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #667eea;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .header-content {
        padding: 0.5rem 0;
    }
    
    .nav {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: block;
    }
    
    .generator-form {
        grid-template-columns: 1fr;
        gap: 2rem;
        padding: 2rem;
    }
    
    .page-title {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .title-content h1 {
        font-size: 2rem;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .quick-qr-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .container {
        padding: 1rem;
    }
    
    .quick-qr-grid {
        grid-template-columns: 1fr;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}
</style>

<script>
let currentQRData = '';

function generateQR() {
    const url = document.getElementById('url').value.trim();
    const title = document.getElementById('title').value.trim();
    
    if (!url) {
        alert('Lütfen bir URL girin!');
        return;
    }
    
    // URL formatını kontrol et
    if (!isValidURL(url)) {
        alert('Lütfen geçerli bir URL girin (https:// ile başlamalı)!');
        return;
    }
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(url)}&color=3b82f6&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
            ${title || 'URL QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; word-break: break-all;">
            ${url}
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { url, title };
    
    // Smooth scroll
    document.getElementById('qrPreview').scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
    });
}

function clearQR() {
    document.getElementById('qrPlaceholder').style.display = 'block';
    document.getElementById('qrDisplay').style.display = 'none';
    document.getElementById('qrActions').style.display = 'none';
    currentQRData = '';
}

function clearForm() {
    document.getElementById('url').value = '';
    document.getElementById('title').value = '';
    clearQR();
}

function downloadQR() {
    if (!currentQRData.url) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.url)}&color=3b82f6&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `url-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.url) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.url)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('QR kod linki panoya kopyalandı!');
    }).catch(() => {
        // Fallback
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

function isValidURL(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}

function toggleMobileMenu() {
    const nav = document.querySelector('.nav');
    nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
}

// Enter tuşu ile form gönderimi
document.addEventListener('DOMContentLoaded', function() {
    const urlInput = document.getElementById('url');
    
    if (urlInput) {
        urlInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                generateQR();
            }
        });
        
        // URL input'una otomatik focus
        urlInput.focus();
    }
});
</script>

</body>
</html>