<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\qr-generator\text.php
$pageTitle = "Metin QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>Metin QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="title-content">
                    <h1>Metin QR Kod Oluşturucu</h1>
                    <p>Metninizi QR kod ile paylaşın, hızlı bilgi aktarımı sağlayın</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>📝 Metin Bilgileri</h3>
                
                <div class="form-group">
                    <label for="textContent">Metin İçeriği</label>
                    <textarea id="textContent" rows="8" placeholder="Buraya QR kodda görünmesini istediğiniz metni yazın...

Örnek kullanımlar:
• İletişim bilgileri
• Adres ve konum bilgileri  
• Özel mesajlar ve notlar
• Ürün açıklamaları
• Etkinlik detayları
• Wi-Fi şifreleri ve bilgileri" required></textarea>
                    <small id="characterCount">0 karakter</small>
                </div>
                
                <div class="form-group">
                    <label for="textType">Metin Türü</label>
                    <select id="textType" onchange="updateTextTemplate()">
                        <option value="custom">Özel Metin</option>
                        <option value="contact">İletişim Bilgileri</option>
                        <option value="address">Adres Bilgisi</option>
                        <option value="wifi">Wi-Fi Bilgileri</option>
                        <option value="product">Ürün Açıklaması</option>
                        <option value="event">Etkinlik Bilgileri</option>
                        <option value="instruction">Kullanım Talimatı</option>
                        <option value="quote">Alıntı/Söz</option>
                    </select>
                    <small>Hazır şablon kullanmak için tür seçin</small>
                </div>
                
                <div class="form-group">
                    <label for="encoding">Karakter Kodlaması</label>
                    <select id="encoding">
                        <option value="UTF-8">UTF-8 (Türkçe karakterler)</option>
                        <option value="ISO-8859-9">ISO-8859-9 (Latin-5)</option>
                        <option value="ASCII">ASCII (Sadece İngilizce)</option>
                    </select>
                    <small>Türkçe karakterler için UTF-8 önerilir</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="Metin QR Kodum">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        Metin QR Oluştur
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
                    <i class="fas fa-file-alt"></i>
                    <h4>Metin QR Kod Burada Görünecek</h4>
                    <p>Metninizi girin ve "Metin QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- Text Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 Metin QR Nasıl Kullanılır?</h3>
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
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>2. Metin Görüntülenir</h4>
                        <p>QR kodundaki metin ekranda görüntülenir</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-copy"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. Metni Kopyala</h4>
                        <p>Metni kopyalayarak başka yerlerde kullanın</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-share"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. Paylaş veya Kaydet</h4>
                        <p>Metni paylaşın veya not olarak kaydedin</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Text Features -->
        <div class="text-features">
            <h3>✨ Metin QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-language"></i>
                    <h4>Çoklu Dil Desteği</h4>
                    <p>Türkçe, İngilizce ve diğer dillerde metin</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-text-width"></i>
                    <h4>Uzun Metin Desteği</h4>
                    <p>Binlerce karakterlik metinler</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Evrensel Uyumluluk</h4>
                    <p>Tüm cihazlarda okunabilir</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Güvenli Paylaşım</h4>
                    <p>İnternet gerektirmez, offline çalışır</p>
                </div>
            </div>
        </div>
        
        <!-- Text Templates -->
        <div class="text-templates">
            <h3>📝 Hazır Metin Şablonları</h3>
            <div class="templates-grid">
                <div class="template-item" onclick="applyTextTemplate('contact')">
                    <div class="template-icon">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="template-content">
                        <h4>İletişim Bilgileri</h4>
                        <p>Ad, telefon, e-posta ve adres bilgileri</p>
                    </div>
                </div>
                
                <div class="template-item" onclick="applyTextTemplate('address')">
                    <div class="template-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="template-content">
                        <h4>Adres Bilgisi</h4>
                        <p>Detaylı adres ve yol tarifi</p>
                    </div>
                </div>
                
                <div class="template-item" onclick="applyTextTemplate('wifi')">
                    <div class="template-icon">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <div class="template-content">
                        <h4>Wi-Fi Bilgileri</h4>
                        <p>Ağ adı, şifre ve bağlantı talimatları</p>
                    </div>
                </div>
                
                <div class="template-item" onclick="applyTextTemplate('product')">
                    <div class="template-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="template-content">
                        <h4>Ürün Açıklaması</h4>
                        <p>Ürün özellikleri ve kullanım bilgileri</p>
                    </div>
                </div>
                
                <div class="template-item" onclick="applyTextTemplate('event')">
                    <div class="template-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="template-content">
                        <h4>Etkinlik Bilgileri</h4>
                        <p>Tarih, saat, yer ve etkinlik detayları</p>
                    </div>
                </div>
                
                <div class="template-item" onclick="applyTextTemplate('instruction')">
                    <div class="template-icon">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <div class="template-content">
                        <h4>Kullanım Talimatı</h4>
                        <p>Adım adım kullanım kılavuzu</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Usage Examples -->
        <div class="usage-examples">
            <h3>💡 Kullanım Örnekleri</h3>
            <div class="examples-grid">
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="example-content">
                        <h4>İşletme Bilgileri</h4>
                        <p>Çalışma saatleri, adres, iletişim bilgileri</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="example-content">
                        <h4>Eğitim Materyalleri</h4>
                        <p>Ders notları, formüller, önemli bilgiler</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="example-content">
                        <h4>Menü ve Tarifler</h4>
                        <p>Yemek tarifleri, malzeme listesi</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="example-content">
                        <h4>Özel Mesajlar</h4>
                        <p>Sevgililer günü, doğum günü mesajları</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Text Tips -->
        <div class="text-tips">
            <h3>💡 Metin QR İpuçları</h3>
            <div class="tips-grid">
                <div class="tip-item">
                    <div class="tip-number">01</div>
                    <div class="tip-content">
                        <h4>Kısa ve Öz Tutun</h4>
                        <p>Çok uzun metinler QR kodun okunmasını zorlaştırabilir</p>
                    </div>
                </div>
                
                <div class="tip-item">
                    <div class="tip-number">02</div>
                    <div class="tip-content">
                        <h4>Türkçe Karakter Kullanın</h4>
                        <p>UTF-8 kodlaması ile Türkçe karakterler sorunsuz görünür</p>
                    </div>
                </div>
                
                <div class="tip-item">
                    <div class="tip-number">03</div>
                    <div class="tip-content">
                        <h4>Formatlamaya Dikkat</h4>
                        <p>Satır sonları ve paragraflar okunabilirliği artırır</p>
                    </div>
                </div>
                
                <div class="tip-item">
                    <div class="tip-number">04</div>
                    <div class="tip-content">
                        <h4>Test Edin</h4>
                        <p>QR kodu oluşturduktan sonra mutlaka test edin</p>
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
                <a href="<?php echo SITE_URL; ?>/qr/vcard" class="quick-qr-card">
                    <i class="fas fa-id-card"></i>
                    <span>vCard QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/wifi" class="quick-qr-card">
                    <i class="fas fa-wifi"></i>
                    <span>Wi-Fi QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/email" class="quick-qr-card">
                    <i class="fas fa-envelope"></i>
                    <span>E-posta QR</span>
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

.form-group input, .form-group textarea, .form-group select {
    width: 100%;
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-group input:focus, .form-group textarea:focus, .form-group select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 200px;
    line-height: 1.6;
}

.form-group small {
    color: #6b7280;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    display: block;
}

#characterCount {
    color: #3b82f6;
    font-weight: 500;
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
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
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
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
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

/* Text Features */
.text-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.text-features h3 {
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
    border-color: #3b82f6;
    box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #3b82f6;
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

/* Text Templates */
.text-templates {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.text-templates h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.templates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.template-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    cursor: pointer;
    transition: all 0.3s ease;
}

.template-item:hover {
    transform: translateY(-2px);
    border-color: #3b82f6;
    background: rgba(59, 130, 246, 0.05);
}

.template-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.template-content h4 {
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.template-content p {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.6;
}

/* Usage Examples - Aynı stiller */
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
    border-color: #3b82f6;
    background: rgba(59, 130, 246, 0.05);
}

.example-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
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

/* Text Tips */
.text-tips {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.text-tips h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.tips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.tip-item {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 2rem;
    background: #f8fafc;
    border-radius: 16px;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
}

.tip-item:hover {
    transform: translateY(-2px);
    border-color: #3b82f6;
    background: rgba(59, 130, 246, 0.05);
}

.tip-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    flex-shrink: 0;
}

.tip-content h4 {
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
}

.tip-content p {
    color: #6b7280;
    font-size: 0.95rem;
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
    
    .instructions-grid, .features-grid, .examples-grid, .templates-grid, .tips-grid {
        grid-template-columns: 1fr;
    }
    
    .tip-item {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
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

const textTemplates = {
    contact: `İletişim Bilgileri
    
Ad: Ahmet Yılmaz
Telefon: +90 212 000 00 00
E-posta: ahmet@example.com
Adres: Atatürk Mah. İstiklal Cad. No:15 
Şişli/İstanbul

Çalışma Saatleri:
Pazartesi-Cuma: 09:00-18:00
Cumartesi: 09:00-13:00`,

    address: `Adres Bilgileri

Şirket: ABC Teknoloji Ltd.
Adres: Atatürk Mahallesi
İstiklal Caddesi No: 15 Kat: 3
Şişli/İstanbul 34360

Yol Tarifi:
- Metro: Şişli-Mecidiyeköy Metro İstasyonu
- Otobüs: 25E, 30M, 42K hatları
- Araç: Büyükdere Caddesi üzerinden gelip İstiklal Caddesi'ne sapın`,

    wifi: `Wi-Fi Bağlantı Bilgileri

Ağ Adı (SSID): MisafirAgi
Şifre: misafir2024

Bağlantı Talimatları:
1. Wi-Fi ayarlarını açın
2. "MisafirAgi" ağını seçin  
3. Şifreyi girin: misafir2024
4. Bağlan'a tıklayın

İnternet hızı: 100 Mbps
Kullanım süresi: 24 saat`,

    product: `Ürün Bilgileri

Ürün Adı: Bluetooth Kulaklık Pro
Model: BK-2024
Fiyat: 299 TL

Özellikler:
• Bluetooth 5.0 teknolojisi
• 8 saat müzik dinleme
• Gürültü önleyici mikrofon
• IPX4 su geçirmezlik
• Hızlı şarj (15 dk = 2 saat)

Garanti: 2 yıl
Üretici: TechSound`,

    event: `Etkinlik Bilgileri

Etkinlik: Teknoloji Konferansı 2024
Tarih: 15 Haziran 2024 Cumartesi
Saat: 09:00 - 17:00
Yer: İstanbul Kongre Merkezi
Salon: A1

Program:
09:00-10:00 Kayıt
10:00-12:00 Yapay Zeka Sunumu  
12:00-13:00 Öğle Arası
13:00-15:00 Blockchain Paneli
15:00-17:00 Networking

Katılım ücretsiz
Kayıt: www.techconf2024.com`,

    instruction: `Kullanım Talimatları

Ürün: Akıllı Termostat

Kurulum:
1. Cihazı duvara monte edin
2. Elektrik bağlantısını yapın
3. Wi-Fi'ye bağlanın (Ayarlar > Wi-Fi)
4. Mobil uygulamayı indirin

Kullanım:
• Sıcaklık ayarı: +/- tuşları
• Program ayarı: Menü > Program
• Uzaktan kontrol: Mobil uygulama

Destek: 0850 xxx xxxx`,

    quote: `"Başarı, hazırlık ile fırsatın buluştuğu andır."

- Bobby Unser

Bu söz bize şunu hatırlatır: 
Şans her zaman hazırlıklı olanı kayırır. 
Hayallerinize ulaşmak için bugünden 
hazırlanmaya başlayın.

#motivasyon #başarı #hayat`
};

function updateTextTemplate() {
    const textType = document.getElementById('textType').value;
    const textContent = document.getElementById('textContent');
    
    if (textType !== 'custom' && textTemplates[textType]) {
        textContent.value = textTemplates[textType];
        updateCharacterCount();
    }
}

function applyTextTemplate(templateType) {
    document.getElementById('textType').value = templateType;
    updateTextTemplate();
}

function updateCharacterCount() {
    const text = document.getElementById('textContent').value;
    const count = text.length;
    const counter = document.getElementById('characterCount');
    
    counter.textContent = `${count.toLocaleString()} karakter`;
}

function generateQR() {
    const textContent = document.getElementById('textContent').value.trim();
    const encoding = document.getElementById('encoding').value;
    const title = document.getElementById('title').value.trim();
    
    if (!textContent) {
        alert('Lütfen metin içeriğini girin!');
        return;
    }
    
    if (textContent.length > 4000) {
        alert('Metin çok uzun! Lütfen 4000 karakterden az bir metin girin.');
        return;
    }
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(textContent)}&color=3b82f6&bgcolor=ffffff&margin=20&format=png&charset-source=${encoding}&charset-target=${encoding}`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    const preview = textContent.length > 200 ? textContent.substring(0, 200) + '...' : textContent;
    
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="Metin QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${title || 'Metin QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            <strong>Metin Önizleme:</strong>
            <div style="background: #f3f4f6; padding: 1rem; border-radius: 8px; margin-top: 0.5rem; white-space: pre-wrap; font-family: monospace; max-height: 150px; overflow-y: auto;">${preview}</div>
            <div style="margin-top: 0.5rem;">
                <strong>Karakter Sayısı:</strong> ${textContent.length.toLocaleString()}<br>
                <strong>Kodlama:</strong> ${encoding}
            </div>
            <small style="margin-top: 0.5rem; display: block;">QR kodu taradığında bu metin görüntülenecek</small>
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        textContent, encoding, title 
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
    document.getElementById('textContent').value = '';
    document.getElementById('textType').value = 'custom';
    document.getElementById('encoding').value = 'UTF-8';
    document.getElementById('title').value = '';
    updateCharacterCount();
    clearQR();
}

function downloadQR() {
    if (!currentQRData.textContent) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.textContent)}&color=3b82f6&bgcolor=ffffff&margin=20&format=png&charset-source=${currentQRData.encoding}&charset-target=${currentQRData.encoding}`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `text-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.textContent) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.textContent)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('Metin QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Metin QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('Metin QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Karakter sayacını başlat
    updateCharacterCount();
    
    // Textarea değişikliklerini dinle
    const textContentTextarea = document.getElementById('textContent');
    textContentTextarea.addEventListener('input', updateCharacterCount);
    
    // İlk textarea'ya focus
    if (textContentTextarea) {
        textContentTextarea.focus();
    }
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>