<?php
$pageTitle = "Konum QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>Konum QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="title-content">
                    <h1>Konum QR Kod Oluşturucu</h1>
                    <p>Konumunuzu QR kod ile paylaşın, kolay navigasyon sağlayın</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>📍 Konum Bilgileri</h3>
                
                <div class="form-group">
                    <label for="locationMethod">Konum Girme Yöntemi</label>
                    <select id="locationMethod" onchange="toggleLocationMethod()">
                        <option value="coordinates">Koordinat ile (Enlem/Boylam)</option>
                        <option value="address">Adres ile</option>
                        <option value="current">Mevcut Konumu Kullan</option>
                    </select>
                </div>
                
                <!-- Koordinat Girişi -->
                <div id="coordinatesSection" class="location-section">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="latitude">Enlem (Latitude)</label>
                            <input type="number" id="latitude" step="any" placeholder="41.0082" required>
                            <small>-90 ile 90 arasında değer</small>
                        </div>
                        <div class="form-group">
                            <label for="longitude">Boylam (Longitude)</label>
                            <input type="number" id="longitude" step="any" placeholder="28.9784" required>
                            <small>-180 ile 180 arasında değer</small>
                        </div>
                    </div>
                </div>
                
                <!-- Adres Girişi -->
                <div id="addressSection" class="location-section" style="display: none;">
                    <div class="form-group">
                        <label for="address">Adres</label>
                        <textarea id="address" rows="3" placeholder="Sultanahmet Meydanı, Fatih/İstanbul, Türkiye"></textarea>
                        <small>Tam adres bilgisi girin</small>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="geocodeAddress()">
                        <i class="fas fa-search"></i>
                        Koordinatları Bul
                    </button>
                </div>
                
                <!-- Mevcut Konum -->
                <div id="currentLocationSection" class="location-section" style="display: none;">
                    <div class="current-location-info">
                        <i class="fas fa-crosshairs"></i>
                        <p>Tarayıcınızın konum erişim iznini vererek mevcut konumunuzu kullanabilirsiniz.</p>
                        <button type="button" class="btn btn-secondary" onclick="getCurrentLocation()">
                            <i class="fas fa-location-arrow"></i>
                            Mevcut Konumu Al
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="locationName">Konum Adı (Opsiyonel)</label>
                    <input type="text" id="locationName" placeholder="İstanbul Sultanahmet">
                    <small>QR kod için açıklayıcı isim</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="Konum Paylaşımı">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        Konum QR Oluştur
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
                    <i class="fas fa-map-marker-alt"></i>
                    <h4>Konum QR Kod Burada Görünecek</h4>
                    <p>Konum bilgilerini girin ve "Konum QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- Location Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 Konum QR Nasıl Kullanılır?</h3>
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
                        <i class="fas fa-map"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>2. Harita Uygulaması Açılır</h4>
                        <p>Varsayılan harita uygulaması otomatik açılır</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. Rota Oluşturulur</h4>
                        <p>Mevcut konumdan hedefe navigasyon başlar</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. Hedefe Ulaşın</h4>
                        <p>GPS navigasyon ile kolayca hedefe ulaşın</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Location Features -->
        <div class="location-features">
            <h3>✨ Konum QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-crosshairs"></i>
                    <h4>Hassas Konum</h4>
                    <p>GPS koordinatları ile metrelik hassasiyet</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Evrensel Uyumluluk</h4>
                    <p>Tüm harita uygulamalarında çalışır</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-compass"></i>
                    <h4>Otomatik Navigasyon</h4>
                    <p>Direkt harita uygulamasında rota oluşturur</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-globe"></i>
                    <h4>Dünya Çapında</h4>
                    <p>Dünyanın herhangi bir yerindeki konumlar</p>
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
                        <h4>İş Yerleri</h4>
                        <p>Mağaza, restoran, ofis lokasyonları için müşteri yönlendirmesi</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="example-content">
                        <h4>Etkinlik Mekanları</h4>
                        <p>Düğün, toplantı, parti mekanlarına kolay ulaşım</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="example-content">
                        <h4>Otopark Lokasyonu</h4>
                        <p>Araç park yerini hatırlamak için konum paylaşımı</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="example-content">
                        <h4>Ev/Ofis Adresi</h4>
                        <p>Kargo, teslimat için konum bilgisi paylaşımı</p>
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
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(5, 150, 105, 0.3);
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

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
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
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.form-group small {
    color: #6b7280;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    display: block;
}

.location-section {
    margin: 1.5rem 0;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
}

.current-location-info {
    text-align: center;
    padding: 2rem;
    color: #6b7280;
}

.current-location-info i {
    font-size: 3rem;
    color: #059669;
    margin-bottom: 1rem;
}

.current-location-info p {
    margin-bottom: 1.5rem;
    line-height: 1.6;
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
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(5, 150, 105, 0.4);
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
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
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

/* Location Features */
.location-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.location-features h3 {
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
    border-color: #059669;
    box-shadow: 0 5px 15px rgba(5, 150, 105, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #059669;
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
    border-color: #059669;
    background: rgba(5, 150, 105, 0.05);
}

.example-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
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
    
    .form-row {
        grid-template-columns: 1fr;
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

function toggleLocationMethod() {
    const method = document.getElementById('locationMethod').value;
    
    // Tüm section'ları gizle
    document.getElementById('coordinatesSection').style.display = 'none';
    document.getElementById('addressSection').style.display = 'none';
    document.getElementById('currentLocationSection').style.display = 'none';
    
    // Seçilen section'ı göster
    if (method === 'coordinates') {
        document.getElementById('coordinatesSection').style.display = 'block';
    } else if (method === 'address') {
        document.getElementById('addressSection').style.display = 'block';
    } else if (method === 'current') {
        document.getElementById('currentLocationSection').style.display = 'block';
    }
}

function getCurrentLocation() {
    if (!navigator.geolocation) {
        alert('Bu tarayıcı konum hizmetlerini desteklemiyor!');
        return;
    }
    
    const button = event.target;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Konum alınıyor...';
    button.disabled = true;
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
            document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
            
            button.innerHTML = '<i class="fas fa-check"></i> Konum Alındı';
            button.style.background = '#10b981';
            
            // 3 saniye sonra normal haline döndür
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-location-arrow"></i> Mevcut Konumu Al';
                button.style.background = '';
                button.disabled = false;
            }, 3000);
        },
        function(error) {
            alert('Konum alınamadı: ' + error.message);
            button.innerHTML = '<i class="fas fa-location-arrow"></i> Mevcut Konumu Al';
            button.disabled = false;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

function geocodeAddress() {
    const address = document.getElementById('address').value.trim();
    if (!address) {
        alert('Lütfen bir adres girin!');
        return;
    }
    
    // Bu örnekte basit bir geocoding simülasyonu yapıyoruz
    // Gerçek uygulamada Google Maps Geocoding API gibi bir servis kullanılmalı
    alert('Geocoding özelliği geliştirme aşamasında. Manuel olarak koordinat giriniz.');
}

function generateQR() {
    const latitude = document.getElementById('latitude').value.trim();
    const longitude = document.getElementById('longitude').value.trim();
    const locationName = document.getElementById('locationName').value.trim();
    const title = document.getElementById('title').value.trim();
    
    if (!latitude || !longitude) {
        alert('Lütfen enlem ve boylam değerlerini girin!');
        return;
    }
    
    // Koordinat validasyonu
    const lat = parseFloat(latitude);
    const lng = parseFloat(longitude);
    
    if (isNaN(lat) || lat < -90 || lat > 90) {
        alert('Enlem değeri -90 ile 90 arasında olmalıdır!');
        return;
    }
    
    if (isNaN(lng) || lng < -180 || lng > 180) {
        alert('Boylam değeri -180 ile 180 arasında olmalıdır!');
        return;
    }
    
    // Google Maps URL formatı oluştur
    const googleMapsURL = `https://maps.google.com/?q=${lat},${lng}`;
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(googleMapsURL)}&color=059669&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="Konum QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${title || locationName || 'Konum QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            <strong>Enlem:</strong> ${lat}<br>
            <strong>Boylam:</strong> ${lng}<br>
            ${locationName ? `<strong>Konum:</strong> ${locationName}<br>` : ''}
            <strong>Google Maps:</strong> <span style="word-break: break-all; font-size: 0.8rem;">${googleMapsURL}</span>
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        latitude: lat, longitude: lng, locationName, title, googleMapsURL 
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
    document.getElementById('locationMethod').value = 'coordinates';
    document.getElementById('latitude').value = '';
    document.getElementById('longitude').value = '';
    document.getElementById('address').value = '';
    document.getElementById('locationName').value = '';
    document.getElementById('title').value = '';
    toggleLocationMethod();
    clearQR();
}

function downloadQR() {
    if (!currentQRData.googleMapsURL) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.googleMapsURL)}&color=059669&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `location-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.googleMapsURL) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.googleMapsURL)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('Konum QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Konum QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('Konum QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Sayfa yüklendiğinde koordinat seçeneğini göster
document.addEventListener('DOMContentLoaded', function() {
    toggleLocationMethod();
    
    // İlk input'a focus
    const latInput = document.getElementById('latitude');
    if (latInput) {
        latInput.focus();
    }
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>