<?php
$pageTitle = "İş QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>İş QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="title-content">
                    <h1>İş QR Kod Oluşturucu</h1>
                    <p>İş bilgilerinizi QR kod ile paylaşın, profesyonel iletişim sağlayın</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>💼 İş Bilgileri</h3>
                
                <div class="form-group">
                    <label for="businessName">İş/Şirket Adı</label>
                    <input type="text" id="businessName" placeholder="ABC Teknoloji Ltd." required>
                    <small>Firma veya iş adınız</small>
                </div>
                
                <div class="form-group">
                    <label for="businessUrl">İş Web Sitesi/URL</label>
                    <input type="url" id="businessUrl" placeholder="https://www.firma.com" required>
                    <small>İş web sitenizin URL'si</small>
                </div>
                
                <div class="form-group">
                    <label for="businessDescription">İş Açıklaması (Opsiyonel)</label>
                    <textarea id="businessDescription" rows="3" placeholder="Web tasarım ve yazılım geliştirme hizmetleri..."></textarea>
                    <small>İş alanınızın kısa açıklaması</small>
                </div>
                
                <div class="form-group">
                    <label for="contactPerson">İletişim Kişisi (Opsiyonel)</label>
                    <input type="text" id="contactPerson" placeholder="Ahmet Yılmaz">
                    <small>Sorumlu kişi adı</small>
                </div>
                
                <div class="form-group">
                    <label for="businessPhone">İş Telefonu (Opsiyonel)</label>
                    <div class="phone-input-wrapper">
                        <select id="countryCode" class="country-select">
                            <option value="+90">🇹🇷 +90</option>
                            <option value="+1">🇺🇸 +1</option>
                            <option value="+44">🇬🇧 +44</option>
                            <option value="+49">🇩🇪 +49</option>
                            <option value="+33">🇫🇷 +33</option>
                        </select>
                        <input type="tel" id="businessPhone" placeholder="212 000 00 00">
                    </div>
                    <small>İş telefon numarası</small>
                </div>
                
                <div class="form-group">
                    <label for="businessEmail">İş E-postası (Opsiyonel)</label>
                    <input type="email" id="businessEmail" placeholder="info@firma.com">
                    <small>İş e-posta adresi</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="İş Kartım">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        İş QR Oluştur
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
                    <i class="fas fa-briefcase"></i>
                    <h4>İş QR Kod Burada Görünecek</h4>
                    <p>İş bilgilerini girin ve "İş QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- Business Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 İş QR Nasıl Kullanılır?</h3>
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
                        <i class="fas fa-external-link-alt"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>2. İş Sayfası Açılır</h4>
                        <p>İş web sitesi veya portfolyo sayfası otomatik açılır</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. İçeriği İncele</h4>
                        <p>İş bilgilerini, hizmetleri ve örnekleri inceleyin</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. İletişime Geç</h4>
                        <p>İş fırsatları için iletişim bilgilerini kullanın</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Business Features -->
        <div class="business-features">
            <h3>✨ İş QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-rocket"></i>
                    <h4>Hızlı Erişim</h4>
                    <p>İş bilgilerine anında erişim sağlar</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-chart-line"></i>
                    <h4>Profesyonel İmaj</h4>
                    <p>Modern ve teknolojik görünüm</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-globe"></i>
                    <h4>Evrensel Kullanım</h4>
                    <p>Tüm cihazlarda çalışır</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-analytics"></i>
                    <h4>Takip Edilebilir</h4>
                    <p>Ziyaret istatistikleri alınabilir</p>
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
                        <h4>Dijital Kartvizit</h4>
                        <p>Kağıt kartvizit yerine QR kodlu dijital kartvizit</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="example-content">
                        <h4>İşletme Tanıtımı</h4>
                        <p>Mağaza, ofis gibi yerlerde işletme bilgileri</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="example-content">
                        <h4>Portfolyo Paylaşımı</h4>
                        <p>Freelancer ve ajanslar için iş örnekleri</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <div class="example-content">
                        <h4>Networking Etkinlikleri</h4>
                        <p>İş ağı kurma etkinliklerinde hızlı paylaşım</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Access to Other QR Types -->
        <div class="other-qr-types">
            <h3>📱 Diğer QR Türleri</h3>
            <div class="quick-qr-grid">
                <a href="<?php echo SITE_URL; ?>/qr/vcard" class="quick-qr-card">
                    <i class="fas fa-id-card"></i>
                    <span>vCard QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/url" class="quick-qr-card">
                    <i class="fas fa-link"></i>
                    <span>URL QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/social" class="quick-qr-card">
                    <i class="fas fa-share-alt"></i>
                    <span>Sosyal Medya QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/text" class="quick-qr-card">
                    <i class="fas fa-file-alt"></i>
                    <span>Metin QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/phone" class="quick-qr-card">
                    <i class="fas fa-phone"></i>
                    <span>Telefon QR</span>
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
    background: linear-gradient(135deg, #6c5ce7 0%, #5a4fcf 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(108, 92, 231, 0.3);
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
    width: 120px;
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
    width: 100%;
}

.phone-input-wrapper input {
    flex: 1;
}

.form-group input:focus, .form-group textarea:focus, .country-select:focus {
    outline: none;
    border-color: #6c5ce7;
    box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
    width: 100%;
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
    background: linear-gradient(135deg, #6c5ce7 0%, #5a4fcf 100%);
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(108, 92, 231, 0.4);
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
    background: linear-gradient(135deg, #6c5ce7 0%, #5a4fcf 100%);
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

/* Business Features */
.business-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.business-features h3 {
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
    border-color: #6c5ce7;
    box-shadow: 0 5px 15px rgba(108, 92, 231, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #6c5ce7;
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
    border-color: #6c5ce7;
    background: rgba(108, 92, 231, 0.05);
}

.example-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #6c5ce7 0%, #5a4fcf 100%);
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
    const businessName = document.getElementById('businessName').value.trim();
    const businessUrl = document.getElementById('businessUrl').value.trim();
    const businessDescription = document.getElementById('businessDescription').value.trim();
    const contactPerson = document.getElementById('contactPerson').value.trim();
    const countryCode = document.getElementById('countryCode').value;
    const businessPhone = document.getElementById('businessPhone').value.trim();
    const businessEmail = document.getElementById('businessEmail').value.trim();
    const title = document.getElementById('title').value.trim();
    
    if (!businessName) {
        alert('Lütfen iş/şirket adını girin!');
        return;
    }
    
    if (!businessUrl) {
        alert('Lütfen iş web sitesi URL\'sini girin!');
        return;
    }
    
    if (!isValidUrl(businessUrl)) {
        alert('Lütfen geçerli bir URL girin!');
        return;
    }
    
    // vCard formatında iş bilgileri oluştur
    let vcard = 'BEGIN:VCARD\n';
    vcard += 'VERSION:3.0\n';
    vcard += `ORG:${businessName}\n`;
    
    if (contactPerson) {
        vcard += `FN:${contactPerson}\n`;
    }
    
    if (businessDescription) {
        vcard += `NOTE:${businessDescription}\n`;
    }
    
    if (businessPhone) {
        const fullPhone = countryCode + businessPhone.replace(/\D/g, '');
        vcard += `TEL:${fullPhone}\n`;
    }
    
    if (businessEmail) {
        vcard += `EMAIL:${businessEmail}\n`;
    }
    
    vcard += `URL:${businessUrl}\n`;
    vcard += 'END:VCARD';
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(vcard)}&color=6c5ce7&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="İş QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${title || businessName || 'İş QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            <strong>İş Adı:</strong> ${businessName}<br>
            <strong>Web Sitesi:</strong> <a href="${businessUrl}" target="_blank" style="color: #6c5ce7;">${businessUrl}</a><br>
            ${contactPerson ? `<strong>İletişim:</strong> ${contactPerson}<br>` : ''}
            ${businessPhone ? `<strong>Telefon:</strong> ${countryCode} ${businessPhone}<br>` : ''}
            ${businessEmail ? `<strong>E-posta:</strong> ${businessEmail}<br>` : ''}
            ${businessDescription ? `<strong>Açıklama:</strong> ${businessDescription}` : ''}
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        businessName, businessUrl, businessDescription, contactPerson, 
        businessPhone, businessEmail, title, vcard 
    };
    
    // Smooth scroll
    document.getElementById('qrPreview').scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
    });
}

function isValidUrl(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}

function clearQR() {
    document.getElementById('qrPlaceholder').style.display = 'block';
    document.getElementById('qrDisplay').style.display = 'none';
    document.getElementById('qrActions').style.display = 'none';
    currentQRData = '';
}

function clearForm() {
    document.getElementById('businessName').value = '';
    document.getElementById('businessUrl').value = '';
    document.getElementById('businessDescription').value = '';
    document.getElementById('contactPerson').value = '';
    document.getElementById('countryCode').value = '+90';
    document.getElementById('businessPhone').value = '';
    document.getElementById('businessEmail').value = '';
    document.getElementById('title').value = '';
    clearQR();
}

function downloadQR() {
    if (!currentQRData.vcard) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.vcard)}&color=6c5ce7&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `business-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.vcard) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.vcard)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('İş QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('İş QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('İş QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Sayfa yüklendiğinde ilk input'a focus
document.addEventListener('DOMContentLoaded', function() {
    const businessNameInput = document.getElementById('businessName');
    if (businessNameInput) {
        businessNameInput.focus();
    }
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>