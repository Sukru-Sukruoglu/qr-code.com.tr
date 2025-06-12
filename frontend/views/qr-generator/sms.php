<?php
$pageTitle = "SMS QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>SMS QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-sms"></i>
                </div>
                <div class="title-content">
                    <h1>SMS QR Kod Oluşturucu</h1>
                    <p>SMS mesajınızı QR kod ile paylaşın, hızlı mesaj gönderimi sağlayın</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>💬 SMS Bilgileri</h3>
                
                <div class="form-group">
                    <label for="phoneNumber">Telefon Numarası</label>
                    <div class="phone-input-wrapper">
                        <select id="countryCode" class="country-select">
                            <option value="+90">🇹🇷 +90</option>
                            <option value="+1">🇺🇸 +1</option>
                            <option value="+44">🇬🇧 +44</option>
                            <option value="+49">🇩🇪 +49</option>
                            <option value="+33">🇫🇷 +33</option>
                            <option value="+39">🇮🇹 +39</option>
                            <option value="+34">🇪🇸 +34</option>
                            <option value="+31">🇳🇱 +31</option>
                            <option value="+32">🇧🇪 +32</option>
                            <option value="+41">🇨🇭 +41</option>
                        </select>
                        <input type="tel" id="phoneNumber" placeholder="212 000 00 00" required>
                    </div>
                    <small>SMS gönderilecek telefon numarası</small>
                </div>
                
                <div class="form-group">
                    <label for="smsMessage">SMS Mesajı</label>
                    <textarea id="smsMessage" rows="6" placeholder="Merhaba! Size özel bir teklifimiz var. Detaylar için bizi arayın. 🎉" required></textarea>
                    <small id="characterCount">0/160 karakter</small>
                </div>
                
                <div class="form-group">
                    <label for="smsType">SMS Türü</label>
                    <select id="smsType" onchange="updateSMSTemplate()">
                        <option value="custom">Özel Mesaj</option>
                        <option value="contact">İletişim Mesajı</option>
                        <option value="promotion">Promosyon/İndirim</option>
                        <option value="appointment">Randevu Hatırlatma</option>
                        <option value="event">Etkinlik Daveti</option>
                        <option value="support">Destek Talebi</option>
                        <option value="feedback">Geri Bildirim</option>
                    </select>
                    <small>Hazır şablon kullanmak için tür seçin</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="SMS Gönder">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        SMS QR Oluştur
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
                    <i class="fas fa-sms"></i>
                    <h4>SMS QR Kod Burada Görünecek</h4>
                    <p>SMS bilgilerini girin ve "SMS QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- SMS Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 SMS QR Nasıl Kullanılır?</h3>
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
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>2. SMS Uygulaması Açılır</h4>
                        <p>Telefonun SMS uygulaması otomatik açılır</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. Mesaj Hazırlanır</h4>
                        <p>Telefon numarası ve mesaj otomatik doldurulur</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. Mesajı Gönderin</h4>
                        <p>Gönder butonuna basarak SMS'i gönderin</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SMS Features -->
        <div class="sms-features">
            <h3>✨ SMS QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-bolt"></i>
                    <h4>Hızlı İletişim</h4>
                    <p>Telefon numarası yazmaya gerek yok</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <h4>Hatasız Gönderim</h4>
                    <p>Numara ve mesaj otomatik doldurulur</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-clock"></i>
                    <h4>Zaman Tasarrufu</h4>
                    <p>Mesaj şablonları ile hızlı hazırlık</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Evrensel Uyumluluk</h4>
                    <p>Tüm telefonlarda çalışır</p>
                </div>
            </div>
        </div>
        
        <!-- SMS Templates -->
        <div class="sms-templates">
            <h3>📝 Hazır SMS Şablonları</h3>
            <div class="templates-grid">
                <div class="template-item" onclick="applySMSTemplate('contact')">
                    <div class="template-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="template-content">
                        <h4>İletişim Mesajı</h4>
                        <p>"Merhaba! Size ulaşmak istiyorum. Müsait olduğunuzda arayabilir misiniz?"</p>
                    </div>
                </div>
                
                <div class="template-item" onclick="applySMSTemplate('promotion')">
                    <div class="template-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="template-content">
                        <h4>Promosyon/İndirim</h4>
                        <p>"Özel indirim fırsatımız! %20 indirim için hemen arayın. Son 2 gün!"</p>
                    </div>
                </div>
                
                <div class="template-item" onclick="applySMSTemplate('appointment')">
                    <div class="template-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="template-content">
                        <h4>Randevu Hatırlatma</h4>
                        <p>"Yarın saat 14:00'te randevunuz var. Onaylamak için lütfen yanıtlayın."</p>
                    </div>
                </div>
                
                <div class="template-item" onclick="applySMSTemplate('event')">
                    <div class="template-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="template-content">
                        <h4>Etkinlik Daveti</h4>
                        <p>"Özel etkinliğimize davetlisiniz! Tarih: 15 Haziran, Saat: 19:00"</p>
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
                        <h4>İşletme İletişimi</h4>
                        <p>Müşterilerin size SMS ile hızlı ulaşabilmesi</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="example-content">
                        <h4>Randevu Sistemi</h4>
                        <p>Hastane, kuaför gibi randevu hatırlatmaları</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="example-content">
                        <h4>Pazarlama Kampanyaları</h4>
                        <p>Promosyon ve indirim duyuruları</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="example-content">
                        <h4>Müşteri Desteği</h4>
                        <p>Destek talepleri ve geri bildirimler</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SMS Benefits -->
        <div class="sms-benefits">
            <h3>🎯 SMS QR'ın Avantajları</h3>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-number">01</div>
                    <div class="benefit-content">
                        <h4>Yüksek Açılma Oranı</h4>
                        <p>SMS'lerin %98 oranında açıldığı kanıtlanmıştır</p>
                    </div>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-number">02</div>
                    <div class="benefit-content">
                        <h4>Anında Ulaşım</h4>
                        <p>Mesajlar saniyeler içinde karşı tarafa ulaşır</p>
                    </div>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-number">03</div>
                    <div class="benefit-content">
                        <h4>İnternet Gerektirmez</h4>
                        <p>Wi-Fi veya data bağlantısı olmadan çalışır</p>
                    </div>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-number">04</div>
                    <div class="benefit-content">
                        <h4>Düşük Maliyet</h4>
                        <p>Uygun fiyatlı ve etkili iletişim yöntemi</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Access to Other QR Types -->
        <div class="other-qr-types">
            <h3>📱 Diğer QR Türleri</h3>
            <div class="quick-qr-grid">
                <a href="<?php echo SITE_URL; ?>/qr/phone" class="quick-qr-card">
                    <i class="fas fa-phone"></i>
                    <span>Telefon QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/whatsapp" class="quick-qr-card">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/email" class="quick-qr-card">
                    <i class="fas fa-envelope"></i>
                    <span>E-posta QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/vcard" class="quick-qr-card">
                    <i class="fas fa-id-card"></i>
                    <span>vCard QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/social" class="quick-qr-card">
                    <i class="fas fa-share-alt"></i>
                    <span>Sosyal Medya QR</span>
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
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
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

.form-group input, .form-group textarea, .form-group select {
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

.form-group input:focus, .form-group textarea:focus, .form-group select:focus, .country-select:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
    width: 100%;
}

.form-group small {
    color: #6b7280;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    display: block;
}

#characterCount {
    color: #10b981;
    font-weight: 500;
}

#characterCount.warning {
    color: #f59e0b;
}

#characterCount.danger {
    color: #ef4444;
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
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
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
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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

/* SMS Features */
.sms-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.sms-features h3 {
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
    border-color: #10b981;
    box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #10b981;
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

/* SMS Templates */
.sms-templates {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.sms-templates h3 {
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
    border-color: #10b981;
    background: rgba(16, 185, 129, 0.05);
}

.template-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
    font-style: italic;
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
    border-color: #10b981;
    background: rgba(16, 185, 129, 0.05);
}

.example-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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

/* SMS Benefits */
.sms-benefits {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.sms-benefits h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 2rem;
    background: #f8fafc;
    border-radius: 16px;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
}

.benefit-item:hover {
    transform: translateY(-2px);
    border-color: #10b981;
    background: rgba(16, 185, 129, 0.05);
}

.benefit-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    flex-shrink: 0;
}

.benefit-content h4 {
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
}

.benefit-content p {
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
    
    .instructions-grid, .features-grid, .examples-grid, .templates-grid, .benefits-grid {
        grid-template-columns: 1fr;
    }
    
    .benefit-item {
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

const smsTemplates = {
    contact: "Merhaba! Size ulaşmak istiyorum. Müsait olduğunuzda arayabilir misiniz?",
    promotion: "Özel indirim fırsatımız! %20 indirim için hemen arayın. Son 2 gün!",
    appointment: "Yarın saat 14:00'te randevunuz var. Onaylamak için lütfen yanıtlayın.",
    event: "Özel etkinliğimize davetlisiniz! Tarih: 15 Haziran, Saat: 19:00",
    support: "Merhaba! Yardıma ihtiyacınız var mı? Size nasıl yardımcı olabiliriz?",
    feedback: "Hizmetimiz hakkında görüşlerinizi paylaşır mısınız? Geri bildiriminiz bizim için değerli."
};

function updateSMSTemplate() {
    const smsType = document.getElementById('smsType').value;
    const messageTextarea = document.getElementById('smsMessage');
    
    if (smsType !== 'custom' && smsTemplates[smsType]) {
        messageTextarea.value = smsTemplates[smsType];
        updateCharacterCount();
    }
}

function applySMSTemplate(templateType) {
    document.getElementById('smsType').value = templateType;
    updateSMSTemplate();
}

function updateCharacterCount() {
    const message = document.getElementById('smsMessage').value;
    const count = message.length;
    const counter = document.getElementById('characterCount');
    
    counter.textContent = `${count}/160 karakter`;
    
    // Renk değişimi
    counter.className = '';
    if (count > 160) {
        counter.classList.add('danger');
    } else if (count > 140) {
        counter.classList.add('warning');
    }
}

function generateQR() {
    const countryCode = document.getElementById('countryCode').value;
    const phoneNumber = document.getElementById('phoneNumber').value.trim();
    const smsMessage = document.getElementById('smsMessage').value.trim();
    const title = document.getElementById('title').value.trim();
    
    if (!phoneNumber) {
        alert('Lütfen telefon numarasını girin!');
        return;
    }
    
    if (!smsMessage) {
        alert('Lütfen SMS mesajını girin!');
        return;
    }
    
    // Telefon numarasını temizle (sadece rakamlar)
    const cleanPhone = phoneNumber.replace(/\D/g, '');
    const fullPhone = countryCode + cleanPhone;
    
    // SMS URI formatı oluştur
    const smsURI = `sms:${fullPhone}?body=${encodeURIComponent(smsMessage)}`;
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(smsURI)}&color=10b981&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="SMS QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${title || 'SMS QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            <strong>Alıcı:</strong> ${fullPhone}<br>
            <strong>Mesaj:</strong> <div style="background: #f3f4f6; padding: 0.75rem; border-radius: 8px; margin-top: 0.5rem; font-style: italic;">"${smsMessage}"</div>
            <small style="margin-top: 0.5rem; display: block;">QR kodu taradığında SMS uygulaması açılacak ve mesaj hazır olacak</small>
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        fullPhone, smsMessage, title, smsURI 
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
    document.getElementById('smsMessage').value = '';
    document.getElementById('smsType').value = 'custom';
    document.getElementById('title').value = '';
    updateCharacterCount();
    clearQR();
}

function downloadQR() {
    if (!currentQRData.smsURI) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.smsURI)}&color=10b981&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `sms-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.smsURI) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.smsURI)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('SMS QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('SMS QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('SMS QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Karakter sayacını başlat
    updateCharacterCount();
    
    // SMS mesajı değişikliklerini dinle
    const smsTextarea = document.getElementById('smsMessage');
    smsTextarea.addEventListener('input', updateCharacterCount);
    
    // İlk input'a focus
    const phoneInput = document.getElementById('phoneNumber');
    if (phoneInput) {
        phoneInput.focus();
    }
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>