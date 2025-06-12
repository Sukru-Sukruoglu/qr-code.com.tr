<?php
$pageTitle = "Uygulama QR Kod Oluşturucu | QR-CODE.COM.TR";
$pageClass = "qr-generator-page";
include ROOT_PATH . '/frontend/components/header.php';
?>

<main class="qr-generator-main">
    <div class="container">
        <div class="qr-generator-content">
            <!-- Header -->
            <div class="qr-gen-header">
                <div class="breadcrumb">
                    <a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Ana Sayfa</a>
                    <span>/</span>
                    <span>Uygulama QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon app-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="title-content">
                        <h1>Uygulama QR Kod Oluşturucu</h1>
                        <p>Mobil uygulamanızı QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fas fa-mobile-alt"></i> Uygulama Bilgileri</h3>
                        
                        <form id="appQrForm" class="qr-form">
                            <!-- Uygulama Türü -->
                            <div class="app-type-selector">
                                <h4><i class="fas fa-list"></i> Uygulama Türü Seçin</h4>
                                <div class="app-type-options">
                                    <label class="app-type-option">
                                        <input type="radio" name="appType" value="single" checked>
                                        <div class="option-content">
                                            <i class="fas fa-mobile-alt"></i>
                                            <span>Tek Uygulama</span>
                                            <small>Sadece bir uygulama linki</small>
                                        </div>
                                    </label>
                                    
                                    <label class="app-type-option">
                                        <input type="radio" name="appType" value="both">
                                        <div class="option-content">
                                            <i class="fas fa-store"></i>
                                            <span>Her İki Platform</span>
                                            <small>iOS & Android birlikte</small>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Tek Uygulama Seçeneği -->
                            <div id="singleAppOption" class="app-option">
                                <div class="form-group">
                                    <label for="platform">
                                        <i class="fas fa-mobile-alt"></i> Platform
                                        <span class="required">*</span>
                                    </label>
                                    <select id="platform" required>
                                        <option value="">Platform seçin</option>
                                        <option value="ios">App Store (iOS)</option>
                                        <option value="android">Google Play (Android)</option>
                                        <option value="web">Web Uygulaması</option>
                                        <option value="windows">Microsoft Store</option>
                                        <option value="other">Diğer</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="appUrl">
                                        <i class="fas fa-link"></i> Uygulama URL'si
                                        <span class="required">*</span>
                                    </label>
                                    <input type="url" id="appUrl" placeholder="https://apps.apple.com/app/..." required>
                                    <small class="form-help">Uygulama mağazasındaki link</small>
                                </div>
                            </div>

                            <!-- Her İki Platform Seçeneği -->
                            <div id="bothPlatformsOption" class="app-option" style="display: none;">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="iosUrl">
                                            <i class="fab fa-apple"></i> App Store URL'si
                                            <span class="required">*</span>
                                        </label>
                                        <input type="url" id="iosUrl" placeholder="https://apps.apple.com/app/...">
                                        <small class="form-help">iOS uygulaması linki</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="androidUrl">
                                            <i class="fab fa-google-play"></i> Google Play URL'si
                                            <span class="required">*</span>
                                        </label>
                                        <input type="url" id="androidUrl" placeholder="https://play.google.com/store/apps/...">
                                        <small class="form-help">Android uygulaması linki</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Uygulama Detayları -->
                            <h4><i class="fas fa-info-circle"></i> Uygulama Detayları</h4>

                            <div class="form-group">
                                <label for="appName">
                                    <i class="fas fa-mobile-alt"></i> Uygulama Adı
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="appName" placeholder="Müzik Çalar Pro" required>
                                <small class="form-help">Uygulamanızın adı</small>
                            </div>

                            <div class="form-group">
                                <label for="developer">
                                    <i class="fas fa-user-tie"></i> Geliştirici
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <input type="text" id="developer" placeholder="ABC Yazılım">
                                <small class="form-help">Geliştirici firma adı</small>
                            </div>

                            <div class="form-group">
                                <label for="appDescription">
                                    <i class="fas fa-align-left"></i> Açıklama
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="appDescription" rows="3" placeholder="Uygulama hakkında kısa açıklama"></textarea>
                                <small class="form-help">Uygulamanızın kısa tanıtımı</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="category">
                                        <i class="fas fa-tags"></i> Kategori
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <select id="category">
                                        <option value="">Kategori seçin</option>
                                        <option value="games">Oyunlar</option>
                                        <option value="entertainment">Eğlence</option>
                                        <option value="social">Sosyal</option>
                                        <option value="music">Müzik</option>
                                        <option value="photo">Fotoğraf</option>
                                        <option value="productivity">Verimlilik</option>
                                        <option value="education">Eğitim</option>
                                        <option value="health">Sağlık</option>
                                        <option value="finance">Finans</option>
                                        <option value="shopping">Alışveriş</option>
                                        <option value="travel">Seyahat</option>
                                        <option value="food">Yemek</option>
                                        <option value="news">Haberler</option>
                                        <option value="business">İş</option>
                                        <option value="utilities">Araçlar</option>
                                        <option value="other">Diğer</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="rating">
                                        <i class="fas fa-star"></i> Değerlendirme
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <select id="rating">
                                        <option value="">Puan seçin</option>
                                        <option value="5.0">⭐⭐⭐⭐⭐ 5.0</option>
                                        <option value="4.5">⭐⭐⭐⭐⭐ 4.5</option>
                                        <option value="4.0">⭐⭐⭐⭐☆ 4.0</option>
                                        <option value="3.5">⭐⭐⭐⭐☆ 3.5</option>
                                        <option value="3.0">⭐⭐⭐☆☆ 3.0</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-divider"></div>

                            <!-- QR Kod Özelleştirme -->
                            <h4><i class="fas fa-palette"></i> QR Kod Özelleştirme</h4>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="qrSize">QR Kod Boyutu</label>
                                    <select id="qrSize">
                                        <option value="200">200x200 px (Küçük)</option>
                                        <option value="300" selected>300x300 px (Orta)</option>
                                        <option value="500">500x500 px (Büyük)</option>
                                        <option value="800">800x800 px (Çok Büyük)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="qrFormat">Dosya Formatı</label>
                                    <select id="qrFormat">
                                        <option value="png" selected>PNG (Önerilen)</option>
                                        <option value="jpg">JPG</option>
                                        <option value="svg">SVG (Vektör)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="qrColor">QR Kod Rengi</label>
                                    <div class="color-input-group">
                                        <input type="color" id="qrColor" value="#00b894">
                                        <span class="color-value">#00b894</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bgColor">Arka Plan Rengi</label>
                                    <div class="color-input-group">
                                        <input type="color" id="bgColor" value="#ffffff">
                                        <span class="color-value">#ffffff</span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-large">
                                <i class="fas fa-mobile-alt"></i> Uygulama QR Kodu Oluştur
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="qr-preview-section">
                    <div class="qr-preview-card">
                        <h3><i class="fas fa-eye"></i> Önizleme</h3>
                        
                        <div id="qrPreview" class="qr-preview-container">
                            <div class="qr-placeholder">
                                <i class="fas fa-mobile-alt"></i>
                                <p>Uygulama bilgilerini girin<br>QR kodunuz burada görünecek</p>
                            </div>
                        </div>

                        <div id="qrActions" class="qr-actions" style="display: none;">
                            <button onclick="downloadQR()" class="btn btn-success">
                                <i class="fas fa-download"></i> İndir
                            </button>
                            <button onclick="shareQR()" class="btn btn-outline">
                                <i class="fas fa-share-alt"></i> Paylaş
                            </button>
                            <button onclick="copyQRLink()" class="btn btn-outline">
                                <i class="fas fa-copy"></i> Linki Kopyala
                            </button>
                        </div>

                        <!-- QR Info -->
                        <div id="qrInfo" class="qr-info" style="display: none;">
                            <h4>QR Kod Bilgileri</h4>
                            <div class="info-item">
                                <span class="info-label">Uygulama:</span>
                                <span id="infoApp" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Platform:</span>
                                <span id="infoPlatform" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Geliştirici:</span>
                                <span id="infoDeveloper" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Boyut:</span>
                                <span id="infoSize" class="info-value"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Usage Tips -->
                    <div class="usage-tips">
                        <h4><i class="fas fa-lightbulb"></i> Kullanım İpuçları</h4>
                        <ul>
                            <li>Uygulamanızı sosyal medyada tanıtmak için QR kod kullanın</li>
                            <li>Kartvizitlerde uygulama indirme linki paylaşın</li>
                            <li>Web sitenizde mobil uygulama yönlendirmesi yapın</li>
                            <li>Yeşil renk teknoloji temasına uygun görünüm sağlar</li>
                            <li>Her iki platform için tek QR kod oluşturabilirsiniz</li>
                            <li>Etkinliklerde uygulama tanıtımı için kullanın</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.app-icon {
    background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
}

.qr-placeholder i {
    color: #00b894;
    font-size: 4rem;
    margin-bottom: 1rem;
}

.app-type-selector {
    margin-bottom: 2rem;
}

.app-type-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-top: 1rem;
}

.app-type-option {
    cursor: pointer;
    position: relative;
}

.app-type-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    cursor: pointer;
}

.option-content {
    padding: 1.5rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    text-align: center;
    transition: all 0.3s ease;
    background: white;
}

.option-content i {
    font-size: 2rem;
    color: #00b894;
    margin-bottom: 0.5rem;
    display: block;
}

.option-content span {
    font-weight: 600;
    color: #2d3748;
    display: block;
    margin-bottom: 0.25rem;
}

.option-content small {
    color: #718096;
    font-size: 0.875rem;
}

.app-type-option input[type="radio"]:checked + .option-content {
    border-color: #00b894;
    background: linear-gradient(135deg, rgba(0, 184, 148, 0.1) 0%, rgba(0, 160, 133, 0.1) 100%);
}

.app-option {
    transition: all 0.3s ease;
}

.form-divider {
    border-top: 1px solid #e2e8f0;
    margin: 2rem 0 1.5rem;
}

.color-input-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.color-input-group input[type="color"] {
    width: 50px;
    height: 40px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.color-value {
    font-family: monospace;
    font-size: 0.9rem;
    color: #666;
}

@media (max-width: 768px) {
    .app-type-options {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('appQrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    const appTypeRadios = document.querySelectorAll('input[name="appType"]');
    const singleAppOption = document.getElementById('singleAppOption');
    const bothPlatformsOption = document.getElementById('bothPlatformsOption');
    
    let currentQRData = '';
    
    // App type change handler
    appTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'single') {
                singleAppOption.style.display = 'block';
                bothPlatformsOption.style.display = 'none';
                document.getElementById('platform').required = true;
                document.getElementById('appUrl').required = true;
                document.getElementById('iosUrl').required = false;
                document.getElementById('androidUrl').required = false;
            } else {
                singleAppOption.style.display = 'none';
                bothPlatformsOption.style.display = 'block';
                document.getElementById('platform').required = false;
                document.getElementById('appUrl').required = false;
                document.getElementById('iosUrl').required = true;
                document.getElementById('androidUrl').required = true;
            }
        });
    });
    
    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        generateAppQR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generateAppQR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generateAppQR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generateAppQR();
    });
    
    function generateAppQR() {
        const appType = document.querySelector('input[name="appType"]:checked').value;
        const appName = document.getElementById('appName').value.trim();
        
        if (!appName) {
            alert('Lütfen uygulama adını giriniz');
            return;
        }
        
        let qrData = '';
        let platformText = '';
        
        if (appType === 'single') {
            const platform = document.getElementById('platform').value;
            const appUrl = document.getElementById('appUrl').value.trim();
            
            if (!platform) {
                alert('Lütfen platform seçiniz');
                return;
            }
            
            if (!appUrl) {
                alert('Lütfen uygulama URL\'sini giriniz');
                return;
            }
            
            qrData = appUrl;
            platformText = platform;
        } else {
            const iosUrl = document.getElementById('iosUrl').value.trim();
            const androidUrl = document.getElementById('androidUrl').value.trim();
            
            if (!iosUrl || !androidUrl) {
                alert('Lütfen her iki platform için URL giriniz');
                return;
            }
            
            // Smart app banner formatı (gerçek uygulamada akıllı yönlendirme sayfası oluşturulmalı)
            qrData = `https://smartappbanner.example.com?ios=${encodeURIComponent(iosUrl)}&android=${encodeURIComponent(androidUrl)}`;
            platformText = 'iOS & Android';
        }
        
        currentQRData = qrData;
        
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(qrData)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="Uygulama QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        document.getElementById('infoApp').textContent = appName;
        document.getElementById('infoPlatform').textContent = platformText;
        document.getElementById('infoDeveloper').textContent = document.getElementById('developer').value || 'Belirtilmedi';
        document.getElementById('infoSize').textContent = `${size}x${size} px`;
        
        // Preview'a scroll
        preview.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

function downloadQR() {
    const img = document.querySelector('.qr-image');
    if (img) {
        const link = document.createElement('a');
        link.href = img.src;
        link.download = 'app-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        const appName = document.getElementById('appName').value.trim();
        navigator.share({
            title: 'Uygulama QR Kod',
            text: `${appName} uygulamasını indirmek için QR kodu tarayın`,
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('Uygulama linki kopyalandı!');
        });
    }
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>