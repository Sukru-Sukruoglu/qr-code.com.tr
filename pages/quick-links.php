<?php
<?php
session_start();
$pageTitle = "Hızlı Linkler | QR-CODE.COM.TR";
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
            --text-primary: #1a202c;
            --text-muted: #718096;
            --bg-primary: #ffffff;
            --bg-secondary: #f7fafc;
            --border-color: #e2e8f0;
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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 3rem 0;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header p {
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        .quick-links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .link-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-primary);
        }

        .link-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.15);
        }

        .link-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .link-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .link-description {
            color: var(--text-muted);
            font-size: 0.95rem;
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
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-bolt"></i> Hızlı Linkler</h1>
            <p>QR-CODE.COM.TR'de sık kullanılan özellikler ve sayfalar</p>
        </div>

        <div class="quick-links-grid">
            <a href="<?php echo $baseURL; ?>/qr-olustur" class="link-card">
                <div class="link-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="link-title">Yeni QR Kod Oluştur</div>
                <div class="link-description">Hızlıca yeni QR kodlar oluşturun ve paylaşın</div>
            </a>

            <a href="<?php echo $baseURL; ?>/qr-listesi" class="link-card">
                <div class="link-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="link-title">QR Kodlarım</div>
                <div class="link-description">Oluşturduğunuz tüm QR kodları görüntüleyin</div>
            </a>

            <a href="<?php echo $baseURL; ?>/analytics" class="link-card">
                <div class="link-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="link-title">Analitikler</div>
                <div class="link-description">QR kod istatistiklerinizi inceleyin</div>
            </a>

            <a href="<?php echo $baseURL; ?>/profile" class="link-card">
                <div class="link-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="link-title">Profil Ayarları</div>
                <div class="link-description">Hesap bilgilerinizi yönetin</div>
            </a>

            <a href="<?php echo $baseURL; ?>/pages/features" class="link-card">
                <div class="link-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="link-title">Özellikler</div>
                <div class="link-description">Platform özelliklerini keşfedin</div>
            </a>

            <a href="<?php echo $baseURL; ?>/pages/how-to-use" class="link-card">
                <div class="link-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="link-title">Kullanım Kılavuzu</div>
                <div class="link-description">Nasıl kullanacağınızı öğrenin</div>
            </a>
        </div>

        <a href="<?php echo $baseURL; ?>/dashboard" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Dashboard'a Dön
        </a>
    </div>
</body>
</html>