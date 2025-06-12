<?php
$pageTitle = "MP3 QR Kod Oluşturucu | QR-CODE.COM.TR";
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
                    <span>MP3 QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon mp3-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <div class="title-content">
                        <h1>MP3 QR Kod Oluşturucu</h1>
                        <p>Müzik dosyalarınızı QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fas fa-music"></i> Müzik Bilgileri</h3>
                        
                        <form id="mp3QrForm" class="qr-form">
                            <!-- Müzik Yükleme Seçenekleri -->
                            <div class="upload-options">
                                <div class="option-tabs">
                                    <button type="button" class="option-tab active" data-option="url">
                                        <i class="fas fa-link"></i> MP3 URL'si
                                    </button>
                                    <button type="button" class="option-tab" data-option="upload">
                                        <i class="fas fa-upload"></i> Dosya Yükle
                                    </button>
                                    <button type="button" class="option-tab" data-option="platform">
                                        <i class="fab fa-spotify"></i> Platform
                                    </button>
                                </div>
                            </div>

                            <!-- URL Seçeneği -->
                            <div id="urlOption" class="upload-option">
                                <div class="form-group">
                                    <label for="mp3Url">
                                        <i class="fas fa-link"></i> MP3 Dosya URL'si
                                        <span class="required">*</span>
                                    </label>
                                    <input type="url" id="mp3Url" placeholder="https://example.com/music.mp3" required>
                                    <small class="form-help">Müzik dosyanızın internetteki URL adresini girin (MP3, WAV, OGG desteklenir)</small>
                                </div>
                            </div>

                            <!-- Dosya Yükleme Seçeneği -->
                            <div id="uploadOption" class="upload-option" style="display: none;">
                                <div class="form-group">
                                    <label for="mp3File">
                                        <i class="fas fa-upload"></i> Müzik Dosyası Seç
                                        <span class="required">*</span>
                                    </label>
                                    <div class="file-upload-area" onclick="document.getElementById('mp3File').click()">
                                        <input type="file" id="mp3File" accept="audio/*" style="display: none;">
                                        <div class="upload-content">
                                            <i class="fas fa-music"></i>
                                            <p>Müzik dosyanızı buraya sürükleyin veya seçmek için tıklayın</p>
                                            <small>MP3, WAV, OGG formatları desteklenir. Maksimum: 25MB</small>
                                        </div>
                                    </div>
                                    <div id="audioPreview" class="audio-preview" style="display: none;">
                                        <audio id="previewAudio" controls style="width: 100%; margin-bottom: 1rem;"></audio>
                                        <div class="audio-info">
                                            <span id="audioName"></span>
                                            <span id="audioSize"></span>
                                            <button type="button" onclick="clearAudio()" class="btn-remove">
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
                                        <i class="fab fa-spotify"></i> Müzik Platformları
                                    </label>
                                    <div class="music-platforms">
                                        <div class="platform-item" data-platform="spotify">
                                            <i class="fab fa-spotify"></i>
                                            <span>Spotify</span>
                                        </div>
                                        <div class="platform-item" data-platform="apple-music">
                                            <i class="fab fa-apple"></i>
                                            <span>Apple Music</span>
                                        </div>
                                        <div class="platform-item" data-platform="youtube-music">
                                            <i class="fab fa-youtube"></i>
                                            <span>YouTube Music</span>
                                        </div>
                                        <div class="platform-item" data-platform="soundcloud">
                                            <i class="fab fa-soundcloud"></i>
                                            <span>SoundCloud</span>
                                        </div>
                                        <div class="platform-item" data-platform="deezer">
                                            <i class="fas fa-music"></i>
                                            <span>Deezer</span>
                                        </div>
                                        <div class="platform-item" data-platform="amazon-music">
                                            <i class="fab fa-amazon"></i>
                                            <span>Amazon Music</span>
                                        </div>
                                    </div>
                                    <input type="url" id="platformUrl" placeholder="Müzik linkini girin" style="margin-top: 1rem;">
                                    <small class="form-help">Seçilen platform için müzik linkinizi yapıştırın</small>
                                </div>
                            </div>

                            <!-- Müzik Bilgileri -->
                            <div class="form-group">
                                <label for="songTitle">
                                    <i class="fas fa-music"></i> Şarkı Adı
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <input type="text" id="songTitle" placeholder="Şarkı adı">
                                <small class="form-help">Şarkının adını girin</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="artistName">
                                        <i class="fas fa-user"></i> Sanatçı
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="text" id="artistName" placeholder="Sanatçı adı">
                                    <small class="form-help">Sanatçının adı</small>
                                </div>

                                <div class="form-group">
                                    <label for="albumName">
                                        <i class="fas fa-compact-disc"></i> Albüm
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="text" id="albumName" placeholder="Albüm adı">
                                    <small class="form-help">Albüm adı</small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="duration">
                                        <i class="fas fa-clock"></i> Süre
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <input type="text" id="duration" placeholder="3:45">
                                    <small class="form-help">Şarkı süresi (dakika:saniye)</small>
                                </div>

                                <div class="form-group">
                                    <label for="genre">
                                        <i class="fas fa-tags"></i> Tür
                                        <span class="optional">(İsteğe bağlı)</span>
                                    </label>
                                    <select id="genre">
                                        <option value="">Müzik türü seçin</option>
                                        <option value="pop">Pop</option>
                                        <option value="rock">Rock</option>
                                        <option value="jazz">Jazz</option>
                                        <option value="klasik">Klasik</option>
                                        <option value="elektronik">Elektronik</option>
                                        <option value="rap">Rap/Hip-Hop</option>
                                        <option value="country">Country</option>
                                        <option value="blues">Blues</option>
                                        <option value="reggae">Reggae</option>
                                        <option value="folk">Folk</option>
                                        <option value="metal">Metal</option>
                                        <option value="r&b">R&B</option>
                                        <option value="türk-müziği">Türk Müziği</option>
                                        <option value="diğer">Diğer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">
                                    <i class="fas fa-info-circle"></i> Açıklama
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="description" rows="3" placeholder="Şarkı hakkında kısa açıklama"></textarea>
                                <small class="form-help">Şarkı veya albüm hakkında bilgi</small>
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
                                        <input type="color" id="qrColor" value="#fd7e14">
                                        <span class="color-value">#fd7e14</span>
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
                                <i class="fas fa-music"></i> MP3 QR Kodu Oluştur
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
                                <i class="fas fa-music"></i>
                                <p>Müzik bilgilerini girin<br>QR kodunuz burada görünecek</p>
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
                                <span class="info-label">Müzik Türü:</span>
                                <span id="infoMusicType" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Şarkı:</span>
                                <span id="infoSong" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Sanatçı:</span>
                                <span id="infoArtist" class="info-value"></span>
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
                            <li>QR kodu tarayarak müziğe direkt erişim sağlanır</li>
                            <li>Albüm tanıtımları için idealdir</li>
                            <li>Konser ve etkinliklerde kullanışlıdır</li>
                            <li>Turuncu renk müzik temasına uygun olduğu için önerilir</li>
                            <li>Spotify, Apple Music gibi platformları destekler</li>
                            <li>Müzik dosyasının herkese açık olması gerekir</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.mp3-icon {
    background: linear-gradient(135deg, #fd7e14 0%, #e8590c 100%);
}

.qr-placeholder i {
    color: #fd7e14;
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

.audio-preview {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
    background: #fafafa;
    margin-top: 1rem;
}

.audio-info {
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

.music-platforms {
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
    const form = document.getElementById('mp3QrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    const optionTabs = document.querySelectorAll('.option-tab');
    const uploadOptions = document.querySelectorAll('.upload-option');
    const fileInput = document.getElementById('mp3File');
    const audioPreview = document.getElementById('audioPreview');
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
            document.getElementById('mp3Url').value = '';
        } else if (option === 'upload') {
            clearAudio();
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
                case 'spotify':
                    platformInput.placeholder = 'Spotify şarkı linkini girin (https://open.spotify.com/...)';
                    break;
                case 'apple-music':
                    platformInput.placeholder = 'Apple Music linkini girin';
                    break;
                case 'youtube-music':
                    platformInput.placeholder = 'YouTube Music linkini girin';
                    break;
                case 'soundcloud':
                    platformInput.placeholder = 'SoundCloud linkini girin';
                    break;
                case 'deezer':
                    platformInput.placeholder = 'Deezer linkini girin';
                    break;
                case 'amazon-music':
                    platformInput.placeholder = 'Amazon Music linkini girin';
                    break;
            }
        });
    });
    
    // File upload
    fileInput.addEventListener('change', handleAudioSelect);
    
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
        if (files.length > 0 && files[0].type.startsWith('audio/')) {
            fileInput.files = files;
            handleAudioSelect();
        } else {
            alert('Lütfen sadece ses dosyası seçin');
        }
    });
    
    function handleAudioSelect() {
        const file = fileInput.files[0];
        if (file) {
            if (!file.type.startsWith('audio/')) {
                alert('Lütfen sadece ses dosyası seçin');
                clearAudio();
                return;
            }
            
            if (file.size > 25 * 1024 * 1024) { // 25MB
                alert('Dosya boyutu 25MB\'dan küçük olmalıdır');
                clearAudio();
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewAudio').src = e.target.result;
                document.getElementById('audioName').textContent = file.name;
                document.getElementById('audioSize').textContent = formatFileSize(file.size);
                audioPreview.style.display = 'block';
                uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }
    
    function clearAudio() {
        fileInput.value = '';
        audioPreview.style.display = 'none';
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
        generateMP3QR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generateMP3QR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generateMP3QR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generateMP3QR();
    });
    
    function generateMP3QR() {
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        const songTitle = document.getElementById('songTitle').value.trim();
        const artistName = document.getElementById('artistName').value.trim();
        const duration = document.getElementById('duration').value.trim();
        
        let musicUrl = '';
        
        if (currentOption === 'url') {
            musicUrl = document.getElementById('mp3Url').value.trim();
            if (!musicUrl) {
                alert('Lütfen MP3 URL\'sini giriniz');
                return;
            }
        } else if (currentOption === 'upload') {
            if (!fileInput.files[0]) {
                alert('Lütfen ses dosyası seçiniz');
                return;
            }
            // Bu durumda dosya yükleme işlemi yapılacak
            // Şimdilik örnek URL kullanıyoruz
            musicUrl = 'https://example.com/uploaded-music.mp3';
        } else if (currentOption === 'platform') {
            musicUrl = document.getElementById('platformUrl').value.trim();
            if (!musicUrl) {
                alert('Lütfen platform müzik URL\'sini giriniz');
                return;
            }
        }
        
        currentQRData = musicUrl;
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(musicUrl)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="MP3 QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        let musicType = 'URL Linki';
        if (currentOption === 'upload') musicType = 'Yüklenen Dosya';
        if (currentOption === 'platform') musicType = 'Platform Linki';
        
        document.getElementById('infoMusicType').textContent = musicType;
        document.getElementById('infoSong').textContent = songTitle || 'Belirtilmedi';
        document.getElementById('infoArtist').textContent = artistName || 'Belirtilmedi';
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
        link.download = 'mp3-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        navigator.share({
            title: 'MP3 QR Kod',
            text: 'Müziğime erişim için QR kodu tarayın',
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('Müzik linki kopyalandı!');
        });
    }
}

function clearAudio() {
    document.getElementById('mp3File').value = '';
    document.getElementById('audioPreview').style.display = 'none';
    document.querySelector('.file-upload-area').style.display = 'block';
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>