<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\dashboard\analytics.php
// Session kontrolü
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Giriş kontrolü
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /dashboard/qr-code.com.tr/giris');
    exit;
}

// Kullanıcı bilgileri - EN ÜSTTE
$userName = $_SESSION['user_name'] ?? 'Kullanıcı';
$userEmail = $_SESSION['user_email'] ?? '';
$userRole = $_SESSION['user_role'] ?? 'user';

$pageTitle = "Analitikler | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';

$qr_id = $_GET['qr_id'] ?? 1;

// Demo QR bilgisi
$qr = [
    'id' => $qr_id,
    'title' => 'İşletmem Web Sitesi',
    'type' => 'url',
    'total_scans' => 245,
    'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
];

// Demo istatistikler
$analyticsStats = [
    'today_scans' => 12,
    'week_scans' => 89,
    'month_scans' => 235,
    'total_scans' => $qr['total_scans']
];

// Demo chart verisi
$analyticsChartData = [
    ['scan_date' => date('Y-m-d', strtotime('-6 days')), 'scan_count' => 15],
    ['scan_date' => date('Y-m-d', strtotime('-5 days')), 'scan_count' => 23],
    ['scan_date' => date('Y-m-d', strtotime('-4 days')), 'scan_count' => 18],
    ['scan_date' => date('Y-m-d', strtotime('-3 days')), 'scan_count' => 31],
    ['scan_date' => date('Y-m-d', strtotime('-2 days')), 'scan_count' => 27],
    ['scan_date' => date('Y-m-d', strtotime('-1 day')), 'scan_count' => 19],
    ['scan_date' => date('Y-m-d'), 'scan_count' => 12],
];

// Demo analitik verileri
$demoData = [
    'deviceTypes' => [
        'labels' => ['Mobil', 'Masaüstü', 'Tablet'],
        'values' => [156, 67, 22]
    ],
    'browsers' => [
        'labels' => ['Chrome', 'Safari', 'Firefox', 'Edge'],
        'values' => [123, 67, 34, 21]
    ],
    'countries' => [
        'labels' => ['Türkiye', 'Almanya', 'İngiltere', 'Fransa'],
        'values' => [189, 34, 15, 7]
    ],
    'timeData' => [
        'labels' => ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00'],
        'values' => [5, 2, 15, 25, 20, 8]
    ],
    'recentScans' => [
        [
            'scan_time' => '2024-06-06 14:30:00',
            'ip_address' => '192.168.1.1',
            'country' => 'Türkiye',
            'city' => 'İstanbul',
            'device_type' => 'Mobil',
            'browser' => 'Chrome'
        ],
        [
            'scan_time' => '2024-06-06 13:15:00',
            'ip_address' => '192.168.1.2',
            'country' => 'Türkiye',
            'city' => 'Ankara',
            'device_type' => 'Masaüstü',
            'browser' => 'Firefox'
        ],
        [
            'scan_time' => '2024-06-06 12:45:00',
            'ip_address' => '192.168.1.3',
            'country' => 'Almanya',
            'city' => 'Berlin',
            'device_type' => 'Tablet',
            'browser' => 'Safari'
        ],
        [
            'scan_time' => '2024-06-06 11:20:00',
            'ip_address' => '192.168.1.4',
            'country' => 'Türkiye',
            'city' => 'İzmir',
            'device_type' => 'Mobil',
            'browser' => 'Chrome'
        ],
        [
            'scan_time' => '2024-06-06 10:10:00',
            'ip_address' => '192.168.1.5',
            'country' => 'İngiltere',
            'city' => 'Londra',
            'device_type' => 'Masaüstü',
            'browser' => 'Edge'
        ]
    ]
};
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* Sidebar - Dashboard ile aynı */
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
            transition: transform 0.3s ease;
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
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
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
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* Analytics Header */
        .analytics-header {
            background: rgba(255,255,255,0.9);
            padding: 3rem;
            border-radius: 24px;
            margin-bottom: 3rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .analytics-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .qr-info p {
            color: #718096;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255,255,255,0.9);
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .stat-card.today .stat-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stat-card.week .stat-icon {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .stat-card.month .stat-icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #718096;
            font-weight: 500;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .card {
            background: rgba(255,255,255,0.9);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 2rem 2rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .chart-container {
            position: relative;
            height: 300px;
            padding: 2rem;
        }

        /* Analytics Grid */
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .chart-card {
            background: rgba(255,255,255,0.9);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .chart-card:hover {
            transform: translateY(-8px);
        }

        .chart-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
        }

        /* Table Styles */
        .table-card {
            background: rgba(255,255,255,0.9);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            margin-bottom: 3rem;
        }

        .table-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
            color: #374151;
        }

        tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        /* Loading & Error States */
        .loading-indicator {
            background: rgba(255,255,255,0.9);
            padding: 4rem 2rem;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e5e7eb;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .error-message {
            background: rgba(255,255,255,0.9);
            border: 2px solid #fee2e2;
            border-radius: 24px;
            padding: 3rem 2rem;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .error-content i {
            font-size: 3rem;
            color: #ef4444;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            display: none;
        }

        .mobile-menu-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Footer Styles */
        .dashboard-footer {
            background: rgba(255,255,255,0.9);
            border-radius: 24px;
            margin-top: 4rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.2fr;
            gap: 2rem;
            padding: 3rem 2rem 2rem;
        }

        .footer-section h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.4rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .footer-logo i {
            font-size: 1.8rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-section p {
            color: #718096;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.6rem;
        }

        .footer-links a {
            color: #718096;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #667eea;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: #718096;
            font-size: 0.9rem;
        }

        .contact-item i {
            color: #667eea;
            width: 16px;
            font-size: 0.9rem;
        }

        .footer-bottom {
            background: rgba(102, 126, 234, 0.05);
            padding: 1.5rem 2rem;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-bottom-content p {
            color: #718096;
            font-size: 0.85rem;
            margin: 0;
        }

        .footer-links-inline {
            display: flex;
            gap: 1.5rem;
        }

        .footer-links-inline a {
            color: #718096;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }

        .footer-links-inline a:hover {
            color: #667eea;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .content-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .analytics-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }
            
            .footer-section:first-child {
                grid-column: 1 / -1;
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 0.5rem;
            }
            
            .analytics-header {
                padding: 2rem 1rem;
            }
            
            .analytics-header h1 {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }
            
            .stat-card {
                padding: 1.5rem;
            }
            
            .analytics-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .chart-wrapper {
                height: 250px;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding: 2rem 1rem 1rem;
            }
            
            .footer-bottom {
                padding: 1rem;
            }
            
            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            .footer-links-inline {
                justify-content: center;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .sidebar-header {
                padding: 1rem;
            }
            
            .nav-section {
                padding: 0.5rem 1rem;
            }
            
            .analytics-header h1 {
                font-size: 1.8rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .chart-container, .chart-wrapper {
                padding: 1rem;
                height: 250px;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" onclick="toggleSidebar()" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="<?php echo $baseURL; ?>" class="sidebar-logo">
                    <i class="fas fa-qrcode"></i>
                    <span>QR-CODE.COM.TR</span>
                </a>
                
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-name"><?php echo htmlspecialchars($userName); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($userEmail); ?></div>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Dashboard</div>
                    <a href="<?php echo $baseURL; ?>/dashboard" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Ana Sayfa</span>
                    </a>
                    <a href="<?php echo $baseURL; ?>/analytics" class="nav-link active">
                        <i class="fas fa-chart-line"></i>
                        <span>Analitikler</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">QR Kodlar</div>
                    <a href="<?php echo $baseURL; ?>/qr-olustur" class="nav-link">
                        <i class="fas fa-plus"></i>
                        <span>Yeni QR Oluştur</span>
                    </a>
                    <a href="<?php echo $baseURL; ?>/qr-listesi" class="nav-link">
                        <i class="fas fa-list"></i>
                        <span>QR Kodlarım</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Hesap</div>
                    <a href="<?php echo $baseURL; ?>/profile" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        <span>Profil</span>
                    </a>
                    <a href="<?php echo $baseURL; ?>/cikis" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Çıkış Yap</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Analytics Header -->
            <div class="analytics-header">
                <h1>
                    <i class="fas fa-chart-line"></i>
                    QR Kod Analitikleri
                </h1>
                <p><?php echo htmlspecialchars($qr['title']); ?> için detaylı analitik veriler ve istatistikler</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-number"><?php echo number_format($analyticsStats['total_scans']); ?></div>
                    <div class="stat-label">Toplam Tarama</div>
                </div>
                
                <div class="stat-card today">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-number" id="todayScans"><?php echo number_format($analyticsStats['today_scans']); ?></div>
                    <div class="stat-label">Bugünkü Tarama</div>
                </div>
                
                <div class="stat-card week">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="stat-number" id="weekScans"><?php echo number_format($analyticsStats['week_scans']); ?></div>
                    <div class="stat-label">Bu Hafta</div>
                </div>

                <div class="stat-card month">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-number" id="monthScans"><?php echo number_format($analyticsStats['month_scans']); ?></div>
                    <div class="stat-label">Bu Ay</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Daily Chart -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-chart-area"></i>
                            Günlük Tarama Trendi
                        </h2>
                    </div>
                    
                    <div class="chart-container">
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>

                <!-- QR Info Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-qrcode"></i>
                            QR Kod Bilgileri
                        </h2>
                    </div>
                    
                    <div style="padding: 2rem;">
                        <div style="margin-bottom: 1.5rem;">
                            <div style="font-weight: 600; margin-bottom: 0.5rem; color: #2d3748;">QR Başlığı</div>
                            <div style="color: #718096;"><?php echo htmlspecialchars($qr['title']); ?></div>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <div style="font-weight: 600; margin-bottom: 0.5rem; color: #2d3748;">QR Türü</div>
                            <div style="color: #718096;"><?php echo ucfirst($qr['type']); ?></div>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <div style="font-weight: 600; margin-bottom: 0.5rem; color: #2d3748;">Oluşturulma Tarihi</div>
                            <div style="color: #718096;"><?php echo date('d.m.Y H:i', strtotime($qr['created_at'])); ?></div>
                        </div>

                        <a href="<?php echo $baseURL; ?>/qr-listesi" class="btn btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-list"></i>
                            Tüm QR Kodlarım
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Loading Indicator -->
            <div id="loadingIndicator" class="loading-indicator hidden">
                <div class="spinner"></div>
                <p>Detaylı analitik veriler yükleniyor...</p>
            </div>
            
            <!-- Error Message -->
            <div id="errorMessage" class="error-message hidden">
                <div class="error-content">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Veri Yükleme Hatası</h3>
                    <p id="errorText">Analitik veriler yüklenirken bir hata oluştu.</p>
                    <button onclick="retryLoad()" class="btn btn-primary">
                        <i class="fas fa-redo"></i> Tekrar Dene
                    </button>
                </div>
            </div>
            
            <!-- Charts Grid -->
            <div class="analytics-grid" id="analyticsGrid">
                <!-- Device Chart -->
                <div class="chart-card">
                    <h3><i class="fas fa-mobile-alt"></i> Cihaz Türü Dağılımı</h3>
                    <div class="chart-wrapper">
                        <canvas id="deviceChart"></canvas>
                    </div>
                </div>
                
                <!-- Browser Chart -->
                <div class="chart-card">
                    <h3><i class="fas fa-globe"></i> Tarayıcı Dağılımı</h3>
                    <div class="chart-wrapper">
                        <canvas id="browserChart"></canvas>
                    </div>
                </div>
                
                <!-- Country Chart -->
                <div class="chart-card">
                    <h3><i class="fas fa-map"></i> Ülke Dağılımı</h3>
                    <div class="chart-wrapper">
                        <canvas id="countryChart"></canvas>
                    </div>
                </div>

                <!-- Time Chart -->
                <div class="chart-card">
                    <h3><i class="fas fa-clock"></i> Saatlik Dağılım</h3>
                    <div class="chart-wrapper">
                        <canvas id="timeChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Detailed Table -->
            <div class="table-card" id="detailedTable">
                <h3><i class="fas fa-table"></i> Son Tarama Kayıtları</h3>
                <div class="table-container">
                    <table id="scansTable">
                        <thead>
                            <tr>
                                <th>Tarih/Saat</th>
                                <th>IP Adresi</th>
                                <th>Ülke</th>
                                <th>Şehir</th>
                                <th>Cihaz</th>
                                <th>Tarayıcı</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- JavaScript ile doldurulacak -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Section -->
            <footer class="dashboard-footer">
                <div class="footer-content">
                    <div class="footer-section">
                        <div class="footer-logo">
                            <i class="fas fa-qrcode"></i>
                            <span>QR-CODE.COM.TR</span>
                        </div>
                        <p>Türkiye'nin en gelişmiş QR kod platformu - Analitikler</p>
                    </div>

                    <div class="footer-section">
                        <h4>Hızlı Linkler</h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo $baseURL; ?>/dashboard">Dashboard</a></li>
                            <li><a href="<?php echo $baseURL; ?>/qr-olustur">QR Oluştur</a></li>
                            <li><a href="<?php echo $baseURL; ?>/qr-listesi">QR Kodlarım</a></li>
                            <li><a href="<?php echo $baseURL; ?>/profile">Profil</a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h4>Destek</h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo $baseURL; ?>/yardim">Yardım</a></li>
                            <li><a href="<?php echo $baseURL; ?>/iletisim">İletişim</a></li>
                            <li><a href="<?php echo $baseURL; ?>/gizlilik">Gizlilik</a></li>
                            <li><a href="<?php echo $baseURL; ?>">Ana Sayfa</a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h4>İletişim</h4>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>info@qr-code.com.tr</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+90 (212) 555 0123</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <p>&copy; <?php echo date('Y'); ?> QR-CODE.COM.TR. Tüm hakları saklıdır.</p>
                        <div class="footer-links-inline">
                            <a href="<?php echo $baseURL; ?>/gizlilik">Gizlilik</a>
                            <a href="<?php echo $baseURL; ?>/kullanim-kosullari">Koşullar</a>
                            <a href="<?php echo $baseURL; ?>/cerez-politikasi">Çerezler</a>
                        </div>
                    </div>
                </div>
            </footer>
        </main>
    </div>

<script>
// Global değişkenler - Null kontrolü ile
const baseURL = '<?php echo $baseURL; ?>' || '/dashboard/qr-code.com.tr';
const qrId = <?php echo json_encode($qr_id); ?> || 1;
const chartData = <?php echo json_encode($analyticsChartData); ?> || [];
const demoData = <?php echo json_encode($demoData); ?> || {};

// Analytics Manager Class - Hata düzeltmeleri ile
class AnalyticsManager {
    constructor() {
        this.qrId = qrId;
        this.charts = {};
        this.sidebar = null;
        this.mobileBtn = null;
        this.isLoading = false;
        this.maxRetries = 3;
        this.currentRetries = 0;
        
        // Safe DOM ready check
        this.initWhenReady();
    }

    initWhenReady() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.init());
        } else {
            // Kısa gecikme ile init - DOM elementlerinin hazır olması için
            setTimeout(() => this.init(), 100);
        }
    }

    async init() {
        try {
            console.log('🚀 Analytics Manager başlatılıyor...');
            
            // DOM elementlerini güvenli şekilde al
            this.sidebar = this.getElement('sidebar');
            this.mobileBtn = this.getElement('mobileMenuBtn');

            // Input validation
            if (!this.qrId) {
                console.warn('⚠️ QR ID bulunamadı, demo veriler kullanılacak');
            }

            // Fonksiyonları sırayla başlat
            await this.setupCharts();
            this.setupMobileMenu();
            this.setupAnimations();
            this.loadDemoData();
            
            console.log('✅ Analytics başarıyla başlatıldı');
        } catch (error) {
            console.error('❌ Analytics başlatma hatası:', error);
            this.showError('Sayfa yüklenirken bir hata oluştu: ' + error.message);
        }
    }

    // Safe element getter
    getElement(id) {
        try {
            return document.getElementById(id);
        } catch (error) {
            console.warn(`⚠️ Element bulunamadı: ${id}`);
            return null;
        }
    }

    // Safe element query
    queryElement(selector) {
        try {
            return document.querySelector(selector);
        } catch (error) {
            console.warn(`⚠️ Selector bulunamadı: ${selector}`);
            return null;
        }
    }

    async setupCharts() {
        try {
            console.log('📊 Chartlar oluşturuluyor...');

            // Paralel chart oluşturma
            const chartPromises = [
                this.createDailyChart(),
                this.createDeviceChart(),
                this.createBrowserChart(),
                this.createCountryChart(),
                this.createTimeChart()
            ];

            await Promise.allSettled(chartPromises);
            console.log('✅ Tüm chartlar oluşturuldu');
        } catch (error) {
            console.error('❌ Chart setup hatası:', error);
        }
    }

    async createDailyChart() {
        return new Promise((resolve) => {
            try {
                const canvas = this.getElement('dailyChart');
                if (!canvas || !canvas.getContext) {
                    console.warn('⚠️ Daily chart canvas bulunamadı');
                    resolve();
                    return;
                }

                const ctx = canvas.getContext('2d');
                
                // Mevcut chart'ı temizle
                if (this.charts.daily) {
                    this.charts.daily.destroy();
                }

                // Safe data mapping
                const labels = chartData?.map(item => {
                    try {
                        const date = new Date(item.scan_date);
                        return date.toLocaleDateString('tr-TR', { month: 'short', day: 'numeric' });
                    } catch (e) {
                        return 'N/A';
                    }
                }) || [];

                const values = chartData?.map(item => item.scan_count || 0) || [];

                this.charts.daily = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Tarama Sayısı',
                            data: values,
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#667eea',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

                resolve();
            } catch (error) {
                console.error('❌ Daily chart oluşturma hatası:', error);
                resolve(); // Hata durumunda da resolve et
            }
        });
    }

    async createDeviceChart() {
        return new Promise((resolve) => {
            try {
                const canvas = this.getElement('deviceChart');
                if (!canvas || !canvas.getContext) {
                    console.warn('⚠️ Device chart canvas bulunamadı');
                    resolve();
                    return;
                }

                const ctx = canvas.getContext('2d');
                
                if (this.charts.device) {
                    this.charts.device.destroy();
                }

                const deviceData = demoData?.deviceTypes || { labels: [], values: [] };

                this.charts.device = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: deviceData.labels || [],
                        datasets: [{
                            data: deviceData.values || [],
                            backgroundColor: ['#667eea', '#10b981', '#f59e0b']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                resolve();
            } catch (error) {
                console.error('❌ Device chart oluşturma hatası:', error);
                resolve();
            }
        });
    }

    async createBrowserChart() {
        return new Promise((resolve) => {
            try {
                const canvas = this.getElement('browserChart');
                if (!canvas || !canvas.getContext) {
                    console.warn('⚠️ Browser chart canvas bulunamadı');
                    resolve();
                    return;
                }

                const ctx = canvas.getContext('2d');
                
                if (this.charts.browser) {
                    this.charts.browser.destroy();
                }

                const browserData = demoData?.browsers || { labels: [], values: [] };

                this.charts.browser = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: browserData.labels || [],
                        datasets: [{
                            data: browserData.values || [],
                            backgroundColor: ['#667eea', '#10b981', '#f59e0b', '#ef4444']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                resolve();
            } catch (error) {
                console.error('❌ Browser chart oluşturma hatası:', error);
                resolve();
            }
        });
    }

    async createCountryChart() {
        return new Promise((resolve) => {
            try {
                const canvas = this.getElement('countryChart');
                if (!canvas || !canvas.getContext) {
                    console.warn('⚠️ Country chart canvas bulunamadı');
                    resolve();
                    return;
                }

                const ctx = canvas.getContext('2d');
                
                if (this.charts.country) {
                    this.charts.country.destroy();
                }

                const countryData = demoData?.countries || { labels: [], values: [] };

                this.charts.country = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: countryData.labels || [],
                        datasets: [{
                            data: countryData.values || [],
                            backgroundColor: '#667eea'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y', // horizontalBar yerine
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                resolve();
            } catch (error) {
                console.error('❌ Country chart oluşturma hatası:', error);
                resolve();
            }
        });
    }

    async createTimeChart() {
        return new Promise((resolve) => {
            try {
                const canvas = this.getElement('timeChart');
                if (!canvas || !canvas.getContext) {
                    console.warn('⚠️ Time chart canvas bulunamadı');
                    resolve();
                    return;
                }

                const ctx = canvas.getContext('2d');
                
                if (this.charts.time) {
                    this.charts.time.destroy();
                }

                const timeData = demoData?.timeData || { labels: [], values: [] };

                this.charts.time = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: timeData.labels || [],
                        datasets: [{
                            label: 'Tarama Sayısı',
                            data: timeData.values || [],
                            borderColor: '#8b5cf6',
                            backgroundColor: 'rgba(139, 92, 246, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                resolve();
            } catch (error) {
                console.error('❌ Time chart oluşturma hatası:', error);
                resolve();
            }
        });
    }

    loadDemoData() {
        try {
            const recentScans = demoData?.recentScans || [];
            this.populateTable(recentScans);
            console.log('✅ Demo veriler yüklendi');
        } catch (error) {
            console.error('❌ Demo veri yükleme hatası:', error);
        }
    }

    populateTable(recentScans) {
        try {
            const tbody = this.queryElement('#scansTable tbody');
            if (!tbody) {
                console.warn('⚠️ Table tbody bulunamadı');
                return;
            }

            tbody.innerHTML = '';
            
            if (!recentScans || recentScans.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; color: #6b7280;">Henüz tarama verisi bulunmuyor</td></tr>';
                return;
            }

            recentScans.forEach((scan, index) => {
                try {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${this.formatDate(scan.scan_time)}</td>
                        <td>${this.escapeHtml(scan.ip_address || '-')}</td>
                        <td>${this.escapeHtml(scan.country || '-')}</td>
                        <td>${this.escapeHtml(scan.city || '-')}</td>
                        <td>${this.escapeHtml(scan.device_type || '-')}</td>
                        <td>${this.escapeHtml(scan.browser || '-')}</td>
                    `;
                    tbody.appendChild(row);
                } catch (rowError) {
                    console.warn(`⚠️ Tablo satırı ${index} oluşturma hatası:`, rowError);
                }
            });
        } catch (error) {
            console.error('❌ Tablo doldurma hatası:', error);
        }
    }

    setupMobileMenu() {
        try {
            const handleResize = () => {
                try {
                    if (window.innerWidth <= 1024) {
                        if (this.mobileBtn) this.mobileBtn.style.display = 'block';
                        if (this.sidebar) this.sidebar.classList.remove('open');
                    } else {
                        if (this.mobileBtn) this.mobileBtn.style.display = 'none';
                        if (this.sidebar) this.sidebar.classList.remove('open');
                    }
                } catch (e) {
                    console.warn('⚠️ Resize handler hatası:', e);
                }
            };

            handleResize();
            window.addEventListener('resize', handleResize);

            // Safe click outside handler
            document.addEventListener('click', (e) => {
                try {
                    if (window.innerWidth <= 1024 && 
                        this.sidebar && this.mobileBtn &&
                        !this.sidebar.contains(e.target) && 
                        !this.mobileBtn.contains(e.target) && 
                        this.sidebar.classList.contains('open')) {
                        this.sidebar.classList.remove('open');
                    }
                } catch (clickError) {
                    console.warn('⚠️ Click handler hatası:', clickError);
                }
            });

            console.log('✅ Mobile menu başarıyla ayarlandı');
        } catch (error) {
            console.error('❌ Mobile menu ayarlama hatası:', error);
        }
    }

    setupAnimations() {
        try {
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        try {
                            if (entry.isIntersecting) {
                                entry.target.style.animationDelay = Math.random() * 0.3 + 's';
                                entry.target.classList.add('fade-in');
                                observer.unobserve(entry.target);
                            }
                        } catch (animError) {
                            console.warn('⚠️ Animasyon entry hatası:', animError);
                        }
                    });
                });

                const elementsToAnimate = document.querySelectorAll('.stat-card, .chart-card, .card');
                elementsToAnimate.forEach(el => {
                    try {
                        observer.observe(el);
                    } catch (observeError) {
                        console.warn('⚠️ Observer hatası:', observeError);
                    }
                });

                console.log('✅ Animasyonlar başarıyla ayarlandı');
            }
        } catch (error) {
            console.error('❌ Animasyon ayarlama hatası:', error);
        }
    }

    // Utility Methods - Safe implementations
    formatDate(dateString) {
        try {
            if (!dateString) return '-';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return '-';
            return date.toLocaleString('tr-TR');
        } catch (error) {
            console.warn('❌ Tarih formatlama hatası:', error);
            return '-';
        }
    }

    escapeHtml(text) {
        try {
            if (!text) return '-';
            const div = document.createElement('div');
            div.textContent = String(text);
            return div.innerHTML;
        } catch (error) {
            console.warn('❌ HTML escape hatası:', error);
            return String(text || '-');
        }
    }

    showError(message) {
        try {
            const errorDiv = this.getElement('errorMessage');
            const errorText = this.getElement('errorText');

            if (errorDiv) errorDiv.classList.remove('hidden');
            if (errorText) errorText.textContent = message;

            console.error('🚨 Hata gösteriliyor:', message);
        } catch (error) {
            console.error('❌ Error gösterme hatası:', error);
        }
    }

    hideError() {
        try {
            const errorDiv = this.getElement('errorMessage');
            if (errorDiv) errorDiv.classList.add('hidden');
        } catch (error) {
            console.warn('⚠️ Error gizleme hatası:', error);
        }
    }

    async retry() {
        try {
            if (this.isLoading) return;
            
            this.currentRetries++;
            if (this.currentRetries > this.maxRetries) {
                this.showError('Maksimum deneme sayısına ulaşıldı. Sayfayı yenileyin.');
                return;
            }

            console.log(`🔄 Yeniden deneme: ${this.currentRetries}/${this.maxRetries}`);
            await this.init();
        } catch (error) {
            console.error('❌ Retry hatası:', error);
        }
    }
}

// Global Functions - Safe implementations
function toggleSidebar() {
    try {
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            sidebar.classList.toggle('open');
        }
    } catch (error) {
        console.error('❌ Sidebar toggle hatası:', error);
    }
}

function retryLoad() {
    try {
        if (window.analyticsManager) {
            window.analyticsManager.retry();
        } else {
            console.log('🔄 Analytics Manager yeniden başlatılıyor...');
            window.analyticsManager = new AnalyticsManager();
        }
    } catch (error) {
        console.error('❌ Retry load hatası:', error);
        window.location.reload(); // Son çare olarak sayfa yenile
    }
}

// Initialize Analytics Manager - Safe initialization
try {
    window.analyticsManager = new AnalyticsManager();
} catch (error) {
    console.error('❌ Analytics Manager başlatma hatası:', error);
}

// Global error handling
window.addEventListener('error', function(e) {
    console.error('❌ JavaScript Global Hatası:', e.error);
});

window.addEventListener('unhandledrejection', function(e) {
    console.error('❌ Promise Hatası:', e.reason);
});

// Debug info
console.log('🚀 Analytics Dashboard yüklendi');
console.log('👤 Kullanıcı: <?php echo addslashes($userName); ?>');
console.log('📊 QR ID: <?php echo $qr_id; ?>');
console.log('🔧 Chart.js Version:', Chart?.version || 'N/A');
</script>

</body>
</html>