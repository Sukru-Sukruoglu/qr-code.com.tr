<?php
$pageTitle = "Sık Sorulan Sorular | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            background: #f8fafc;
            color: #374151;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }

        .logo i {
            font-size: 2rem;
        }

        .nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav a {
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav a:hover {
            color: #667eea;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: #667eea;
            border-color: #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8rem 0 4rem;
            margin-top: 80px;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* FAQ Section */
        .faq-section {
            padding: 4rem 0;
            background: white;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .faq-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            cursor: pointer;
            font-weight: 600;
            background: #f8fafc;
            transition: all 0.3s ease;
            user-select: none;
        }

        .faq-question:hover {
            background: #f1f5f9;
        }

        .faq-question.active {
            background: #667eea;
            color: white;
        }

        .faq-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
            color: #667eea;
        }

        .faq-question.active .faq-icon {
            transform: rotate(180deg);
            color: white;
        }

        .faq-answer {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            background: white;
        }

        .faq-answer.active {
            max-height: 500px;
            padding: 1.5rem;
        }

        .faq-answer p {
            line-height: 1.7;
            color: #6b7280;
            font-size: 0.95rem;
            margin: 0;
        }

        /* Categories */
        .faq-categories {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .category-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 25px;
            background: white;
            color: #6b7280;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .category-btn.active {
            border-color: #667eea;
            background: #667eea;
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .category-btn:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-1px);
        }

        .category-btn.active:hover {
            color: white;
        }

        /* Contact CTA */
        .contact-cta {
            background: #f8fafc;
            padding: 3rem 0;
            text-align: center;
        }

        .contact-cta h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }

        .contact-cta p {
            margin-bottom: 2rem;
            color: #6b7280;
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #667eea;
        }

        .footer-section p {
            opacity: 0.8;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #667eea;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 2rem;
            text-align: center;
            opacity: 0.8;
        }

        /* Mobile Responsive */
        .mobile-menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #374151;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .nav {
                display: none;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .faq-categories {
                flex-direction: column;
                align-items: center;
            }
            
            .category-btn {
                width: 200px;
                text-align: center;
            }
            
            .faq-question {
                padding: 1rem;
                font-size: 0.95rem;
            }
            
            .faq-answer.active {
                padding: 1rem;
            }
        }

        /* Debug Styling */
        .debug {
            background: #ff0000 !important;
            color: white !important;
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <a href="<?php echo $baseURL; ?>/frontend/views/home/" class="logo">
                <i class="fas fa-qrcode"></i>
                <span>QR-CODE.COM.TR</span>
            </a>
            
            <nav class="nav">
                <a href="<?php echo $baseURL; ?>/frontend/views/home/">Ana Sayfa</a>
                <a href="<?php echo $baseURL; ?>/frontend/views/home/#ozellikler">Özellikler</a>
                <a href="<?php echo $baseURL; ?>/frontend/views/sss/">SSS</a>
                <a href="<?php echo $baseURL; ?>/frontend/views/contact/" class="btn btn-outline">İletişim</a>
                <a href="<?php echo $baseURL; ?>/giris" class="btn btn-outline">Giriş Yap</a>
                <a href="<?php echo $baseURL; ?>/kayit" class="btn btn-primary">Kayıt Ol</a>
            </nav>

            <div class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>❓ Sık Sorulan Sorular</h1>
        <p>QR kod oluşturma ve kullanımıyla ilgili merak ettiğiniz her şey burada. Sorunuza cevap bulamadığınız takdirde bizimle iletişime geçebilirsiniz.</p>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="faq-container">
            <!-- Kategori Filtreleri -->
            <div class="faq-categories">
                <button class="category-btn active" data-category="all">🔍 Tümü</button>
                <button class="category-btn" data-category="general">📋 Genel</button>
                <button class="category-btn" data-category="usage">⚙️ Kullanım</button>
                <button class="category-btn" data-category="technical">🔧 Teknik</button>
                <button class="category-btn" data-category="pricing">💰 Fiyatlandırma</button>
            </div>

            <!-- FAQ İçeriği -->
            <div class="faq-list">
                <!-- Test FAQ -->
                <div class="faq-item" data-category="general">
                    <div class="faq-question">
                        <span>🚀 TEST - Bu tıklanabilir mi?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Bu bir test sorusudur. Eğer bu açılıyorsa JavaScript çalışıyor demektir!</p>
                    </div>
                </div>

                <!-- Genel Sorular -->
                <div class="faq-item" data-category="general">
                    <div class="faq-question">
                        <span>🤔 QR kod nedir ve nasıl çalışır?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>QR kod (Quick Response Code), iki boyutlu bir barkod türüdür. Metin, URL, telefon numarası, e-posta adresi gibi çeşitli veri türlerini saklayabilir. Akıllı telefon kamerasıyla taranarak içindeki bilgilere hızlıca erişim sağlanır.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="general">
                    <div class="faq-question">
                        <span>💰 QR kod oluşturmak ücretsiz mi?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Evet! Temel QR kod oluşturma işlemi tamamen ücretsizdir. Statik QR kodları sınırsız olarak oluşturabilir ve kullanabilirsiniz. Premium özellikler için uygun fiyatlı planlarımız mevcuttur.</p>
                    </div>
                </div>

                <!-- Kullanım Sorları -->
                <div class="faq-item" data-category="usage">
                    <div class="faq-question">
                        <span>📱 Hangi QR kod türlerini oluşturabilirim?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Platformumuzda 21 farklı QR kod türü oluşturabilirsiniz: URL, Wi-Fi, vCard (dijital kartvizit), WhatsApp, E-posta, SMS, Telefon, Metin, PDF, Müzik, Video, Instagram, Facebook, LinkedIn, YouTube, TikTok, Konum, Etkinlik, Menü ve daha fazlası.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="usage">
                    <div class="faq-question">
                        <span>🎨 QR kodumu nasıl özelleştirebilirim?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>QR kodlarınızı renklendirip, logo ekleyip, farklı tasarım stilleri uygulayabilirsiniz. Markanıza uygun özel QR kodlar oluşturarak profesyonel bir görünüm elde edebilirsiniz.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="usage">
                    <div class="faq-question">
                        <span>📶 Wi-Fi QR kodu nasıl çalışır?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Wi-Fi QR kodu oluştururken ağ adı, şifre ve güvenlik türünü girin. QR kodu tarayan kişiler şifre yazmadan otomatik olarak Wi-Fi ağınıza bağlanır. Misafirlerin kolayca internete erişmesi için idealdir.</p>
                    </div>
                </div>

                <!-- Teknik Sorular -->
                <div class="faq-item" data-category="technical">
                    <div class="faq-question">
                        <span>⏰ QR kodlarım ne kadar süre çalışır?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Statik QR kodlar sonsuz süre çalışır ve hiçbir zaman süreleri dolmaz. Dinamik QR kodlar ise hesap durumunuza bağlı olarak çalışır. Premium hesaplarda dinamik QR kodlar aktif kalır.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="technical">
                    <div class="faq-question">
                        <span>📏 QR kodun boyutu nasıl belirlenmeli?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>QR kod boyutu kullanım amacına göre değişir. Kartvizitler için minimum 2x2 cm, posterler için 5x5 cm ve üzeri önerilir. Genel kural: okuma mesafesinin 10'da biri kadar boyut yeterlidir.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="technical">
                    <div class="faq-question">
                        <span>💾 QR kod hangi formatlarda indirilebilir?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>QR kodlarınızı PNG, JPG, SVG ve PDF formatlarında indirebilirsiniz. Yazdırma için PNG veya PDF, web kullanımı için PNG veya SVG formatları önerilir.</p>
                    </div>
                </div>

                <!-- Fiyatlandırma Sorları -->
                <div class="faq-item" data-category="pricing">
                    <div class="faq-question">
                        <span>⭐ Premium özellikler nelerdir?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Premium özellikler: Dinamik QR kodlar, detaylı analitikler, logo ekleme, özel tasarımlar, toplu QR oluşturma, API erişimi, öncelikli destek ve reklamsız deneyim içerir.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="pricing">
                    <div class="faq-question">
                        <span>🆓 Ücretsiz hesapta kaç QR kod oluşturabilirim?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Ücretsiz hesaplarda sınırsız statik QR kod oluşturabilirsiniz. Dinamik QR kodlar için premium hesap gereklidir. Hiçbir gizli ücret yoktur.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="technical">
                    <div class="faq-question">
                        <span>🔒 QR kod güvenli midir?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>QR kodlar kendileri güvenlidir, ancak yönlendirdikleri içerik güvenlik riski oluşturabilir. Güvenilmeyen kaynaklardan gelen QR kodları taramadan önce dikkatli olun. Platformumuz güvenli URL kontrolü yapar.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="usage">
                    <div class="faq-question">
                        <span>👤 vCard QR kodu nedir?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>vCard QR kodu dijital kartvizittir. İsim, telefon, e-posta, adres, şirket bilgileri ve sosyal medya linklerinizi içerir. Tarandığında kişi bilgileriniz direkt telefon rehberine kaydedilir.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="technical">
                    <div class="faq-question">
                        <span>⚠️ QR kod neden çalışmıyor?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>QR kod okuma sorunları genellikle şu nedenlerdendir: Kötü aydınlatma, bulanık görüntü, QR kodun çok küçük olması, hasarlı QR kod veya eski telefon kamerası. QR kod okuyucu uygulaması kullanmayı deneyin.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="general">
                    <div class="faq-question">
                        <span>📊 QR kod analitikleri nasıl çalışır?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Dinamik QR kodlarında tarama sayıları, tarih/saat bilgisi, konum verileri ve cihaz bilgilerini takip edebilirsiniz. Bu veriler marketing kampanyalarınızın başarısını ölçmenize yardımcı olur.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="contact-cta">
    <div class="container">
        <h3>🤔 Sorunuza cevap bulamadınız mı?</h3>
        <p>Teknik destek ekibimiz size yardımcı olmak için burada! 7/24 destek alabilirsiniz.</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo $baseURL; ?>/frontend/views/contact/" class="btn btn-primary">
                <i class="fas fa-envelope"></i>
                İletişime Geç
            </a>
            <a href="https://wa.me/905322268040" class="btn btn-outline" target="_blank">
                <i class="fab fa-whatsapp"></i>
                WhatsApp Destek
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h4>QR-CODE.COM.TR</h4>
                <p>Türkiye'nin en gelişmiş QR kod oluşturucu platformu. Hızlı, güvenli ve profesyonel çözümler.</p>
            </div>
            
            <div class="footer-section">
                <h4>Hızlı Bağlantılar</h4>
                <ul>
                    <li><a href="<?php echo $baseURL; ?>/frontend/views/home/">Ana Sayfa</a></li>
                    <li><a href="<?php echo $baseURL; ?>/qr-olustur">QR Kod Oluştur</a></li>
                    <li><a href="<?php echo $baseURL; ?>/frontend/views/sss/">SSS</a></li>
                    <li><a href="<?php echo $baseURL; ?>/frontend/views/contact/">İletişim</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Destek</h4>
                <ul>
                    <li><a href="<?php echo $baseURL; ?>/yardim">Yardım Merkezi</a></li>
                    <li><a href="<?php echo $baseURL; ?>/api-dokumantasyon">API Belgeleri</a></li>
                    <li><a href="mailto:info@qr-code.com.tr">E-posta Destek</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>İletişim</h4>
                <ul>
                    <li>📧 info@qr-code.com.tr</li>
                    <li>📞 +90 (532) 226-8040</li>
                    <li>📍 İstanbul, Türkiye</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024 QR-CODE.COM.TR. Tüm hakları saklıdır.</p>
        </div>
    </div>
</footer>

<script>
console.log('JavaScript yüklendi!');

// Sayfa yüklendiğinde çalışacak ana fonksiyon
document.addEventListener('DOMContentLoaded', function() {
    console.log('Sayfa tamamen yüklendi');
    
    // FAQ toggle sistemi
    setupFAQToggle();
    
    // Kategori filtreleme sistemi
    setupCategoryFilter();
});

// FAQ toggle sistemini kurma
function setupFAQToggle() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    console.log('FAQ soru sayısı:', faqQuestions.length);
    
    faqQuestions.forEach((question, index) => {
        question.addEventListener('click', function(e) {
            e.preventDefault();
            console.log(`FAQ ${index + 1} tıklandı:`, this.textContent.trim());
            
            const faqItem = this.parentElement;
            const answer = faqItem.querySelector('.faq-answer');
            const isActive = this.classList.contains('active');
            
            // Diğer açık FAQ'ları kapat
            document.querySelectorAll('.faq-question.active').forEach(q => {
                if (q !== this) {
                    q.classList.remove('active');
                    q.parentElement.querySelector('.faq-answer').classList.remove('active');
                }
            });
            
            // Bu FAQ'yı aç/kapat
            if (isActive) {
                this.classList.remove('active');
                answer.classList.remove('active');
                console.log('FAQ kapatıldı');
            } else {
                this.classList.add('active');
                answer.classList.add('active');
                console.log('FAQ açıldı');
            }
        });
        
        // Hover efekti için debug
        question.addEventListener('mouseenter', function() {
            console.log('FAQ hover:', this.textContent.trim());
        });
    });
}

// Kategori filtreleme sistemini kurma
function setupCategoryFilter() {
    const categoryBtns = document.querySelectorAll('.category-btn');
    console.log('Kategori buton sayısı:', categoryBtns.length);
    
    categoryBtns.forEach((btn) => {
        btn.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            console.log('Kategori seçildi:', category);
            
            // Aktif buton değiştir
            categoryBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // FAQ'ları filtrele
            filterFAQItems(category);
        });
    });
}

// FAQ öğelerini filtreleme
function filterFAQItems(category) {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        
        if (category === 'all' || itemCategory === category) {
            item.style.display = 'block';
            item.style.opacity = '1';
        } else {
            item.style.display = 'none';
            // Gizlenen öğelerdeki açık cevapları kapat
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            question.classList.remove('active');
            answer.classList.remove('active');
        }
    });
    
    console.log(`Filtreleme tamamlandı: ${category}`);
}

// Test fonksiyonu - konsola yazdır
function testClick() {
    console.log('Test tıklama çalıştı!');
    alert('JavaScript çalışıyor!');
}

console.log('Tüm JavaScript fonksiyonları yüklendi');
</script>

</body>
</html>