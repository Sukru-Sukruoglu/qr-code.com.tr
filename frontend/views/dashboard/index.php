<?php
// Session kontrolü
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Giriş kontrolü
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /dashboard/qr-code.com.tr/giris');
    exit;
}

$userName = $_SESSION['user_name'] ?? 'Kullanıcı';
$userEmail = $_SESSION['user_email'] ?? '';
$userRole = $_SESSION['user_role'] ?? 'user';

$pageTitle = "Dashboard | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';

// Demo veriler - veritabanı yerine
$userQRs = [
    [
        'id' => 1,
        'title' => 'İşletmem Web Sitesi',
        'type' => 'url',
        'scan_count' => 245,
        'is_active' => 1,
        'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
    ],
    [
        'id' => 2,
        'title' => 'WiFi Şifresi - Cafe',
        'type' => 'wifi',
        'scan_count' => 89,
        'is_active' => 1,
        'created_at' => date('Y-m-d H:i:s', strtotime('-1 week'))
    ],
    [
        'id' => 3,
        'title' => 'WhatsApp İletişim',
        'type' => 'whatsapp',
        'scan_count' => 156,
        'is_active' => 1,
        'created_at' => date('Y-m-d H:i:s', strtotime('-2 weeks'))
    ],
    [
        'id' => 4,
        'title' => 'Dijital Kartvizit',
        'type' => 'vcard',
        'scan_count' => 67,
        'is_active' => 1,
        'created_at' => date('Y-m-d H:i:s', strtotime('-1 month'))
    ],
    [
        'id' => 5,
        'title' => 'Restoran Menüsü',
        'type' => 'menu',
        'scan_count' => 312,
        'is_active' => 1,
        'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))
    ]
];

// Demo istatistikler
$stats = [
    'total_qrs' => count($userQRs),
    'total_scans' => array_sum(array_column($userQRs, 'scan_count')),
    'today_qrs' => 2,
    'week_qrs' => 4
];

// Demo chart verisi - son 7 gün
$chartData = [
    ['scan_date' => date('Y-m-d', strtotime('-6 days')), 'scan_count' => 15],
    ['scan_date' => date('Y-m-d', strtotime('-5 days')), 'scan_count' => 23],
    ['scan_date' => date('Y-m-d', strtotime('-4 days')), 'scan_count' => 18],
    ['scan_date' => date('Y-m-d', strtotime('-3 days')), 'scan_count' => 31],
    ['scan_date' => date('Y-m-d', strtotime('-2 days')), 'scan_count' => 27],
    ['scan_date' => date('Y-m-d', strtotime('-1 day')), 'scan_count' => 19],
    ['scan_date' => date('Y-m-d'), 'scan_count' => 12],
];

// QR türü ikonu helper fonksiyonu
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

        .welcome-section {
            background: rgba(255,255,255,0.9);
            padding: 3rem;
            border-radius: 24px;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .quick-actions {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-top: 2rem;
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

        .btn-outline {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
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
            margin-bottom: 2rem;
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

        .qr-list {
            padding: 1rem 0;
        }

        .qr-item {
            display: flex;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: background 0.3s ease;
        }

        .qr-item:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        .qr-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1.5rem;
        }

        .qr-info {
            flex: 1;
        }

        .qr-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .qr-meta {
            font-size: 0.9rem;
            color: #718096;
            display: flex;
            gap: 1rem;
        }

        .qr-type {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        .qr-stats {
            text-align: right;
        }

        .scan-count {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
        }

        .scan-label {
            font-size: 0.8rem;
            color: #718096;
        }

        .chart-container {
            position: relative;
            height: 300px;
            padding: 2rem;
        }

        /* QR Types Section */
        .qr-types-section {
            background: rgba(255,255,255,0.9);
            border-radius: 24px;
            padding: 3rem 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            margin-bottom: 3rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-header p {
            color: #718096;
            font-size: 1.1rem;
        }

        /* QR Grid */
        .qr-types-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .qr-type-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .qr-type-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .qr-type-card:hover::before {
            transform: scaleX(1);
        }

        .qr-type-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
        }

        .type-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: all 0.3s ease;
        }

        .qr-type-card:hover .type-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .type-icon i {
            font-size: 2.2rem;
            color: white;
        }

        .qr-type-card h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.75rem;
        }

        .qr-type-card p {
            color: #718096;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        /* Category sections */
        .qr-category {
            margin-bottom: 4rem;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .category-title::before {
            content: '';
            width: 4px;
            height: 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        /* Badge Styles */
        .card-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
        }

        .card-badge.popular { background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%); }
        .card-badge.trending { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .card-badge.business { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }
        .card-badge.social { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
        .card-badge.restaurant { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
        .card-badge.location { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); }

        /* Sub Category Styles */
        .sub-category {
            margin-bottom: 3rem;
        }

        .sub-category-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 1.5rem;
            padding-left: 1rem;
            border-left: 4px solid #667eea;
        }

        /* Compact Grid */
        .qr-types-grid.compact {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .qr-type-card.compact {
            padding: 1.5rem;
        }

        .qr-type-card.compact .type-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
        }

        .qr-type-card.compact .type-icon i {
            font-size: 1.8rem;
        }

        .qr-type-card.compact h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .qr-type-card.compact p {
            font-size: 0.85rem;
        }

        /* Brand Color Effects */
        .qr-type-card.facebook:hover .type-icon { background: linear-gradient(135deg, #1877f2 0%, #1560d3 100%); }
        .qr-type-card.instagram:hover .type-icon { background: linear-gradient(135deg, #e4405f 0%, #fd5949 100%); }
        .qr-type-card.twitter:hover .type-icon { background: linear-gradient(135deg, #1da1f2 0%, #0d8bd9 100%); }
        .qr-type-card.linkedin:hover .type-icon { background: linear-gradient(135deg, #0077b5 0%, #005885 100%); }
        .qr-type-card.youtube:hover .type-icon { background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); }
        .qr-type-card.business:hover .type-icon { background: linear-gradient(135deg, #059669 0%, #047857 100%); }
        .qr-type-card.coupon:hover .type-icon { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
        .qr-type-card.app:hover .type-icon { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
        .qr-type-card.social-pack:hover .type-icon { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }

        /* Large Button */
        .btn-large {
            padding: 1.2rem 3rem;
            font-size: 1.1rem;
            border-radius: 16px;
        }

        .btn-large small {
            display: block;
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 0.25rem;
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
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
            }
            
            .qr-types-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
            }
            
            .qr-types-section {
                padding: 2rem 1rem;
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
            
            .welcome-section {
                padding: 2rem 1rem;
            }
            
            .welcome-section h1 {
                font-size: 2rem;
            }
            
            .quick-actions {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }
            
            .stat-card {
                padding: 1.5rem;
            }
            
            .qr-types-grid, .qr-types-grid.compact {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .section-header h2 {
                font-size: 1.6rem;
            }
            
            .type-icon {
                width: 70px;
                height: 70px;
            }
            
            .type-icon i {
                font-size: 2rem;
            }
            
            .qr-item {
                padding: 1rem;
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            .qr-icon {
                margin-right: 0;
            }
            
            .qr-meta {
                justify-content: center;
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
            
            .welcome-section h1 {
                font-size: 1.8rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .card-header {
                padding: 1.5rem 1rem 0.5rem;
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .chart-container {
                padding: 1rem;
                height: 250px;
            }
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
                <a href="<?php echo $baseURL; ?>/dashboard" class="nav-link active">
                    <i class="fas fa-home"></i>
                    <span>Ana Sayfa</span>
                </a>
                <a href="<?php echo $baseURL; ?>/analytics" class="nav-link">
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
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Merhaba, <?php echo htmlspecialchars($userName); ?>! 👋</h1>
            <p>QR kod dashboard'unuza hoş geldiniz. Burada QR kodlarınızı oluşturabilir, yönetebilir ve analitiklerini görüntüleyebilirsiniz.</p>
            
            <div class="quick-actions">
                <a href="<?php echo $baseURL; ?>/qr-olustur" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Yeni QR Oluştur
                </a>
                <a href="<?php echo $baseURL; ?>/analytics" class="btn btn-outline">
                    <i class="fas fa-chart-line"></i>
                    Analitikler
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-qrcode"></i>
                </div>
                <div class="stat-number"><?php echo number_format($stats['total_qrs']); ?></div>
                <div class="stat-label">Toplam QR Kod</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-number"><?php echo number_format($stats['total_scans']); ?></div>
                <div class="stat-label">Toplam Tarama</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-number"><?php echo number_format($stats['today_qrs']); ?></div>
                <div class="stat-label">Bugün Oluşturulan</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <div class="stat-number"><?php echo number_format($stats['week_qrs']); ?></div>
                <div class="stat-label">Bu Hafta</div>
            </div>
        </div>
       <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent QR Codes -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-clock"></i>
                        Son QR Kodlarım
                    </h2>
                    <a href="<?php echo $baseURL; ?>/qr-listesi" class="btn btn-outline" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;">
                        Tümünü Gör
                    </a>
                </div>
                
                <div class="qr-list">
                    <?php foreach (array_slice($userQRs, 0, 5) as $qr): ?>
                        <div class="qr-item">
                            <div class="qr-icon">
                                <i class="fas fa-<?php echo getQRIcon($qr['type']); ?>"></i>
                            </div>
                            <div class="qr-info">
                                <div class="qr-title">
                                    <?php echo htmlspecialchars($qr['title']); ?>
                                </div>
                                <div class="qr-meta">
                                    <span class="qr-type">
                                        <?php echo getQRTypeName($qr['type']); ?>
                                    </span>
                                    <span><?php echo date('d.m.Y', strtotime($qr['created_at'])); ?></span>
                                </div>
                            </div>
                            <div class="qr-stats">
                                <div class="scan-count"><?php echo number_format($qr['scan_count']); ?></div>
                                <div class="scan-label">tarama</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Chart -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-chart-area"></i>
                        Son 7 Gün Taramalar
                    </h2>
                </div>
                
                <div class="chart-container">
                    <canvas id="scanChart"></canvas>
                </div>
            </div>
        </div>

        <!-- QR Types Section -->
        <div class="qr-types-section">
            <div class="section-header">
                <h2>📱 Her Duruma Özel QR Çözümleri</h2>
                <p>İhtiyacınıza uygun QR kod türünü seçin - 21 farklı kategoride profesyonel çözümler</p>
            </div>

            <!-- En Popüler QR Türleri -->
            <div class="qr-category">
                <h3 class="category-title">⭐ En Popüler QR Türleri</h3>
                <div class="qr-types-grid">
                    <div class="qr-type-card" onclick="redirectToQR('url')">
                        <div class="type-icon">
                            <i class="fas fa-link"></i>
                        </div>
                        <h3>URL QR Kodu</h3>
                        <p>Web sitelerine hızlı erişim</p>
                        <div class="card-badge popular">En Popüler</div>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('wifi')">
                        <div class="type-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h3>Wi-Fi QR Kodu</h3>
                        <p>Wi-Fi ağlarına kolay bağlantı</p>
                        <div class="card-badge trending">Çok Kullanılan</div>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('vcard')">
                        <div class="type-icon">
                            <i class="fas fa-address-card"></i>
                        </div>
                        <h3>vCard QR Kodu</h3>
                        <p>Dijital kartvizit paylaşımı</p>
                        <div class="card-badge business">İş Dünyası</div>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('whatsapp')">
                        <div class="type-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h3>WhatsApp QR Kodu</h3>
                        <p>WhatsApp mesaj gönderme</p>
                        <div class="card-badge social">Sosyal</div>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('menu')">
                        <div class="type-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3>Menü QR Kodu</h3>
                        <p>Restoran menüsü paylaşımı</p>
                        <div class="card-badge restaurant">Restoran</div>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('location')">
                        <div class="type-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Konum QR Kodu</h3>
                        <p>Konum paylaşımı</p>
                        <div class="card-badge location">Navigasyon</div>
                    </div>
                </div>
            </div>

            <!-- İletişim & Medya QR Türleri -->
            <div class="qr-category">
                <h3 class="category-title">📋 İletişim & Medya QR Türleri</h3>
                <div class="qr-types-grid">
                    <div class="qr-type-card" onclick="redirectToQR('text')">
                        <div class="type-icon">
                            <i class="fas fa-file-text"></i>
                        </div>
                        <h3>Metin QR Kodu</h3>
                        <p>Metinleri QR koda dönüştür</p>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('email')">
                        <div class="type-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>E-posta QR Kodu</h3>
                        <p>E-posta gönderimi için QR</p>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('phone')">
                        <div class="type-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3>Telefon QR Kodu</h3>
                        <p>Telefon numarası paylaşımı</p>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('sms')">
                        <div class="type-icon">
                            <i class="fas fa-sms"></i>
                        </div>
                        <h3>SMS QR Kodu</h3>
                        <p>SMS mesajı gönderim</p>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('pdf')">
                        <div class="type-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3>PDF QR Kodu</h3>
                        <p>PDF dosyası paylaşımı</p>
                    </div>

                    <div class="qr-type-card" onclick="redirectToQR('image')">
                        <div class="type-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <h3>Görsel QR Kodu</h3>
                        <p>Resim galerisi paylaşımı</p>
                    </div>
                </div>
            </div>

            <!-- Gelişmiş QR Kategorileri -->
            <div class="qr-category">
                <h3 class="category-title">🚀 Gelişmiş QR Kategorileri</h3>
                
                <!-- Sosyal Medya Alt Kategorisi -->
                <div class="sub-category">
                    <h4 class="sub-category-title">Sosyal Medya</h4>
                    <div class="qr-types-grid compact">
                        <div class="qr-type-card compact facebook" onclick="redirectToQR('facebook')">
                            <div class="type-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <h3>Facebook</h3>
                            <p>Facebook profil paylaşımı</p>
                        </div>

                        <div class="qr-type-card compact instagram" onclick="redirectToQR('instagram')">
                            <div class="type-icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <h3>Instagram</h3>
                            <p>Instagram hesap bağlantısı</p>
                        </div>

                        <div class="qr-type-card compact twitter" onclick="redirectToQR('twitter')">
                            <div class="type-icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <h3>Twitter</h3>
                            <p>Twitter profil linkı</p>
                        </div>

                        <div class="qr-type-card compact linkedin" onclick="redirectToQR('linkedin')">
                            <div class="type-icon">
                                <i class="fab fa-linkedin"></i>
                            </div>
                            <h3>LinkedIn</h3>
                            <p>LinkedIn profil bağlantısı</p>
                        </div>

                        <div class="qr-type-card compact youtube" onclick="redirectToQR('youtube')">
                            <div class="type-icon">
                                <i class="fab fa-youtube"></i>
                            </div>
                            <h3>YouTube</h3>
                            <p>YouTube kanal linkı</p>
                        </div>
                    </div>
                </div>

                <!-- İş & Ticaret Alt Kategorisi -->
                <div class="sub-category">
                    <h4 class="sub-category-title">İş & Ticaret</h4>
                    <div class="qr-types-grid compact">
                        <div class="qr-type-card compact business" onclick="redirectToQR('business')">
                            <div class="type-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3>İşletme</h3>
                            <p>İşletme bilgileri</p>
                        </div>

                        <div class="qr-type-card compact coupon" onclick="redirectToQR('coupon')">
                            <div class="type-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h3>Kupon</h3>
                            <p>İndirim kuponları</p>
                        </div>

                        <div class="qr-type-card compact app" onclick="redirectToQR('app')">
                            <div class="type-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3>Uygulama</h3>
                            <p>Mobil uygulama linkı</p>
                        </div>

                        <div class="qr-type-card compact social-pack" onclick="redirectToQR('social-pack')">
                            <div class="type-icon">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <h3>Sosyal Paket</h3>
                            <p>Tüm sosyal medya linkları</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tüm Türleri Gör Butonu -->
            <div style="text-align: center; margin-top: 3rem;">
                <a href="<?php echo $baseURL; ?>/qr-turleri" class="btn btn-primary btn-large">
                    <i class="fas fa-th-large"></i>
                    <span>Tüm QR Türlerini Keşfet</span>
                    <small>21 Farklı Kategori</small>
                </a>
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
                    <p>Türkiye'nin en gelişmiş QR kod platformu</p>
                </div>

                <div class="footer-section">
                    <h4>Hızlı Linkler</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo $baseURL; ?>/qr-olustur">QR Oluştur</a></li>
                        <li><a href="<?php echo $baseURL; ?>/qr-listesi">QR Kodlarım</a></li>
                        <li><a href="<?php echo $baseURL; ?>/analytics">Analytics</a></li>
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
// Global değişkenler
const baseURL = '<?php echo $baseURL; ?>';
const chartData = <?php echo json_encode($chartData); ?>;

// Dashboard Class
class Dashboard {
    constructor() {
        this.sidebar = null;
        this.mobileBtn = null;
        this.chart = null;
        
        // DOM yüklendikten sonra initialize et
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.init());
        } else {
            this.init();
        }
    }

    init() {
        try {
            // DOM elementlerini al
            this.sidebar = document.getElementById('sidebar');
            this.mobileBtn = document.getElementById('mobileMenuBtn');

            // Fonksiyonları başlat
            this.setupChart();
            this.setupMobileMenu();
            this.setupAnimations();
            this.logInitialization();
            
            console.log('✅ Dashboard başarıyla başlatıldı');
        } catch (error) {
            console.error('❌ Dashboard başlatma hatası:', error);
        }
    }

    setupChart() {
        try {
            const canvas = document.getElementById('scanChart');
            if (!canvas) {
                console.warn('⚠️ Chart canvas bulunamadı');
                return;
            }

            const ctx = canvas.getContext('2d');

            this.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.map(item => {
                        const date = new Date(item.scan_date);
                        return date.toLocaleDateString('tr-TR', { month: 'short', day: 'numeric' });
                    }),
                    datasets: [{
                        label: 'Tarama Sayısı',
                        data: chartData.map(item => item.scan_count),
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

            console.log('✅ Chart başarıyla oluşturuldu');
        } catch (error) {
            console.error('❌ Chart oluşturma hatası:', error);
        }
    }

    setupMobileMenu() {
        try {
            // Resize event listener
            const handleResize = () => {
                if (window.innerWidth <= 1024) {
                    if (this.mobileBtn) this.mobileBtn.style.display = 'block';
                    if (this.sidebar) this.sidebar.classList.remove('open');
                } else {
                    if (this.mobileBtn) this.mobileBtn.style.display = 'none';
                    if (this.sidebar) this.sidebar.classList.remove('open');
                }
            };

            // İlk kontrol
            handleResize();

            // Event listeners
            window.addEventListener('resize', handleResize);

            // Sidebar dışına tıklandığında kapat
            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 1024 && 
                    this.sidebar && this.mobileBtn &&
                    !this.sidebar.contains(e.target) && 
                    !this.mobileBtn.contains(e.target) && 
                    this.sidebar.classList.contains('open')) {
                    this.sidebar.classList.remove('open');
                }
            });

            console.log('✅ Mobile menu başarıyla ayarlandı');
        } catch (error) {
            console.error('❌ Mobile menu ayarlama hatası:', error);
        }
    }

    setupAnimations() {
        try {
            // Intersection Observer destekleniyorsa animasyonları etkinleştir
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.animationDelay = Math.random() * 0.3 + 's';
                            entry.target.classList.add('fade-in');
                            observer.unobserve(entry.target);
                        }
                    });
                });

                // Animasyon eklenecek elementleri gözlemle
                const elementsToAnimate = document.querySelectorAll('.stat-card, .qr-type-card');
                elementsToAnimate.forEach(el => {
                    observer.observe(el);
                });

                console.log('✅ Animasyonlar başarıyla ayarlandı');
            }
        } catch (error) {
            console.error('❌ Animasyon ayarlama hatası:', error);
        }
    }

    logInitialization() {
        console.log('🎉 Dashboard yüklendi');
        console.log('👤 Kullanıcı: <?php echo addslashes($userName); ?>');
        console.log('📊 Toplam QR: <?php echo $stats["total_qrs"]; ?>');
        console.log('👀 Toplam Tarama: <?php echo $stats["total_scans"]; ?>');
    }
}

// Global fonksiyonlar
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

function redirectToQR(type) {
    try {
        if (type && baseURL) {
            window.location.href = `${baseURL}/qr-olustur?type=${encodeURIComponent(type)}`;
        } else {
            console.error('❌ QR yönlendirme hatası: Geçersiz parametreler');
        }
    } catch (error) {
        console.error('❌ QR yönlendirme hatası:', error);
    }
}

// Dashboard'ı başlat
const dashboard = new Dashboard();

// CSS animasyonları
const style = document.createElement('style');
style.textContent = `
    .fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
    }