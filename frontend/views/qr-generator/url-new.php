<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\qr-generator\url.php
$pageTitle = "URL QR Kod Oluşturucu | QR-CODE.COM.TR";
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
            <span>URL QR</span>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="icon-wrapper">
                    <i class="fas fa-link"></i>
                </div>
                <div class="title-content">
                    <h1>URL QR Kod Oluşturucu</h1>
                    <p>Web sitesi, sosyal medya veya herhangi bir URL için QR kod oluşturun</p>
                </div>
            </div>
        </div>

        <!-- Generator Form -->
        <div class="generator-form">
            <div class="form-section">
                <h3>🔗 URL Bilgileri</h3>
                
                <div class="form-group">
                    <label for="url">Website URL'si</label>
                    <input type="url" id="url" placeholder="https://example.com" required>
                    <small>Tam URL'yi girin (https:// dahil)</small>
                </div>
                
                <div class="form-group">
                    <label for="title">QR Kod Başlığı (Opsiyonel)</label>
                    <input type="text" id="title" placeholder="Website QR Kodum">
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-primary btn-generate" onclick="generateQR()">
                        <i class="fas fa-qrcode"></i>
                        QR Kod Oluştur
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
                    <i class="fas fa-qrcode"></i>
                    <h4>QR Kod Burada Görünecek</h4>
                    <p>URL bilgilerini girin ve "QR Kod Oluştur" butonuna tıklayın</p>
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
        
        <!-- Quick Access to Other QR Types -->
        <div class="other-qr-types">
            <h3>📱 Diğer QR Türleri</h3>
            <div class="quick-qr-grid">
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

.form-group input {
    width: 100%;
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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
    const url = document.getElementById('url').value.trim();
    const title = document.getElementById('title').value.trim();
    
    if (!url) {
        alert('Lütfen bir URL girin!');
        return;
    }
    
    // URL formatını kontrol et
    if (!isValidURL(url)) {
        alert('Lütfen geçerli bir URL girin (https:// ile başlamalı)!');
        return;
    }
    
    // QR kod oluştur
    const qrSize = 300;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(url)}&color=3b82f6&bgcolor=ffffff&margin=20&format=png`;
    
    // Placeholder'ı gizle
    document.getElementById('qrPlaceholder').style.display = 'none';
    
    // QR display'i göster
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.innerHTML = `
        <div style="margin-bottom: 1rem;">
            <img src="${qrURL}" alt="QR Kod" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <div style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
            ${title || 'URL QR Kodu'}
        </div>
        <div style="color: #6b7280; font-size: 0.9rem; word-break: break-all;">
            ${url}
        </div>
    `;
    
    qrDisplay.style.display = 'block';
    
    // Action butonlarını göster
    document.getElementById('qrActions').style.display = 'flex';
    
    currentQRData = { url, title };
    
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
    document.getElementById('url').value = '';
    document.getElementById('title').value = '';
    clearQR();
}

function downloadQR() {
    if (!currentQRData.url) return;
    
    const qrSize = 512;
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(currentQRData.url)}&color=3b82f6&bgcolor=ffffff&margin=20&format=png`;
    
    const link = document.createElement('a');
    link.href = qrURL;
    link.download = `url-qr-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function copyQRLink() {
    if (!currentQRData.url) return;
    
    const qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(currentQRData.url)}`;
    
    navigator.clipboard.writeText(qrURL).then(() => {
        alert('QR kod linki panoya kopyalandı!');
    }).catch(() => {
        // Fallback
        const textArea = document.createElement('textarea');
        textArea.value = qrURL;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('QR kod linki kopyalandı!');
    });
}

function saveQR() {
    alert('QR kod kaydedildi! (Bu özellik geliştirme aşamasında)');
}

function isValidURL(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}

// Enter tuşu ile form gönderimi
document.addEventListener('DOMContentLoaded', function() {
    const urlInput = document.getElementById('url');
    
    if (urlInput) {
        urlInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                generateQR();
            }
        });
        
        // URL input'una otomatik focus
        urlInput.focus();
    }
});
</script>

<?php
// Footer'ı include et
include ROOT_PATH . '/frontend/components/footer-new.php';
?>