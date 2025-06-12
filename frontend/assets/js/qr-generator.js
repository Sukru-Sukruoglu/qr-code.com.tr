// QR Generator JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Form ve önizleme elementlerini seçelim
    const urlQrForm = document.getElementById('urlQrForm');
    const qrCodePreview = document.getElementById('qrCodePreview');
    const qrDownloadOptions = document.getElementById('qrDownloadOptions');
    
    // URL form işlemi
    if (urlQrForm) {
        urlQrForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Form verilerini al
            const url = document.getElementById('url').value;
            const foregroundColor = document.getElementById('foregroundColor').value;
            const backgroundColor = document.getElementById('backgroundColor').value;
            const size = document.getElementById('qrSize').value;
            
            // URL kontrolü
            if (!isValidURL(url)) {
                alert('Lütfen geçerli bir URL giriniz (örn: https://example.com)');
                return;
            }
            
            // QR kod oluştur - Burada örnek olarak görsel ekliyoruz
            // Gerçek uygulamada API'ye istek göndermek gerekir
            generateQRCode(url, foregroundColor, backgroundColor, size);
            
            // İndirme seçeneklerini göster
            qrDownloadOptions.style.display = 'flex';
        });
    }
    
    // PNG indirme butonu
    const downloadPngBtn = document.getElementById('downloadPng');
    if (downloadPngBtn) {
        downloadPngBtn.addEventListener('click', function() {
            // QR kodunu PNG olarak indir
            downloadQRCode('png');
        });
    }
    
    // SVG indirme butonu
    const downloadSvgBtn = document.getElementById('downloadSvg');
    if (downloadSvgBtn) {
        downloadSvgBtn.addEventListener('click', function() {
            // QR kodunu SVG olarak indir
            downloadQRCode('svg');
        });
    }
    
    // Kaydetme butonu
    const saveQrCodeBtn = document.getElementById('saveQrCode');
    if (saveQrCodeBtn) {
        saveQrCodeBtn.addEventListener('click', function() {
            saveQRCode();
        });
    }
    
    // QR kod oluşturma fonksiyonu
    function generateQRCode(data, fgColor, bgColor, size) {
        // Burada normalde bir QR kod kütüphanesi kullanılır (örn: qrcode.js)
        // Bu örnek için sadece basit bir görsel gösteriyoruz
        
        qrCodePreview.innerHTML = '';
        qrCodePreview.classList.add('generated-qr');
        
        // Örnek QR kod görünümü oluşturuyoruz
        const qrImg = document.createElement('img');
        
        // Gerçek uygulamada bu URL'yi kendi API'niz ile değiştirin
        qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(data)}&size=${size}x${size}&color=${fgColor.substring(1)}&bgcolor=${bgColor.substring(1)}`;
        qrImg.alt = 'Oluşturulan QR Kod';
        qrImg.style.maxWidth = '100%';
        
        qrCodePreview.appendChild(qrImg);
    }
    
    // QR kodu indirme fonksiyonu
    function downloadQRCode(format) {
        const qrImg = qrCodePreview.querySelector('img');
        if (!qrImg) return;
        
        // Gerçek uygulamada doğru indirme yöntemini kullanın
        const downloadLink = document.createElement('a');
        
        if (format === 'png') {
            fetch(qrImg.src)
                .then(response => response.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    downloadLink.href = url;
                    downloadLink.download = `qrcode_${Date.now()}.png`;
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                    window.URL.revokeObjectURL(url);
                });
        } else if (format === 'svg') {
            // Bu örnek için SVG indirme simulasyonu
            alert('SVG indirme özelliği şu anda hazırlanıyor.');
        }
    }
    
    // QR kodu kaydetme fonksiyonu
    function saveQRCode() {
        // Kullanıcı oturumu kontrolü
        const isLoggedIn = document.body.classList.contains('logged-in');
        
        if (!isLoggedIn) {
            // Kullanıcı giriş yapmamış
            window.location.href = SITE_URL + '/auth/login';
            return;
        }
        
        // API'ye istek göndererek kullanıcının hesabına kaydet
        alert('QR kodunuz hesabınıza kaydedildi!');
    }
    
    // URL doğrulama fonksiyonu
    function isValidURL(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }
});