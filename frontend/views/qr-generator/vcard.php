<?php
$pageTitle = "vCard QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>vCard QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-id-card"></i>
                </div>
                <div class="title-content">
                    <h1>vCard QR Kod Oluşturucu</h1>
                    <p>Dijital kartvizitinizi QR kod ile paylaşın, kişiler rehbere kolayca eklesin</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>👤 Kişisel Bilgiler</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">Ad</label>
                        <input type="text" id="firstName" placeholder="Adınız" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Soyad</label>
                        <input type="text" id="lastName" placeholder="Soyadınız" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="organization">Şirket/Organizasyon</label>
                    <input type="text" id="organization" placeholder="Şirket adı">
                </div>
                
                <div class="form-group">
                    <label for="title">Unvan/Pozisyon</label>
                    <input type="text" id="title" placeholder="Yazılım Geliştirici">
                </div>
                
                <h3>📞 İletişim Bilgileri</h3>
                
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="tel" id="phone" placeholder="+90 532 000 00 00">
                </div>
                
                <div class="form-group">
                    <label for="email">E-posta</label>
                    <input type="email" id="email" placeholder="ornek@email.com">
                </div>
                
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" placeholder="https://website.com">
                </div>
                
                <h3>📍 Adres Bilgileri</h3>
                
                <div class="form-group">
                    <label for="address">Adres</label>
                    <textarea id="address" rows="3" placeholder="Sokak, Mahalle, İlçe/İl"></textarea>
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        vCard QR Oluştur
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
                    <i class="fas fa-id-card"></i>
                    <h4>vCard QR Kod Burada Görünecek</h4>
                    <p>Kişisel bilgilerinizi girin ve "vCard QR Oluştur" butonuna tıklayın</p>
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
        
        <!-- vCard Usage Instructions -->
        <div class="usage-instructions">
            <h3>📋 vCard QR Nasıl Kullanılır?</h3>
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
                        <i class="fas fa-address-book"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>2. Rehbere Ekle</h4>
                        <p>Kişi bilgilerini otomatik olarak rehbere kaydedin</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>3. Kolay Paylaşım</h4>
                        <p>Kartvizitin QR kodu ile hızlıca paylaşın</p>
                    </div>
                </div>
                
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="instruction-content">
                        <h4>4. Evrensel Uyumluluk</h4>
                        <p>Tüm akıllı telefonlarda çalışır</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- vCard Features -->
        <div class="vcard-features">
            <h3>✨ vCard QR Özellikleri</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-user-check"></i>
                    <h4>Tam Profil</h4>
                    <p>Ad, soyad, unvan, şirket bilgileri</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-phone-alt"></i>
                    <h4>İletişim</h4>
                    <p>Telefon, e-posta, website bilgileri</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <h4>Konum</h4>
                    <p>Tam adres ve konum bilgileri</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-download"></i>
                    <h4>Otomatik</h4>
                    <p>Tek tıkla rehbere kaydetme</p>
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
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
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
    margin: 2rem 0 1.5rem 0;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-bottom: 2px solid #f3f4f6;
    padding-bottom: 0.5rem;
}

.form-section h3:first-child {
    margin-top: 0;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
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
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
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
    margin-top: 2rem;
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
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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

/* vCard Features */
.vcard-features {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.vcard-features h3 {
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
    border-color: #8b5cf6;
    box-shadow: 0 5px 15px rgba(139, 92, 246, 0.2);
}

.feature-item i {
    font-size: 2rem;
    color: #8b5cf6;
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
    
    .instructions-grid, .features-grid {
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
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const organization = document.getElementById('organization').value.trim();
    const title = document.getElementById('title').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const email = document.getElementById('email').value.trim();
    const website = document.getElementById('website').value.trim();
    const address = document.getElementById('address').value.trim();
    
    if (!firstName || !lastName) {
        alert('Lütfen en az ad ve soyad bilgilerini girin!');
        return;
    }
    
    // vCard formatı oluştur
    let vCardString = 'BEGIN:VCARD\n';
    vCardString += 'VERSION:3.0\n';
    vCardString += `FN:${firstName} ${lastName}\n`;
    vCardString += `N:${lastName};${firstName};;;\n`;
    
    if (organization) {
        vCardString += `ORG:${organization}\n`;
    }
    
    if (title) {
        vCardString += `TITLE:${title}\n`;
    }
    
    if (phone) {
        vCardString += `TEL:${phone}\n`;
    }
    
    if (email) {
        vCardString += `EMAIL:${email}\n`;
    }
    
    if (website) {
        vCardString += `URL:${website}\n`;
    }
    
    if (address) {
        vCardString += `ADR:;;${address};;;;\n`;
    }
    
    vCardString += 'END:VCARD';
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(vCardString)}&color=8b5cf6&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="vCard QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 1rem;">
            ${firstName} ${lastName} - vCard
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; text-align: left;">
            ${organization ? `<strong>Şirket:</strong> ${organization}<br>` : ''}
            ${title ? `<strong>Unvan:</strong> ${title}<br>` : ''}
            ${phone ? `<strong>Telefon:</strong> ${phone}<br>` : ''}
            ${email ? `<strong>E-posta:</strong> ${email}<br>` : ''}
            ${website ? `<strong>Website:</strong> ${website}<br>` : ''}
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { 
        firstName, lastName, organization, title, 
        phone, email, website, address, vCardString 
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
    document.getElementById('firstName').value = '';
    document.getElementById('lastName').value = '';
    document.getElementById('organization').value = '';
    document.getElementById('title').value = '';
    document.getElementById('phone').value = '';
    document.getElementById('email').value = '';
    document.getElementById('website').value = '';
    document.getElementById('address').value = '';
    clearQR();
}

function downloadQR() {
    if (!currentQRData.vCardString) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.vCardString)}&color=8b5cf6&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `vcard-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.vCardString) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.vCardString)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('vCard QR kod linki panoya kopyalandı!');
    }).catch(() => {
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('vCard QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('vCard QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

// Enter tuşu ile form gönderimi
document.addEventListener('DOMContentLoaded', function() {
    const firstNameInput = document.getElementById('firstName');
    
    if (firstNameInput) {
        // İlk input'a otomatik focus
        firstNameInput.focus();
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