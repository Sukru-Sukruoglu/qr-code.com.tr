<?php
session_start();
$pageTitle = "Hakkımızda | QR-CODE.COM.TR";
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

        .content-section {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .content-section h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .content-section p {
            margin-bottom: 1.5rem;
            color: var(--text-muted);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .stat-card {
            text-align: center;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 20px;
            padding: 2rem;
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .team-member {
            text-align: center;
            background: rgba(255,255,255,0.7);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .member-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: white;
        }

        .member-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .member-role {
            color: var(--text-muted);
            font-size: 0.9rem;
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

        .values-list {
            list-style: none;
            margin-top: 1rem;
        }

        .values-list li {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 16px;
        }

        .values-list li i {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-top: 0.25rem;
        }

        .values-list li strong {
            color: var(--text-primary);
            display: block;
            margin-bottom: 0.25rem;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .team-grid {
                grid-template-columns: 1fr;
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
            <h1><i class="fas fa-info-circle"></i> Hakkımızda</h1>
            <p>Modern QR kod çözümleri ile dijital dünyayı dönüştürüyoruz</p>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-bullseye"></i> Misyonumuz</h2>
            <p>
                QR-CODE.COM.TR olarak, QR kod teknolojisini herkesin kolayca kullanabileceği, 
                güvenli ve etkili bir platforma dönüştürmeyi hedefliyoruz. Amacımız, 
                bireylerden büyük şirketlere kadar herkese profesyonel QR kod çözümleri sunmaktır.
            </p>
            <p>
                Dijital dönüşümün öncüsü olarak, QR kod teknolojisinin gücünü kullanarak 
                fiziksel ve dijital dünya arasında köprü kurmaya devam ediyoruz.
            </p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">50K+</div>
                <div class="stat-label">Oluşturulan QR Kod</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Aktif Kullanıcı</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">1M+</div>
                <div class="stat-label">Toplam Tarama</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">99.9%</div>
                <div class="stat-label">Uptime Garantisi</div>
            </div>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-eye"></i> Vizyonumuz</h2>
            <p>
                QR kod teknolojisinin Türkiye'deki en güvenilir ve yenilikçi platformu olmak. 
                Kullanıcılarımızın dijital ihtiyaçlarını karşılayan, sürekli gelişen ve 
                dünya standartlarında hizmet sunan bir ekosistem oluşturmak.
            </p>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-heart"></i> Değerlerimiz</h2>
            <ul class="values-list">
                <li>
                    <i class="fas fa-shield-alt"></i>
                    <div>
                        <strong>Güvenlik</strong>
                        Kullanıcı verilerinin güvenliği bizim için en önemli önceliktir.
                    </div>
                </li>
                <li>
                    <i class="fas fa-rocket"></i>
                    <div>
                        <strong>İnovasyon</strong>
                        Sürekli gelişim ve yenilikçi çözümlerle sektöre öncülük ediyoruz.
                    </div>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <div>
                        <strong>Kullanıcı Odaklılık</strong>
                        Her kararımızı kullanıcı deneyimini iyileştirmek için alıyoruz.
                    </div>
                </li>
                <li>
                    <i class="fas fa-star"></i>
                    <div>
                        <strong>Kalite</strong>
                        Sunduğumuz her hizmette en yüksek kalite standartlarını hedefliyoruz.
                    </div>
                </li>
            </ul>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-users-cog"></i> Ekibimiz</h2>
            <p>
                Deneyimli yazılım geliştirici, tasarımcı ve dijital pazarlama uzmanlarından oluşan 
                ekibimiz, QR-CODE.COM.TR'yi sürekli geliştirmek için çalışıyor.
            </p>
            
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="member-name">Ahmet Yılmaz</div>
                    <div class="member-role">Kurucu & CEO</div>
                </div>
                <div class="team-member">
                    <div class="member-avatar">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="member-name">Zeynep Kaya</div>
                    <div class="member-role">Baş Yazılım Geliştirici</div>
                </div>
                <div class="team-member">
                    <div class="member-avatar">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <div class="member-name">Mehmet Özkan</div>
                    <div class="member-role">UX/UI Tasarımcı</div>
                </div>
                <div class="team-member">
                    <div class="member-avatar">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="member-name">Ayşe Demir</div>
                    <div class="member-role">Pazarlama Müdürü</div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-handshake"></i> Neden Bizi Seçmelisiniz?</h2>
            <p>
                📊 <strong>Detaylı Analitikler:</strong> QR kodlarınızın performansını takip edin<br>
                🎨 <strong>Özelleştirilebilir Tasarım:</strong> Markanıza uygun QR kodlar oluşturun<br>
                🔒 <strong>Güvenli Altyapı:</strong> SSL şifreleme ile korunan veriler<br>
                📱 <strong>Mobil Uyumlu:</strong> Her cihazdan erişilebilir platform<br>
                🚀 <strong>Hızlı Performans:</strong> CDN altyapısı ile hızlı yükleme<br>
                🎯 <strong>Kolay Kullanım:</strong> Sezgisel ve kullanıcı dostu arayüz
            </p>
        </div>
    </div>
</body>
</html>