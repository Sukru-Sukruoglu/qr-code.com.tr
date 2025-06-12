<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\components\footer-new.php
?>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <!-- Footer Logo & Info -->
            <div class="footer-section">
                <div class="footer-logo">
                    <div class="logo-icon">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">QR-CODE</span>
                        <span class="logo-sub">.COM.TR</span>
                    </div>
                </div>
                <p class="footer-description">
                    Türkiye'nin en gelişmiş QR kod oluşturucu platformu. 
                    Ücretsiz, hızlı ve güvenli QR kod çözümleri.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
            
            <!-- QR Types -->
            <div class="footer-section">
                <h4>QR Kod Türleri</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo SITE_URL; ?>/qr/url">URL QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/wifi">WiFi QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/vcard">vCard QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/whatsapp">WhatsApp QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/email">E-posta QR Kodu</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/qr/text">Metin QR Kodu</a></li>
                </ul>
            </div>
            
            <!-- Company -->
            <div class="footer-section">
                <h4>Şirket</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo SITE_URL; ?>/hakkimizda">Hakkımızda</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/iletisim">İletişim</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/gizlilik">Gizlilik Politikası</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/kullanim-sartlari">Kullanım Şartları</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/sss">Sık Sorulan Sorular</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/api">API Dokümantasyonu</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div class="footer-section">
                <h4>İletişim</h4>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kavacık Mh. Fatih Sultan Mehmet Cd. Tonoğlu Plaza No:3 Kat:4<br>Beykoz/İstanbul</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+90 (532) 226-8040</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@qr-code.com.tr</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span>Pazartesi - Cuma: 09:00 - 18:00</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; 2024 QR-CODE.COM.TR - Tüm hakları saklıdır.</p>
                <div class="footer-bottom-links">
                    <a href="<?php echo SITE_URL; ?>/gizlilik">Gizlilik</a>
                    <a href="<?php echo SITE_URL; ?>/kullanim-sartlari">Şartlar</a>
                    <a href="<?php echo SITE_URL; ?>/cerez-politikasi">Çerezler</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Footer Styles */
.footer {
    background: #1a1a1a;
    color: #e5e7eb;
    margin-top: 4rem;
}

.footer-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    padding: 3rem 0;
}

.footer-section h4 {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.footer-logo .logo-main {
    color: white;
}

.footer-description {
    color: #9ca3af;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 40px;
    height: 40px;
    background: #374151;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e5e7eb;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: #9ca3af;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #667eea;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    color: #9ca3af;
}

.contact-item i {
    color: #667eea;
    margin-top: 0.25rem;
    flex-shrink: 0;
}

.footer-bottom {
    border-top: 1px solid #374151;
    padding: 2rem 0;
}

.footer-bottom-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #9ca3af;
    font-size: 0.9rem;
}

.footer-bottom-links {
    display: flex;
    gap: 2rem;
}

.footer-bottom-links a {
    color: #9ca3af;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #667eea;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .footer-bottom-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}
</style>

<script>
function toggleMobileMenu() {
    const nav = document.querySelector('.nav');
    nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
}
</script>

</body>
</html>