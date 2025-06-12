<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\how-to-use\index.php
// Session kontrolü
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Nasıl Kullanılır | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';
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
    <!-- CSS buraya gelecek -->
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-qrcode"></i>
                    <span>QR-CODE.COM.TR</span>
                </div>
                
                <nav class="nav">
                    <a href="<?php echo $baseURL; ?>/">Ana Sayfa</a>
                    <a href="<?php echo $baseURL; ?>/frontend/views/features">Özellikler</a>
                    <a href="<?php echo $baseURL; ?>/frontend/views/how-to-use" class="active">Nasıl Kullanılır</a>
                    <a href="<?php echo $baseURL; ?>/frontend/views/about">Hakkımızda</a>
                    <a href="<?php echo $baseURL; ?>/frontend/views/contact">İletişim</a>
                    <?php if ($isLoggedIn): ?>
                        <a href="<?php echo $baseURL; ?>/dashboard" class="btn btn-primary">Dashboard</a>
                    <?php else: ?>
                        <a href="<?php echo $baseURL; ?>/giris" class="btn btn-outline">Giriş Yap</a>
                        <a href="<?php echo $baseURL; ?>/kayit" class="btn btn-primary">Kayıt Ol</a>
                    <?php endif; ?>
                </nav>

                <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </header>

    <?php
session_start();
$pageTitle = "Nasıl Kullanılır | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';
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

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 4rem;
            padding: 3rem 0;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .step-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255,255,255,0.2);
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateX(10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .step-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .step-content p {
            color: var(--text-muted);
            margin-bottom: 1rem;
        }

        .step-list {
            list-style: none;
            margin-top: 1rem;
        }

        .step-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
        }

        .step-list li i {
            color: var(--success-color);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            text-decoration: none;
            border-radius: var(--radius-xl);
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .tips-section {
            background: rgba(16, 185, 129, 0.1);
            border-radius: 24px;
            padding: 3rem;
            margin-top: 3rem;
            border: 2px solid rgba(16, 185, 129, 0.2);
        }

        .tips-section h3 {
            color: var(--success-color);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        @media (max-width: 768px) {
            .step-card {
                flex-direction: column;
                text-align: center;
            }
            
            .header h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?php echo $baseURL; ?>/dashboard" class="back-btn">
            <i class="fas fa-arrow-left"></i> Dashboard'a Dön
        </a>

        <div class="header">
            <h1><i class="fas fa-question-circle"></i> Nasıl Kullanılır</h1>
            <p>QR-CODE.COM.TR'yi kullanarak QR kod oluşturma rehberi</p>
        </div>

        <div class="step-card">
            <div class="step-number">1</div>
            <div class="step-content">
                <h3>Hesap Oluşturun</h3>
                <p>İlk olarak ücretsiz hesabınızı oluşturun ve platformumuza giriş yapın.</p>
                <ul class="step-list">
                    <li><i class="fas fa-check"></i> E-posta ile kayıt olun</li>
                    <li><i class="fas fa-check"></i> E-posta adresinizi doğrulayın</li>
                    <li><i class="fas fa-check"></i> Dashboard'a erişim kazanın</li>
                </ul>
            </div>
        </div>

        <div class="step-card">
            <div class="step-number">2</div>
            <div class="step-content">
                <h3>QR Kod Türünü Seçin</h3>
                <p>Hangi türde QR kod oluşturmak istediğinizi belirleyin.</p>
                <ul class="step-list">
                    <li><i class="fas fa-check"></i> URL/Website linki</li>
                    <li><i class="fas fa-check"></i> Metin mesajı</li>
                    <li><i class="fas fa-check"></i> Telefon numarası</li>
                    <li><i class="fas fa-check"></i> E-posta adresi</li>
                    <li><i class="fas fa-check"></i> WiFi bilgileri</li>
                </ul>
            </div>
        </div>

        <div class="step-card">
            <div class="step-number">3</div>
            <div class="step-content">
                <h3>İçeriği Girin</h3>
                <p>QR kodunuzun içeriğini girin ve gerekli bilgileri doldurun.</p>
                <ul class="step-list">
                    <li><i class="fas fa-check"></i> İçerik bilgilerini girin</li>
                    <li><i class="fas fa-check"></i> QR kodunuza başlık verin</li>
                    <li><i class="fas fa-check"></i> Açıklama ekleyin (opsiyonel)</li>
                </ul>
            </div>
        </div>

        <div class="step-card">
            <div class="step-number">4</div>
            <div class="step-content">
                <h3>Tasarımı Özelleştirin</h3>
                <p>QR kodunuzun görünümünü markanıza uygun şekilde özelleştirin.</p>
                <ul class="step-list">
                    <li><i class="fas fa-check"></i> Renkleri seçin</li>
                    <li><i class="fas fa-check"></i> Logo ekleyin</li>
                    <li><i class="fas fa-check"></i> Çerçeve stili seçin</li>
                    <li><i class="fas fa-check"></i> Boyutu ayarlayın</li>
                </ul>
            </div>
        </div>

        <div class="step-card">
            <div class="step-number">5</div>
            <div class="step-content">
                <h3>İndirin ve Kullanın</h3>
                <p>QR kodunuzu istediğiniz formatta indirin ve kullanmaya başlayın.</p>
                <ul class="step-list">
                    <li><i class="fas fa-check"></i> Format seçin (PNG, JPG, SVG, PDF)</li>
                    <li><i class="fas fa-check"></i> Kaliteyi belirleyin</li>
                    <li><i class="fas fa-check"></i> İndirin ve paylaşın</li>
                </ul>
            </div>
        </div>

        <div class="step-card">
            <div class="step-number">6</div>
            <div class="step-content">
                <h3>Analitikleri Takip Edin</h3>
                <p>QR kodunuzun performansını analytics panelinden takip edin.</p>
                <ul class="step-list">
                    <li><i class="fas fa-check"></i> Tarama sayılarını görün</li>
                    <li><i class="fas fa-check"></i> Konum analizlerini inceleyin</li>
                    <li><i class="fas fa-check"></i> Cihaz türlerini kontrol edin</li>
                    <li><i class="fas fa-check"></i> Zaman dilimi raporları alın</li>
                </ul>
            </div>
        </div>

        <div class="tips-section">
            <h3><i class="fas fa-lightbulb"></i> İpuçları ve Öneriler</h3>
            <ul class="step-list">
                <li><i class="fas fa-star"></i> <strong>Kontrast:</strong> QR kod ile arka plan arasında yeterli kontrast olmasına dikkat edin</li>
                <li><i class="fas fa-star"></i> <strong>Boyut:</strong> Basılı materyaller için en az 2x2 cm boyut kullanın</li>
                <li><i class="fas fa-star"></i> <strong>Test:</strong> QR kodunuzu yazdırmadan önce farklı cihazlarda test edin</li>
                <li><i class="fas fa-star"></i> <strong>Logo:</strong> Logo eklerken QR kodun %30'undan fazlasını kaplamayın</li>
                <li><i class="fas fa-star"></i> <strong>Açıklama:</strong> QR kodun yanına ne yaptığını açıklayan metin ekleyin</li>
            </ul>
        </div>
    </div>
</body>
</html>

    <script>
        function toggleMobileMenu() {
            const nav = document.querySelector('.nav');
            nav.classList.toggle('mobile-open');
        }
    </script>
</body>
</html>