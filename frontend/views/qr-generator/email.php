<?php
$pageTitle = "E-posta QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>E-posta QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="title-content">
                    <h1>E-posta QR Kod Oluşturucu</h1>
                    <p>E-posta gönderimi için QR kod oluşturun, hızlı iletişim kurun</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>📧 E-posta Bilgileri</h3>
                
                <div class="form-group">
                    <label for="emailTo">Alıcı E-posta Adresi</label>
                    <input type="email" id="emailTo" placeholder="ornek@email.com" required>
                    <small>E-posta gönderilecek adres</small>
                </div>
                
                <div class="form-group">
                    <label for="emailSubject">E-posta Konusu</label>
                    <input type="text" id="emailSubject" placeholder="İletişim - Web Sitesi">
                    <small>E-posta konu satırı (opsiyonel)</small>
                </div>
                
                <div class="form-group">
                    <label for="emailBody">E-posta Mesajı</label>
                    <textarea id="emailBody" rows="4" placeholder="Merhaba,&#10;&#10;Size web sitenizden ulaşıyorum.&#10;&#10;İyi günler."></textarea>
                    <small>Ön tanımlı mesaj içeriği (opsiyonel)</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="E-posta İletişim">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        E-posta QR Oluştur
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
                    <i class="fas fa-envelope"></i>
                    <h4>E-posta QR Kod Burada Görünecek</h4>
                    <p>E-posta bilgilerini girin ve "E-posta QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- Email Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 E-posta QR Nasıl Kullanılır?</h3>
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
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>2. E-posta Uygulaması Açılır</h4>
                        <p>Varsayılan e-posta uygulaması otomatik açılır</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. Bilgiler Doldurulur</h4>
                        <p>Alıcı, konu ve mesaj otomatik doldurulur</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. Hemen Gönder</h4>
                        <p>Gerekirse düzenleyip direkt gönderebilirsiniz</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Email Features */
        <div class="email-features">
            <h3>✨ E-posta QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-at"></i>
                    <h4>Otomatik Adres</h4>
                    <p>Alıcı e-posta adresi otomatik doldurulur</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-heading"></i>
                    <h4>Hazır Konu</h4>
                    <p>E-posta konu satırı önceden belirlenir</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-file-text"></i>
                    <h4>Ön Tanımlı Mesaj</h4>
                    <p>Mesaj içeriği hazır olarak gelir</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Evrensel Uyumluluk</h4>
                    <p>Tüm e-posta uygulamalarında çalışır</p>
                </div>
            </div>
        </div>
        
        <!-- Usage Examples -->
        <div class="usage-examples">
            <h3>💡 Kullanım Örnekleri</h3>
            <div class="examples-grid">
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="example-content">
                        <h4>İş İletişimi</h4>
                        <p>Kartvizitlerde, broşürlerde hızlı iş iletişimi için</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-life-ring"></i>
                    </div>
                    <div class="example-content">
                        <h4>Müşteri Desteği</h4>
                        <p>Web sitelerinde destek e-postası için hızlı erişim</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="example-content">
                        <h4>Etkinlik Organizasyonu</h4>
                        <p>Etkinlik bilgileri ve rezervasyon için</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="example-content">
                        <h4>Eğitim Kurumları</h4>
                        <p>Öğrenci ve veli iletişimi için</p>
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
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
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

.form-group input, .form-group textarea {
    width: 100%;
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-group input:focus, .form-group textarea:focus {
    outline: none;
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
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
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 38, 38, 0.4);
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
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
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

/* Email Features */
.email-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.email-features h3 {
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
    border-color: #dc2626;
    box-shadow: 0 5px 15px rgba(220, 38, 38, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #dc2626;
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
    border-color: #dc2626;
    background: rgba(220, 38, 38, 0.05);
}

.example-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
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
    const emailTo = document.getElementById('emailTo').value.trim();
    const emailSubject = document.getElementById('emailSubject').value.trim();
    const emailBody = document.getElementById('emailBody').value.trim();
    const title = document.getElementById('title').value.trim();
    
    if (!emailTo) {
        alert('Lütfen alıcı e-posta adresini girin!');
        return;
    }
    
    // E-posta adres validasyonu
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailTo)) {
        alert('Lütfen geçerli bir e-posta adresi girin!');
        return;
    }
    
    // Mailto URL formatı oluştur
    let mailtoURL = `mailto:${emailTo}`;
    let params = [];
    
    if (emailSubject) {
        params.push(`subject=${encodeURIComponent(emailSubject)}`);
    }
    
    if (emailBody) {
        params.push(`body=${encodeURIComponent(emailBody)}`);
    }
    
    if (params.length > 0) {
        mailtoURL += '?' + params.join('&');
    }
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(mailtoURL)}&color=dc2626&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="E-posta QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${title || 'E-posta QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            <strong>Alıcı:</strong> ${emailTo}<br>
            ${emailSubject ? `<strong>Konu:</strong> ${emailSubject}<br>` : ''}
            ${emailBody ? `<strong>Mesaj:</strong> ${emailBody.length > 50 ? emailBody.substring(0, 50) + '...' : emailBody}<br>` : ''}
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        emailTo, emailSubject, emailBody, title, mailtoURL 
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
    document.getElementById('emailTo').value = '';
    document.getElementById('emailSubject').value = '';
    document.getElementById('emailBody').value = '';
    document.getElementById('title').value = '';
    clearQR();
}

function downloadQR() {
    if (!currentQRData.mailtoURL) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.mailtoURL)}&color=dc2626&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `email-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.mailtoURL) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.mailtoURL)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('E-posta QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('E-posta QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('E-posta QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Enter tuşu ile form gönderimi
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('emailTo');
    
    if (emailInput) {
        emailInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                generateQR();
            }
        });
        
        // Email input'a otomatik focus
        emailInput.focus();
    }
    
    // Form elemanlarına enter event listener ekle
    const formInputs = document.querySelectorAll('.form-group input, .form-group textarea');
    formInputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                generateQR();
            }
        });
    });
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>