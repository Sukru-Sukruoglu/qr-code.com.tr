<?php
$pageTitle = "Instagram QR Kod Oluşturucu | QR-CODE.COM.TR";
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
                    <span>Instagram QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon instagram-icon">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="title-content">
                        <h1>Instagram QR Kod Oluşturucu</h1>
                        <p>Instagram profilinizi QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fab fa-instagram"></i> Instagram Bilgileri</h3>
                        
                        <form id="instagramQrForm" class="qr-form">
                            <!-- Instagram URL -->
                            <div class="form-group">
                                <label for="instagramUrl">
                                    <i class="fab fa-instagram"></i> Instagram URL'si
                                    <span class="required">*</span>
                                </label>
                                <input type="url" id="instagramUrl" placeholder="https://instagram.com/username" required>
                                <small class="form-help">Instagram profilinizin tam URL'sini girin</small>
                            </div>

                            <!-- Profil Detayları -->
                            <h4><i class="fas fa-info-circle"></i> Profil Detayları</h4>

                            <div class="form-group">
                                <label for="profileName">
                                    <i class="fas fa-user"></i> Profil Adı
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="profileName" placeholder="@username" required>
                                <small class="form-help">Instagram kullanıcı adınız</small>
                            </div>

                            <div class="form-group">
                                <label for="displayName">
                                    <i class="fas fa-heading"></i> Görünen Ad
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <input type="text" id="displayName" placeholder="ABC Şirketi">
                                <small class="form-help">Profilinizde görünen ad</small>
                            </div>

                            <div class="form-group">
                                <label for="bio">
                                    <i class="fas fa-align-left"></i> Biyografi
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="bio" rows="3" placeholder="Profil hakkında kısa açıklama"></textarea>
                                <small class="form-help">Instagram biyografiniz</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="followers">
                                        <i class="fas fa-users"></i> Takipçi Sayısı
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="text" id="followers" placeholder="10.5K">
                                    <small class="form-help">Takipçi sayınız (örn: 10.5K)</small>
                                </div>

                                <div class="form-group">
                                    <label for="posts">
                                        <i class="fas fa-camera"></i> Gönderi Sayısı
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="text" id="posts" placeholder="150">
                                    <small class="form-help">Toplam gönderi sayısı</small>
                                </div>
                            </div>

                            <!-- İletişim Bilgileri -->
                            <h4><i class="fas fa-phone"></i> İletişim Bilgileri</h4>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">
                                        <i class="fas fa-envelope"></i> E-posta
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="email" id="email" placeholder="info@sirket.com">
                                </div>

                                <div class="form-group">
                                    <label for="website">
                                        <i class="fas fa-globe"></i> Website
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="url" id="website" placeholder="https://www.sirket.com">
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
                                        <input type="color" id="qrColor" value="#e4405f">
                                        <span class="color-value">#e4405f</span>
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
                                <i class="fab fa-instagram"></i> Instagram QR Kodu Oluştur
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
                                <i class="fab fa-instagram"></i>
                                <p>Instagram bilgilerini girin<br>QR kodunuz burada görünecek</p>
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
                                <span class="info-label">Profil:</span>
                                <span id="infoProfile" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Ad:</span>
                                <span id="infoName" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Takipçi:</span>
                                <span id="infoFollowers" class="info-value"></span>
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
                            <li>Kartvizitlerde Instagram profilinize yönlendirme yapın</li>
                            <li>Mağaza vitrininde sosyal medya takibini artırın</li>
                            <li>Etkinliklerde Instagram takipçisi kazanın</li>
                            <li>Pembe renk Instagram temasına uygun görünüm sağlar</li>
                            <li>QR kod ile hızlı takip kampanyaları yapın</li>
                            <li>Broşür ve reklamlarda sosyal medya entegrasyonu</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.instagram-icon {
    background: linear-gradient(135deg, #e4405f 0%, #833ab4 50%, #fd5949 100%);
}

.qr-placeholder i {
    color: #e4405f;
    font-size: 4rem;
    margin-bottom: 1rem;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('instagramQrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    
    let currentQRData = '';
    
    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        generateInstagramQR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generateInstagramQR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generateInstagramQR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generateInstagramQR();
    });
    
    function generateInstagramQR() {
        const instagramUrl = document.getElementById('instagramUrl').value.trim();
        const profileName = document.getElementById('profileName').value.trim();
        
        if (!instagramUrl) {
            alert('Lütfen Instagram URL\'sini giriniz');
            return;
        }
        
        if (!profileName) {
            alert('Lütfen profil adını giriniz');
            return;
        }
        
        currentQRData = instagramUrl;
        
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(instagramUrl)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="Instagram QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        document.getElementById('infoProfile').textContent = profileName;
        document.getElementById('infoName').textContent = document.getElementById('displayName').value || 'Belirtilmedi';
        document.getElementById('infoFollowers').textContent = document.getElementById('followers').value || 'Belirtilmedi';
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
        link.download = 'instagram-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        const profileName = document.getElementById('profileName').value.trim();
        navigator.share({
            title: 'Instagram QR Kod',
            text: `${profileName} Instagram profilini ziyaret etmek için QR kodu tarayın`,
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('Instagram linki kopyalandı!');
        });
    }
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>