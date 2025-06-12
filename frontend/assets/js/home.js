// Hızlı QR oluşturma
function generateQuickQR() {
    const text = document.getElementById('quickText').value;
    if (!text.trim()) {
        alert('Lütfen bir URL veya metin girin!');
        return;
    }
    
    const qrResult = document.getElementById('qrResult');
    const qrImageContainer = document.getElementById('qrImageContainer');
    
    // QR kodu oluştur
    const qrImageUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(text)}`;
    qrImageContainer.innerHTML = `<img src="${qrImageUrl}" alt="QR Kod" style="border-radius: 10px;">`;
    
    // Sonucu göster
    qrResult.style.display = 'block';
    qrResult.scrollIntoView({ behavior: 'smooth' });
}

// QR indirme
function downloadQR() {
    const text = document.getElementById('quickText').value;
    if (!text.trim()) return;
    
    const qrImageUrl = `https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=${encodeURIComponent(text)}`;
    
    const link = document.createElement('a');
    link.href = qrImageUrl;
    link.download = 'qr-kod.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Link kopyalama
function copyQRLink() {
    const text = document.getElementById('quickText').value;
    if (!text.trim()) return;
    
    const qrImageUrl = `https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=${encodeURIComponent(text)}`;
    
    navigator.clipboard.writeText(qrImageUrl).then(() => {
        alert('QR kod linki kopyalandı!');
    });
}

// Scroll fonksiyonları
function scrollToNeeds() {
    const needsSection = document.querySelector('.qr-needs');
    if (needsSection) {
        needsSection.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
        });
    }
}

function scrollToQRTypes() {
    const typesSection = document.querySelector('.qr-types');
    if (typesSection) {
        typesSection.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
        });
    }
}

// QR generator'a yönlendirme
function goToQRGenerator(type) {
    window.location.href = `/dashboard/qr-code.com.tr/qr-olustur?type=${type}`;
}

// Mobile menu
function toggleMobileMenu() {
    const nav = document.querySelector('.nav');
    nav.classList.toggle('mobile-open');
}

// Enter tuşu ile QR oluşturma
document.addEventListener('DOMContentLoaded', function() {
    const quickTextInput = document.getElementById('quickText');
    if (quickTextInput) {
        quickTextInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                generateQuickQR();
            }
        });
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});