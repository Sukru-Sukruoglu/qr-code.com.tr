<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\qr-create\index.php
// Session kontrolü
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Giriş kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: /dashboard/qr-code.com.tr/giris");
    exit;
}

$pageTitle = "QR Kod Oluştur | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';
$userName = $_SESSION['username'] ?? 'Kullanıcı';

// QR Türleri tanımları
$qrTypes = [
    'url' => [
        'name' => 'Web Sitesi',
        'icon' => 'link',
        'color' => '#3b82f6',
        'description' => 'Web sitelerine hızlı erişim sağlayın'
    ],
    'text' => [
        'name' => 'Metin',
        'icon' => 'font',
        'color' => '#6b7280',
        'description' => 'Düz metin paylaşımı yapın'
    ],
    'wifi' => [
        'name' => 'WiFi',
        'icon' => 'wifi',
        'color' => '#10b981',
        'description' => 'WiFi ağına kolay bağlantı'
    ],
    'email' => [
        'name' => 'E-posta',
        'icon' => 'envelope',
        'color' => '#f59e0b',
        'description' => 'Hazır e-posta şablonu'
    ],
    'phone' => [
        'name' => 'Telefon',
        'icon' => 'phone',
        'color' => '#8b5cf6',
        'description' => 'Direkt arama yapma'
    ],
    'sms' => [
        'name' => 'SMS',
        'icon' => 'sms',
        'color' => '#06b6d4',
        'description' => 'Hazır SMS gönderme'
    ],
    'whatsapp' => [
        'name' => 'WhatsApp',
        'icon' => 'whatsapp',
        'color' => '#25d366',
        'description' => 'WhatsApp mesaj gönderme'
    ],
    'vcard' => [
        'name' => 'Kartvizit',
        'icon' => 'id-card',
        'color' => '#1f2937',
        'description' => 'Dijital kartvizit paylaşımı'
    ],
    'location' => [
        'name' => 'Konum',
        'icon' => 'map-marker-alt',
        'color' => '#ef4444',
        'description' => 'Konum paylaşımı'
    ],
    'instagram' => [
        'name' => 'Instagram',
        'icon' => 'instagram',
        'color' => '#e4405f',
        'description' => 'Instagram profil paylaşımı'
    ],
    'facebook' => [
        'name' => 'Facebook',
        'icon' => 'facebook-f',
        'color' => '#1877f2',
        'description' => 'Facebook sayfa paylaşımı'
    ],
    'menu' => [
        'name' => 'Menü',
        'icon' => 'utensils',
        'color' => '#f97316',
        'description' => 'Restoran menüsü paylaşımı'
    ]
];

// Seçili QR türü
$selectedType = $_GET['type'] ?? 'url';
if (!array_key_exists($selectedType, $qrTypes)) {
    $selectedType = 'url';
}

// Form işleme
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // QR kod oluşturma işlemi burada yapılacak
    $success = true;
    $qrId = rand(1000, 9999); // Demo ID
}
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #2d3748;
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }

        .sidebar-logo i {
            font-size: 2rem;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem;
            border-radius: 12px;
        }

        .user-info {
            background: rgba(255,255,255,0.1);
            padding: 1.5rem;
            border-radius: 16px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            border: 3px solid rgba(255,255,255,0.3);
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .user-email {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section {
            padding: 1rem 2rem;
        }

        .nav-section-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(5px);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .breadcrumb {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            color: #718096;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* QR Creator Container */
        .qr-creator {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 2rem;
        }

        /* Type Selector */
        .type-selector {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 2rem;
            height: fit-content;
        }

        .selector-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .selector-title i {
            color: #667eea;
        }

        .type-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .type-option {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .type-option:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: translateX(5px);
        }

        .type-option.active {
            background: rgba(102, 126, 234, 0.1);
            border-color: #667eea;
        }

        .type-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .type-info h4 {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }

        .type-info p {
            font-size: 0.9rem;
            color: #718096;
        }

        /* Form Container */
        .form-container {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            overflow: hidden;
        }

        .form-header {
            padding: 2rem 2rem 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-title .icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
        }

        .form-body {
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid rgba(102, 126, 234, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.7);
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23718096' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
            padding-right: 3rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
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

        .btn-outline {
            background: rgba(255,255,255,0.9);
            color: #667eea;
            border: 2px solid #667eea;
            backdrop-filter: blur(10px);
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
        }

        .btn-lg {
            padding: 1.25rem 2.5rem;
            font-size: 1.1rem;
        }

        /* QR Preview */
        .qr-preview {
            background: rgba(102, 126, 234, 0.05);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            margin-top: 2rem;
        }

        .qr-placeholder {
            width: 200px;
            height: 200px;
            background: white;
            border-radius: 16px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            color: #718096;
            font-size: 4rem;
        }

        .preview-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .preview-subtitle {
            color: #718096;
            font-size: 0.9rem;
        }

        /* Success Message */
        .success-message {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1.5rem 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .qr-creator {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .type-selector {
                order: 2;
            }

            .form-container {
                order: 1;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .type-selector,
        .form-container {
            animation: fadeInUp 0.6s ease forwards;
        }

        .form-container {
            animation-delay: 0.1s;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo $baseURL; ?>/dashboard" class="sidebar-logo">
                <i class="fas fa-qrcode"></i>
                <span>QR-CODE.COM.TR</span>
            </a>
            
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-name"><?php echo htmlspecialchars($userName); ?></div>
                <div class="user-email"><?php echo htmlspecialchars($_SESSION['email'] ?? 'user@example.com'); ?></div>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Dashboard</div>
                <div class="nav-item">
                    <a href="<?php echo $baseURL; ?>/dashboard" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Ana Sayfa</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="<?php echo $baseURL; ?>/analytics" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        <span>Analitikler</span>
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">QR Kodlar</div>
                <div class="nav-item">
                    <a href="<?php echo $baseURL; ?>/qr-olustur" class="nav-link active">
                        <i class="fas fa-plus"></i>
                        <span>Yeni QR Oluştur</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="<?php echo $baseURL; ?>/qr-listesi" class="nav-link">
                        <i class="fas fa-list"></i>
                        <span>QR Kodlarım</span>
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Hesap</div>
                <div class="nav-item">
                    <a href="<?php echo $baseURL; ?>/profile" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        <span>Profil</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="<?php echo $baseURL; ?>/pricing" class="nav-link">
                        <i class="fas fa-crown"></i>
                        <span>Planlar</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="<?php echo $baseURL; ?>/cikis" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Çıkış Yap</span>
                    </a>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="breadcrumb">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
                <i class="fas fa-chevron-right" style="font-size: 0.7rem; margin: 0 0.5rem;"></i>
                <span>QR Kod Oluştur</span>
            </div>
            <h1 class="page-title">✨ QR Kod Oluştur</h1>
            <p class="page-subtitle">İhtiyacınıza uygun QR kod türünü seçin ve hızlıca oluşturun</p>
        </div>

        <!-- Success Message -->
        <?php if (isset($success) && $success): ?>
            <div class="success-message">
                ✅ QR kodunuz başarıyla oluşturuldu! QR #<?php echo $qrId; ?>
            </div>
        <?php endif; ?>

        <!-- QR Creator -->
        <div class="qr-creator">
            <!-- Type Selector -->
            <div class="type-selector">
                <h2 class="selector-title">
                    <i class="fas fa-list"></i>
                    QR Kod Türü Seçin
                </h2>
                
                <div class="type-list">
                    <?php foreach ($qrTypes as $type => $info): ?>
                        <div class="type-option <?php echo $type === $selectedType ? 'active' : ''; ?>" 
                             onclick="selectType('<?php echo $type; ?>')">
                            <div class="type-icon" style="background: <?php echo $info['color']; ?>;">
                                <i class="fas fa-<?php echo $info['icon']; ?>"></i>
                            </div>
                            <div class="type-info">
                                <h4><?php echo $info['name']; ?></h4>
                                <p><?php echo $info['description']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <div class="form-header">
                    <h2 class="form-title">
                        <div class="icon" style="background: <?php echo $qrTypes[$selectedType]['color']; ?>;">
                            <i class="fas fa-<?php echo $qrTypes[$selectedType]['icon']; ?>"></i>
                        </div>
                        <span id="formTitle"><?php echo $qrTypes[$selectedType]['name']; ?> QR Kodu</span>
                    </h2>
                </div>
                
                <div class="form-body">
                    <form method="POST" id="qrForm">
                        <input type="hidden" name="qr_type" value="<?php echo $selectedType; ?>" id="qrTypeInput">
                        
                        <!-- Dynamic Form Content -->
                        <div id="formContent">
                            <?php echo getFormTemplate($selectedType); ?>
                        </div>

                        <!-- QR Customization -->
                        <div class="form-group">
                            <label class="form-label">QR Kod Başlığı (İsteğe Bağlı)</label>
                            <input type="text" class="form-input" name="qr_title" placeholder="QR kodunuz için bir başlık girin">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">QR Kod Boyutu</label>
                                <select class="form-input form-select" name="qr_size">
                                    <option value="200">200x200 px (Küçük)</option>
                                    <option value="300" selected>300x300 px (Orta)</option>
                                    <option value="400">400x400 px (Büyük)</option>
                                    <option value="500">500x500 px (Çok Büyük)</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">QR Kod Rengi</label>
                                <select class="form-input form-select" name="qr_color">
                                    <option value="#000000">Siyah</option>
                                    <option value="#667eea">Mavi</option>
                                    <option value="#10b981">Yeşil</option>
                                    <option value="#ef4444">Kırmızı</option>
                                    <option value="#8b5cf6">Mor</option>
                                    <option value="#f59e0b">Turuncu</option>
                                </select>
                            </div>
                        </div>

                        <!-- QR Preview -->
                        <div class="qr-preview">
                            <div class="qr-placeholder">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <div class="preview-title">QR Kod Önizlemesi</div>
                            <div class="preview-subtitle">Form doldurulduktan sonra önizleme burada görünecek</div>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                            <button type="submit" class="btn btn-primary btn-lg" style="flex: 1;">
                                <i class="fas fa-magic"></i>
                                QR Kod Oluştur
                            </button>
                            
                            <button type="button" class="btn btn-outline" onclick="previewQR()">
                                <i class="fas fa-eye"></i>
                                Önizleme
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('✨ QR Kod Oluştur sayfası yüklendi');
});

function selectType(type) {
    // URL'yi güncelle
    const url = new URL(window.location);
    url.searchParams.set('type', type);
    window.location.href = url.toString();
}

function previewQR() {
    alert('QR kod önizleme özelliği yakında eklenecek!');
}

// Form validation
document.getElementById('qrForm').addEventListener('submit', function(e) {
    const formData = new FormData(this);
    const type = formData.get('qr_type');
    
    // Basit validation
    let isValid = true;
    let errorMessage = '';
    
    switch(type) {
        case 'url':
            const url = formData.get('url');
            if (!url || !isValidURL(url)) {
                isValid = false;
                errorMessage = 'Lütfen geçerli bir URL girin!';
            }
            break;
        case 'text':
            const text = formData.get('text');
            if (!text || text.trim().length === 0) {
                isValid = false;
                errorMessage = 'Lütfen metin girin!';
            }
            break;
        case 'email':
            const email = formData.get('email');
            if (!email || !isValidEmail(email)) {
                isValid = false;
                errorMessage = 'Lütfen geçerli bir e-posta adresi girin!';
            }
            break;
    }
    
    if (!isValid) {
        e.preventDefault();
        alert(errorMessage);
        return false;
    }
});

function isValidURL(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
</script>

</body>
</html>

<?php
// Form template fonksiyonu
function getFormTemplate($type) {
    switch($type) {
        case 'url':
            return '<div class="form-group">
                <label class="form-label">Web Site URL\'si *</label>
                <input type="url" class="form-input" name="url" placeholder="https://example.com" required>
                <small style="color: #718096; font-size: 0.9rem;">http:// veya https:// ile başlamalıdır</small>
            </div>';

        case 'text':
            return '<div class="form-group">
                <label class="form-label">Metin İçeriği *</label>
                <textarea class="form-input form-textarea" name="text" placeholder="QR kodunda görünecek metni girin..." required></textarea>
                <small style="color: #718096; font-size: 0.9rem;">Maksimum 1000 karakter</small>
            </div>';

        case 'wifi':
            return '<div class="form-group">
                <label class="form-label">WiFi Ağ Adı (SSID) *</label>
                <input type="text" class="form-input" name="wifi_ssid" placeholder="WiFi ağ adını girin" required>
            </div>
            <div class="form-group">
                <label class="form-label">WiFi Şifresi</label>
                <input type="password" class="form-input" name="wifi_password" placeholder="WiFi şifresini girin">
            </div>
            <div class="form-group">
                <label class="form-label">Güvenlik Türü</label>
                <select class="form-input form-select" name="wifi_security">
                    <option value="WPA">WPA/WPA2</option>
                    <option value="WEP">WEP</option>
                    <option value="nopass">Şifresiz</option>
                </select>
            </div>';

        case 'email':
            return '<div class="form-group">
                <label class="form-label">E-posta Adresi *</label>
                <input type="email" class="form-input" name="email" placeholder="example@domain.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Konu</label>
                <input type="text" class="form-input" name="email_subject" placeholder="E-posta konusu">
            </div>
            <div class="form-group">
                <label class="form-label">Mesaj</label>
                <textarea class="form-input form-textarea" name="email_body" placeholder="E-posta içeriği..."></textarea>
            </div>';

        case 'phone':
            return '<div class="form-group">
                <label class="form-label">Telefon Numarası *</label>
                <input type="tel" class="form-input" name="phone" placeholder="+90 555 123 45 67" required>
                <small style="color: #718096; font-size: 0.9rem;">Ülke kodu ile birlikte girin (+90 5XX XXX XX XX)</small>
            </div>';

        case 'sms':
            return '<div class="form-group">
                <label class="form-label">Telefon Numarası *</label>
                <input type="tel" class="form-input" name="sms_phone" placeholder="+90 555 123 45 67" required>
            </div>
            <div class="form-group">
                <label class="form-label">SMS Mesajı</label>
                <textarea class="form-input form-textarea" name="sms_message" placeholder="SMS mesaj içeriği..."></textarea>
            </div>';

        case 'whatsapp':
            return '<div class="form-group">
                <label class="form-label">WhatsApp Numarası *</label>
                <input type="tel" class="form-input" name="whatsapp_phone" placeholder="+90 555 123 45 67" required>
                <small style="color: #718096; font-size: 0.9rem;">Ülke kodu ile birlikte girin (+90 5XX XXX XX XX)</small>
            </div>
            <div class="form-group">
                <label class="form-label">Mesaj</label>
                <textarea class="form-input form-textarea" name="whatsapp_message" placeholder="WhatsApp mesaj içeriği..."></textarea>
            </div>';

        case 'vcard':
            return '<div class="form-row">
                <div class="form-group">
                    <label class="form-label">Ad *</label>
                    <input type="text" class="form-input" name="vcard_firstname" placeholder="Adınız" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Soyad *</label>
                    <input type="text" class="form-input" name="vcard_lastname" placeholder="Soyadınız" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Telefon</label>
                <input type="tel" class="form-input" name="vcard_phone" placeholder="+90 555 123 45 67">
            </div>
            <div class="form-group">
                <label class="form-label">E-posta</label>
                <input type="email" class="form-input" name="vcard_email" placeholder="email@domain.com">
            </div>
            <div class="form-group">
                <label class="form-label">Şirket</label>
                <input type="text" class="form-input" name="vcard_company" placeholder="Şirket adı">
            </div>
            <div class="form-group">
                <label class="form-label">Ünvan</label>
                <input type="text" class="form-input" name="vcard_title" placeholder="İş ünvanı">
            </div>';

        case 'location':
            return '<div class="form-row">
                <div class="form-group">
                    <label class="form-label">Enlem (Latitude) *</label>
                    <input type="number" step="any" class="form-input" name="location_lat" placeholder="41.0082" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Boylam (Longitude) *</label>
                    <input type="number" step="any" class="form-input" name="location_lng" placeholder="28.9784" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Konum Adı</label>
                <input type="text" class="form-input" name="location_name" placeholder="Konum adı (opsiyonel)">
            </div>';

        case 'instagram':
            return '<div class="form-group">
                <label class="form-label">Instagram Kullanıcı Adı *</label>
                <input type="text" class="form-input" name="instagram_username" placeholder="kullanici_adi" required>
                <small style="color: #718096; font-size: 0.9rem;">@ işareti olmadan sadece kullanıcı adını girin</small>
            </div>';

        case 'facebook':
            return '<div class="form-group">
                <label class="form-label">Facebook Sayfa URL\'si *</label>
                <input type="url" class="form-input" name="facebook_url" placeholder="https://facebook.com/sayfaadi" required>
                <small style="color: #718096; font-size: 0.9rem;">Facebook sayfa linkini tam olarak girin</small>
            </div>';

        case 'menu':
            return '<div class="form-group">
                <label class="form-label">Menü URL\'si *</label>
                <input type="url" class="form-input" name="menu_url" placeholder="https://example.com/menu" required>
                <small style="color: #718096; font-size: 0.9rem;">Online menünüzün linkini girin</small>
            </div>
            <div class="form-group">
                <label class="form-label">Restoran Adı</label>
                <input type="text" class="form-input" name="menu_restaurant" placeholder="Restoran adı">
            </div>';

        default:
            return '<div class="form-group">
                <label class="form-label">İçerik *</label>
                <textarea class="form-input form-textarea" name="content" placeholder="QR kod içeriğini girin..." required></textarea>
            </div>';
    }
}
?>