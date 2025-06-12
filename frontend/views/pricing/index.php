<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\pricing\index.php
$pageTitle = "Fiyatlandırma | QR-CODE.COM.TR";
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
            color: #374151;
            background: #f8fafc;
            overflow-x: hidden;
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
            cursor: pointer;
            text-align: center;
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

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1.1rem;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8rem 0 6rem;
            margin-top: 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/>') repeat;
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .pricing-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            background: rgba(255,255,255,0.2);
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-switch.active {
            background: #fbbf24;
        }

        .toggle-slider {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .toggle-switch.active .toggle-slider {
            transform: translateX(30px);
        }

        .pricing-label {
            font-weight: 600;
            opacity: 0.8;
        }

        .pricing-label.active {
            opacity: 1;
            color: #fbbf24;
        }

        .discount-badge {
            background: #fbbf24;
            color: #1a1a1a;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        /* Pricing Section */
        .pricing-section {
            padding: 6rem 0;
            background: white;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            border: 2px solid transparent;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .pricing-card.popular {
            border-color: #667eea;
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
        }

        .pricing-card.popular:hover {
            transform: scale(1.05) translateY(-10px);
        }

        .popular-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .plan-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem;
            color: white;
        }

        .plan-name {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }

        .plan-price {
            text-align: center;
            margin-bottom: 1rem;
        }

        .price-amount {
            font-size: 3rem;
            font-weight: 800;
            color: #667eea;
        }

        .price-currency {
            font-size: 1.5rem;
            vertical-align: top;
        }

        .price-period {
            font-size: 1rem;
            color: #6b7280;
            font-weight: 400;
        }

        .original-price {
            text-decoration: line-through;
            color: #9ca3af;
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        .plan-description {
            text-align: center;
            color: #6b7280;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .features-list {
            list-style: none;
            margin-bottom: 2rem;
        }

        .features-list li {
            padding: 0.75rem 0;
            position: relative;
            padding-left: 2rem;
            font-size: 0.95rem;
            color: #374151;
        }

        .features-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 0.75rem;
            color: #10b981;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .features-list li.limited:before {
            content: "⚡";
            color: #fbbf24;
        }

        .features-list li.special {
            background: rgba(102, 126, 234, 0.1);
            padding: 0.75rem 1rem 0.75rem 2rem;
            border-radius: 8px;
            margin: 0.5rem 0;
            font-weight: 500;
        }

        .cta-button {
            width: 100%;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .cta-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .cta-secondary {
            background: transparent;
            border-color: #667eea;
            color: #667eea;
        }

        .cta-secondary:hover {
            background: #667eea;
            color: white;
        }

        /* FAQ Section */
        .faq-section {
            padding: 6rem 0;
            background: #f8fafc;
        }

        .faq-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.1rem;
            color: #6b7280;
        }

        .faq-item {
            background: white;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .faq-question {
            padding: 1.5rem;
            cursor: pointer;
            background: #f8fafc;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-question:hover {
            background: #f1f5f9;
        }

        .faq-question.active {
            background: #667eea;
            color: white;
        }

        .faq-icon {
            transition: transform 0.3s ease;
        }

        .faq-question.active .faq-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .faq-answer.active {
            max-height: 200px;
            padding: 1.5rem;
        }

        .faq-answer p {
            color: #6b7280;
            line-height: 1.6;
        }

        /* CTA Section */
        .final-cta {
            padding: 6rem 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
        }

        .final-cta h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .final-cta p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .note {
            text-align: center;
            font-size: 0.9rem;
            color: #6b7280;
            margin-top: 2rem;
            font-style: italic;
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
                font-size: 2.5rem;
            }
            
            .nav {
                display: none;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .pricing-grid {
                grid-template-columns: 1fr;
            }
            
            .pricing-card.popular {
                transform: none;
            }
            
            .pricing-card.popular:hover {
                transform: translateY(-10px);
            }
            
            .pricing-toggle {
                flex-direction: column;
                gap: 0.5rem;
            }
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
                <a href="<?php echo $baseURL; ?>/frontend/views/pricing/">Fiyatlandırma</a>
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
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <h1>💰 Fiyatlandırma</h1>
            <p>Tüm planlarımız reklamsızdır ve müşterilerinize ödün vermeden mümkün olan en iyi deneyimi sunabilmenizi sağlar. Ayrıca indirilebilir tüm formatların ve tasarım seçeneklerinin kullanımı tamamen ücretsizdir.</p>
            
            <div class="pricing-toggle">
                <span class="pricing-label monthly active">Aylık</span>
                <div class="toggle-switch" onclick="togglePricing()">
                    <div class="toggle-slider"></div>
                </div>
                <span class="pricing-label yearly">Yıllık <span class="discount-badge">%20 İndirim</span></span>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="pricing-section">
    <div class="container">
        <div class="pricing-grid">
            <!-- Ücretsiz Plan -->
            <div class="pricing-card">
                <div class="plan-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="plan-name">Ücretsiz</div>
                <div class="plan-price">
                    <div class="price-amount">
                        <span class="price-currency">₺</span>0
                    </div>
                    <div class="price-period">/ ay</div>
                </div>
                <div class="plan-description">Başlamak için mükemmel</div>
                <ul class="features-list">
                    <li>10 Dinamik QR Kod</li>
                    <li class="limited">10.000 Yıllık Tarama</li>
                    <li>Maksimum dosya boyutu: 1MB</li>
                    <li>Reklamsız Deneyim</li>
                    <li>1 Yıl Analitik Geçmişi</li>
                    <li>Maksimum 2 Kullanıcı</li>
                    <li>200 Toplu Üretim</li>
                    <li>Tüm İndirme Formatları</li>
                </ul>
                <a href="<?php echo $baseURL; ?>/kayit" class="cta-button cta-secondary">
                    <i class="fas fa-rocket"></i>
                    Ücretsiz Başla
                </a>
            </div>

            <!-- Başlangıç Planı -->
            <div class="pricing-card">
                <div class="plan-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="plan-name">Başlangıç</div>
                <div class="plan-price">
                    <div class="price-amount monthly-price">
                        <span class="price-currency">₺</span>149
                    </div>
                    <div class="price-amount yearly-price" style="display: none;">
                        <span class="original-price">₺1.788</span>
                        <span class="price-currency">₺</span>1.430
                    </div>
                    <div class="price-period monthly-period">/ ay</div>
                    <div class="price-period yearly-period" style="display: none;">/ yıl</div>
                </div>
                <div class="plan-description">Küçük işletmeler için ideal</div>
                <ul class="features-list">
                    <li>25 Dinamik QR Kod</li>
                    <li>100.000 Yıllık Tarama</li>
                    <li>Maksimum dosya boyutu: 3MB</li>
                    <li>Reklamsız Deneyim</li>
                    <li>1 Yıl Analitik Geçmişi</li>
                    <li>CSV Analitik Export</li>
                    <li>Maksimum 3 Kullanıcı</li>
                    <li>500 Toplu Üretim</li>
                    <li class="special">Logo Ekleme Desteği</li>
                </ul>
                <a href="<?php echo $baseURL; ?>/kayit?plan=starter" class="cta-button cta-primary">
                    <i class="fas fa-crown"></i>
                    Planı Seç
                </a>
            </div>

            <!-- Profesyonel Plan -->
            <div class="pricing-card popular">
                <div class="popular-badge">⭐ En Popüler</div>
                <div class="plan-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <div class="plan-name">Profesyonel</div>
                <div class="plan-price">
                    <div class="price-amount monthly-price">
                        <span class="price-currency">₺</span>349
                    </div>
                    <div class="price-amount yearly-price" style="display: none;">
                        <span class="original-price">₺4.188</span>
                        <span class="price-currency">₺</span>3.350
                    </div>
                    <div class="price-period monthly-period">/ ay</div>
                    <div class="price-period yearly-period" style="display: none;">/ yıl</div>
                </div>
                <div class="plan-description">Büyüyen işletmeler için</div>
                <ul class="features-list">
                    <li>100 Dinamik QR Kod</li>
                    <li>Sınırsız Tarama</li>
                    <li>Maksimum dosya boyutu: 5MB</li>
                    <li>Reklamsız Deneyim</li>
                    <li>Özel Alt Domain</li>
                    <li>2 Yıl Analitik Geçmişi</li>
                    <li>CSV Analitik Export</li>
                    <li>Maksimum 5 Kullanıcı</li>
                    <li>1.000 Toplu Üretim</li>
                    <li class="special">Premium Tasarım Şablonları</li>
                    <li class="special">API Erişimi</li>
                </ul>
                <a href="<?php echo $baseURL; ?>/kayit?plan=professional" class="cta-button cta-primary">
                    <i class="fas fa-bolt"></i>
                    Planı Seç
                </a>
            </div>

            <!-- İşletme Planı -->
            <div class="pricing-card">
                <div class="plan-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="plan-name">İşletme</div>
                <div class="plan-price">
                    <div class="price-amount monthly-price">
                        <span class="price-currency">₺</span>699
                    </div>
                    <div class="price-amount yearly-price" style="display: none;">
                        <span class="original-price">₺8.388</span>
                        <span class="price-currency">₺</span>6.710
                    </div>
                    <div class="price-period monthly-period">/ ay</div>
                    <div class="price-period yearly-period" style="display: none;">/ yıl</div>
                </div>
                <div class="plan-description">Orta ölçekli şirketler için</div>
                <ul class="features-list">
                    <li>250 Dinamik QR Kod</li>
                    <li>Sınırsız Tarama</li>
                    <li>Maksimum dosya boyutu: 10MB</li>
                    <li>Reklamsız Deneyim</li>
                    <li>Özel Alt Domain</li>
                    <li>3 Yıl Analitik Geçmişi</li>
                    <li>CSV Analitik Export</li>
                    <li>Maksimum 10 Kullanıcı</li>
                    <li>3.000 Toplu Üretim</li>
                    <li class="special">Öncelikli Destek</li>
                    <li class="special">Gelişmiş API</li>
                    <li class="special">White Label Çözümü</li>
                </ul>
                <a href="<?php echo $baseURL; ?>/kayit?plan=business" class="cta-button cta-primary">
                    <i class="fas fa-chart-line"></i>
                    Planı Seç
                </a>
            </div>

            <!-- Kurumsal Plan -->
            <div class="pricing-card">
                <div class="plan-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="plan-name">Kurumsal</div>
                <div class="plan-price">
                    <div class="price-amount">
                        Özel Fiyat
                    </div>
                </div>
                <div class="plan-description">Büyük kurumlar için özel çözümler</div>
                <ul class="features-list">
                    <li>Sınırsız QR Kod</li>
                    <li>Sınırsız Tarama</li>
                    <li>Sınırsız Dosya Boyutu</li>
                    <li>Özel Server Desteği</li>
                    <li>Sınırsız Alt Domain</li>
                    <li>Sınırsız Analitik Geçmişi</li>
                    <li>Sınırsız Kullanıcı</li>
                    <li>Sınırsız Toplu Üretim</li>
                    <li class="special">24/7 Premium Destek</li>
                    <li class="special">Özel Entegrasyon</li>
                    <li class="special">SLA Garantisi</li>
                    <li class="special">Özel Eğitim</li>
                </ul>
                <a href="<?php echo $baseURL; ?>/frontend/views/contact/" class="cta-button cta-secondary">
                    <i class="fas fa-envelope"></i>
                    Bize Ulaşın
                </a>
            </div>
        </div>

        <div class="note">
            * Tüm fiyatlar Türk Lirası (₺) cinsindendir ve KDV dahildir. Yıllık planlar %20 indirimli fiyatlandırılmıştır.
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="faq-content">
            <div class="section-header">
                <h2>💡 Fiyatlandırma SSS</h2>
                <p>Planlarımız hakkında merak ettiklerinizi yanıtladık</p>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>🆓 Ücretsiz plan gerçekten ücretsiz mi?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet, ücretsiz planımız tamamen ücretsizdir. Kredi kartı bilgisi gerektirmez ve sınırsız süre kullanabilirsiniz. Hesap oluşturup hemen deneyimleyebilirsiniz.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>📊 Reklam gösteriliyor mu?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Hayır! Tüm planlarımızda reklam bulunmaz. Kullanıcı deneyiminin kaliteli olması bizim için çok önemlidir.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>💳 Ödeme nasıl yapılır?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Güvenli ödeme altyapımızla kredi kartı, banka kartı ve havale ile ödeme yapabilirsiniz. Tüm ödemeler SSL ile şifrelenir.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>🔄 Plan nasıl değiştirebilirim?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Hesap panelinden istediğiniz zaman planınızı yükseltebilir veya düşürebilirsiniz. Fark tutarlar anında hesaplanır.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>❌ İptal edebilir miyim?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Tabii ki! İstediğiniz zaman aboneliğinizi iptal edebilirsiniz. Ödediğiniz süre sonuna kadar tüm özellikler aktif kalır.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>🎓 Eğitim indirimi var mı?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet! Öğrenciler, eğitim kurumları ve kar amacı gütmeyen kuruluşlar için özel indirimlerimiz bulunur. İletişime geçin!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="final-cta">
    <div class="container">
        <h2>🚀 Hemen Başlayın!</h2>
        <p>Hangi planı seçerseniz seçin, profesyonel QR kod çözümlerimizle dijital dünyadaki varlığınızı güçlendirin.</p>
        
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo $baseURL; ?>/kayit" class="btn btn-primary btn-lg">
                <i class="fas fa-rocket"></i>
                Ücretsiz Dene
            </a>
            <a href="<?php echo $baseURL; ?>/frontend/views/contact/" class="btn btn-outline btn-lg" style="background: rgba(255,255,255,0.1); border-color: white; color: white;">
                <i class="fas fa-phone"></i>
                Bize Ulaşın
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
                    <li><a href="<?php echo $baseURL; ?>/frontend/views/pricing/">Fiyatlandırma</a></li>
                    <li><a href="<?php echo $baseURL; ?>/frontend/views/sss/">SSS</a></li>
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
// Aylık/Yıllık toggle sistemi
function togglePricing() {
    const toggle = document.querySelector('.toggle-switch');
    const monthlyLabels = document.querySelectorAll('.pricing-label.monthly');
    const yearlyLabels = document.querySelectorAll('.pricing-label.yearly');
    const monthlyPrices = document.querySelectorAll('.monthly-price');
    const yearlyPrices = document.querySelectorAll('.yearly-price');
    const monthlyPeriods = document.querySelectorAll('.monthly-period');
    const yearlyPeriods = document.querySelectorAll('.yearly-period');
    
    toggle.classList.toggle('active');
    
    if (toggle.classList.contains('active')) {
        // Yıllık göster
        monthlyLabels.forEach(label => label.classList.remove('active'));
        yearlyLabels.forEach(label => label.classList.add('active'));
        monthlyPrices.forEach(price => price.style.display = 'none');
        yearlyPrices.forEach(price => price.style.display = 'block');
        monthlyPeriods.forEach(period => period.style.display = 'none');
        yearlyPeriods.forEach(period => period.style.display = 'block');
    } else {
        // Aylık göster
        monthlyLabels.forEach(label => label.classList.add('active'));
        yearlyLabels.forEach(label => label.classList.remove('active'));
        monthlyPrices.forEach(price => price.style.display = 'block');
        yearlyPrices.forEach(price => price.style.display = 'none');
        monthlyPeriods.forEach(period => period.style.display = 'block');
        yearlyPeriods.forEach(period => period.style.display = 'none');
    }
}

// FAQ toggle sistemi
document.addEventListener('DOMContentLoaded', function() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.parentElement.querySelector('.faq-answer');
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
            } else {
                this.classList.add('active');
                answer.classList.add('active');
            }
        });
    });
});

// Card hover efektleri
document.querySelectorAll('.pricing-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        if (!this.classList.contains('popular')) {
            this.style.transform = 'translateY(-10px)';
        }
    });
    
    card.addEventListener('mouseleave', function() {
        if (!this.classList.contains('popular')) {
            this.style.transform = '';
        }
    });
});

// CTA button animasyonları
document.querySelectorAll('.cta-button').forEach(button => {
    button.addEventListener('click', function() {
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
    });
});
</script>

</body>
</html>