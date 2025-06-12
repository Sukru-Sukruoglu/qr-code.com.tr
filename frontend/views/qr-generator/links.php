<?php
$pageTitle = "Link Listesi QR Kod Oluşturucu | QR-CODE.COM.TR";
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
                    <span>Link Listesi QR Kod</span>
                </div>
                
                <div class="qr-gen-title">
                    <div class="title-icon links-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="title-content">
                        <h1>Link Listesi QR Kod Oluşturucu</h1>
                        <p>Birden fazla linki tek QR kod ile paylaşın</p>
                    </div>
                </div>
            </div>

            <div class="qr-generator-layout">
                <!-- Form Section -->
                <div class="qr-form-section">
                    <div class="qr-form-card">
                        <h3><i class="fas fa-list"></i> Link Listesi</h3>
                        
                        <form id="linkListQrForm" class="qr-form">
                            <!-- Başlık -->
                            <div class="form-group">
                                <label for="listTitle">
                                    <i class="fas fa-heading"></i> Liste Başlığı
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="listTitle" placeholder="Önemli Linkler" required>
                                <small class="form-help">Link listenizin başlığı</small>
                            </div>

                            <div class="form-group">
                                <label for="listDescription">
                                    <i class="fas fa-align-left"></i> Açıklama
                                    <span class="optional">(İsteğe bağlı)</span>
                                </label>
                                <textarea id="listDescription" rows="2" placeholder="Liste hakkında kısa açıklama"></textarea>
                                <small class="form-help">Liste açıklaması</small>
                            </div>

                            <!-- Linkler -->
                            <h4><i class="fas fa-link"></i> Linkler</h4>
                            
                            <div id="linkContainer">
                                <!-- Link 1 -->
                                <div class="link-group" data-index="1">
                                    <div class="link-header">
                                        <span class="link-number">1</span>
                                        <button type="button" class="remove-link" onclick="removeLink(1)" style="display: none;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="linkTitle1">
                                                <i class="fas fa-tag"></i> Link Başlığı
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" id="linkTitle1" placeholder="Ana Sayfa" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="linkUrl1">
                                                <i class="fas fa-link"></i> URL
                                                <span class="required">*</span>
                                            </label>
                                            <input type="url" id="linkUrl1" placeholder="https://www.example.com" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="linkDesc1">
                                            <i class="fas fa-info-circle"></i> Açıklama
                                            <span class="optional">(İsteğe bağlı)</span>
                                        </label>
                                        <input type="text" id="linkDesc1" placeholder="Link açıklaması">
                                    </div>
                                </div>

                                <!-- Link 2 -->
                                <div class="link-group" data-index="2">
                                    <div class="link-header">
                                        <span class="link-number">2</span>
                                        <button type="button" class="remove-link" onclick="removeLink(2)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="linkTitle2">
                                                <i class="fas fa-tag"></i> Link Başlığı
                                            </label>
                                            <input type="text" id="linkTitle2" placeholder="İletişim">
                                        </div>
                                        <div class="form-group">
                                            <label for="linkUrl2">
                                                <i class="fas fa-link"></i> URL
                                            </label>
                                            <input type="url" id="linkUrl2" placeholder="https://www.example.com/contact">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="linkDesc2">
                                            <i class="fas fa-info-circle"></i> Açıklama
                                            <span class="optional">(İsteğe bağlı)</span>
                                        </label>
                                        <input type="text" id="linkDesc2" placeholder="Link açıklaması">
                                    </div>
                                </div>
                            </div>

                            <div class="link-actions">
                                <button type="button" class="btn btn-outline" onclick="addLink()">
                                    <i class="fas fa-plus"></i> Link Ekle
                                </button>
                                <span class="link-count">Toplam: <span id="linkCountText">2</span> link</span>
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
                                        <input type="color" id="qrColor" value="#fd79a8">
                                        <span class="color-value">#fd79a8</span>
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
                                <i class="fas fa-list"></i> Link Listesi QR Kodu Oluştur
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
                                <i class="fas fa-list"></i>
                                <p>Link bilgilerini girin<br>QR kodunuz burada görünecek</p>
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
                                <span class="info-label">Liste:</span>
                                <span id="infoList" class="info-value"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Link Sayısı:</span>
                                <span id="infoLinkCount" class="info-value"></span>
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
                            <li>Birden fazla önemli linki tek QR kod ile paylaşın</li>
                            <li>Kartvizitlerde kapsamlı bilgi erişimi sunun</li>
                            <li>Etkinliklerde çoklu link paylaşımı yapın</li>
                            <li>Pembe renk çok amaçlı kullanıma uygun görünüm sağlar</li>
                            <li>Link-in-bio alternatifi olarak kullanabilirsiniz</li>
                            <li>Önemli sıralamaya göre linkleri düzenleyin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.links-icon {
    background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
}

.qr-placeholder i {
    color: #fd79a8;
    font-size: 4rem;
    margin-bottom: 1rem;
}

.link-group {
    background: #f8f9fa;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1rem;
}

.link-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.link-number {
    background: #fd79a8;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.9rem;
}

.remove-link {
    background: #dc3545;
    color: white;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.remove-link:hover {
    background: #c82333;
}

.link-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 1.5rem 0;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.link-count {
    color: #6c757d;
    font-size: 0.9rem;
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
let linkCounter = 2;

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('linkListQrForm');
    const preview = document.getElementById('qrPreview');
    const actions = document.getElementById('qrActions');
    const info = document.getElementById('qrInfo');
    
    let currentQRData = '';
    
    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        generateLinkListQR();
    });
    
    // Color input handlers
    document.getElementById('qrColor').addEventListener('input', function() {
        document.querySelector('#qrColor + .color-value').textContent = this.value;
        if (currentQRData) generateLinkListQR();
    });
    
    document.getElementById('bgColor').addEventListener('input', function() {
        document.querySelector('#bgColor + .color-value').textContent = this.value;
        if (currentQRData) generateLinkListQR();
    });
    
    // Size change handler
    document.getElementById('qrSize').addEventListener('change', function() {
        if (currentQRData) generateLinkListQR();
    });
    
    function generateLinkListQR() {
        const listTitle = document.getElementById('listTitle').value.trim();
        
        if (!listTitle) {
            alert('Lütfen liste başlığını giriniz');
            return;
        }
        
        // Collect links
        const links = [];
        const linkGroups = document.querySelectorAll('.link-group');
        
        linkGroups.forEach(group => {
            const index = group.dataset.index;
            const title = document.getElementById(`linkTitle${index}`).value.trim();
            const url = document.getElementById(`linkUrl${index}`).value.trim();
            
            if (title && url) {
                links.push({
                    title: title,
                    url: url,
                    description: document.getElementById(`linkDesc${index}`).value.trim()
                });
            }
        });
        
        if (links.length === 0) {
            alert('Lütfen en az bir link ekleyin');
            return;
        }
        
        // Create link list page URL (gerçek uygulamada kendi sayfanızı oluşturun)
        const linkData = {
            title: listTitle,
            description: document.getElementById('listDescription').value.trim(),
            links: links
        };
        
        currentQRData = `https://link-list.example.com/${encodeURIComponent(listTitle.toLowerCase().replace(/\s+/g, '-'))}`;
        
        const size = document.getElementById('qrSize').value;
        const color = document.getElementById('qrColor').value.replace('#', '');
        const bgColor = document.getElementById('bgColor').value.replace('#', '');
        
        // QR kod oluştur
        const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(currentQRData)}&size=${size}x${size}&color=${color}&bgcolor=${bgColor}&format=png`;
        
        preview.innerHTML = `<img src="${qrUrl}" alt="Link Listesi QR Kod" class="qr-image">`;
        
        // Actions ve info göster
        actions.style.display = 'flex';
        info.style.display = 'block';
        
        // Info güncelle
        document.getElementById('infoList').textContent = listTitle;
        document.getElementById('infoLinkCount').textContent = links.length;
        document.getElementById('infoSize').textContent = `${size}x${size} px`;
        
        // Preview'a scroll
        preview.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

function addLink() {
    linkCounter++;
    const container = document.getElementById('linkContainer');
    
    const linkGroup = document.createElement('div');
    linkGroup.className = 'link-group';
    linkGroup.dataset.index = linkCounter;
    
    linkGroup.innerHTML = `
        <div class="link-header">
            <span class="link-number">${linkCounter}</span>
            <button type="button" class="remove-link" onclick="removeLink(${linkCounter})">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="linkTitle${linkCounter}">
                    <i class="fas fa-tag"></i> Link Başlığı
                </label>
                <input type="text" id="linkTitle${linkCounter}" placeholder="Link ${linkCounter}">
            </div>
            <div class="form-group">
                <label for="linkUrl${linkCounter}">
                    <i class="fas fa-link"></i> URL
                </label>
                <input type="url" id="linkUrl${linkCounter}" placeholder="https://www.example.com">
            </div>
        </div>
        <div class="form-group">
            <label for="linkDesc${linkCounter}">
                <i class="fas fa-info-circle"></i> Açıklama
                <span class="optional">(İsteğe bağlı)</span>
            </label>
            <input type="text" id="linkDesc${linkCounter}" placeholder="Link açıklaması">
        </div>
    `;
    
    container.appendChild(linkGroup);
    updateLinkCount();
}

function removeLink(index) {
    const linkGroup = document.querySelector(`[data-index="${index}"]`);
    if (linkGroup) {
        linkGroup.remove();
        updateLinkCount();
    }
}

function updateLinkCount() {
    const count = document.querySelectorAll('.link-group').length;
    document.getElementById('linkCountText').textContent = count;
}

function downloadQR() {
    const img = document.querySelector('.qr-image');
    if (img) {
        const link = document.createElement('a');
        link.href = img.src;
        link.download = 'link-list-qr-code.png';
        link.click();
    }
}

function shareQR() {
    if (navigator.share) {
        const listTitle = document.getElementById('listTitle').value.trim();
        navigator.share({
            title: 'Link Listesi QR Kod',
            text: `${listTitle} link listesi için QR kodu tarayın`,
            url: currentQRData
        });
    } else {
        copyQRLink();
    }
}

function copyQRLink() {
    if (currentQRData) {
        navigator.clipboard.writeText(currentQRData).then(() => {
            alert('Link listesi kopyalandı!');
        });
    }
}
</script>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>