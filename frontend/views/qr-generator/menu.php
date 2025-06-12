<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\qr-generator\menu.php
$pageTitle = "Menü QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>Menü QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="title-content">
                    <h1>Menü QR Kod Oluşturucu</h1>
                    <p>Restoran menünüzü QR kod ile paylaşın, temassız menü deneyimi sağlayın</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>🍽️ Menü Bilgileri</h3>
                
                <div class="form-group">
                    <label for="menuType">Menü Türü</label>
                    <select id="menuType" onchange="toggleMenuType()">
                        <option value="url">Menü URL'si (Online Menü)</option>
                        <option value="pdf">PDF Menü</option>
                        <option value="image">Görsel Menü</option>
                        <option value="text">Metin Menü</option>
                    </select>
                    <small>Menü paylaşım yönteminizi seçin</small>
                </div>
                
                <!-- URL Menü -->
                <div id="urlMenuSection" class="menu-section">
                    <div class="form-group">
                        <label for="menuUrl">Menü URL'si</label>
                        <input type="url" id="menuUrl" placeholder="https://restaurant.com/menu" required>
                        <small>Online menü sayfanızın URL'si</small>
                    </div>
                </div>
                
                <!-- PDF Menü -->
                <div id="pdfMenuSection" class="menu-section" style="display: none;">
                    <div class="form-group">
                        <label for="pdfUrl">PDF Menü URL'si</label>
                        <input type="url" id="pdfUrl" placeholder="https://restaurant.com/menu.pdf">
                        <small>PDF menü dosyanızın URL'si</small>
                    </div>
                </div>
                
                <!-- Görsel Menü -->
                <div id="imageMenuSection" class="menu-section" style="display: none;">
                    <div class="form-group">
                        <label for="imageUrl">Menü Görseli URL'si</label>
                        <input type="url" id="imageUrl" placeholder="https://restaurant.com/menu.jpg">
                        <small>Menü görsel dosyanızın URL'si</small>
                    </div>
                </div>
                
                <!-- Metin Menü -->
                <div id="textMenuSection" class="menu-section" style="display: none;">
                    <div class="form-group">
                        <label for="menuText">Menü Metni</label>
                        <textarea id="menuText" rows="6" placeholder="🍔 Hamburger - 25₺&#10;🍕 Pizza - 35₺&#10;🥗 Salata - 20₺&#10;☕ Kahve - 10₺"></textarea>
                        <small>Basit metin formatında menünüz</small>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="restaurantName">Restoran Adı (Opsiyonel)</label>
                    <input type="text" id="restaurantName" placeholder="Lezzetli Restoran">
                    <small>QR kod için restoran/cafe adı</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="Dijital Menü">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        Menü QR Oluştur
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
                    <i class="fas fa-utensils"></i>
                    <h4>Menü QR Kod Burada Görünecek</h4>
                    <p>Menü bilgilerini girin ve "Menü QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- Menu Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 Menü QR Nasıl Kullanılır?</h3>
            <div class="instructions-grid">
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>1. QR Kodu Tarayın</h4>
                        <p>Müşteriler masa üzerindeki QR kodu kamera ile tarar</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>2. Menü Açılır</h4>
                        <p>Telefon/tablette dijital menü otomatik açılır</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. Menüyü İnceler</h4>
                        <p>Müşteri ürünleri ve fiyatları detaylıca inceler</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. Sipariş Verir</h4>
                        <p>İstediği ürünleri seçip sipariş verebilir</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Menu Features -->
        <div class="menu-features">
            <h3>✨ Menü QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-virus-slash"></i>
                    <h4>Temassız Menü</h4>
                    <p>Hijyenik, fiziksel menüye dokunmadan erişim</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-sync-alt"></i>
                    <h4>Anlık Güncelleme</h4>
                    <p>Fiyat ve ürün değişiklikleri anında yansıtılır</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-leaf"></i>
                    <h4>Çevre Dostu</h4>
                    <p>Kağıt menü kullanımını azaltır, doğa dostu</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-money-bill-wave"></i>
                    <h4>Maliyet Tasarrufu</h4>
                    <p>Basım maliyetlerini ortadan kaldırır</p>
                </div>
            </div>
        </div>
        
        <!-- Usage Examples -->
        <div class="usage-examples">
            <h3>💡 Kullanım Örnekleri</h3>
            <div class="examples-grid">
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="example-content">
                        <h4>Restoranlar</h4>
                        <p>Ana yemek, çorba, tatlı menüleri için dijital erişim</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <div class="example-content">
                        <h4>Kafeler</h4>
                        <p>Kahve çeşitleri, pastane ürünleri için</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-pizza-slice"></i>
                    </div>
                    <div class="example-content">
                        <h4>Fast Food</h4>
                        <p>Hızlı servis menüleri ve combo seçenekleri</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-glass-cheers"></i>
                    </div>
                    <div class="example-content">
                        <h4>Barlar</h4>
                        <p>İçecek menüleri ve kokteyl tarifleri</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Menu QR Benefits -->
        <div class="menu-benefits">
            <h3>🎯 Menü QR'ın Avantajları</h3>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-number">01</div>
                    <div class="benefit-content">
                        <h4>Müşteri Deneyimi</h4>
                        <p>Modern ve teknolojik imaj, müşteri memnuniyeti artar</p>
                    </div>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-number">02</div>
                    <div class="benefit-content">
                        <h4>Operasyonel Verimlilik</h4>
                        <p>Garson iş yükü azalır, servis hızlanır</p>
                    </div>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-number">03</div>
                    <div class="benefit-content">
                        <h4>Uluslararası Erişim</h4>
                        <p>Çok dilli menüler ile turistlere hitap eder</p>
                    </div>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-number">04</div>
                    <div class="benefit-content">
                        <h4>Analitik Takip</h4>
                        <p>Menü görüntüleme istatistikleri alınabilir</p>
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
    background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(234, 88, 12, 0.3);
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

.menu-section {
    margin: 1.5rem 0;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
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
    border-color: #ea580c;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
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
    background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(234, 88, 12, 0.4);
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
    background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
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

/* Menu Features */
.menu-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.menu-features h3 {
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
    border-color: #ea580c;
    box-shadow: 0 5px 15px rgba(234, 88, 12, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #ea580c;
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
    border-color: #ea580c;
    background: rgba(234, 88, 12, 0.05);
}

.example-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
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

/* Menu Benefits */
.menu-benefits {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.menu-benefits h3 {
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
    border-color: #ea580c;
    background: rgba(234, 88, 12, 0.05);
}

.benefit-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
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
    
    .instructions-grid, .features-grid, .examples-grid, .benefits-grid {
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

function toggleMenuType() {
    const menuType = document.getElementById('menuType').value;
    
    // Tüm section'ları gizle
    document.getElementById('urlMenuSection').style.display = 'none';
    document.getElementById('pdfMenuSection').style.display = 'none';
    document.getElementById('imageMenuSection').style.display = 'none';
    document.getElementById('textMenuSection').style.display = 'none';
    
    // Seçilen section'ı göster
    if (menuType === 'url') {
        document.getElementById('urlMenuSection').style.display = 'block';
    } else if (menuType === 'pdf') {
        document.getElementById('pdfMenuSection').style.display = 'block';
    } else if (menuType === 'image') {
        document.getElementById('imageMenuSection').style.display = 'block';
    } else if (menuType === 'text') {
        document.getElementById('textMenuSection').style.display = 'block';
    }
}

function generateQR() {
    const menuType = document.getElementById('menuType').value;
    const restaurantName = document.getElementById('restaurantName').value.trim();
    const title = document.getElementById('title').value.trim();
    
    let menuData = '';
    let menuInfo = '';
    
    // Menü türüne göre veri al
    if (menuType === 'url') {
        const menuUrl = document.getElementById('menuUrl').value.trim();
        if (!menuUrl) {
            alert('Lütfen menü URL\'sini girin!');
            return;
        }
        if (!isValidUrl(menuUrl)) {
            alert('Lütfen geçerli bir URL girin!');
            return;
        }
        menuData = menuUrl;
        menuInfo = `Online Menü: ${menuUrl}`;
    } else if (menuType === 'pdf') {
        const pdfUrl = document.getElementById('pdfUrl').value.trim();
        if (!pdfUrl) {
            alert('Lütfen PDF URL\'sini girin!');
            return;
        }
        if (!isValidUrl(pdfUrl)) {
            alert('Lütfen geçerli bir PDF URL\'si girin!');
            return;
        }
        menuData = pdfUrl;
        menuInfo = `PDF Menü: ${pdfUrl}`;
    } else if (menuType === 'image') {
        const imageUrl = document.getElementById('imageUrl').value.trim();
        if (!imageUrl) {
            alert('Lütfen görsel URL\'sini girin!');
            return;
        }
        if (!isValidUrl(imageUrl)) {
            alert('Lütfen geçerli bir görsel URL\'si girin!');
            return;
        }
        menuData = imageUrl;
        menuInfo = `Görsel Menü: ${imageUrl}`;
    } else if (menuType === 'text') {
        const menuText = document.getElementById('menuText').value.trim();
        if (!menuText) {
            alert('Lütfen menü metnini girin!');
            return;
        }
        menuData = menuText;
        menuInfo = `Metin Menü: ${menuText.length > 50 ? menuText.substring(0, 50) + '...' : menuText}`;
    }
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(menuData)}&color=ea580c&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="Menü QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${title || restaurantName || 'Menü QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            ${restaurantName ? `<strong>Restoran:</strong> ${restaurantName}<br>` : ''}
            <strong>Menü Türü:</strong> ${getMenuTypeText(menuType)}<br>
            <strong>İçerik:</strong> <span style="word-break: break-all; font-size: 0.8rem;">${menuInfo}</span>
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        menuType, menuData, restaurantName, title, menuInfo 
    };
    
    // Smooth scroll
    document.getElementById('qrPreview').scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
    });
}

function getMenuTypeText(type) {
    const types = {
        'url': 'Online Menü',
        'pdf': 'PDF Menü',
        'image': 'Görsel Menü',
        'text': 'Metin Menü'
    };
    return types[type] || type;
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
    document.getElementById('menuType').value = 'url';
    document.getElementById('menuUrl').value = '';
    document.getElementById('pdfUrl').value = '';
    document.getElementById('imageUrl').value = '';
    document.getElementById('menuText').value = '';
    document.getElementById('restaurantName').value = '';
    document.getElementById('title').value = '';
    toggleMenuType();
    clearQR();
}

function downloadQR() {
    if (!currentQRData.menuData) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.menuData)}&color=ea580c&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `menu-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.menuData) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.menuData)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('Menü QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Menü QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('Menü QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Sayfa yüklendiğinde URL seçeneğini göster
document.addEventListener('DOMContentLoaded', function() {
    toggleMenuType();
    
    // İlk input'a focus
    const menuUrlInput = document.getElementById('menuUrl');
    if (menuUrlInput) {
        menuUrlInput.focus();
    }
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>