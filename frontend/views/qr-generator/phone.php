<?php
$pageTitle = "Telefon QR Kod Oluşturucu | QR-CODE.COM.TR";
$pageClass = "qr-generator-page";

// Config dosyalarını dahil et
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(__DIR__ . '/../../..'));
}
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/dashboard/qr-code.com.tr');
}

// Header'ı include et
include ROOT_PATH . '/frontend/components/header-new.php';
?>

<!-- Sadece sayfa içeriği -->
<div class="qr-generator-container">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="<?php echo SITE_URL; ?>">Ana Sayfa</a>
            <span>/</span>
            <a href="<?php echo SITE_URL; ?>/qr">QR Oluştur</a>
            <span>/</span>
            <span>Telefon QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="title-content">
                    <h1>Telefon QR Kod Oluşturucu</h1>
                    <p>Telefon numaranızı QR kod ile paylaşın, tek tıkla arama yapılsın</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>📞 Telefon Bilgileri</h3>
                
                <div class="form-group">
                    <label for="phoneNumber">Telefon Numarası</label>
                    <div class="phone-input-wrapper">
                        <select id="countryCode" class="country-select">
                            <option value="+90">🇹🇷 +90 (Türkiye)</option>
                            <option value="+1">🇺🇸 +1 (ABD)</option>
                            <option value="+44">🇬🇧 +44 (İngiltere)</option>
                            <option value="+49">🇩🇪 +49 (Almanya)</option>
                            <option value="+33">🇫🇷 +33 (Fransa)</option>
                            <option value="+39">🇮🇹 +39 (İtalya)</option>
                            <option value="+34">🇪🇸 +34 (İspanya)</option>
                            <option value="+31">🇳🇱 +31 (Hollanda)</option>
                            <option value="+32">🇧🇪 +32 (Belçika)</option>
                            <option value="+41">🇨🇭 +41 (İsviçre)</option>
                            <option value="+43">🇦🇹 +43 (Avusturya)</option>
                            <option value="+7">🇷🇺 +7 (Rusya)</option>
                            <option value="+86">🇨🇳 +86 (Çin)</option>
                            <option value="+81">🇯🇵 +81 (Japonya)</option>
                            <option value="+82">🇰🇷 +82 (Güney Kore)</option>
                            <option value="+91">🇮🇳 +91 (Hindistan)</option>
                            <option value="+55">🇧🇷 +55 (Brezilya)</option>
                            <option value="+52">🇲🇽 +52 (Meksika)</option>
                            <option value="+61">🇦🇺 +61 (Avustralya)</option>
                            <option value="+64">🇳🇿 +64 (Yeni Zelanda)</option>
                            <option value="+27">🇿🇦 +27 (Güney Afrika)</option>
                            <option value="+20">🇪🇬 +20 (Mısır)</option>
                            <option value="+971">🇦🇪 +971 (BAE)</option>
                            <option value="+966">🇸🇦 +966 (Suudi Arabistan)</option>
                        </select>
                        <input type="tel" id="phoneNumber" placeholder="532 000 00 00" required>
                    </div>
                    <small>Ülke kodunu seçin ve telefon numaranızı girin (0 olmadan)</small>
                </div>
                
                <div class="form-group">
                    <label for="contactName">Kişi Adı (Opsiyonel)</label>
                    <input type="text" id="contactName" placeholder="Ahmet Yılmaz">
                    <small>Arayan kişi bilgisi için</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="Telefon İletişim">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        Telefon QR Oluştur
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
                    <i class="fas fa-phone"></i>
                    <h4>Telefon QR Kod Burada Görünecek</h4>
                    <p>Telefon bilgilerini girin ve "Telefon QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- Phone Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 Telefon QR Nasıl Kullanılır?</h3>
            <div class="instructions-grid">
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>1. QR Kodu Tarayın</h4>
                        <p>Telefonun kamera uygulaması ile QR kodu tarayın</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>2. Telefon Uygulaması Açılır</h4>
                        <p>Arama uygulaması otomatik açılır ve numara girilir</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. Kişi Bilgisi Görülür</h4>
                        <p>Varsa kişi adı otomatik olarak görüntülenir</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. Hemen Ara</h4>
                        <p>Tek tıkla arama başlatabilirsiniz</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Phone Features -->
        <div class="phone-features">
            <h3>✨ Telefon QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-rocket"></i>
                    <h4>Hızlı Arama</h4>
                    <p>Numara yazmaya gerek kalmadan direkt arama</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-globe"></i>
                    <h4>Uluslararası Destek</h4>
                    <p>Tüm ülke kodları ve numara formatları</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-address-book"></i>
                    <h4>Kişi Bilgisi</h4>
                    <p>İsteğe bağlı olarak arayan kişi adı eklenebilir</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Evrensel Uyumluluk</h4>
                    <p>Tüm akıllı telefonlarda sorunsuz çalışır</p>
                </div>
            </div>
        </div>
        
        <!-- Usage Examples -->
        <div class="usage-examples">
            <h3>💡 Kullanım Örnekleri</h3>
            <div class="examples-grid">
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-id-card-alt"></i>
                    </div>
                    <div class="example-content">
                        <h4>Kartvizitler</h4>
                        <p>Dijital kartvizitlerde direkt arama özelliği</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="example-content">
                        <h4>İş Yerleri</h4>
                        <p>Mağaza, restoran gibi işletmelerde müşteri iletişimi</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-life-ring"></i>
                    </div>
                    <div class="example-content">
                        <h4>Acil Durum</h4>
                        <p>Acil durum numaralarının hızlı erişimi</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="example-content">
                        <h4>Müşteri Hizmetleri</h4>
                        <p>Destek hatlarına hızlı ulaşım için</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Access to Other QR Types -->
        <div class="other-qr-types">
            <h3>📱 Diğer QR Türleri</h3>
            <div class="quick-qr-grid">
                <a href="<?php echo SITE_URL; ?>/qr/url" class="quick-qr-card">
                    <i class="fas fa-link"></i>
                    <span>URL QR</span>
                </a>
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
                <a href="<?php echo SITE_URL; ?>/#qr-turleri" class="quick-qr-card all-types">
                    <i class="fas fa-plus"></i>
                    <span>Tümünü Gör</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Sayfa özel stilleri */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.qr-generator-container {
    padding: 2rem 0;
}

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
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
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

.phone-input-wrapper {
    display: flex;
    gap: 0.5rem;
}

.country-select {
    width: 180px;
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 0.9rem;
    background: white;
    transition: all 0.3s ease;
}

.form-group input, .form-group textarea, .country-select {
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-group input {
    flex: 1;
}

.form-group input:focus, .form-group textarea:focus, .country-select:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4);
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

/* Usage Instructions */
.usage-instructions {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.usage-instructions h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.instructions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.instruction-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.instruction-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.instruction-content h4 {
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.instruction-content p {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.6;
}

/* Phone Features */
.phone-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.phone-features h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
}

.feature-item {
    text-align: center;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-2px);
    border-color: #2563eb;
    box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #2563eb;
    margin-bottom: 1rem;
}

.feature-item h4 {
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.feature-item p {
    color: #6b7280;
    font-size: 0.9rem;
}

/* Usage Examples */
.usage-examples {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.usage-examples h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.examples-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.example-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
}

.example-item:hover {
    transform: translateY(-2px);
    border-color: #2563eb;
    background: rgba(37, 99, 235, 0.05);
}

.example-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.example-content h4 {
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.example-content p {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.6;
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

/* Mobile Responsive */
@media (max-width: 768px) {
    .generator-form {
        grid-template-columns: 1fr;
        gap: 2rem;
        padding: 2rem;
    }
    
    .phone-input-wrapper {
        flex-direction: column;
    }
    
    .country-select {
        width: 100%;
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
    
    .quick-qr-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .instructions-grid, .features-grid, .examples-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 1rem;
    }
    
    .quick-qr-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
let currentQRData = '';

function generateQR() {
    const countryCode = document.getElementById('countryCode').value;
    const phoneNumber = document.getElementById('phoneNumber').value.trim();
    const contactName = document.getElementById('contactName').value.trim();
    const title = document.getElementById('title').value.trim();
    
    if (!phoneNumber) {
        alert('Lütfen telefon numaranızı girin!');
        return;
    }
    
    // Telefon numarasını temizle (sadece rakamlar)
    const cleanPhone = phoneNumber.replace(/\D/g, '');
    
    if (cleanPhone.length < 7) {
        alert('Lütfen geçerli bir telefon numarası girin!');
        return;
    }
    
    // Tel protokolü: tel:+905551234567
    const phoneURL = `tel:${countryCode.replace('+', '')}${cleanPhone}`;
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(phoneURL)}&color=2563eb&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="Telefon QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${title || contactName || 'Telefon QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            <strong>Telefon:</strong> ${countryCode} ${phoneNumber}<br>
            ${contactName ? `<strong>Kişi:</strong> ${contactName}<br>` : ''}
            <strong>Tel URL:</strong> <span style="word-break: break-all; font-size: 0.8rem;">${phoneURL}</span>
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        countryCode, phoneNumber, contactName, title, phoneURL 
    };
    
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
    document.getElementById('countryCode').value = '+90';
    document.getElementById('phoneNumber').value = '';
    document.getElementById('contactName').value = '';
    document.getElementById('title').value = '';
    clearQR();
}

function downloadQR() {
    if (!currentQRData.phoneURL) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.phoneURL)}&color=2563eb&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `phone-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.phoneURL) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.phoneURL)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('Telefon QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Telefon QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('Telefon QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Telefon numarası formatlaması
document.getElementById('phoneNumber').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    
    // Türkiye için format: 532 000 00 00
    if (document.getElementById('countryCode').value === '+90') {
        if (value.length >= 3) {
            value = value.substring(0, 3) + ' ' + value.substring(3);
        }
        if (value.length >= 7) {
            value = value.substring(0, 7) + ' ' + value.substring(7);
        }
        if (value.length >= 10) {
            value = value.substring(0, 10) + ' ' + value.substring(10, 12);
        }
    }
    
    e.target.value = value;
});

// Enter tuşu ile form gönderimi
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('phoneNumber');
    
    if (phoneInput) {
        phoneInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                generateQR();
            }
        });
        
        // Phone input'a otomatik focus
        phoneInput.focus();
    }
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>