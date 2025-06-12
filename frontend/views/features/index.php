<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\features\index.php
// Session kontrolü - güvenli session başlatma
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Özellikler | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';

// Kullanıcı girişi kontrolü
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #667eea;
            --primary-dark: #764ba2;
            --success-color: #10b981;
            --text-primary: #1a202c;
            --text-muted: #718096;
            --bg-primary: #ffffff;
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --radius-xl: 1rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(315deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Header Navigation Styles */
        .header-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(102, 126, 234, 0.1);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            text-decoration: none;
        }

        .logo i {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 0.75rem;
            border-radius: 12px;
            font-size: 1.5rem;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav a:hover {
            color: var(--primary-color);
            background: rgba(102, 126, 234, 0.1);
        }

        .nav a.active {
            color: var(--primary-color);
            background: rgba(102, 126, 234, 0.15);
            font-weight: 600;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-primary);
            cursor: pointer;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .page-header {
            text-align: center;
            margin-bottom: 4rem;
            padding: 3rem 0;
        }

        .page-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header p {
            font-size: 1.2rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .feature-card p {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .feature-list {
            list-style: none;
            margin-top: 1.5rem;
            text-align: left;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            color: var(--text-muted);
        }

        .feature-list li i {
            color: var(--success-color);
            font-size: 1.1rem;
        }

        .cta-section {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 4rem;
            text-align: center;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .cta-section p {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.25rem 3rem;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            text-decoration: none;
            border-radius: var(--radius-xl);
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 768px) {
            .nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 1rem 2rem;
                border-top: 1px solid rgba(102, 126, 234, 0.1);
            }

            .nav.mobile-open {
                display: flex;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .nav-container {
                padding: 0 1rem;
            }

            .page-header h1 {
                font-size: 2.5rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .feature-card {
                padding: 2rem;
            }
            
            .cta-section {
                padding: 3rem 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Header -->
    <nav class="header-nav">
        <div class="nav-container">
            <a href="<?php echo $baseURL; ?>/" class="logo">
                <i class="fas fa-qrcode"></i>
                <span>QR-CODE.COM.TR</span>
            </a>

            <div class="nav" id="navbarNav">
                <a href="<?php echo $baseURL; ?>/">Ana Sayfa</a>
                <a href="<?php echo $baseURL; ?>/frontend/views/features" class="active">Özellikler</a>
                <a href="<?php echo $baseURL; ?>/frontend/views/how-to-use">Nasıl Kullanılır</a>
                <a href="<?php echo $baseURL; ?>/frontend/views/about">Hakkımızda</a>
                <a href="<?php echo $baseURL; ?>/frontend/views/contact">İletişim</a>
                <?php if ($isLoggedIn): ?>
                    <a href="<?php echo $baseURL; ?>/dashboard" class="btn btn-primary">Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo $baseURL; ?>/giris" class="btn btn-outline">Giriş Yap</a>
                    <a href="<?php echo $baseURL; ?>/kayit" class="btn btn-primary">Kayıt Ol</a>
                <?php endif; ?>
            </div>

            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <a href="<?php echo $baseURL; ?>/">
                <i class="fas fa-home"></i> Ana Sayfa
            </a>
            <i class="fas fa-chevron-right"></i>
            <span>Özellikler</span>
        </nav>

        <div class="page-header">
            <h1><i class="fas fa-star"></i> Özellikler</h1>
            <p>QR-CODE.COM.TR'nin sunduğu güçlü özellikler ile QR kod deneyiminizi bir üst seviyeye taşıyın</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-qrcode"></i>
                </div>
                <h3>Kolay QR Kod Oluşturma</h3>
                <p>Birkaç tıkla profesyonel QR kodlar oluşturun. URL, metin, telefon, e-posta ve daha fazlası için destek.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Çoklu format desteği</li>
                    <li><i class="fas fa-check"></i> Anında önizleme</li>
                    <li><i class="fas fa-check"></i> Yüksek çözünürlük</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Detaylı Analitikler</h3>
                <p>QR kodlarınızın performansını takip edin. Tarama sayısı, konum, cihaz türü ve daha fazlası.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Gerçek zamanlı istatistikler</li>
                    <li><i class="fas fa-check"></i> Coğrafi analiz</li>
                    <li><i class="fas fa-check"></i> Cihaz analizi</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h3>Özelleştirilebilir Tasarım</h3>
                <p>QR kodlarınızı markanıza uygun renkler ve logolarla özelleştirin.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Renk seçenekleri</li>
                    <li><i class="fas fa-check"></i> Logo ekleme</li>
                    <li><i class="fas fa-check"></i> Çerçeve stilleri</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-cloud-download-alt"></i>
                </div>
                <h3>Çoklu İndirme Formatları</h3>
                <p>QR kodlarınızı PNG, JPG, SVG ve PDF formatlarında indirin.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Vektör formatları</li>
                    <li><i class="fas fa-check"></i> Yüksek çözünürlük</li>
                    <li><i class="fas fa-check"></i> Baskı uyumlu</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Güvenli ve Hızlı</h3>
                <p>Verileriniz güvenli sunucularda saklanır ve QR kodlarınız hızla yüklenir.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> SSL şifreleme</li>
                    <li><i class="fas fa-check"></i> Hızlı CDN</li>
                    <li><i class="fas fa-check"></i> Yedekleme sistemi</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Mobil Uyumlu</h3>
                <p>Tüm cihazlardan erişilebilir, responsive tasarım ile her yerden kullanın.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Responsive design</li>
                    <li><i class="fas fa-check"></i> Touch optimizasyonu</li>
                    <li><i class="fas fa-check"></i> Offline çalışma</li>
                </ul>
            </div>
        </div>

        <div class="cta-section">
            <h2>Hemen Başlayın!</h2>
            <p>Bu güçlü özelliklerle QR kod projelerinizi hayata geçirin</p>
            <a href="<?php echo $baseURL; ?>/qr-olustur" class="cta-btn">
                <i class="fas fa-plus"></i> İlk QR Kodunuzu Oluşturun
            </a>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const nav = document.getElementById('navbarNav');
            nav.classList.toggle('mobile-open');
        }

        // Scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Animate feature cards
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });
        });
    </script>

    <?php 
    // BaseURL ve connectionStatus tanımla
    if (!isset($baseURL)) {
        $baseURL = '/dashboard/qr-code.com.tr';
    }
    if (!isset($connectionStatus)) {
        $connectionStatus = 'demo';
    }
    
    // Footer'ı dahil et
    include_once __DIR__ . '/../../../includes/footer.php'; 
    ?>

</body>
</html>