<?php
$pageTitle = "URL QR Kod Oluşturucu | QR-CODE.COM.TR";
$pageClass = "qr-generator-page";
$pageStylesheet = "qr-generator";
$pageScript = "qr-generator";

include ROOT_PATH . '/frontend/components/header.php';
?>

<main class="qr-generator-container">
    <div class="container">
        <div class="page-header">
            <h1>URL QR Kodu Oluştur</h1>
            <p>Web sitesi bağlantınız için hızlıca QR kod oluşturun</p>
        </div>
        
        <div class="qr-generator-wrapper">
            <div class="qr-form-container">
                <form id="urlQrForm" class="qr-form">
                    <div class="form-group">
                        <label for="url">Web Site Adresi</label>
                        <div class="input-group">
                            <div class="input-addon">
                                <i class="fas fa-link"></i>
                            </div>
                            <input type="url" id="url" name="url" class="form-control" placeholder="https://example.com" required>
                        </div>
                        <small class="form-hint">QR kodunuzun yönlendireceği tam web adresini girin.</small>
                    </div>
                    
                    <div class="form-divider">
                        <span>QR Kodu Özelleştir</span>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="foregroundColor">Ön Plan Rengi</label>
                            <input type="color" id="foregroundColor" name="foregroundColor" class="form-control" value="#000000">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="backgroundColor">Arka Plan Rengi</label>
                            <input type="color" id="backgroundColor" name="backgroundColor" class="form-control" value="#FFFFFF">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="qrSize">QR Kod Boyutu</label>
                        <select id="qrSize" name="size" class="form-control">
                            <option value="200">Küçük (200x200)</option>
                            <option value="300" selected>Orta (300x300)</option>
                            <option value="400">Büyük (400x400)</option>
                            <option value="500">Çok Büyük (500x500)</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-qrcode"></i> QR Kodu Oluştur
                    </button>
                </form>
            </div>
            
            <div class="qr-preview-container">
                <div class="qr-preview-header">
                    <h3>QR Kod Önizleme</h3>
                </div>
                
                <div class="qr-preview-content">
                    <div id="qrCodePreview" class="qr-preview-placeholder">
                        <i class="fas fa-qrcode"></i>
                        <p>QR kodunuz burada görüntülenecek</p>
                    </div>
                </div>
                
                <div id="qrDownloadOptions" class="qr-download-options" style="display: none;">
                    <button id="downloadPng" class="btn btn-outline btn-sm">
                        <i class="fas fa-download"></i> PNG İndir
                    </button>
                    <button id="downloadSvg" class="btn btn-outline btn-sm">
                        <i class="fas fa-download"></i> SVG İndir
                    </button>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <button id="saveQrCode" class="btn btn-primary btn-sm">
                        <i class="fas fa-save"></i> Hesabıma Kaydet
                    </button>
                    <?php else: ?>
                    <p class="login-prompt">
                        <i class="fas fa-info-circle"></i> QR kodunu kaydetmek için 
                        <a href="<?php echo SITE_URL; ?>/auth/login">giriş yapın</a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>