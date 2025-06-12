<?php
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
        }

        .content-section {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            margin-bottom: 3rem;
            box-shadow: var(--shadow-lg);
        }

        .content-section h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .content-section p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 20px;
            border: 2px solid rgba(102, 126, 234, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .value-item {
            padding: 2rem;
            background: rgba(255,255,255,0.8);
            border-radius: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .value-item h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .value-item p {
            color: var(--text-muted);
            line-height: 1.7;
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

        .team-section {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            margin-bottom: 3rem;
            box-shadow: var(--shadow-lg);
        }

        .team-member {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 2rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 20px;
            margin-bottom: 2rem;
        }

        .member-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(315deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            flex-shrink: 0;
        }

        .member-info h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .member-role {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .member-bio {
            color: var(--text-muted);
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-info-circle"></i> Hakkımızda</h1>
            <p>QR-CODE.COM.TR olarak dijital dönüşümde yanınızdayız</p>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-flag"></i> Misyonumuz</h2>
            <p>
                QR-CODE.COM.TR olarak, dijital dünyada bağlantıları kolaylaştırmak ve işletmelerin modern teknolojilerle büyümesine yardımcı olmak için faaliyet gösteriyoruz. 2024 yılında kurulan platformumuz, kullanıcı dostu arayüzü ve güçlü altyapısıyla QR kod teknologisinin Türkiye'deki öncülerinden biri olmayı hedefliyor.
            </p>
            <p>
                Amacımız, küçük işletmelerden büyük şirketlere kadar herkese erişilebilir, güvenli ve etkili QR kod çözümleri sunmaktır. Modern pazarlama stratejilerinde kritik rol oynayan QR kodlarını, herkesin kolayca kullanabileceği bir platform haline getirdik.
            </p>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-chart-line"></i> Platform İstatistikleri</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Aktif Kullanıcı</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">2M+</div>
                    <div class="stat-label">Oluşturulan QR Kod</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">15M+</div>
                    <div class="stat-label">Toplam Tarama</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-heart"></i> Değerlerimiz</h2>
            <div class="values-grid">
                <div class="value-item">
                    <h4><i class="fas fa-users"></i> Kullanıcı Odaklılık</h4>
                    <p>Kullanıcılarımızın ihtiyaçlarını önceleyerek, sürekli olarak platform deneyimini iyileştiriyoruz.</p>
                </div>
                <div class="value-item">
                    <h4><i class="fas fa-shield-alt"></i> Güvenlik</h4>
                    <p>Verilerinizin güvenliği bizim için öncelikli. En yüksek güvenlik standartlarını uyguluyoruz.</p>
                </div>
                <div class="value-item">
                    <h4><i class="fas fa-rocket"></i> İnovasyon</h4>
                    <p>Teknolojinin öncü trendlerini takip ederek sürekli yenilik getiriyoruz.</p>
                </div>
                <div class="value-item">
                    <h4><i class="fas fa-handshake"></i> Güvenilirlik</h4>
                    <p>7/24 kesintisiz hizmet sunarak işinizin devamlılığını sağlıyoruz.</p>
                </div>
                <div class="value-item">
                    <h4><i class="fas fa-globe"></i> Erişilebilirlik</h4>
                    <p>Herkesin kullanabileceği, sade ve anlaşılır arayüz tasarlıyoruz.</p>
                </div>
                <div class="value-item">
                    <h4><i class="fas fa-leaf"></i> Sürdürülebilirlik</h4>
                    <p>Çevresel sorumluluğumuzu dijital çözümlerle yerine getiriyoruz.</p>
                </div>
            </div>
        </div>

        <div class="team-section">
            <h2><i class="fas fa-users"></i> Ekibimiz</h2>
            <div class="team-member">
                <div class="member-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="member-info">
                    <h4>Ahmet Yılmaz</h4>
                    <div class="member-role">Kurucu & CEO</div>
                    <div class="member-bio">
                        10 yıllık yazılım geliştirme deneyimi. Dijital pazarlama ve QR kod teknolojileri konusunda uzman.
                    </div>
                </div>
            </div>
            
            <div class="team-member">
                <div class="member-avatar">
                    <i class="fas fa-code"></i>
                </div>
                <div class="member-info">
                    <h4>Elif Kaya</h4>
                    <div class="member-role">CTO & Baş Geliştirici</div>
                    <div class="member-bio">
                        Bilgisayar mühendisi. Modern web teknolojileri ve güvenlik sistemleri konusunda uzman.
                    </div>
                </div>
            </div>
            
            <div class="team-member">
                <div class="member-avatar">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div class="member-info">
                    <h4>Murat Demir</h4>
                    <div class="member-role">UI/UX Tasarımcı</div>
                    <div class="member-bio">
                        Kullanıcı deneyimi tasarımında 7 yıllık deneyim. Modern ve kullanıcı dostu arayüzler tasarlıyor.
                    </div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2><i class="fas fa-road"></i> Geleceğe Bakış</h2>
            <p>
                QR-CODE.COM.TR olarak, dijital dönüşümün hızlandığı bu dönemde, müşterilerimize en iyi hizmeti sunmak için sürekli olarak platformumuzu geliştiriyoruz. Yapay zeka entegrasyonu, gelişmiş analitik araçları ve yeni QR kod türleri ile geleceğin teknolojilerini bugünden sunmayı hedefliyoruz.
            </p>
            <p>
                Hedefimiz, sadece Türkiye'de değil, global pazarda da tanınan bir marka olmak ve QR kod teknolojisinin gelişimine katkıda bulunmaktır. Bu yolculukta bizimle olan tüm kullanıcılarımıza teşekkür ederiz.
            </p>
        </div>

        <a href="<?php echo $baseURL; ?>/dashboard" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Dashboard'a Dön
        </a>
    </div>
</body>
</html>