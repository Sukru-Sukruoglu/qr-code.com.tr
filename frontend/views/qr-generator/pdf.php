<?php
$pageTitle = "PDF QR Kod Oluşturucu | QR-CODE.COM.TR";
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
                    <span>PDF QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon pdf-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="title-content">
                        <h1>PDF QR Kod Oluşturucu</h1>
                        <p>PDF dosyalarınızı QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fas fa-file-pdf"></i> PDF Dosya Bilgileri</h3>
                        
                        <form id="pdfQrForm" class="qr-form">
                            <!-- Dosya Yükleme Seçenekleri -->
                            <div class="upload-options">
                                <div class="option-tabs">
                                    <button type="button" class="option-tab active" data-option="url">
                                        <i class="fas fa-link"></i> PDF URL'si
                                    </button>
                                    <button type="button" class="option-tab" data-option="upload">
                                        <i class="fas fa-upload"></i> Dosya Yükle
                                    </button>
                                </div>
                            </div>

                            <!-- URL Seçeneği -->
                            <div id="urlOption" class="upload-option">
                                <div class="form-group">
                                    <label for="pdfUrl">
                                        <i class="fas fa-link"></i> PDF Dosya URL'si
                                        <span class="required">*</span>
                                    </label>
                                    <input type="url" id="pdfUrl" placeholder="https://example.com/dosya.pdf" required>
                                    <small class="form-help">PDF dosyanızın internetteki URL adresini girin</small>
                                </div>
                            </div>

                            <!-- Dosya Yükleme Seçeneği -->
                            <div id="uploadOption" class="upload-option" style="display: none;">
                                <div class="form-group">
                                    <label for="pdfFile">
                                        <i class="fas fa-upload"></i> PDF Dosyası Seç
                                        <span class="required">*</span>
                                    </label>
                                    <div class="file-upload-area" onclick="document.getElementById('pdfFile').click()">
                                        <input type="file" id="pdfFile" accept=".pdf" style="display: none;">
                                        <div class="upload-content">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>PDF dosyanızı buraya sürükleyin veya seçmek için tıklayın</p>
                                            <small>Maksimum dosya boyutu: 10MB</small>
                                        </div>
                                    </div>
                                    <div id="fileInfo" class="file-info" style="display: none;">
                                        <i class="fas fa-file-pdf"></i>
                                        <span id="fileName"></span>
                                        <span id="fileSize"></span>
                                        <button type="button" onclick="clearFile()" class="btn-remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- PDF Bilgileri -->
                            <div class="form-group">
                                <label for="pdfTitle">
                                    <i class="fas fa-heading"></i> PDF Başlığı
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <input type="text" id="pdfTitle" placeholder="Doküman başlığı">
                                <small class="form-help">PDF içeriğinizi açıklayan bir başlık</small>
                            </div>

                            <div class="form-group">
                                <label for="pdfDescription">
                                    <i class="fas fa-info-circle"></i> Açıklama
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="pdfDescription" rows="3" placeholder="PDF içeriği hakkında kısa açıklama"></textarea>
                                <small class="form-help">PDF'nin ne içerdiği hakkında bilgi</small>
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
                                        <input type="color" id="qrColor" value="#dc3545">
                                        <span class="color-value">#dc3545</span>
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
                                <i class="fas fa-file-pdf"></i> PDF QR Kodu Oluştur
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
                                <i class="fas fa-file-pdf"></i>
                                <p>PDF bilgilerini girin<br>QR kodunuz burada görünecek</p>
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
                                <span class="info-label">PDF Türü:</span>
                                <span id="infoPdfType" class="info-value"></span>
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
                            <li>QR kodu tarayarak PDF dosyanıza direkt erişim sağlanır</li>
                            <li>Menü, broşür, katalog paylaşımında çok kullanışlıdır</li>
                            <li>PDF URL'sinin herkese açık olması gerekir</li>
                            <li>Kırmızı renk PDF temasına uygun olduğu için önerilir</li>
                            <li>Yazdırılan materyallerde QR boyutuna dikkat edin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.pdf-icon {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}

.qr-placeholder i {
    color: #dc3545;
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

.file-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    margin-top: 1rem;
}

.file-info i {
    color: #dc3545;
    font-size: 1.5rem;
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
    const form = document.getElementById('pdfQrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    const optionTabs = document.querySelectorAll('.option-tab');
    const uploadOptions = document.querySelectorAll('.upload-option');
    const fileInput = document.getElementById('pdfFile');
    const fileInfo = document.getElementById('fileInfo');
    const uploadArea = document.querySelector('.file-upload-area');
    
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
            document.getElementById('pdfUrl').value = '';
        } else {
            clearFile();
        }
    }
    
    // File upload
    fileInput.addEventListener('change', handleFileSelect);
    
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
        if (files.length > 0 && files[0].type === 'application/pdf') {
            fileInput.files = files;
            handleFileSelect();
        } else {
            alert('Lütfen sadece PDF dosyası seçin');
        }
    });
    
    function handleFileSelect() {
        const file = fileInput.files[0];
        if (file) {
            if (file.type !== 'application/pdf') {
                alert('Lütfen sadece PDF dosyası seçin');
                clearFile();
                return;
            }
            
            if (file.size > 10 * 1024 * 1024) { // 10MB
                alert('Dosya boyutu 10MB\'dan küçük olmalıdır');
                clearFile();
                return;
            }
            
            document.getElementById('fileName').textContent = file.name;
            document.getElementById('fileSize').textContent = formatFileSize(file.size);
            fileInfo.style.display = 'flex';
            uploadArea.style.display = 'none';
        }
    }
    
    function clearFile() {
        fileInput.value = '';
        fileInfo.style.display = 'none';
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
        generatePdfQR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generatePdfQR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generatePdfQR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generatePdfQR();
    });
    
    function generatePdfQR() {
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        const title = document.getElementById('pdfTitle').value.trim();
        
        let pdfUrl = '';
        
        if (currentOption === 'url') {
            pdfUrl = document.getElementById('pdfUrl').value.trim();
            if (!pdfUrl) {
                alert('Lütfen PDF URL\'sini giriniz');
                return;
            }
        } else {
            if (!fileInput.files[0]) {
                alert('Lütfen PDF dosyası seçiniz');
                return;
            }
            // Bu durumda dosya yükleme işlemi yapılacak
            // Şimdilik örnek URL kullanıyoruz
            pdfUrl = 'https://example.com/uploaded-file.pdf';
        }
        
        currentQRData = pdfUrl;
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(pdfUrl)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="PDF QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        document.getElementById('infoPdfType').textContent = currentOption === 'url' ? 'URL Linki' : 'Yüklenen Dosya';
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
        link.download = 'pdf-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        navigator.share({
            title: 'PDF QR Kod',
            text: 'PDF dosyama erişim için QR kodu tarayın',
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('PDF linki kopyalandı!');
        });
    }
}

function clearFile() {
    document.getElementById('pdfFile').value = '';
    document.getElementById('fileInfo').style.display = 'none';
    document.querySelector('.file-upload-area').style.display = 'block';
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>