<?php
$pageTitle = "Görsel QR Kod Oluşturucu | QR-CODE.COM.TR";
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
                    <span>Görsel QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon images-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="title-content">
                        <h1>Görsel QR Kod Oluşturucu</h1>
                        <p>Fotoğraf ve resimlerinizi QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fas fa-images"></i> Görsel Bilgileri</h3>
                        
                        <form id="imagesQrForm" class="qr-form">
                            <!-- Görsel Yükleme Seçenekleri -->
                            <div class="upload-options">
                                <div class="option-tabs">
                                    <button type="button" class="option-tab active" data-option="url">
                                        <i class="fas fa-link"></i> Görsel URL'si
                                    </button>
                                    <button type="button" class="option-tab" data-option="upload">
                                        <i class="fas fa-upload"></i> Dosya Yükle
                                    </button>
                                    <button type="button" class="option-tab" data-option="gallery">
                                        <i class="fas fa-folder-open"></i> Galeri
                                    </button>
                                </div>
                            </div>

                            <!-- URL Seçeneği -->
                            <div id="urlOption" class="upload-option">
                                <div class="form-group">
                                    <label for="imageUrl">
                                        <i class="fas fa-link"></i> Görsel URL'si
                                        <span class="required">*</span>
                                    </label>
                                    <input type="url" id="imageUrl" placeholder="https://example.com/resim.jpg" required>
                                    <small class="form-help">Görselin internetteki URL adresini girin (JPG, PNG, GIF desteklenir)</small>
                                </div>
                            </div>

                            <!-- Dosya Yükleme Seçeneği -->
                            <div id="uploadOption" class="upload-option" style="display: none;">
                                <div class="form-group">
                                    <label for="imageFile">
                                        <i class="fas fa-upload"></i> Görsel Dosyası Seç
                                        <span class="required">*</span>
                                    </label>
                                    <div class="file-upload-area" onclick="document.getElementById('imageFile').click()">
                                        <input type="file" id="imageFile" accept="image/*" style="display: none;">
                                        <div class="upload-content">
                                            <i class="fas fa-camera"></i>
                                            <p>Görselinizi buraya sürükleyin veya seçmek için tıklayın</p>
                                            <small>JPG, PNG, GIF formatları desteklenir. Maksimum: 5MB</small>
                                        </div>
                                    </div>
                                    <div id="imagePreview" class="image-preview" style="display: none;">
                                        <img id="previewImg" src="" alt="Önizleme">
                                        <div class="image-info">
                                            <span id="imageName"></span>
                                            <span id="imageSize"></span>
                                            <button type="button" onclick="clearImage()" class="btn-remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Galeri Seçeneği -->
                            <div id="galleryOption" class="upload-option" style="display: none;">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-folder-open"></i> Popüler Platformlar
                                    </label>
                                    <div class="gallery-platforms">
                                        <div class="platform-item" data-platform="google-photos">
                                            <i class="fab fa-google"></i>
                                            <span>Google Photos</span>
                                        </div>
                                        <div class="platform-item" data-platform="instagram">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </div>
                                        <div class="platform-item" data-platform="flickr">
                                            <i class="fab fa-flickr"></i>
                                            <span>Flickr</span>
                                        </div>
                                        <div class="platform-item" data-platform="imgur">
                                            <i class="fas fa-image"></i>
                                            <span>Imgur</span>
                                        </div>
                                    </div>
                                    <input type="url" id="galleryUrl" placeholder="Galeri veya albüm URL'sini girin" style="margin-top: 1rem;">
                                    <small class="form-help">Galeri linkinizi buraya yapıştırın</small>
                                </div>
                            </div>

                            <!-- Görsel Bilgileri -->
                            <div class="form-group">
                                <label for="imageTitle">
                                    <i class="fas fa-heading"></i> Görsel Başlığı
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <input type="text" id="imageTitle" placeholder="Fotoğraf başlığı">
                                <small class="form-help">Görselinizi açıklayan bir başlık</small>
                            </div>

                            <div class="form-group">
                                <label for="imageDescription">
                                    <i class="fas fa-info-circle"></i> Açıklama
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="imageDescription" rows="3" placeholder="Görsel hakkında kısa açıklama"></textarea>
                                <small class="form-help">Fotoğrafın ne olduğu hakkında bilgi</small>
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
                                        <input type="color" id="qrColor" value="#6f42c1">
                                        <span class="color-value">#6f42c1</span>
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
                                <i class="fas fa-images"></i> Görsel QR Kodu Oluştur
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
                                <i class="fas fa-images"></i>
                                <p>Görsel bilgilerini girin<br>QR kodunuz burada görünecek</p>
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
                                <span class="info-label">Görsel Türü:</span>
                                <span id="infoImageType" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Başlık:</span>
                                <span id="infoTitle" class="info-value"></span>
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
                            <li>QR kodu tarayarak görsele direkt erişim sağlanır</li>
                            <li>Portfolyo, galeri ve sergi paylaşımında kullanışlıdır</li>
                            <li>Sosyal medya fotoğraflarınızı offline paylaşabilirsiniz</li>
                            <li>Mor renk görsel temasına uygun olduğu için önerilir</li>
                            <li>Baskı kalitesi için büyük boyut seçin</li>
                            <li>Görselin herkese açık olması gerekir</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.images-icon {
    background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
}

.qr-placeholder i {
    color: #6f42c1;
    font-size: 4rem;
    margin-bottom: 1rem;
}

.upload-options {
    margin-bottom: 2rem;
}

.option-tabs {
    display: flex;
    background: #f8f9fa;
    border-radius: 10px;
    padding: 4px;
    margin-bottom: 1.5rem;
}

.option-tab {
    flex: 1;
    padding: 12px 16px;
    border: none;
    background: transparent;
    border-radius: 8px;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.option-tab.active {
    background: white;
    color: var(--primary-color);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.file-upload-area {
    border: 2px dashed #e2e8f0;
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafafa;
}

.file-upload-area:hover {
    border-color: var(--primary-color);
    background: #f0f7ff;
}

.upload-content i {
    font-size: 3rem;
    color: #6c757d;
    margin-bottom: 1rem;
}

.upload-content p {
    margin: 0.5rem 0;
    color: #4a5568;
    font-weight: 600;
}

.upload-content small {
    color: #6c757d;
}

.image-preview {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
    background: #fafafa;
    margin-top: 1rem;
}

.image-preview img {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.image-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.9rem;
    color: #6c757d;
}

.btn-remove {
    margin-left: auto;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-platforms {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.platform-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.platform-item:hover {
    border-color: var(--primary-color);
    background: #f0f7ff;
}

.platform-item.active {
    border-color: var(--primary-color);
    background: #f0f7ff;
}

.platform-item i {
    font-size: 1.5rem;
    color: #6c757d;
}

.platform-item span {
    font-weight: 600;
    color: #4a5568;
    font-size: 0.9rem;
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
    const form = document.getElementById('imagesQrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    const optionTabs = document.querySelectorAll('.option-tab');
    const uploadOptions = document.querySelectorAll('.upload-option');
    const fileInput = document.getElementById('imageFile');
    const imagePreview = document.getElementById('imagePreview');
    const uploadArea = document.querySelector('.file-upload-area');
    const platformItems = document.querySelectorAll('.platform-item');
    
    let currentQRData = '';
    let currentOption = 'url';
    
    // Option tabs
    optionTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const option = this.dataset.option;
            switchOption(option);
        });
    });
    
    function switchOption(option) {
        currentOption = option;
        
        // Update active tab
        optionTabs.forEach(tab => {
            tab.classList.toggle('active', tab.dataset.option === option);
        });
        
        // Show/hide options
        uploadOptions.forEach(opt => {
            opt.style.display = opt.id === option + 'Option' ? 'block' : 'none';
        });
        
        // Clear form
        if (option === 'url') {
            document.getElementById('imageUrl').value = '';
        } else if (option === 'upload') {
            clearImage();
        } else if (option === 'gallery') {
            document.getElementById('galleryUrl').value = '';
            platformItems.forEach(item => item.classList.remove('active'));
        }
    }
    
    // Platform selection
    platformItems.forEach(item => {
        item.addEventListener('click', function() {
            platformItems.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            
            const platform = this.dataset.platform;
            const galleryInput = document.getElementById('galleryUrl');
            
            switch(platform) {
                case 'google-photos':
                    galleryInput.placeholder = 'Google Photos albüm linkini girin';
                    break;
                case 'instagram':
                    galleryInput.placeholder = 'Instagram profil veya post linkini girin';
                    break;
                case 'flickr':
                    galleryInput.placeholder = 'Flickr albüm linkini girin';
                    break;
                case 'imgur':
                    galleryInput.placeholder = 'Imgur albüm linkini girin';
                    break;
            }
        });
    });
    
    // File upload
    fileInput.addEventListener('change', handleImageSelect);
    
    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--primary-color)';
        this.style.background = '#f0f7ff';
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = '#e2e8f0';
        this.style.background = '#fafafa';
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#e2e8f0';
        this.style.background = '#fafafa';
        
        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            fileInput.files = files;
            handleImageSelect();
        } else {
            alert('Lütfen sadece görsel dosyası seçin');
        }
    });
    
    function handleImageSelect() {
        const file = fileInput.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Lütfen sadece görsel dosyası seçin');
                clearImage();
                return;
            }
            
            if (file.size > 5 * 1024 * 1024) { // 5MB
                alert('Dosya boyutu 5MB\'dan küçük olmalıdır');
                clearImage();
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imageName').textContent = file.name;
                document.getElementById('imageSize').textContent = formatFileSize(file.size);
                imagePreview.style.display = 'block';
                uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }
    
    function clearImage() {
        fileInput.value = '';
        imagePreview.style.display = 'none';
        uploadArea.style.display = 'block';
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        generateImageQR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generateImageQR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generateImageQR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generateImageQR();
    });
    
    function generateImageQR() {
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        const title = document.getElementById('imageTitle').value.trim();
        
        let imageUrl = '';
        
        if (currentOption === 'url') {
            imageUrl = document.getElementById('imageUrl').value.trim();
            if (!imageUrl) {
                alert('Lütfen görsel URL\'sini giriniz');
                return;
            }
        } else if (currentOption === 'upload') {
            if (!fileInput.files[0]) {
                alert('Lütfen görsel dosyası seçiniz');
                return;
            }
            // Bu durumda dosya yükleme işlemi yapılacak
            // Şimdilik örnek URL kullanıyoruz
            imageUrl = 'https://example.com/uploaded-image.jpg';
        } else if (currentOption === 'gallery') {
            imageUrl = document.getElementById('galleryUrl').value.trim();
            if (!imageUrl) {
                alert('Lütfen galeri URL\'sini giriniz');
                return;
            }
        }
        
        currentQRData = imageUrl;
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(imageUrl)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="Görsel QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        let imageType = 'URL Linki';
        if (currentOption === 'upload') imageType = 'Yüklenen Dosya';
        if (currentOption === 'gallery') imageType = 'Galeri Linki';
        
        document.getElementById('infoImageType').textContent = imageType;
        document.getElementById('infoTitle').textContent = title || 'Belirtilmedi';
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
        link.download = 'image-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        navigator.share({
            title: 'Görsel QR Kod',
            text: 'Görselime erişim için QR kodu tarayın',
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('Görsel linki kopyalandı!');
        });
    }
}

function clearImage() {
    document.getElementById('imageFile').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.querySelector('.file-upload-area').style.display = 'block';
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>