<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\contact\index.php
$pageTitle = "İletişim | QR-CODE.COM.TR";
$pageClass = "contact-page";

// Config dosyalarını dahil et
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(__DIR__ . '/../../..'));
}
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/dashboard/qr-code.com.tr');
}

// Header'ı include et
include ROOT_PATH . '/frontend/components/header-new.php';
?>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <h1>📞 İletişim</h1>
            <p>Size nasıl yardımcı olabiliriz? Bizimle iletişime geçin!</p>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="contact-content">
    <div class="container">
        <div class="contact-grid">
            <!-- İletişim Bilgileri -->
            <div class="contact-info">
                <div class="info-header">
                    <h2>🏢 İletişim Bilgileri</h2>
                    <p>Sorularınız için bize ulaşın</p>
                </div>
                
                <div class="info-cards">
                    <!-- Adres -->
                    <div class="info-card">
                        <div class="info-icon address">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <h3>Adresimiz</h3>
                            <p>
                                Kavacık Mh.<br>
                                Fatih Sultan Mehmet Cd.<br>
                                Tonoğlu Plaza No:3 Kat:4<br>
                                <strong>Beykoz/İstanbul</strong>
                            </p>
                            <a href="https://maps.google.com/maps?q=Kavacık+Mh.+Fatih+Sultan+Mehmet+Cd.+Tonoğlu+Plaza+No:3+Kat:4+Beykoz+İstanbul" 
                               target="_blank" class="info-link">
                                <i class="fas fa-external-link-alt"></i>
                                Haritada Görüntüle
                            </a>
                        </div>
                    </div>
                    
                    <!-- Telefon 1 -->
                    <div class="info-card">
                        <div class="info-icon phone">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <h3>Telefon (Mobil)</h3>
                            <p><strong>+90 (532) 226-8040</strong></p>
                            <div class="phone-actions">
                                <a href="tel:+905322268040" class="info-link">
                                    <i class="fas fa-phone"></i>
                                    Ara
                                </a>
                                <a href="https://wa.me/905322268040" target="_blank" class="info-link whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Telefon 2 -->
                    <div class="info-card">
                        <div class="info-icon phone">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <h3>Telefon (Sabit Hat)</h3>
                            <p><strong>+90 (212) 503-3939</strong></p>
                            <div class="phone-actions">
                                <a href="tel:+902125033939" class="info-link">
                                    <i class="fas fa-phone"></i>
                                    Ara
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- E-posta -->
                    <div class="info-card">
                        <div class="info-icon email">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h3>E-posta</h3>
                            <p><strong>info@qr-code.com.tr</strong></p>
                            <a href="mailto:info@qr-code.com.tr" class="info-link">
                                <i class="fas fa-paper-plane"></i>
                                E-posta Gönder
                            </a>
                        </div>
                    </div>
                    
                    <!-- Çalışma Saatleri -->
                    <div class="info-card">
                        <div class="info-icon hours">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-content">
                            <h3>Çalışma Saatleri</h3>
                            <div class="working-hours">
                                <div class="hour-row">
                                    <span>Pazartesi - Cuma</span>
                                    <strong>09:00 - 18:00</strong>
                                </div>
                                <div class="hour-row">
                                    <span>Cumartesi</span>
                                    <strong>10:00 - 16:00</strong>
                                </div>
                                <div class="hour-row closed">
                                    <span>Pazar</span>
                                    <strong>Kapalı</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sosyal Medya -->
                    <div class="info-card">
                        <div class="info-icon social">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <div class="info-content">
                            <h3>Sosyal Medya</h3>
                            <p>Bizi takip edin, haberdar olun!</p>
                            <div class="social-links">
                                <a href="https://wa.me/905322268040" target="_blank" class="social-link whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="#" target="_blank" class="social-link twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" target="_blank" class="social-link facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" target="_blank" class="social-link linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" target="_blank" class="social-link instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- İletişim Formu -->
            <div class="contact-form-section">
                <div class="form-header">
                    <h2>💬 Mesaj Gönder</h2>
                    <p>Sorularınızı bize iletin, en kısa sürede dönüş yapalım</p>
                </div>
                
                <form class="contact-form" id="contactForm" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">Adınız *</label>
                            <input type="text" id="firstName" name="firstName" required 
                                   placeholder="Adınızı girin" autocomplete="given-name">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Soyadınız *</label>
                            <input type="text" id="lastName" name="lastName" required 
                                   placeholder="Soyadınızı girin" autocomplete="family-name">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">E-posta Adresiniz *</label>
                            <input type="email" id="email" name="email" required 
                                   placeholder="email@example.com" autocomplete="email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon Numaranız</label>
                            <input type="tel" id="phone" name="phone" 
                                   placeholder="(5XX) XXX-XXXX" autocomplete="tel">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Konu *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Konu seçin...</option>
                            <option value="genel">Genel Bilgi</option>
                            <option value="teknik">Teknik Destek</option>
                            <option value="ozellik">Özellik Talebi</option>
                            <option value="hata">Hata Bildirimi</option>
                            <option value="isbirligi">İş Birliği</option>
                            <option value="diger">Diğer</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Mesajınız *</label>
                        <textarea id="message" name="message" rows="6" required
                                  placeholder="Mesajınızı buraya yazın... (En az 10 karakter)"></textarea>
                        <div class="char-counter">
                            <span id="charCount">0</span> karakter
                        </div>
                    </div>
                    
                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="privacy" name="privacy" required>
                            <span class="checkmark"></span>
                            <a href="<?php echo SITE_URL; ?>/gizlilik-politikasi" target="_blank">Gizlilik Politikası</a>'nı okudum ve kabul ediyorum. *
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="fas fa-paper-plane"></i>
                        Mesaj Gönder
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Google Maps -->
        <div class="map-section">
            <h2>🗺️ Konum</h2>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3009.814157!2d29.0667!3d41.0833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDHCsDA1JzAwLjAiTiAyOcKwMDQnMDAuMCJF!5e0!3m2!1str!2str!4v1620000000000!5m2!1str!2str" 
                    width="100%" 
                    height="400" 
                    style="border:0; border-radius: 16px;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    title="QR-CODE.COM.TR Ofis Konumu">
                </iframe>
            </div>
        </div>
        
        <!-- SSS Bölümü -->
        <div class="faq-section">
            <h2>❓ Sık Sorulan Sorular</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
                        <h4>QR kod oluşturmak ücretsiz mi?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Evet, QR-CODE.COM.TR'de QR kod oluşturmak tamamen ücretsizdir. Tüm QR türlerini sınırsız olarak oluşturabilirsiniz.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
                        <h4>Oluşturduğum QR kodlar ne kadar süre geçerli?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Statik QR kodlar süresiz geçerlidir. Ancak dinamik QR kodlar için premium üyelik gerekir ve bu kodlar hesap aktif olduğu sürece geçerlidir.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
                        <h4>QR kodlarımı nasıl indirebilirim?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>QR kodunuzu oluşturduktan sonra "PNG İndir" butonuna tıklayarak yüksek kalitede (512x512 piksel) indirebilirsiniz.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
                        <h4>Teknik destek alabilir miyim?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Tabii ki! İletişim formunu kullanarak veya doğrudan bizi arayarak teknik destek alabilirsiniz. Çalışma saatleri içinde hızla yanıt veriyoruz.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
                        <h4>Mobil uygulamanız var mı?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Şu anda web sitesi üzerinden hizmet veriyoruz. Ancak site mobil uyumlu olarak tasarlanmıştır ve tüm cihazlarda mükemmel çalışır.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
                        <h4>Toplu QR kod oluşturabilir miyim?</h4>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Toplu QR kod oluşturma özelliği premium üyelerde mevcuttur. CSV dosyası yükleyerek yüzlerce QR kodu aynı anda oluşturabilirsiniz.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Contact Page Styles */
.contact-page {
    padding-top: 140px; /* Top bar + header height */
}

.contact-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
    position: relative;
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    text-align: center;
    position: relative;
    z-index: 2;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hero-content p {
    font-size: 1.3rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

.contact-content {
    padding: 4rem 0;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    margin-bottom: 4rem;
}

.info-header, .form-header {
    margin-bottom: 2rem;
}

.info-header h2, .form-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.info-header p, .form-header p {
    color: #6b7280;
    font-size: 1.1rem;
}

.info-cards {
    display: grid;
    gap: 2rem;
}

.info-card {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 2px solid #f3f4f6;
    transition: all 0.3s ease;
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
}

.info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #667eea;
}

.info-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.info-icon.address { background: #ef4444; }
.info-icon.phone { background: #10b981; }
.info-icon.email { background: #3b82f6; }
.info-icon.hours { background: #f59e0b; }
.info-icon.social { background: #8b5cf6; }

.info-content h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.75rem;
}

.info-content p {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.info-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid #667eea;
    transition: all 0.3s ease;
    margin-right: 0.75rem;
    margin-top: 0.5rem;
}

.info-link:hover {
    background: #667eea;
    color: white;
    transform: translateY(-1px);
}

.info-link.whatsapp {
    background: #25d366;
    border-color: #25d366;
    color: white;
}

.info-link.whatsapp:hover {
    background: #128c7e;
    border-color: #128c7e;
}

.phone-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.working-hours {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.hour-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 3px solid #10b981;
}

.hour-row.closed {
    border-left-color: #ef4444;
    opacity: 0.7;
}

.hour-row span {
    color: #6b7280;
}

.hour-row strong {
    color: #1a1a1a;
    font-weight: 600;
}

.social-links {
    display: flex;
    gap: 0.75rem;
    margin-top: 1rem;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.social-link:hover {
    transform: scale(1.1);
}

.social-link.whatsapp { background: #25d366; }
.social-link.twitter { background: #1da1f2; }
.social-link.facebook { background: #1877f2; }
.social-link.linkedin { background: #0077b5; }
.social-link.instagram { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }

/* Contact Form */
.contact-form-section {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 2px solid #f3f4f6;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.char-counter {
    font-size: 0.875rem;
    color: #6b7280;
    margin-top: 0.5rem;
    text-align: right;
}

.checkbox-group {
    flex-direction: row;
    align-items: flex-start;
    gap: 0.75rem;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    cursor: pointer;
    font-size: 0.95rem;
    line-height: 1.5;
}

.checkbox-label input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    flex-shrink: 0;
    margin-top: 2px;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
    background: #667eea;
    border-color: #667eea;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    color: white;
    font-weight: bold;
    font-size: 0.8rem;
}

.checkbox-label a {
    color: #667eea;
    text-decoration: none;
}

.checkbox-label a:hover {
    text-decoration: underline;
}

.btn-submit {
    margin-top: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none !important;
}

/* Input Error/Success States */
.form-group input.error,
.form-group select.error,
.form-group textarea.error {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.form-group input.success,
.form-group select.success,
.form-group textarea.success {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.field-error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.field-error::before {
    content: '⚠';
    font-size: 1rem;
}

/* Notification System */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 400px;
    padding: 0;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    animation: slideInRight 0.4s ease-out;
    font-family: inherit;
}

.notification-success {
    background: #10b981;
    color: white;
}

.notification-error {
    background: #ef4444;
    color: white;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
}

.notification-content i {
    font-size: 1.25rem;
    flex-shrink: 0;
}

.notification-content span {
    flex: 1;
    font-weight: 500;
}

.notification-close {
    background: none;
    border: none;
    color: inherit;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.2s ease;
    flex-shrink: 0;
}

.notification-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Map Section */
.map-section {
    margin: 4rem 0;
}

.map-section h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 2rem;
    text-align: center;
}

.map-container {
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border-radius: 16px;
    overflow: hidden;
}

/* FAQ Section */
.faq-section {
    margin: 4rem 0;
}

.faq-section h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 2rem;
    text-align: center;
}

.faq-grid {
    display: grid;
    gap: 1rem;
}

.faq-item {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 2px solid #f3f4f6;
    transition: all 0.3s ease;
}

.faq-item:hover {
    border-color: #667eea;
}

.faq-question {
    padding: 1.5rem;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8fafc;
    transition: all 0.3s ease;
    outline: none;
}

.faq-question:hover {
    background: #e5e7eb;
}

.faq-question:focus {
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
}

.faq-question h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
}

.faq-question i {
    color: #667eea;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.faq-question.active i {
    transform: rotate(180deg);
}

.faq-answer {
    padding: 0 1.5rem;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-answer.active {
    padding: 1.5rem;
    max-height: 200px;
}

.faq-answer p {
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
}

/* Phone Input Formatting */
.form-group input[type="tel"] {
    font-family: 'Courier New', monospace;
    letter-spacing: 0.5px;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Animation Keyframes */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animated {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-page {
        padding-top: 120px;
    }
    
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .info-card {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .phone-actions {
        justify-content: center;
    }
    
    .social-links {
        justify-content: center;
    }
    
    .working-hours {
        align-items: center;
    }
    
    .hour-row {
        max-width: 300px;
    }
    
    .notification {
        top: 10px;
        right: 10px;
        left: 10px;
        max-width: none;
    }
    
    .notification-content {
        padding: 0.875rem 1rem;
        gap: 0.75rem;
    }
    
    .notification-content i {
        font-size: 1.125rem;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 1rem;
    }
    
    .hero-content h1 {
        font-size: 2rem;
    }
    
    .hero-content p {
        font-size: 1.1rem;
    }
    
    .contact-form-section {
        padding: 1.5rem;
    }
    
    .info-card {
        padding: 1.5rem;
    }
    
    .info-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}
</style>

<script>
// İletişim Sayfası JavaScript - İyileştirilmiş Versiyon

// Sayfa yüklendiğinde çalışacak fonksiyonlar
document.addEventListener('DOMContentLoaded', function() {
    initializeContactPage();
});

function initializeContactPage() {
    setupFormValidation();
    setupFAQToggle();
    setupSmoothScroll();
    setupAnimations();
    setupPhoneFormatting();
    setupCharacterCounter();
}

// Form Validasyonu ve Gönderimi
function setupFormValidation() {
    const contactForm = document.getElementById('contactForm');
    if (!contactForm) return;

    contactForm.addEventListener('submit', handleFormSubmit);
    
    // Real-time validation
    const inputs = contactForm.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', clearFieldError);
    });
}

function handleFormSubmit(e) {
    e.preventDefault();
    
    try {
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);
        
        // Validasyon kontrolü
        const validationResult = validateForm(data);
        if (!validationResult.isValid) {
            showError(validationResult.message);
            focusFirstError();
            return;
        }
        
        submitForm(data);
        
    } catch (error) {
        console.error('Form submission error:', error);
        showError('Beklenmeyen bir hata oluştu. Lütfen tekrar deneyin.');
    }
}

function validateForm(data) {
    // Zorunlu alanlar kontrolü
    const requiredFields = {
        'firstName': 'Ad',
        'lastName': 'Soyad',
        'email': 'E-posta',
        'subject': 'Konu',
        'message': 'Mesaj'
    };
    
    for (const [field, label] of Object.entries(requiredFields)) {
        if (!data[field] || data[field].trim() === '') {
            return {
                isValid: false,
                message: `${label} alanı zorunludur!`,
                field: field
            };
        }
    }
    
    // E-posta format kontrolü
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(data.email)) {
        return {
            isValid: false,
            message: 'Geçerli bir e-posta adresi girin!',
            field: 'email'
        };
    }
    
    // Telefon format kontrolü (opsiyonel ama dolu ise)
    if (data.phone && data.phone.trim() !== '') {
        const phoneRegex = /^[\+]?[\d\s\-\(\)]{10,}$/;
        if (!phoneRegex.test(data.phone.replace(/\s/g, ''))) {
            return {
                isValid: false,
                message: 'Geçerli bir telefon numarası girin!',
                field: 'phone'
            };
        }
    }
    
    // Gizlilik politikası kontrolü
    if (!data.privacy) {
        return {
            isValid: false,
            message: 'Gizlilik politikasını kabul etmelisiniz!',
            field: 'privacy'
        };
    }
    
    // Mesaj uzunluk kontrolü
    if (data.message.length < 10) {
        return {
            isValid: false,
            message: 'Mesajınız en az 10 karakter olmalıdır!',
            field: 'message'
        };
    }
    
    // İsim uzunluk kontrolü
    if (data.firstName.length < 2) {
        return {
            isValid: false,
            message: 'Ad en az 2 karakter olmalıdır!',
            field: 'firstName'
        };
    }
    
    if (data.lastName.length < 2) {
        return {
            isValid: false,
            message: 'Soyad en az 2 karakter olmalıdır!',
            field: 'lastName'
        };
    }
    
    return { isValid: true };
}

function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    
    clearFieldError(field);
    
    // Alan bazında validasyon
    switch (field.name) {
        case 'email':
            if (value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                showFieldError(field, 'Geçerli bir e-posta adresi girin');
            } else if (value) {
                showFieldSuccess(field);
            }
            break;
        case 'phone':
            if (value && !/^[\+]?[\d\s\-\(\)]{10,}$/.test(value.replace(/\s/g, ''))) {
                showFieldError(field, 'Geçerli bir telefon numarası girin');
            } else if (value) {
                showFieldSuccess(field);
            }
            break;
        case 'firstName':
        case 'lastName':
            if (value && value.length < 2) {
                showFieldError(field, 'En az 2 karakter olmalıdır');
            } else if (value.length >= 2) {
                showFieldSuccess(field);
            }
            break;
        case 'message':
            if (value && value.length < 10) {
                showFieldError(field, 'En az 10 karakter olmalıdır');
            } else if (value.length >= 10) {
                showFieldSuccess(field);
            }
            break;
    }
}

function showFieldError(field, message) {
    field.classList.remove('success');
    field.classList.add('error');
    
    // Hata mesajını göster
    let errorDiv = field.parentNode.querySelector('.field-error');
    if (!errorDiv) {
        errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        field.parentNode.appendChild(errorDiv);
    }
    errorDiv.textContent = message;
}

function showFieldSuccess(field) {
    field.classList.remove('error');
    field.classList.add('success');
    clearFieldError(field);
}

function clearFieldError(field) {
    if (typeof field === 'object' && field.target) {
        field = field.target;
    }
    
    field.classList.remove('error');
    const errorDiv = field.parentNode.querySelector('.field-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}

function focusFirstError() {
    const firstError = document.querySelector('.form-group input.error, .form-group select.error, .form-group textarea.error');
    if (firstError) {
        firstError.focus();
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function submitForm(data) {
    const submitBtn = document.querySelector('.btn-submit');
    const originalText = submitBtn.innerHTML;
    
    // Loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
    submitBtn.disabled = true;
    
    // Gerçek API çağrısı burada yapılabilir
    // fetch('/api/contact', { 
    //     method: 'POST', 
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
    //     },
    //     body: JSON.stringify(data) 
    // })
    // .then(response => response.json())
    // .then(result => {
    //     if (result.success) {
    //         showSuccess(result.message);
    //         document.getElementById('contactForm').reset();
    //     } else {
    //         showError(result.message);
    //     }
    // })
    // .catch(error => {
    //     showError('Bağlantı hatası oluştu. Lütfen tekrar deneyin.');
    // })
    // .finally(() => {
    //     submitBtn.innerHTML = originalText;
    //     submitBtn.disabled = false;
    // });
    
    // Simülasyon (2 saniye bekleme)
    setTimeout(() => {
        // Başarı durumu
        showSuccess('Mesajınız başarıyla gönderildi! En kısa sürede size dönüş yapacağız.');
        document.getElementById('contactForm').reset();
        updateCharCounter();
        
        // Tüm success/error sınıflarını temizle
        document.querySelectorAll('.form-group input, .form-group select, .form-group textarea').forEach(field => {
            field.classList.remove('success', 'error');
        });
        
        // Button'u eski haline getir
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        // Sayfayı yukarı kaydır
        document.querySelector('.contact-hero').scrollIntoView({ 
            behavior: 'smooth' 
        });
        
    }, 2000);
}

// Telefon numarası formatlama
function setupPhoneFormatting() {
    const phoneInput = document.getElementById('phone');
    if (!phoneInput) return;
    
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        // Türkiye formatı: (5XX) XXX-XXXX
        if (value.startsWith('90')) {
            value = value.substring(2);
        }
        
        if (value.length > 0) {
            if (value.length <= 3) {
                value = `(${value}`;
            } else if (value.length <= 6) {
                value = `(${value.substring(0, 3)}) ${value.substring(3)}`;
            } else if (value.length <= 10) {
                value = `(${value.substring(0, 3)}) ${value.substring(3, 6)}-${value.substring(6)}`;
            } else {
                value = `(${value.substring(0, 3)}) ${value.substring(3, 6)}-${value.substring(6, 10)}`;
            }
        }
        
        e.target.value = value;
    });
}

// Karakter sayacı
function setupCharacterCounter() {
    const messageTextarea = document.getElementById('message');
    const charCounter = document.getElementById('charCount');
    
    if (!messageTextarea || !charCounter) return;
    
    messageTextarea.addEventListener('input', updateCharCounter);
    updateCharCounter();
}

function updateCharCounter() {
    const messageTextarea = document.getElementById('message');
    const charCounter = document.getElementById('charCount');
    
    if (!messageTextarea || !charCounter) return;
    
    const count = messageTextarea.value.length;
    charCounter.textContent = count;
    
    // Renk değişimi
    if (count < 10) {
        charCounter.style.color = '#ef4444';
    } else if (count < 50) {
        charCounter.style.color = '#f59e0b';
    } else {
        charCounter.style.color = '#10b981';
    }
}

// FAQ Toggle Fonksiyonu - İyileştirilmiş
function setupFAQToggle() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            toggleFAQ(this);
        });
        
        // Accessibility için Enter ve Space tuş desteği
        question.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleFAQ(this);
            }
        });
    });
}

function toggleFAQ(element) {
    const answer = element.nextElementSibling;
    const isActive = element.classList.contains('active');
    
    // Tüm FAQ'ları kapat
    document.querySelectorAll('.faq-question').forEach(q => {
        q.classList.remove('active');
        q.setAttribute('aria-expanded', 'false');
        q.nextElementSibling.classList.remove('active');
    });
    
    // Mevcut FAQ'ı toggle et
    if (!isActive) {
        element.classList.add('active');
        element.setAttribute('aria-expanded', 'true');
        answer.classList.add('active');
    }
}

// Smooth Scroll
function setupSmoothScroll() {
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
}

// Animasyonlar
function setupAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                entry.target.classList.add('animated');
            }
        });
    }, observerOptions);

    // Animasyon için elementleri hazırla
    const animatedElements = document.querySelectorAll('.info-card, .faq-item, .contact-form-section');
    animatedElements.forEach(element => {
        if (!element.classList.contains('animated')) {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'all 0.6s ease';
            observer.observe(element);
        }
    });
}

// Yardımcı fonksiyonlar
function showError(message) {
    const notification = createNotification(message, 'error');
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

function showSuccess(message) {
    const notification = createNotification(message, 'success');
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

function createNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
            <button class="notification-close" aria-label="Bildirimi kapat">&times;</button>
        </div>
    `;
    
    // Kapatma butonu
    notification.querySelector('.notification-close').addEventListener('click', () => {
        notification.remove();
    });
    
    // Otomatik kapatma animasyonu
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }, 4700);
    
    return notification;
}

// Global hata yakalama
window.addEventListener('error', function(e) {
    console.error('JavaScript Error:', e.error);
});

// Sayfa unload olduğunda temizlik
window.addEventListener('beforeunload', function() {
    // Aktif notification'ları temizle
    document.querySelectorAll('.notification').forEach(notification => {
        notification.remove();
    });
});

// Export edilecek fonksiyonlar (ihtiyaç halinde)
window.ContactPageFunctions = {
    toggleFAQ,
    validateForm,
    showError,
    showSuccess,
    updateCharCounter
};
</script>

<?php
// BaseURL ve connectionStatus değişkenlerini ayarla
if (!isset($baseURL)) {
    $baseURL = '/dashboard/qr-code.com.tr';
}
if (!isset($connectionStatus)) {
    $connectionStatus = 'demo';
}

// Tek footer dosyasını include et
include ROOT_PATH . '/includes/footer.php';
?>