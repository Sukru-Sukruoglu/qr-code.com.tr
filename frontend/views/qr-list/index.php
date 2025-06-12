<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\qr-list\index.php
// Session kontrolü
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Giriş kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: /dashboard/qr-code.com.tr/giris");
    exit;
}

$pageTitle = "QR Kodlarım | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';
$userName = $_SESSION['username'] ?? 'Kullanıcı';

// Mock QR kodları (şimdilik demo data)
$qrCodes = [
    [
        'id' => 1,
        'title' => 'Şirket Web Sitesi',
        'type' => 'url',
        'content' => 'https://example.com',
        'scan_count' => 45,
        'created_at' => '2024-06-01',
        'is_active' => true
    ],
    [
        'id' => 2,
        'title' => 'WiFi Ofis',
        'type' => 'wifi',
        'content' => 'WIFI:T:WPA;S:OfficeWiFi;P:password123;;',
        'scan_count' => 28,
        'created_at' => '2024-06-02',
        'is_active' => true
    ],
    [
        'id' => 3,
        'title' => 'WhatsApp İletişim',
        'type' => 'whatsapp',
        'content' => 'https://wa.me/905551234567',
        'scan_count' => 67,
        'created_at' => '2024-06-03',
        'is_active' => false
    ],
    [
        'id' => 4,
        'title' => 'Instagram Profil',
        'type' => 'instagram',
        'content' => 'https://instagram.com/myprofile',
        'scan_count' => 89,
        'created_at' => '2024-06-04',
        'is_active' => true
    ],
    [
        'id' => 5,
        'title' => 'Restoran Menü',
        'type' => 'menu',
        'content' => 'https://menu.example.com',
        'scan_count' => 156,
        'created_at' => '2024-06-05',
        'is_active' => true
    ]
];

// Helper fonksiyonları
function getQRIcon($type) {
    $icons = [
        'url' => 'link',
        'wifi' => 'wifi',
        'vcard' => 'id-card',
        'whatsapp' => 'whatsapp',
        'email' => 'envelope',
        'phone' => 'phone',
        'sms' => 'sms',
        'text' => 'file-text',
        'instagram' => 'instagram',
        'facebook' => 'facebook',
        'location' => 'map-marker-alt',
        'menu' => 'utensils'
    ];
    
    return $icons[$type] ?? 'qrcode';
}

function getQRTypeName($type) {
    $names = [
        'url' => 'Web Sitesi',
        'wifi' => 'WiFi',
        'vcard' => 'Kartvizit',
        'whatsapp' => 'WhatsApp',
        'email' => 'E-posta',
        'phone' => 'Telefon',
        'sms' => 'SMS',
        'text' => 'Metin',
        'instagram' => 'Instagram',
        'facebook' => 'Facebook',
        'location' => 'Konum',
        'menu' => 'Menü'
    ];
    
    return $names[$type] ?? ucfirst($type);
}

function formatDate($date) {
    return date('d.m.Y', strtotime($date));
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .page-header-left {
            flex: 1;
        }

        .breadcrumb {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
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

        .page-actions {
            display: flex;
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

        /* Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #718096;
            font-weight: 500;
        }

        /* QR List */
        .qr-list-container {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            overflow: hidden;
        }

        .qr-list-header {
            padding: 2rem 2rem 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .qr-list-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .qr-list-title i {
            color: #667eea;
        }

        .search-filter-bar {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid rgba(102, 126, 234, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.7);
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
        }

        .filter-select {
            padding: 0.875rem 1rem;
            border: 2px solid rgba(102, 126, 234, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            background: rgba(255,255,255,0.7);
            color: #2d3748;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            outline: none;
            border-color: #667eea;
        }

        .qr-items {
            padding: 1rem 0;
        }

        .qr-item {
            display: flex;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .qr-item:hover {
            background: rgba(102, 126, 234, 0.03);
        }

        .qr-item:last-child {
            border-bottom: none;
        }

        .qr-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-right: 1.5rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .qr-info {
            flex: 1;
        }

        .qr-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .qr-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #718096;
            font-size: 0.9rem;
        }

        .qr-type {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .qr-stats {
            text-align: right;
            min-width: 120px;
        }

        .scan-count {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 0.25rem;
        }

        .scan-label {
            color: #718096;
            font-size: 0.9rem;
        }

        .qr-actions {
            display: flex;
            gap: 0.5rem;
            margin-left: 1rem;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.7);
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .action-btn.edit {
            color: #3b82f6;
        }

        .action-btn.edit:hover {
            background: #3b82f6;
            color: white;
        }

        .action-btn.download {
            color: #10b981;
        }

        .action-btn.download:hover {
            background: #10b981;
            color: white;
        }

        .action-btn.delete {
            color: #ef4444;
        }

        .action-btn.delete:hover {
            background: #ef4444;
            color: white;
        }

        .action-btn.toggle {
            color: #f59e0b;
        }

        .action-btn.toggle:hover {
            background: #f59e0b;
            color: white;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #718096;
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 2rem;
            opacity: 0.5;
            color: #cbd5e0;
        }

        .empty-state h3 {
            font-size: 1.6rem;
            margin-bottom: 1rem;
            color: #2d3748;
        }

        .empty-state p {
            margin-bottom: 2rem;
            line-height: 1.6;
            font-size: 1.1rem;
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .page-actions {
                width: 100%;
                justify-content: stretch;
            }

            .btn {
                flex: 1;
                justify-content: center;
            }

            .search-filter-bar {
                flex-direction: column;
            }

            .search-box {
                min-width: auto;
            }

            .qr-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                padding: 1rem;
            }

            .qr-stats,
            .qr-actions {
                width: 100%;
                justify-content: space-between;
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
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

        .stat-card,
        .qr-list-container {
            animation: fadeInUp 0.6s ease forwards;
        }

        .qr-item {
            animation: fadeInUp 0.4s ease forwards;
        }

        .qr-item:nth-child(2) { animation-delay: 0.1s; }
        .qr-item:nth-child(3) { animation-delay: 0.2s; }
        .qr-item:nth-child(4) { animation-delay: 0.3s; }
        .qr-item:nth-child(5) { animation-delay: 0.4s; }
        .qr-item:nth-child(6) { animation-delay: 0.5s; }
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
                    <a href="<?php echo $baseURL; ?>/qr-olustur" class="nav-link">
                        <i class="fas fa-plus"></i>
                        <span>Yeni QR Oluştur</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="<?php echo $baseURL; ?>/qr-listesi" class="nav-link active">
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
            <div class="page-header-left">
                <div class="breadcrumb">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                    <i class="fas fa-chevron-right" style="font-size: 0.7rem; margin: 0 0.5rem;"></i>
                    <span>QR Kodlarım</span>
                </div>
                <h1 class="page-title">📱 QR Kodlarım</h1>
                <p class="page-subtitle">Oluşturduğunuz tüm QR kodları yönetin, düzenleyin ve analiz edin</p>
            </div>
            
            <div class="page-actions">
                <a href="<?php echo $baseURL; ?>/qr-olustur" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Yeni QR Oluştur
                </a>
                <button class="btn btn-outline" onclick="exportAllQRs()">
                    <i class="fas fa-download"></i>
                    Tümünü İndir
                </button>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-number"><?php echo count($qrCodes); ?></div>
                <div class="stat-label">Toplam QR Kod</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number"><?php echo count(array_filter($qrCodes, function($qr) { return $qr['is_active']; })); ?></div>
                <div class="stat-label">Aktif QR Kod</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number"><?php echo array_sum(array_column($qrCodes, 'scan_count')); ?></div>
                <div class="stat-label">Toplam Tarama</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number"><?php echo max(array_column($qrCodes, 'scan_count')); ?></div>
                <div class="stat-label">En Çok Taranan</div>
            </div>
        </div>

        <!-- QR List -->
        <div class="qr-list-container">
            <div class="qr-list-header">
                <h2 class="qr-list-title">
                    <i class="fas fa-list"></i>
                    QR Kod Listesi
                </h2>
                
                <div class="search-filter-bar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="QR kod ara..." id="searchInput">
                    </div>
                    
                    <select class="filter-select" id="typeFilter">
                        <option value="">Tüm Türler</option>
                        <option value="url">Web Sitesi</option>
                        <option value="wifi">WiFi</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="instagram">Instagram</option>
                        <option value="menu">Menü</option>
                    </select>
                    
                    <select class="filter-select" id="statusFilter">
                        <option value="">Tüm Durumlar</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Pasif</option>
                    </select>
                </div>
            </div>
            
            <?php if (!empty($qrCodes)): ?>
                <div class="qr-items" id="qrList">
                    <?php foreach ($qrCodes as $qr): ?>
                        <div class="qr-item" data-type="<?php echo $qr['type']; ?>" data-status="<?php echo $qr['is_active'] ? 'active' : 'inactive'; ?>">
                            <div class="qr-icon">
                                <i class="fas fa-<?php echo getQRIcon($qr['type']); ?>"></i>
                            </div>
                            
                            <div class="qr-info">
                                <div class="qr-title"><?php echo htmlspecialchars($qr['title']); ?></div>
                                <div class="qr-meta">
                                    <span class="qr-type"><?php echo getQRTypeName($qr['type']); ?></span>
                                    <span><i class="fas fa-calendar"></i> <?php echo formatDate($qr['created_at']); ?></span>
                                    <span class="status-badge <?php echo $qr['is_active'] ? 'status-active' : 'status-inactive'; ?>">
                                        <?php echo $qr['is_active'] ? 'Aktif' : 'Pasif'; ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="qr-stats">
                                <div class="scan-count"><?php echo number_format($qr['scan_count']); ?></div>
                                <div class="scan-label">tarama</div>
                            </div>
                            
                            <div class="qr-actions">
                                <button class="action-btn edit" title="Düzenle" onclick="editQR(<?php echo $qr['id']; ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <button class="action-btn download" title="İndir" onclick="downloadQR(<?php echo $qr['id']; ?>)">
                                    <i class="fas fa-download"></i>
                                </button>
                                
                                <button class="action-btn toggle" title="<?php echo $qr['is_active'] ? 'Pasif Yap' : 'Aktif Yap'; ?>" onclick="toggleQR(<?php echo $qr['id']; ?>)">
                                    <i class="fas fa-<?php echo $qr['is_active'] ? 'pause' : 'play'; ?>"></i>
                                </button>
                                
                                <button class="action-btn delete" title="Sil" onclick="deleteQR(<?php echo $qr['id']; ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-qrcode"></i>
                    <h3>Henüz QR kod oluşturmamışsınız</h3>
                    <p>İlk QR kodunuzu oluşturmak için aşağıdaki butona tıklayın</p>
                    <a href="<?php echo $baseURL; ?>/qr-olustur" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        İlk QR Kodunuzu Oluşturun
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('📱 QR Listesi sayfası yüklendi');
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const statusFilter = document.getElementById('statusFilter');
    const qrItems = document.querySelectorAll('.qr-item');
    
    function filterQRs() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedType = typeFilter.value;
        const selectedStatus = statusFilter.value;
        
        qrItems.forEach(item => {
            const title = item.querySelector('.qr-title').textContent.toLowerCase();
            const type = item.dataset.type;
            const status = item.dataset.status;
            
            const matchesSearch = title.includes(searchTerm);
            const matchesType = !selectedType || type === selectedType;
            const matchesStatus = !selectedStatus || status === selectedStatus;
            
            if (matchesSearch && matchesType && matchesStatus) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filterQRs);
    typeFilter.addEventListener('change', filterQRs);
    statusFilter.addEventListener('change', filterQRs);
});

// QR Management Functions
function editQR(id) {
    alert(`QR #${id} düzenleme özelliği yakında eklenecek!`);
}

function downloadQR(id) {
    alert(`QR #${id} indirme işlemi başlatılıyor...`);
}

function toggleQR(id) {
    if (confirm('QR kodun durumunu değiştirmek istediğinizden emin misiniz?')) {
        alert(`QR #${id} durumu değiştirildi!`);
        // Gerçek uygulamada AJAX call yapılacak
        location.reload();
    }
}

function deleteQR(id) {
    if (confirm('Bu QR kodu silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!')) {
        alert(`QR #${id} silindi!`);
        // Gerçek uygulamada AJAX call yapılacak
        location.reload();
    }
}

function exportAllQRs() {
    alert('Tüm QR kodları ZIP dosyası olarak indiriliyor...');
}
</script>

</body>
</html>