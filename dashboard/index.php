<?php
session_start();
$pageTitle = "Dashboard | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';

// Kullanıcı oturum kontrolü
if (!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) {
    // Demo kullanıcı bilgileri
    $_SESSION['user_id'] = 1;
    $_SESSION['username'] = 'demo_user';
    $_SESSION['user_email'] = 'demo@qr-code.com.tr';
    $_SESSION['user_role'] = 'user';
}

$userName = $_SESSION['username'] ?? $_SESSION['user_name'] ?? 'Kullanıcı';
$userEmail = $_SESSION['email'] ?? $_SESSION['user_email'] ?? '';
$userRole = $_SESSION['user_role'] ?? 'user';

// Veritabanı bağlantısı
$pdo = null;
$connectionStatus = 'demo';

// Demo veriler
$totalQRCodes = 23;
$totalScans = 1847;
$thisMonthScans = 156;
$activeCodes = 18;

$recentActivity = [
    [
        'id' => 1,
        'title' => 'Website QR Kodu',
        'type' => 'url',
        'scans' => 45,
        'created_at' => '2024-06-01 10:30:00',
        'last_scan' => '2024-06-08 14:22:00'
    ],
    [
        'id' => 2,
        'title' => 'İletişim QR Kodu',
        'type' => 'vcard',
        'scans' => 32,
        'created_at' => '2024-06-03 16:15:00',
        'last_scan' => '2024-06-08 09:45:00'
    ],
    [
        'id' => 3,
        'title' => 'WiFi QR Kodu',
        'type' => 'wifi',
        'scans' => 28,
        'created_at' => '2024-06-05 11:20:00',
        'last_scan' => '2024-06-07 18:30:00'
    ]
];

$popularQRCodes = [
    [
        'id' => 1,
        'title' => 'Ana Website',
        'type' => 'url',
        'scans' => 245,
        'trend' => '+12%'
    ],
    [
        'id' => 2,
        'title' => 'Instagram Profil',
        'type' => 'url',
        'scans' => 189,
        'trend' => '+8%'
    ],
    [
        'id' => 3,
        'title' => 'Menü QR',
        'type' => 'url',
        'scans' => 156,
        'trend' => '+15%'
    ]
];
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
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --text-primary: #1a202c;
            --text-muted: #718096;
            --bg-primary: #ffffff;
            --bg-secondary: #f7fafc;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --sidebar-width: 280px;
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

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        .logo i {
            font-size: 2rem;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem;
            border-radius: 12px;
        }

        .nav-menu {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: var(--radius-lg);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 2rem;
        }

        .top-bar {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-xl);
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-text h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .welcome-text p {
            color: var(--text-muted);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .stat-icon.primary { background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); }
        .stat-icon.success { background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%); }
        .stat-icon.warning { background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%); }
        .stat-icon.info { background: linear-gradient(135deg, var(--info-color) 0%, #2563eb 100%); }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.875rem;
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
            backdrop-filter: blur(20px);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(255,255,255,0.2);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .card-body {
            padding: 1.5rem 2rem;
        }

        /* Activity List */
        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .activity-content h4 {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .activity-content p {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .activity-stats {
            margin-left: auto;
            text-align: right;
        }

        .activity-stats .scans {
            font-weight: 600;
            color: var(--success-color);
        }

        .activity-stats .time {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            padding: 2rem;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-xl);
            text-decoration: none;
            color: var(--text-primary);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            color: var(--text-primary);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        }

        .action-title {
            font-weight: 600;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo $baseURL; ?>/dashboard" class="logo">
                <i class="fas fa-qrcode"></i>
                <span>QR-CODE</span>
            </a>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="<?php echo $baseURL; ?>/dashboard" class="nav-link active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="<?php echo $baseURL; ?>/qr-olustur" class="nav-link">
                    <i class="fas fa-plus"></i>
                    <span>QR Oluştur</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="<?php echo $baseURL; ?>/qr-listesi" class="nav-link">
                    <i class="fas fa-list"></i>
                    <span>QR Kodlarım</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="<?php echo $baseURL; ?>/analytics" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Analitikler</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="<?php echo $baseURL; ?>/frontend/views/profile" class="nav-link">
                    <i class="fas fa-user"></i>
                    <span>Profil</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="<?php echo $baseURL; ?>/pages/features" class="nav-link">
                    <i class="fas fa-star"></i>
                    <span>Özellikler</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="<?php echo $baseURL; ?>/pages/contact" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    <span>İletişim</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="<?php echo $baseURL; ?>/cikis" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Çıkış</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="welcome-text">
                <h1>Hoş Geldiniz, <?php echo htmlspecialchars($userName); ?>!</h1>
                <p>QR kod yönetim panelinize hoş geldiniz</p>
            </div>
            
            <div class="user-menu">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($userName, 0, 1)); ?>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon primary">
                        <i class="fas fa-qrcode"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo $totalQRCodes; ?></div>
                <div class="stat-label">Toplam QR Kod</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon success">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($totalScans); ?></div>
                <div class="stat-label">Toplam Tarama</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon info">
                        <i class="fas fa-calendar-month"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo $thisMonthScans; ?></div>
                <div class="stat-label">Bu Ay Tarama</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon warning">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo $activeCodes; ?></div>
                <div class="stat-label">Aktif Kodlar</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="<?php echo $baseURL; ?>/qr-olustur" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-title">Yeni QR Oluştur</div>
            </a>

            <a href="<?php echo $baseURL; ?>/qr-listesi" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="action-title">QR Kodlarım</div>
            </a>

            <a href="<?php echo $baseURL; ?>/analytics" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="action-title">Analitikler</div>
            </a>

            <a href="<?php echo $baseURL; ?>/frontend/views/profile" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="action-title">Ayarlar</div>
            </a>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Son Aktiviteler</h3>
                    <a href="<?php echo $baseURL; ?>/qr-listesi" class="btn-link">Tümünü Gör</a>
                </div>
                <div class="card-body">
                    <?php foreach ($recentActivity as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon <?php echo $activity['type'] === 'url' ? 'primary' : ($activity['type'] === 'vcard' ? 'success' : 'info'); ?>">
                                <i class="fas fa-<?php echo $activity['type'] === 'url' ? 'link' : ($activity['type'] === 'vcard' ? 'address-card' : 'wifi'); ?>"></i>
                            </div>
                            <div class="activity-content">
                                <h4><?php echo htmlspecialchars($activity['title']); ?></h4>
                                <p>Oluşturulma: <?php echo date('d.m.Y H:i', strtotime($activity['created_at'])); ?></p>
                            </div>
                            <div class="activity-stats">
                                <div class="scans"><?php echo $activity['scans']; ?> tarama</div>
                                <div class="time">Son: <?php echo date('d.m H:i', strtotime($activity['last_scan'])); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Popular QR Codes -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Popüler QR Kodlar</h3>
                </div>
                <div class="card-body">
                    <?php foreach ($popularQRCodes as $qr): ?>
                        <div class="activity-item">
                            <div class="activity-icon success">
                                <i class="fas fa-fire"></i>
                            </div>
                            <div class="activity-content">
                                <h4><?php echo htmlspecialchars($qr['title']); ?></h4>
                                <p><?php echo $qr['scans']; ?> tarama</p>
                            </div>
                            <div class="activity-stats">
                                <div class="scans" style="color: var(--success-color);"><?php echo $qr['trend']; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </main>

    <?php include_once __DIR__ . '/../includes/footer.php'; ?>

    <script>
        // Dashboard JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.createElement('button');
            toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
            toggleBtn.className = 'mobile-toggle';
            toggleBtn.style.cssText = `
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
                background: var(--primary-color);
                color: white;
                border: none;
                padding: 0.75rem;
                border-radius: 8px;
                display: none;
                cursor: pointer;
            `;

            document.body.appendChild(toggleBtn);

            function checkMobile() {
                if (window.innerWidth <= 768) {
                    toggleBtn.style.display = 'block';
                } else {
                    toggleBtn.style.display = 'none';
                    sidebar.classList.remove('active');
                }
            }

            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 768 && 
                    !sidebar.contains(e.target) && 
                    !toggleBtn.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            });

            window.addEventListener('resize', checkMobile);
            checkMobile();

            // Animate stats on load
            const statValues = document.querySelectorAll('.stat-value');
            statValues.forEach(stat => {
                const finalValue = parseInt(stat.textContent.replace(/,/g, ''));
                stat.textContent = '0';
                
                let currentValue = 0;
                const increment = finalValue / 50;
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        currentValue = finalValue;
                        clearInterval(timer);
                    }
                    stat.textContent = Math.floor(currentValue).toLocaleString();
                }, 30);
            });
        });
    </script>

</body>
</html>