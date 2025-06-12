<?php
$pageTitle = "Facebook QR Kod Oluşturucu | QR-CODE.COM.TR";
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
                    <span>Facebook QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon facebook-icon">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="title-content">
                        <h1>Facebook QR Kod Oluşturucu</h1>
                        <p>Facebook sayfanızı QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fab fa-facebook-f"></i> Facebook Bilgileri</h3>
                        
                        <form id="facebookQrForm" class="qr-form">
                            <!-- Facebook Türü -->
                            <div class="facebook-type-selector">
                                <h4><i class="fas fa-list"></i> Facebook Türü Seçin</h4>
                                <div class="facebook-type-options">
                                    <label class="facebook-type-option">
                                        <input type="radio" name="facebookType" value="page" checked>
                                        <div class="option-content">
                                            <i class="fas fa-flag"></i>
                                            <span>Sayfa</span>
                                            <small>İşletme/Marka sayfası</small>
                                        </div>
                                    </label>
                                    
                                    <label class="facebook-type-option">
                                        <input type="radio" name="facebookType" value="profile">
                                        <div class="option-content">
                                            <i class="fas fa-user"></i>
                                            <span>Profil</span>
                                            <small>Kişisel profil</small>
                                        </div>
                                    </label>
                                    
                                    <label class="facebook-type-option">
                                        <input type="radio" name="facebookType" value="group">
                                        <div class="option-content">
                                            <i class="fas fa-users"></i>
                                            <span>Grup</span>
                                            <small>Facebook grubu</small>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Facebook URL -->
                            <div class="form-group">
                                <label for="facebookUrl">
                                    <i class="fab fa-facebook-f"></i> Facebook URL'si
                                    <span class="required">*</span>
                                </label>
                                <input type="url" id="facebookUrl" placeholder="https://facebook.com/username" required>
                                <small class="form-help">Facebook sayfanızın tam URL'sini girin</small>
                            </div>

                            <!-- Sayfa Detayları -->
                            <h4><i class="fas fa-info-circle"></i> Sayfa Detayları</h4>

                            <div class="form-group">
                                <label for="pageName">
                                    <i class="fas fa-heading"></i> Sayfa/Profil Adı
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="pageName" placeholder="ABC Şirketi" required>
                                <small class="form-help">Facebook sayfanızın adı</small>
                            </div>

                            <div class="form-group">
                                <label for="description">
                                    <i class="fas fa-align-left"></i> Açıklama
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="description" rows="3" placeholder="Sayfa hakkında kısa açıklama"></textarea>
                                <small class="form-help">Sayfanızın kısa tanıtımı</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="category">
                                        <i class="fas fa-tags"></i> Kategori
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <select id="category">
                                        <option value="">Kategori seçin</option>
                                        <option value="business">İşletme</option>
                                        <option value="brand">Marka</option>
                                        <option value="community">Topluluk</option>
                                        <option value="public-figure">Halka Açık Kişi</option>
                                        <option value="entertainment">Eğlence</option>
                                        <option value="cause">Amaç</option>
                                        <option value="local-business">Yerel İşletme</option>
                                        <option value="organization">Organizasyon</option>
                                        <option value="other">Diğer</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="followers">
                                        <i class="fas fa-users"></i> Takipçi Sayısı
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="text" id="followers" placeholder="10.5K">
                                    <small class="form-help">Takipçi sayınız (örn: 10.5K)</small>
                                </div>
                            </div>

                            <!-- İletişim Bilgileri -->
                            <h4><i class="fas fa-phone"></i> İletişim Bilgileri</h4>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">
                                        <i class="fas fa-phone"></i> Telefon
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="tel" id="phone" placeholder="+90 555 123 45 67">
                                </div>

                                <div class="form-group">
                                    <label for="email">
                                        <i class="fas fa-envelope"></i> E-posta
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="email" id="email" placeholder="info@sirket.com">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="website">
                                    <i class="fas fa-globe"></i> Website
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <input type="url" id="website" placeholder="https://www.sirket.com">
                                <small class="form-help">Şirket web sitesi</small>
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
                                        <input type="color" id="qrColor" value="#1877f2">
                                        <span class="color-value">#1877f2</span>
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
                                <i class="fab fa-facebook-f"></i> Facebook QR Kodu Oluştur
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
                                <i class="fab fa-facebook-f"></i>
                                <p>Facebook bilgilerini girin<br>QR kodunuz burada görünecek</p>
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
                                <span class="info-label">Sayfa:</span>
                                <span id="infoPage" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tür:</span>
                                <span id="infoType" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Kategori:</span>
                                <span id="infoCategory" class="info-value"></span>
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
                            <li>Kartvizitlerde Facebook sayfanıza yönlendirme yapın</li>
                            <li>Mağaza vitrininde sosyal medya takibini artırın</li>
                            <li>Etkinliklerde Facebook grubu üyeliği kazanın</li>
                            <li>Mavi renk Facebook temasına uygun görünüm sağlar</li>
                            <li>QR kod ile hızlı takip/beğeni kampanyaları yapın</li>
                            <li>Broşür ve reklamlarda sosyal medya entegrasyonu</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.facebook-icon {
    background: linear-gradient(135deg, #1877f2 0%, #166fe5 100%);
}

.qr-placeholder i {
    color: #1877f2;
    font-size: 4rem;
    margin-bottom: 1rem;
}

.facebook-type-selector {
    margin-bottom: 2rem;
}

.facebook-type-options {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-top: 1rem;
}

.facebook-type-option {
    cursor: pointer;
    position: relative;
}

.facebook-type-option input[type="radio"] {
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
    color: #1877f2;
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

.facebook-type-option input[type="radio"]:checked + .option-content {
    border-color: #1877f2;
    background: linear-gradient(135deg, rgba(24, 119, 242, 0.1) 0%, rgba(22, 111, 229, 0.1) 100%);
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
    .facebook-type-options {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('facebookQrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    
    let currentQRData = '';
    
    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        generateFacebookQR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generateFacebookQR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generateFacebookQR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generateFacebookQR();
    });
    
    function generateFacebookQR() {
        const facebookUrl = document.getElementById('facebookUrl').value.trim();
        const pageName = document.getElementById('pageName').value.trim();
        const facebookType = document.querySelector('input[name="facebookType"]:checked').value;
        
        if (!facebookUrl) {
            alert('Lütfen Facebook URL\'sini giriniz');
            return;
        }
        
        if (!pageName) {
            alert('Lütfen sayfa adını giriniz');
            return;
        }
        
        currentQRData = facebookUrl;
        
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(facebookUrl)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="Facebook QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        const typeText = facebookType === 'page' ? 'Sayfa' : facebookType === 'profile' ? 'Profil' : 'Grup';
        
        document.getElementById('infoPage').textContent = pageName;
        document.getElementById('infoType').textContent = typeText;
        document.getElementById('infoCategory').textContent = document.getElementById('category').value || 'Belirtilmedi';
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
        link.download = 'facebook-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        const pageName = document.getElementById('pageName').value.trim();
        navigator.share({
            title: 'Facebook QR Kod',
            text: `${pageName} Facebook sayfasını ziyaret etmek için QR kodu tarayın`,
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('Facebook linki kopyalandı!');
        });
    }
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>