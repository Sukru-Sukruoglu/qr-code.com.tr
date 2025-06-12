<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\qr\types.php
$pageTitle = "Tüm QR Kod Türleri | QR-CODE.COM.TR";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="/" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-qrcode"></i>
                    <span>QR-CODE.COM.TR</span>
                </a>
            </div>
            
            <nav class="nav">
                <a href="/">Ana Sayfa</a>
                <a href="/giris" class="btn btn-outline">Giriş Yap</a>
                <a href="/kayit" class="btn btn-primary">Kayıt Ol</a>
            </nav>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/">Ana Sayfa</a>
            <span>/</span>
            <span>QR Kod Türleri</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <h1>🎯 Tüm QR Kod Türleri</h1>
            <p>İhtiyacınıza uygun QR kod türünü seçin ve hemen oluşturmaya başlayın</p>
        </div>
        
        <!-- QR Types Grid -->
        <div class="qr-types-grid">
            <!-- URL QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/url'">
                <div class="card-icon url">
                    <i class="fas fa-link"></i>
                </div>
                <h3>URL QR Kodu</h3>
                <p>Web sitelerine hızlı erişim sağlayın</p>
                <div class="card-tags">
                    <span class="tag popular">Popüler</span>
                </div>
            </div>
            
            <!-- Text QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/text'">
                <div class="card-icon text">
                    <i class="fas fa-font"></i>
                </div>
                <h3>Metin QR Kodu</h3>
                <p>Düz metin paylaşımı yapın</p>
                <div class="card-tags">
                    <span class="tag">Basit</span>
                </div>
            </div>
            
            <!-- WiFi QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/wifi'">
                <div class="card-icon wifi">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3>Wi-Fi QR Kodu</h3>
                <p>Wi-Fi ağlarına kolay bağlantı</p>
                <div class="card-tags">
                    <span class="tag popular">Popüler</span>
                </div>
            </div>
            
            <!-- Email QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/email'">
                <div class="card-icon email">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>E-posta QR Kodu</h3>
                <p>Hazır e-posta şablonları</p>
                <div class="card-tags">
                    <span class="tag">İş</span>
                </div>
            </div>
            
            <!-- Phone QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/phone'">
                <div class="card-icon phone">
                    <i class="fas fa-phone"></i>
                </div>
                <h3>Telefon QR Kodu</h3>
                <p>Direkt arama yapma</p>
                <div class="card-tags">
                    <span class="tag">İletişim</span>
                </div>
            </div>
            
            <!-- SMS QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/sms'">
                <div class="card-icon sms">
                    <i class="fas fa-sms"></i>
                </div>
                <h3>SMS QR Kodu</h3>
                <p>Hazır SMS gönderme</p>
                <div class="card-tags">
                    <span class="tag">İletişim</span>
                </div>
            </div>
            
            <!-- WhatsApp QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/whatsapp'">
                <div class="card-icon whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h3>WhatsApp QR Kodu</h3>
                <p>WhatsApp mesaj gönderme</p>
                <div class="card-tags">
                    <span class="tag popular">Popüler</span>
                    <span class="tag">Sosyal</span>
                </div>
            </div>
            
            <!-- vCard QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/vcard'">
                <div class="card-icon vcard">
                    <i class="fas fa-address-card"></i>
                </div>
                <h3>vCard QR Kodu</h3>
                <p>Dijital kartvizit paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">İş</span>
                </div>
            </div>
            
            <!-- Location QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/location'">
                <div class="card-icon location">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Konum QR Kodu</h3>
                <p>Konum paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Harita</span>
                </div>
            </div>
            
            <!-- Business QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/business'">
                <div class="card-icon business">
                    <i class="fas fa-building"></i>
                </div>
                <h3>İşletme QR Kodu</h3>
                <p>Şirket bilgilerini paylaşın</p>
                <div class="card-tags">
                    <span class="tag">İş</span>
                </div>
            </div>
            
            <!-- Social QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/social'">
                <div class="card-icon social">
                    <i class="fas fa-share-alt"></i>
                </div>
                <h3>Sosyal Medya QR Kodu</h3>
                <p>Tüm sosyal hesaplarınız</p>
                <div class="card-tags">
                    <span class="tag">Sosyal</span>
                </div>
            </div>
            
            <!-- Facebook QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/facebook'">
                <div class="card-icon facebook">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <h3>Facebook QR Kodu</h3>
                <p>Facebook sayfası paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Sosyal</span>
                </div>
            </div>
            
            <!-- Instagram QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/instagram'">
                <div class="card-icon instagram">
                    <i class="fab fa-instagram"></i>
                </div>
                <h3>Instagram QR Kodu</h3>
                <p>Instagram profil paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Sosyal</span>
                </div>
            </div>
            
            <!-- Twitter QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/twitter'">
                <div class="card-icon twitter">
                    <i class="fab fa-twitter"></i>
                </div>
                <h3>Twitter QR Kodu</h3>
                <p>Twitter profil paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Sosyal</span>
                </div>
            </div>
            
            <!-- LinkedIn QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/linkedin'">
                <div class="card-icon linkedin">
                    <i class="fab fa-linkedin"></i>
                </div>
                <h3>LinkedIn QR Kodu</h3>
                <p>LinkedIn profil paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">İş</span>
                    <span class="tag">Sosyal</span>
                </div>
            </div>
            
            <!-- YouTube QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/youtube'">
                <div class="card-icon youtube">
                    <i class="fab fa-youtube"></i>
                </div>
                <h3>YouTube QR Kodu</h3>
                <p>YouTube kanal paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Video</span>
                </div>
            </div>
            
            <!-- Menu QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/menu'">
                <div class="card-icon menu">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3>Menü QR Kodu</h3>
                <p>Restoran menüsü paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Restoran</span>
                </div>
            </div>
            
            <!-- Coupon QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/coupon'">
                <div class="card-icon coupon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <h3>Kupon QR Kodu</h3>
                <p>İndirim kuponu oluşturun</p>
                <div class="card-tags">
                    <span class="tag">İndirim</span>
                </div>
            </div>
            
            <!-- App QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/app'">
                <div class="card-icon app">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Uygulama QR Kodu</h3>
                <p>Mobil uygulama paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Mobil</span>
                </div>
            </div>
            
            <!-- PDF QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/pdf'">
                <div class="card-icon pdf">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <h3>PDF QR Kodu</h3>
                <p>PDF dosyası paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Dosya</span>
                </div>
            </div>
            
            <!-- Images QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/images'">
                <div class="card-icon images">
                    <i class="fas fa-images"></i>
                </div>
                <h3>Görsel QR Kodu</h3>
                <p>Fotoğraf paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Medya</span>
                </div>
            </div>
            
            <!-- Video QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/video'">
                <div class="card-icon video">
                    <i class="fas fa-video"></i>
                </div>
                <h3>Video QR Kodu</h3>
                <p>Video paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Video</span>
                </div>
            </div>
            
            <!-- MP3 QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/mp3'">
                <div class="card-icon mp3">
                    <i class="fas fa-music"></i>
                </div>
                <h3>MP3 QR Kodu</h3>
                <p>Müzik paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Müzik</span>
                </div>
            </div>
            
            <!-- Links QR -->
            <div class="qr-type-card" onclick="window.location.href='/qr/links'">
                <div class="card-icon links">
                    <i class="fas fa-list"></i>
                </div>
                <h3>Link Listesi QR Kodu</h3>
                <p>Birden fazla link paylaşımı</p>
                <div class="card-tags">
                    <span class="tag">Çoklu</span>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: #f8fafc;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Header */
.header {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
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
}

.logo i {
    font-size: 2rem;
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
}

.nav a:hover {
    color: #667eea;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-primary {
    background: #667eea;
    color: white;
}

.btn-primary:hover {
    background: #5a67d8;
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: #667eea;
    border-color: #667eea;
}

.btn-outline:hover {
    background: #667eea;
    color: white;
}

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

/* Main Content */
.main-content {
    margin-top: 100px;
    padding: 2rem 0;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    color: #6b7280;
    font-size: 0.9rem;
}

.breadcrumb a {
    color: #667eea;
    text-decoration: none;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.page-header p {
    font-size: 1.1rem;
    color: #6b7280;
    max-width: 600px;
    margin: 0 auto;
}

/* QR Types Grid */
.qr-types-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}

.qr-type-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid #f3f4f6;
    position: relative;
    overflow: hidden;
}

.qr-type-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.05), transparent);
    transition: left 0.5s ease;
}

.qr-type-card:hover::before {
    left: 100%;
}

.qr-type-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.1);
    border-color: #667eea;
}

.card-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.8rem;
    color: white;
    position: relative;
    z-index: 2;
}

.card-icon.url { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
.card-icon.text { background: linear-gradient(135deg, #6b7280, #374151); }
.card-icon.wifi { background: linear-gradient(135deg, #10b981, #059669); }
.card-icon.email { background: linear-gradient(135deg, #f59e0b, #d97706); }
.card-icon.phone { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.card-icon.sms { background: linear-gradient(135deg, #06b6d4, #0891b2); }
.card-icon.whatsapp { background: linear-gradient(135deg, #25d366, #128c7e); }
.card-icon.vcard { background: linear-gradient(135deg, #1f2937, #111827); }
.card-icon.location { background: linear-gradient(135deg, #ef4444, #dc2626); }
.card-icon.business { background: linear-gradient(135deg, #6366f1, #4f46e5); }
.card-icon.social { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.card-icon.facebook { background: linear-gradient(135deg, #1877f2, #166fe5); }
.card-icon.instagram { background: linear-gradient(135deg, #e4405f, #833ab4); }
.card-icon.twitter { background: linear-gradient(135deg, #1da1f2, #0d8bd9); }
.card-icon.linkedin { background: linear-gradient(135deg, #0077b5, #005885); }
.card-icon.youtube { background: linear-gradient(135deg, #ff0000, #cc0000); }
.card-icon.menu { background: linear-gradient(135deg, #f97316, #ea580c); }
.card-icon.coupon { background: linear-gradient(135deg, #ec4899, #db2777); }
.card-icon.app { background: linear-gradient(135deg, #06b6d4, #0891b2); }
.card-icon.pdf { background: linear-gradient(135deg, #dc2626, #b91c1c); }
.card-icon.images { background: linear-gradient(135deg, #059669, #047857); }
.card-icon.video { background: linear-gradient(135deg, #7c3aed, #6d28d9); }
.card-icon.mp3 { background: linear-gradient(135deg, #f59e0b, #d97706); }
.card-icon.links { background: linear-gradient(135deg, #6366f1, #4f46e5); }

.qr-type-card h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #1a1a1a;
}

.qr-type-card p {
    color: #6b7280;
    font-size: 0.95rem;
    margin-bottom: 1rem;
}

.card-tags {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.tag {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    background: #f3f4f6;
    color: #6b7280;
}

.tag.popular {
    background: #fef3c7;
    color: #d97706;
}

/* Responsive */
@media (max-width: 768px) {
    .qr-types-grid {
        grid-template-columns: 1fr;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .nav {
        display: none;
    }
}
</style>

</body>
</html>