<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\qr-generator\social.php
$pageTitle = "Sosyal Medya QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>Sosyal Medya QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-share-alt"></i>
                </div>
                <div class="title-content">
                    <h1>Sosyal Medya QR Kod Oluşturucu</h1>
                    <p>Sosyal medya hesaplarınızı QR kod ile paylaşın, takipçi sayınızı artırın</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>📱 Sosyal Medya Bilgileri</h3>
                
                <div class="form-group">
                    <label for="socialPlatform">Sosyal Medya Platformu</label>
                    <select id="socialPlatform" onchange="updatePlatformExample()">
                        <option value="instagram">📷 Instagram</option>
                        <option value="facebook">📘 Facebook</option>
                        <option value="twitter">🐦 Twitter (X)</option>
                        <option value="linkedin">💼 LinkedIn</option>
                        <option value="youtube">🎥 YouTube</option>
                        <option value="tiktok">🎵 TikTok</option>
                        <option value="telegram">✈️ Telegram</option>
                        <option value="snapchat">👻 Snapchat</option>
                        <option value="pinterest">📌 Pinterest</option>
                        <option value="discord">🎮 Discord</option>
                        <option value="twitch">🎮 Twitch</option>
                        <option value="github">💻 GitHub</option>
                        <option value="custom">🔗 Özel URL</option>
                    </select>
                    <small>Paylaşmak istediğiniz sosyal medya platformunu seçin</small>
                </div>
                
                <div class="form-group">
                    <label for="username">Kullanıcı Adı veya Profil URL'si</label>
                    <div class="username-input-wrapper">
                        <span class="platform-prefix" id="platformPrefix">https://instagram.com/</span>
                        <input type="text" id="username" placeholder="kullaniciadi" required>
                    </div>
                    <small id="platformExample">Örnek: @kullaniciadi veya tam URL</small>
                </div>
                
                <div class="form-group">
                    <label for="displayName">Görünür Ad (Opsiyonel)</label>
                    <input type="text" id="displayName" placeholder="Ahmet Yılmaz">
                    <small>QR kod için görünür isim</small>
                </div>
                
                <div class="form-group">
                    <label for="description">Açıklama (Opsiyonel)</label>
                    <textarea id="description" rows="3" placeholder="Beni takip et! 🚀"></textarea>
                    <small>Kısa açıklama veya çağrı metni</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="Sosyal Medya Profilim">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        Sosyal Medya QR Oluştur
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
                    <i class="fas fa-share-alt"></i>
                    <h4>Sosyal Medya QR Kod Burada Görünecek</h4>
                    <p>Sosyal medya bilgilerini girin ve "Sosyal Medya QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- Social Media Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 Sosyal Medya QR Nasıl Kullanılır?</h3>
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
                        <h4>2. Sosyal Medya Açılır</h4>
                        <p>İlgili sosyal medya uygulaması otomatik açılır</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. Profili Görüntüle</h4>
                        <p>Sosyal medya profiliniz direkt görüntülenir</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. Takip Et veya Beğen</h4>
                        <p>Tek tıkla takip et, beğen veya etkileşime geç</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Social Media Features -->
        <div class="social-features">
            <h3>✨ Sosyal Medya QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-rocket"></i>
                    <h4>Hızlı Takip</h4>
                    <p>Username yazma gereksiz, direkt takip</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-chart-line"></i>
                    <h4>Takipçi Artışı</h4>
                    <p>QR kod ile organik takipçi kazanımı</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-globe"></i>
                    <h4>Çok Platform</h4>
                    <p>13 farklı sosyal medya platformu</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-share"></i>
                    <h4>Kolay Paylaşım</h4>
                    <p>Basılı materyallerde kullanım</p>
                </div>
            </div>
        </div>
        
        <!-- Platform Examples -->
        <div class="platform-examples">
            <h3>🌟 Desteklenen Platformlar</h3>
            <div class="platforms-grid">
                <div class="platform-item">
                    <div class="platform-icon instagram">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="platform-info">
                        <h4>Instagram</h4>
                        <p>Fotoğraf ve story paylaşımları</p>
                    </div>
                </div>
                
                <div class="platform-item">
                    <div class="platform-icon facebook">
                        <i class="fab fa-facebook"></i>
                    </div>
                    <div class="platform-info">
                        <h4>Facebook</h4>
                        <p>Kişisel ve iş sayfaları</p>
                    </div>
                </div>
                
                <div class="platform-item">
                    <div class="platform-icon twitter">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="platform-info">
                        <h4>Twitter (X)</h4>
                        <p>Güncel haberler ve düşünceler</p>
                    </div>
                </div>
                
                <div class="platform-item">
                    <div class="platform-icon linkedin">
                        <i class="fab fa-linkedin"></i>
                    </div>
                    <div class="platform-info">
                        <h4>LinkedIn</h4>
                        <p>Profesyonel ağ kurma</p>
                    </div>
                </div>
                
                <div class="platform-item">
                    <div class="platform-icon youtube">
                        <i class="fab fa-youtube"></i>
                    </div>
                    <div class="platform-info">
                        <h4>YouTube</h4>
                        <p>Video içerik ve kanallar</p>
                    </div>
                </div>
                
                <div class="platform-item">
                    <div class="platform-icon tiktok">
                        <i class="fab fa-tiktok"></i>
                    </div>
                    <div class="platform-info">
                        <h4>TikTok</h4>
                        <p>Kısa video içerikleri</p>
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
                        <i class="fas fa-id-card-alt"></i>
                    </div>
                    <div class="example-content">
                        <h4>Kartvizitler</h4>
                        <p>Kartvizitlerde sosyal medya hesapları</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="example-content">
                        <h4>İşletme Tanıtımı</h4>
                        <p>Mağaza, restoran sosyal medya sayfaları</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="example-content">
                        <h4>Etkinlik Tanıtımı</h4>
                        <p>Konser, seminer gibi etkinlik sosyal medyası</p>
                    </div>
                </div>
                
                <div class="example-item">
                    <div class="example-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="example-content">
                        <h4>Kişisel Marka</h4>
                        <p>Influencer ve content creator profilleri</p>
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
                <a href="<?php echo SITE_URL; ?>/qr/business" class="quick-qr-card">
                    <i class="fas fa-briefcase"></i>
                    <span>İş QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/text" class="quick-qr-card">
                    <i class="fas fa-file-alt"></i>
                    <span>Metin QR</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/qr/whatsapp" class="quick-qr-card">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp QR</span>
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
    background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(233, 30, 99, 0.3);
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

.username-input-wrapper {
    display: flex;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.username-input-wrapper:focus-within {
    border-color: #e91e63;
    box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.1);
}

.platform-prefix {
    background: #f3f4f6;
    padding: 1rem;
    color: #6b7280;
    font-size: 0.9rem;
    border-right: 1px solid #e5e7eb;
    white-space: nowrap;
}

.username-input-wrapper input {
    flex: 1;
    padding: 1rem;
    border: none;
    outline: none;
    font-size: 1rem;
    background: white;
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
    border-color: #e91e63;
    box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.1);
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
    background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(233, 30, 99, 0.4);
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
    background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
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

/* Social Features */
.social-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.social-features h3 {
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
    border-color: #e91e63;
    box-shadow: 0 5px 15px rgba(233, 30, 99, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #e91e63;
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

/* Platform Examples */
.platform-examples {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.platform-examples h3 {
    color: #1a1a1a;
    margin-bottom: 2rem;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.platforms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.platform-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
}

.platform-item:hover {
    transform: translateY(-2px);
    border-color: #e91e63;
    background: rgba(233, 30, 99, 0.05);
}

.platform-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.platform-icon.instagram { background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d); }
.platform-icon.facebook { background: #1877f2; }
.platform-icon.twitter { background: #1da1f2; }
.platform-icon.linkedin { background: #0077b5; }
.platform-icon.youtube { background: #ff0000; }
.platform-icon.tiktok { background: #000000; }

.platform-info h4 {
    color: #1a1a1a;
    margin-bottom: 0.25rem;
    font-size: 1.1rem;
}

.platform-info p {
    color: #6b7280;
    font-size: 0.9rem;
    margin: 0;
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
    border-color: #e91e63;
    background: rgba(233, 30, 99, 0.05);
}

.example-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
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
    
    .username-input-wrapper {
        flex-direction: column;
    }
    
    .platform-prefix {
        border-right: none;
        border-bottom: 1px solid #e5e7eb;
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
    
    .instructions-grid, .features-grid, .examples-grid, .platforms-grid {
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

const platformURLs = {
    instagram: 'https://instagram.com/',
    facebook: 'https://facebook.com/',
    twitter: 'https://twitter.com/',
    linkedin: 'https://linkedin.com/in/',
    youtube: 'https://youtube.com/@',
    tiktok: 'https://tiktok.com/@',
    telegram: 'https://t.me/',
    snapchat: 'https://snapchat.com/add/',
    pinterest: 'https://pinterest.com/',
    discord: 'https://discord.gg/',
    twitch: 'https://twitch.tv/',
    github: 'https://github.com/',
    custom: ''
};

function updatePlatformExample() {
    const platform = document.getElementById('socialPlatform').value;
    const prefix = document.getElementById('platformPrefix');
    const example = document.getElementById('platformExample');
    const usernameInput = document.getElementById('username');
    
    if (platform === 'custom') {
        prefix.textContent = '';
        prefix.style.display = 'none';
        example.textContent = 'Tam URL girin: https://platform.com/profil';
        usernameInput.placeholder = 'https://platform.com/profil';
    } else {
        prefix.style.display = 'block';
        prefix.textContent = platformURLs[platform];
        
        const examples = {
            instagram: '@kullaniciadi veya sadece kullaniciadi',
            facebook: 'kullaniciadi veya profil.linki',
            twitter: '@kullaniciadi veya kullaniciadi',
            linkedin: 'kullaniciadi (profil linki için)',
            youtube: '@kanaladi veya kanal-adi',
            tiktok: '@kullaniciadi veya kullaniciadi',
            telegram: 'kullaniciadi veya grup_linki',
            snapchat: 'kullaniciadi',
            pinterest: 'kullaniciadi',
            discord: 'sunucu_davet_kodu',
            twitch: 'kanaladi',
            github: 'kullaniciadi'
        };
        
        example.textContent = `Örnek: ${examples[platform]}`;
        usernameInput.placeholder = platform === 'youtube' ? 'kanaladi' : 'kullaniciadi';
    }
}

function generateQR() {
    const platform = document.getElementById('socialPlatform').value;
    const username = document.getElementById('username').value.trim();
    const displayName = document.getElementById('displayName').value.trim();
    const description = document.getElementById('description').value.trim();
    const title = document.getElementById('title').value.trim();
    
    if (!username) {
        alert('Lütfen kullanıcı adı veya profil URL\'sini girin!');
        return;
    }
    
    let socialURL = '';
    
    if (platform === 'custom') {
        if (!isValidUrl(username)) {
            alert('Lütfen geçerli bir URL girin!');
            return;
        }
        socialURL = username;
    } else {
        // Username'den @ işaretini kaldır
        const cleanUsername = username.replace('@', '');
        socialURL = platformURLs[platform] + cleanUsername;
    }
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(socialURL)}&color=e91e63&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="Sosyal Medya QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${title || displayName || getPlatformName(platform) + ' Profilim'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            <strong>Platform:</strong> ${getPlatformName(platform)}<br>
            <strong>Profil:</strong> <a href="${socialURL}" target="_blank" style="color: #e91e63;">${socialURL}</a><br>
            ${displayName ? `<strong>Ad:</strong> ${displayName}<br>` : ''}
            ${description ? `<strong>Açıklama:</strong> ${description}` : ''}
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        platform, username, displayName, description, title, socialURL 
    };
    
    // Smooth scroll
    document.getElementById('qrPreview').scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
    });
}

function getPlatformName(platform) {
    const names = {
        instagram: 'Instagram',
        facebook: 'Facebook',
        twitter: 'Twitter (X)',
        linkedin: 'LinkedIn',
        youtube: 'YouTube',
        tiktok: 'TikTok',
        telegram: 'Telegram',
        snapchat: 'Snapchat',
        pinterest: 'Pinterest',
        discord: 'Discord',
        twitch: 'Twitch',
        github: 'GitHub',
        custom: 'Özel Platform'
    };
    return names[platform] || platform;
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
    document.getElementById('socialPlatform').value = 'instagram';
    document.getElementById('username').value = '';
    document.getElementById('displayName').value = '';
    document.getElementById('description').value = '';
    document.getElementById('title').value = '';
    updatePlatformExample();
    clearQR();
}

function downloadQR() {
    if (!currentQRData.socialURL) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.socialURL)}&color=e91e63&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `social-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.socialURL) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.socialURL)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('Sosyal Medya QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Sosyal Medya QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('Sosyal Medya QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Sayfa yüklendiğinde platform örneğini ayarla
document.addEventListener('DOMContentLoaded', function() {
    updatePlatformExample();
    
    // İlk input'a focus
    const usernameInput = document.getElementById('username');
    if (usernameInput) {
        usernameInput.focus();
    }
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>