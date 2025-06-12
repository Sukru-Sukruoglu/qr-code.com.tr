<?php
$pageTitle = "Kupon QR Kod Oluşturucu | QR-CODE.COM.TR";
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
                    <span>Kupon QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon coupon-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="title-content">
                        <h1>Kupon QR Kod Oluşturucu</h1>
                        <p>İndirim kuponlarınızı QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fas fa-ticket-alt"></i> Kupon Bilgileri</h3>
                        
                        <form id="couponQrForm" class="qr-form">
                            <!-- Kupon Temel Bilgileri -->
                            <div class="form-group">
                                <label for="couponTitle">
                                    <i class="fas fa-tag"></i> Kupon Başlığı
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="couponTitle" placeholder="%20 İndirim Kuponu" required>
                                <small class="form-help">Kuponunuzun başlığını girin</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="discountType">
                                        <i class="fas fa-percent"></i> İndirim Türü
                                        <span class="required">*</span>
                                    </label>
                                    <select id="discountType" required>
                                        <option value="">İndirim türü seçin</option>
                                        <option value="percentage">Yüzde (%)</option>
                                        <option value="amount">Miktar (TL)</option>
                                        <option value="freeShipping">Ücretsiz Kargo</option>
                                        <option value="buyOneGetOne">1 Al 1 Bedava</option>
                                        <option value="other">Diğer</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="discountValue">
                                        <i class="fas fa-gift"></i> İndirim Değeri
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" id="discountValue" placeholder="20" required>
                                    <small class="form-help">İndirim miktarını girin</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="couponCode">
                                    <i class="fas fa-code"></i> Kupon Kodu
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <input type="text" id="couponCode" placeholder="INDIRIM20">
                                <small class="form-help">Kupon kodunu girin (örn: INDIRIM20)</small>
                            </div>

                            <div class="form-group">
                                <label for="description">
                                    <i class="fas fa-info-circle"></i> Açıklama
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="description" rows="3" placeholder="Kupon kullanım şartları ve detayları"></textarea>
                                <small class="form-help">Kupon hakkında açıklama</small>
                            </div>

                            <!-- Şirket Bilgileri -->
                            <h4><i class="fas fa-store"></i> Şirket Bilgileri</h4>

                            <div class="form-group">
                                <label for="companyName">
                                    <i class="fas fa-building"></i> Şirket Adı
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="companyName" placeholder="ABC Mağaza" required>
                                <small class="form-help">Kupon veren şirket adı</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="website">
                                        <i class="fas fa-globe"></i> Website
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="url" id="website" placeholder="https://www.sirket.com">
                                </div>

                                <div class="form-group">
                                    <label for="phone">
                                        <i class="fas fa-phone"></i> Telefon
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="tel" id="phone" placeholder="+90 555 123 45 67">
                                </div>
                            </div>

                            <!-- Geçerlilik Bilgileri -->
                            <h4><i class="fas fa-calendar"></i> Geçerlilik Bilgileri</h4>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="validFrom">
                                        <i class="fas fa-calendar-plus"></i> Başlangıç Tarihi
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="date" id="validFrom">
                                </div>

                                <div class="form-group">
                                    <label for="validUntil">
                                        <i class="fas fa-calendar-times"></i> Bitiş Tarihi
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="date" id="validUntil">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="minPurchase">
                                        <i class="fas fa-coins"></i> Min. Alışveriş
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="number" id="minPurchase" placeholder="100" min="0">
                                    <small class="form-help">Minimum alışveriş tutarı (TL)</small>
                                </div>

                                <div class="form-group">
                                    <label for="usageLimit">
                                        <i class="fas fa-hashtag"></i> Kullanım Limiti
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="number" id="usageLimit" placeholder="1" min="1">
                                    <small class="form-help">Kaç kez kullanılabilir</small>
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
                                        <input type="color" id="qrColor" value="#e84393">
                                        <span class="color-value">#e84393</span>
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
                                <i class="fas fa-ticket-alt"></i> Kupon QR Kodu Oluştur
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
                                <i class="fas fa-ticket-alt"></i>
                                <p>Kupon bilgilerini girin<br>QR kodunuz burada görünecek</p>
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
                                <span class="info-label">Kupon:</span>
                                <span id="infoCoupon" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">İndirim:</span>
                                <span id="infoDiscount" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Şirket:</span>
                                <span id="infoCompany" class="info-value"></span>
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
                            <li>Sosyal medya kampanyalarında kupon QR kodu paylaşın</li>
                            <li>E-posta bültenlerinde özel indirimler sunun</li>
                            <li>Mağaza içinde QR kod ile anlık kampanyalar yapın</li>
                            <li>Pembe renk kupon temasına uygun görünüm sağlar</li>
                            <li>Geçerlilik tarihi belirterek aciliyet yaratın</li>
                            <li>Minimum alışveriş tutarı ile satışları artırın</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.coupon-icon {
    background: linear-gradient(135deg, #e84393 0%, #d63384 100%);
}

.qr-placeholder i {
    color: #e84393;
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
    const form = document.getElementById('couponQrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    
    let currentQRData = '';
    
    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        generateCouponQR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generateCouponQR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generateCouponQR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generateCouponQR();
    });
    
    function generateCouponQR() {
        const couponTitle = document.getElementById('couponTitle').value.trim();
        const discountType = document.getElementById('discountType').value;
        const discountValue = document.getElementById('discountValue').value.trim();
        const couponCode = document.getElementById('couponCode').value.trim();
        const companyName = document.getElementById('companyName').value.trim();
        const description = document.getElementById('description').value.trim();
        const website = document.getElementById('website').value.trim();
        
        if (!couponTitle) {
            alert('Lütfen kupon başlığını giriniz');
            return;
        }
        
        if (!discountType) {
            alert('Lütfen indirim türünü seçiniz');
            return;
        }
        
        if (!discountValue) {
            alert('Lütfen indirim değerini giriniz');
            return;
        }
        
        if (!companyName) {
            alert('Lütfen şirket adını giriniz');
            return;
        }
        
        // Kupon bilgilerini JSON formatında oluştur
        const couponData = {
            title: couponTitle,
            discountType: discountType,
            discountValue: discountValue,
            code: couponCode,
            company: companyName,
            description: description,
            website: website
        };
        
        // QR kod için URL oluştur (gerçek uygulamada kendi API'nizi kullanın)
        currentQRData = website || `https://coupon.example.com/${couponCode || 'special-offer'}`;
        
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(currentQRData)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="Kupon QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        let discountText = discountValue;
        if (discountType === 'percentage') discountText += '%';
        if (discountType === 'amount') discountText += ' TL';
        if (discountType === 'freeShipping') discountText = 'Ücretsiz Kargo';
        if (discountType === 'buyOneGetOne') discountText = '1 Al 1 Bedava';
        
        document.getElementById('infoCoupon').textContent = couponTitle;
        document.getElementById('infoDiscount').textContent = discountText;
        document.getElementById('infoCompany').textContent = companyName;
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
        link.download = 'coupon-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        const couponTitle = document.getElementById('couponTitle').value.trim();
        navigator.share({
            title: 'Kupon QR Kod',
            text: `${couponTitle} için QR kodu tarayın`,
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('Kupon linki kopyalandı!');
        });
    }
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>