<?php
// Eğer değişkenler tanımlanmamışsa varsayılan değerleri ata
if (!isset($baseURL)) {
    $baseURL = '/dashboard/qr-code.com.tr';
}

if (!isset($connectionStatus)) {
    $connectionStatus = 'demo';
}
?>

<!-- Footer -->
<footer class="dashboard-footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-logo">
                    <i class="fas fa-qrcode"></i>
                    <span>QR-CODE.COM.TR</span>
                </div>
                <p class="footer-description">
                    Modern QR kod çözümleri ile dijital dünyanızı kolaylaştırın. 
                    Hızlı, güvenli ve kullanıcı dostu QR kod yönetimi.
                </p>
                <div class="footer-social">
                    <a href="https://wa.me/905322268040" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">Hızlı Linkler</h3>
                <ul class="footer-links">
                    <li><a href="<?php echo $baseURL; ?>/dashboard"><i class="fas fa-home"></i> Ana Sayfa</a></li>
                    <li><a href="<?php echo $baseURL; ?>/qr-olustur"><i class="fas fa-plus"></i> QR Oluştur</a></li>
                    <li><a href="<?php echo $baseURL; ?>/qr-listesi"><i class="fas fa-list"></i> QR Kodlarım</a></li>
                    <li><a href="<?php echo $baseURL; ?>/analytics"><i class="fas fa-chart-line"></i> Analitikler</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">Özellikler</h3>
                <ul class="footer-links">
                    <li><a href="<?php echo $baseURL; ?>/pages/features"><i class="fas fa-star"></i> Özellikler</a></li>
                    <li><a href="<?php echo $baseURL; ?>/pages/how-to-use"><i class="fas fa-question-circle"></i> Nasıl Kullanılır</a></li>
                    <li><a href="<?php echo $baseURL; ?>/pages/about"><i class="fas fa-info-circle"></i> Hakkımızda</a></li>
                    <li><a href="<?php echo $baseURL; ?>/frontend/views/contact"><i class="fas fa-envelope"></i> İletişim</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">İletişim</h3>
                <div class="footer-contact">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@qr-code.com.tr</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+90 (532) 226-8040</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>+90 (212) 503-3939</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kavacık Mh. Beykoz/İstanbul</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <div class="footer-copyright">
                    <p>&copy; 2024 QR-CODE.COM.TR - Tüm hakları saklıdır.</p>
                    <p class="footer-note">
                        <?php if ($connectionStatus === 'demo'): ?>
                            <i class="fas fa-info-circle"></i>
                            Bu sayfa demo verilerle çalışmaktadır
                        <?php else: ?>
                            <i class="fas fa-shield-alt"></i>
                            Güvenli bağlantı ile korunmaktadır
                        <?php endif; ?>
                    </p>
                </div>
                
                <div class="footer-links-bottom">
                    <a href="#" onclick="showPrivacyPolicy()">Gizlilik Politikası</a>
                    <a href="#" onclick="showTerms()">Kullanım Şartları</a>
                    <a href="#" onclick="showCookiePolicy()">Çerez Politikası</a>
                    <a href="#" onclick="showHelp()">Yardım</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Footer Styles */
.dashboard-footer {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    margin-top: 2rem; /* Reduced from 4rem */
    position: relative;
    z-index: 1;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 3rem;
    padding: 2rem 0 1rem; /* Reduced padding */
}

.footer-section h3.footer-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: rgba(255,255,255,0.9);
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.footer-logo i {
    font-size: 2rem;
    background: rgba(255,255,255,0.2);
    padding: 0.5rem;
    border-radius: 12px;
}

.footer-description {
    color: rgba(255,255,255,0.8);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.footer-social {
    display: flex;
    gap: 1rem;
}

.footer-social a {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-social a:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-3px);
}

.footer-social a[href*="whatsapp"]:hover {
    background: #25d366;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.footer-links a:hover {
    color: white;
    transform: translateX(5px);
}

.footer-contact .contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: rgba(255,255,255,0.8);
}

.footer-contact .contact-item i {
    width: 20px;
    text-align: center;
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding: 1rem 0; /* Reduced from 1.5rem */
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.footer-copyright {
    flex: 1;
}

.footer-copyright p {
    margin: 0;
    color: rgba(255,255,255,0.8);
    font-size: 0.9rem;
}

.footer-note {
    font-size: 0.8rem !important;
    color: rgba(255,255,255,0.6) !important;
    margin-top: 0.25rem !important;
}

.footer-links-bottom {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.footer-links-bottom a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
    white-space: nowrap;
    cursor: pointer;
}

.footer-links-bottom a:hover {
    color: white;
}

/* Contact page specific adjustments */
.contact-page .dashboard-footer {
    margin-left: 0;
    margin-top: 1rem; /* Further reduced for contact page */
}

/* Body margin removal */
body {
    margin: 0;
    padding: 0;
}

/* Page specific footer adjustments */
.contact-content {
    margin-bottom: 0; /* Remove bottom margin from content */
}

.faq-section {
    margin-bottom: 1rem; /* Reduce bottom margin on FAQ section */
}

/* Responsive Footer */
@media (max-width: 768px) {
    .dashboard-footer {
        margin-left: 0;
        margin-top: 1rem;
    }

    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: center;
        padding: 1.5rem 0 0.5rem; /* Further reduced padding */
    }

    .footer-bottom {
        padding: 0.75rem 0; /* Reduced padding */
    }

    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .footer-links-bottom {
        justify-content: center;
        flex-wrap: wrap;
    }
}

@media (max-width: 480px) {
    .footer-content {
        padding: 1rem 0 0.5rem; /* Minimal padding */
    }

    .footer-bottom {
        padding: 0.5rem 0; /* Minimal padding */
    }

    .footer-social {
        justify-content: center;
    }

    .footer-links-bottom {
        flex-direction: column;
        gap: 0.75rem;
        align-items: center;
    }
}
</style>

<script>
// Footer JavaScript fonksiyonları
function showPrivacyPolicy() {
    showModal('Gizlilik Politikası', `
        <div class="modal-content">
            <h4>Kişisel Verilerin Korunması</h4>
            <p>QR-CODE.COM.TR olarak kişisel verilerinizin gizliliğini önemsiyoruz...</p>
            
            <h4>Veri Toplama</h4>
            <p>Platformumuzda toplanan veriler:</p>
            <ul>
                <li>Hesap bilgileri (ad, e-posta, telefon)</li>
                <li>QR kod verileri ve kullanım istatistikleri</li>
                <li>Sistem log kayıtları</li>
            </ul>
            
            <h4>Veri Kullanımı</h4>
            <p>Toplanan veriler sadece hizmet kalitesini artırmak için kullanılır.</p>
            
            <h4>İletişim Bilgileri</h4>
            <p>E-posta: info@qr-code.com.tr</p>
            <p>Telefon: +90 (532) 226-8040</p>
        </div>
    `);
}

function showTerms() {
    showModal('Kullanım Şartları', `
        <div class="modal-content">
            <h4>Hizmet Kullanımı</h4>
            <p>QR-CODE.COM.TR platformunu kullanarak aşağıdaki şartları kabul etmiş olursunuz:</p>
            
            <h4>Kullanıcı Sorumlulukları</h4>
            <ul>
                <li>Hesap bilgilerinizi güvenli tutmak</li>
                <li>Yasal olmayan içerik oluşturmamak</li>
                <li>Sistem güvenliğini tehdit etmemek</li>
            </ul>
            
            <h4>Hizmet Kapsamı</h4>
            <p>Platform 7/24 hizmet vermeyi hedefler ancak bakım dönemlerinde kesintiler olabilir.</p>
            
            <h4>İletişim</h4>
            <p>Sorularınız için: info@qr-code.com.tr</p>
        </div>
    `);
}

function showCookiePolicy() {
    showModal('Çerez Politikası', `
        <div class="modal-content">
            <h4>Çerez Kullanımı</h4>
            <p>Web sitemizde kullanıcı deneyimini iyileştirmek için çerezler kullanıyoruz.</p>
            
            <h4>Çerez Türleri</h4>
            <ul>
                <li><strong>Zorunlu Çerezler:</strong> Sitenin çalışması için gerekli</li>
                <li><strong>Analitik Çerezler:</strong> Kullanım istatistikleri için</li>
                <li><strong>Performans Çerezler:</strong> Site hızını optimize etmek için</li>
            </ul>
            
            <h4>Çerez Yönetimi</h4>
            <p>Tarayıcı ayarlarınızdan çerezleri yönetebilirsiniz.</p>
        </div>
    `);
}

function showHelp() {
    showModal('Yardım ve Destek', `
        <div class="help-content">
            <div class="help-section">
                <h4>📞 İletişim</h4>
                <p>E-posta: info@qr-code.com.tr</p>
                <p>Mobil: +90 (532) 226-8040</p>
                <p>Sabit: +90 (212) 503-3939</p>
                <p>Çalışma Saatleri: Pazartesi-Cuma 09:00-18:00</p>
            </div>
            
            <div class="help-section">
                <h4>🚀 Hızlı Başlangıç</h4>
                <p>1. Hesap oluşturun</p>
                <p>2. QR kod türünü seçin</p>
                <p>3. İçeriği girin</p>
                <p>4. Tasarımı özelleştirin</p>
                <p>5. İndirin ve kullanın</p>
            </div>
            
            <div class="help-tips">
                <h4>💡 İpuçları</h4>
                <ul>
                    <li>QR kodlarınızı yazdırmadan önce test edin</li>
                    <li>Kontrast oranına dikkat edin</li>
                    <li>Minimum boyut 2x2 cm olmalı</li>
                    <li>Logo eklerken %30 kuralını uygulayın</li>
                </ul>
            </div>
            
            <div class="help-section">
                <h4>📍 Adres</h4>
                <p>Kavacık Mh. Fatih Sultan Mehmet Cd.</p>
                <p>Tonoğlu Plaza No:3 Kat:4</p>
                <p>Beykoz/İstanbul</p>
            </div>
        </div>
    `);
}

function showModal(title, content) {
    const modalHTML = `
        <div class="modal-overlay active" id="footerModal">
            <div class="modal-container">
                <div class="modal-header">
                    <h2>${title}</h2>
                    <button class="modal-close" onclick="closeModal('footerModal')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    ${content}
                </div>
                <div class="modal-footer">
                    <button onclick="closeModal('footerModal')" class="btn btn-primary">Tamam</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalHTML);
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.remove();
    }
}

// Modal CSS'i ekle (eğer yoksa)
if (!document.querySelector('#modalStyles')) {
    const modalStyles = document.createElement('style');
    modalStyles.id = 'modalStyles';
    modalStyles.textContent = `
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(5px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
        }

        .modal-container {
            background: white;
            border-radius: 20px;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            margin: 2rem;
        }

        .modal-overlay.active .modal-container {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-header h2 {
            margin: 0;
            color: #1a202c;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #718096;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #edf2f7;
            color: #1a202c;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            padding: 1rem 2rem 2rem;
            text-align: right;
        }

        .help-content .help-section {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f7fafc;
            border-radius: 0.75rem;
        }

        .help-content h4 {
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .help-tips {
            background: rgba(16, 185, 129, 0.1);
            padding: 1.5rem;
            border-radius: 0.75rem;
            border-left: 4px solid #10b981;
        }

        .help-tips h4 {
            color: #10b981;
        }

        .help-tips ul {
            margin-top: 1rem;
            padding-left: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border: none;
            border-radius: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
    `;
    
    document.head.appendChild(modalStyles);
}
</script>