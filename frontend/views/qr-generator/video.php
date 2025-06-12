<?php
$pageTitle = "Video QR Kod Oluşturucu | QR-CODE.COM.TR";
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
                    <span>Video QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon video-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="title-content">
                        <h1>Video QR Kod Oluşturucu</h1>
                        <p>Videolarınızı QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fas fa-video"></i> Video Bilgileri</h3>
                        
                        <form id="videoQrForm" class="qr-form">
                            <!-- Video Yükleme Seçenekleri -->
                            <div class="upload-options">
                                <div class="option-tabs">
                                    <button type="button" class="option-tab active" data-option="url">
                                        <i class="fas fa-link"></i> Video URL'si
                                    </button>
                                    <button type="button" class="option-tab" data-option="upload">
                                        <i class="fas fa-upload"></i> Dosya Yükle
                                    </button>
                                    <button type="button" class="option-tab" data-option="platform">
                                        <i class="fab fa-youtube"></i> Platform
                                    </button>
                                </div>
                            </div>

                            <!-- URL Seçeneği -->
                            <div id="urlOption" class="upload-option">
                                <div class="form-group">
                                    <label for="videoUrl">
                                        <i class="fas fa-link"></i> Video URL'si
                                        <span class="required">*</span>
                                    </label>
                                    <input type="url" id="videoUrl" placeholder="https://example.com/video.mp4" required>
                                    <small class="form-help">Video dosyanızın internetteki URL adresini girin (MP4, AVI, MOV desteklenir)</small>
                                </div>
                            </div>

                            <!-- Dosya Yükleme Seçeneği -->
                            <div id="uploadOption" class="upload-option" style="display: none;">
                                <div class="form-group">
                                    <label for="videoFile">
                                        <i class="fas fa-upload"></i> Video Dosyası Seç
                                        <span class="required">*</span>
                                    </label>
                                    <div class="file-upload-area" onclick="document.getElementById('videoFile').click()">
                                        <input type="file" id="videoFile" accept="video/*" style="display: none;">
                                        <div class="upload-content">
                                            <i class="fas fa-video"></i>
                                            <p>Video dosyanızı buraya sürükleyin veya seçmek için tıklayın</p>
                                            <small>MP4, AVI, MOV formatları desteklenir. Maksimum: 50MB</small>
                                        </div>
                                    </div>
                                    <div id="videoPreview" class="video-preview" style="display: none;">
                                        <video id="previewVideo" controls style="width: 100%; max-height: 200px; border-radius: 8px;"></video>
                                        <div class="video-info">
                                            <span id="videoName"></span>
                                            <span id="videoSize"></span>
                                            <button type="button" onclick="clearVideo()" class="btn-remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Platform Seçeneği -->
                            <div id="platformOption" class="upload-option" style="display: none;">
                                <div class="form-group">
                                    <label>
                                        <i class="fab fa-youtube"></i> Video Platformları
                                    </label>
                                    <div class="video-platforms">
                                        <div class="platform-item" data-platform="youtube">
                                            <i class="fab fa-youtube"></i>
                                            <span>YouTube</span>
                                        </div>
                                        <div class="platform-item" data-platform="vimeo">
                                            <i class="fab fa-vimeo"></i>
                                            <span>Vimeo</span>
                                        </div>
                                        <div class="platform-item" data-platform="dailymotion">
                                            <i class="fab fa-dailymotion"></i>
                                            <span>Dailymotion</span>
                                        </div>
                                        <div class="platform-item" data-platform="tiktok">
                                            <i class="fab fa-tiktok"></i>
                                            <span>TikTok</span>
                                        </div>
                                        <div class="platform-item" data-platform="instagram">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </div>
                                        <div class="platform-item" data-platform="facebook">
                                            <i class="fab fa-facebook"></i>
                                            <span>Facebook</span>
                                        </div>
                                    </div>
                                    <input type="url" id="platformUrl" placeholder="Video linkini girin" style="margin-top: 1rem;">
                                    <small class="form-help">Seçilen platform için video linkinizi yapıştırın</small>
                                </div>
                            </div>

                            <!-- Video Bilgileri -->
                            <div class="form-group">
                                <label for="videoTitle">
                                    <i class="fas fa-heading"></i> Video Başlığı
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <input type="text" id="videoTitle" placeholder="Video başlığı">
                                <small class="form-help">Videonuzu açıklayan bir başlık</small>
                            </div>

                            <div class="form-group">
                                <label for="videoDescription">
                                    <i class="fas fa-info-circle"></i> Açıklama
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="videoDescription" rows="3" placeholder="Video içeriği hakkında kısa açıklama"></textarea>
                                <small class="form-help">Video hakkında bilgi</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="videoDuration">
                                        <i class="fas fa-clock"></i> Süre
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="text" id="videoDuration" placeholder="5:30">
                                    <small class="form-help">Video süresi (dakika:saniye)</small>
                                </div>

                                <div class="form-group">
                                    <label for="videoCategory">
                                        <i class="fas fa-tags"></i> Kategori
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <select id="videoCategory">
                                        <option value="">Kategori seçin</option>
                                        <option value="eğitim">Eğitim</option>
                                        <option value="eğlence">Eğlence</option>
                                        <option value="müzik">Müzik</option>
                                        <option value="spor">Spor</option>
                                        <option value="teknoloji">Teknoloji</option>
                                        <option value="seyahat">Seyahat</option>
                                        <option value="yemek">Yemek & Mutfak</option>
                                        <option value="sanat">Sanat & Tasarım</option>
                                        <option value="iş">İş & Finans</option>
                                        <option value="diğer">Diğer</option>
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
                                        <input type="color" id="qrColor" value="#e83e8c">
                                        <span class="color-value">#e83e8c</span>
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
                                <i class="fas fa-video"></i> Video QR Kodu Oluştur
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
                                <i class="fas fa-video"></i>
                                <p>Video bilgilerini girin<br>QR kodunuz burada görünecek</p>
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
                                <span class="info-label">Video Türü:</span>
                                <span id="infoVideoType" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Başlık:</span>
                                <span id="infoTitle" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Süre:</span>
                                <span id="infoDuration" class="info-value"></span>
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
                            <li>QR kodu tarayarak videoya direkt erişim sağlanır</li>
                            <li>Eğitim videoları için çok kullanışlıdır</li>
                            <li>Sosyal medya videolarınızı offline paylaşabilirsiniz</li>
                            <li>Pembe renk video temasına uygun olduğu için önerilir</li>
                            <li>YouTube, Vimeo gibi platformları destekler</li>
                            <li>Video dosyasının herkese açık olması gerekir</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.video-icon {
    background: linear-gradient(135deg, #e83e8c 0%, #d91a72 100%);
}

.qr-placeholder i {
    color: #e83e8c;
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

.video-preview {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
    background: #fafafa;
    margin-top: 1rem;
}

.video-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.9rem;
    color: #6c757d;
    margin-top: 1rem;
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

.video-platforms {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
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
    const form = document.getElementById('videoQrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    const optionTabs = document.querySelectorAll('.option-tab');
    const uploadOptions = document.querySelectorAll('.upload-option');
    const fileInput = document.getElementById('videoFile');
    const videoPreview = document.getElementById('videoPreview');
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
            document.getElementById('videoUrl').value = '';
        } else if (option === 'upload') {
            clearVideo();
        } else if (option === 'platform') {
            document.getElementById('platformUrl').value = '';
            platformItems.forEach(item => item.classList.remove('active'));
        }
    }
    
    // Platform selection
    platformItems.forEach(item => {
        item.addEventListener('click', function() {
            platformItems.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            
            const platform = this.dataset.platform;
            const platformInput = document.getElementById('platformUrl');
            
            switch(platform) {
                case 'youtube':
                    platformInput.placeholder = 'YouTube video linkini girin (https://youtu.be/...)';
                    break;
                case 'vimeo':
                    platformInput.placeholder = 'Vimeo video linkini girin';
                    break;
                case 'dailymotion':
                    platformInput.placeholder = 'Dailymotion video linkini girin';
                    break;
                case 'tiktok':
                    platformInput.placeholder = 'TikTok video linkini girin';
                    break;
                case 'instagram':
                    platformInput.placeholder = 'Instagram video linkini girin';
                    break;
                case 'facebook':
                    platformInput.placeholder = 'Facebook video linkini girin';
                    break;
            }
        });
    });
    
    // File upload
    fileInput.addEventListener('change', handleVideoSelect);
    
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
        if (files.length > 0 && files[0].type.startsWith('video/')) {
            fileInput.files = files;
            handleVideoSelect();
        } else {
            alert('Lütfen sadece video dosyası seçin');
        }
    });
    
    function handleVideoSelect() {
        const file = fileInput.files[0];
        if (file) {
            if (!file.type.startsWith('video/')) {
                alert('Lütfen sadece video dosyası seçin');
                clearVideo();
                return;
            }
            
            if (file.size > 50 * 1024 * 1024) { // 50MB
                alert('Dosya boyutu 50MB\'dan küçük olmalıdır');
                clearVideo();
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewVideo').src = e.target.result;
                document.getElementById('videoName').textContent = file.name;
                document.getElementById('videoSize').textContent = formatFileSize(file.size);
                videoPreview.style.display = 'block';
                uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }
    
    function clearVideo() {
        fileInput.value = '';
        videoPreview.style.display = 'none';
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
        generateVideoQR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generateVideoQR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generateVideoQR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generateVideoQR();
    });
    
    function generateVideoQR() {
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        const title = document.getElementById('videoTitle').value.trim();
        const duration = document.getElementById('videoDuration').value.trim();
        
        let videoUrl = '';
        
        if (currentOption === 'url') {
            videoUrl = document.getElementById('videoUrl').value.trim();
            if (!videoUrl) {
                alert('Lütfen video URL\'sini giriniz');
                return;
            }
        } else if (currentOption === 'upload') {
            if (!fileInput.files[0]) {
                alert('Lütfen video dosyası seçiniz');
                return;
            }
            // Bu durumda dosya yükleme işlemi yapılacak
            // Şimdilik örnek URL kullanıyoruz
            videoUrl = 'https://example.com/uploaded-video.mp4';
        } else if (currentOption === 'platform') {
            videoUrl = document.getElementById('platformUrl').value.trim();
            if (!videoUrl) {
                alert('Lütfen platform video URL\'sini giriniz');
                return;
            }
        }
        
        currentQRData = videoUrl;
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(videoUrl)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="Video QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        let videoType = 'URL Linki';
        if (currentOption === 'upload') videoType = 'Yüklenen Dosya';
        if (currentOption === 'platform') videoType = 'Platform Linki';
        
        document.getElementById('infoVideoType').textContent = videoType;
        document.getElementById('infoTitle').textContent = title || 'Belirtilmedi';
        document.getElementById('infoDuration').textContent = duration || 'Belirtilmedi';
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
        link.download = 'video-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        navigator.share({
            title: 'Video QR Kod',
            text: 'Videoma erişim için QR kodu tarayın',
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('Video linki kopyalandı!');
        });
    }
}

function clearVideo() {
    document.getElementById('videoFile').value = '';
    document.getElementById('videoPreview').style.display = 'none';
    document.querySelector('.file-upload-area').style.display = 'block';
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>