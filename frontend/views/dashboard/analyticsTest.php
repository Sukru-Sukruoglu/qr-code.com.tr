<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analitikler | QR-CODE.COM.TR</title>
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
            background: none;
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
                <a href="#" class="sidebar-logo">
                    <i class="fas fa-qrcode"></i>
                    <span>QR-CODE.COM.TR</span>
                </a>
                
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-name">Ahmet Yılmaz</div>
                    <div class="user-email">ahmet@example.com</div>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Dashboard</div>
                    <a href="#" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Ana Sayfa</span>
                    </a>
                    <a href="#" class="nav-link active">
                        <i class="fas fa-chart-line"></i>
                        <span>Analitikler</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">QR Kodlar</div>
                    <a href="#" class="nav-link">
                        <i class="fas fa-plus"></i>
                        <span>Yeni QR Oluştur</span>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-list"></i>
                        <span>QR Kodlarım</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Hesap</div>
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        <span>Profil</span>
                    </a>
                    <a href="#" class="nav-link">
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
                <p>İşletmem Web Sitesi için detaylı analitik veriler ve istatistikler</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-number">245</div>
                    <div class="stat-label">Toplam Tarama</div>
                </div>
                
                <div class="stat-card today">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-number" id="todayScans">12</div>
                    <div class="stat-label">Bugünkü Tarama</div>
                </div>
                
                <div class="stat-card week">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="stat-number" id="weekScans">89</div>
                    <div class="stat-label">Bu Hafta</div>
                </div>

                <div class="stat-card month">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-number" id="monthScans">235</div>
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
                            <div style="color: #718096;">İşletmem Web Sitesi</div>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <div style="font-weight: 600; margin-bottom: 0.5rem; color: #2d3748;">QR Türü</div>
                            <div style="color: #718096;">URL</div>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <div style="font-weight: 600; margin-bottom: 0.5rem; color: #2d3748;">Oluşturulma Tarihi</div>
                            <div style="color: #718096;">03.06.2025 14:30</div>
                        </div>

                        <a href="#" class="btn btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-list"></i>
                            Tüm QR Kodlarım
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Loading Indicator -->
            <div id="loadingIndicator" class="loading-indicator" style="display: none;">
                <div class="spinner"></div>
                <p>Detaylı analitik veriler yükleniyor...</p>
            </div>
            
            <!-- Error Message -->
            <div id="errorMessage" class="error-message" style="display: none;">
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
                        <tbody id="scansTableBody">
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
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">QR Oluştur</a></li>
                            <li><a href="#">QR Kodlarım</a></li>
                            <li><a href="#">Profil</a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h4>Destek</h4>
                        <ul class="footer-links">
                            <li><a href="#">Yardım</a></li>
                            <li><a href="#">İletişim</a></li>
                            <li><a href="#">Gizlilik</a></li>
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
                                <span>+90 212 555 0123</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>İstanbul, Türkiye</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <p>&copy; 2025 QR-CODE.COM.TR. Tüm hakları saklıdır.</p>
                        <div class="footer-links-inline">
                            <a href="#">Kullanım Koşulları</a>
                            <a href="#">Gizlilik Politikası</a>
                            <a href="#">Çerez Politikası</a>
                        </div>
                    </div>
                </div>
            </footer>
        </main>
    </div>

    <script>
        // Global değişkenler
        let charts = {};
        let isLoading = false;

        // Demo veriler
        const demoData = {
            dailyScans: [
                { date: '2025-05-31', scans: 15 },
                { date: '2025-06-01', scans: 23 },
                { date: '2025-06-02', scans: 18 },
                { date: '2025-06-03', scans: 31 },
                { date: '2025-06-04', scans: 27 },
                { date: '2025-06-05', scans: 19 },
                { date: '2025-06-06', scans: 12 }
            ],
            deviceData: {
                labels: ['Mobil', 'Masaüstü', 'Tablet'],
                data: [65, 25, 10],
                colors: ['#667eea', '#764ba2', '#f59e0b']
            },
            browserData: {
                labels: ['Chrome', 'Safari', 'Firefox', 'Edge', 'Diğer'],
                data: [45, 30, 15, 8, 2],
                colors: ['#667eea', '#764ba2', '#f59e0b', '#10b981', '#ef4444']
            },
            countryData: {
                labels: ['Türkiye', 'Almanya', 'İngiltere', 'Fransa', 'Diğer'],
                data: [70, 12, 8, 6, 4],
                colors: ['#667eea', '#764ba2', '#f59e0b', '#10b981', '#ef4444']
            },
            timeData: {
                labels: ['00-06', '06-12', '12-18', '18-24'],
                data: [5, 35, 45, 15],
                colors: ['#667eea', '#764ba2', '#f59e0b', '#10b981']
            },
            scanRecords: [
                {
                    datetime: '2025-06-06 14:23:45',
                    ip: '192.168.1.***',
                    country: 'Türkiye',
                    city: 'İstanbul',
                    device: 'iPhone',
                    browser: 'Safari'
                },
                {
                    datetime: '2025-06-06 13:45:12',
                    ip: '10.0.0.***',
                    country: 'Türkiye',
                    city: 'Ankara',
                    device: 'Android',
                    browser: 'Chrome'
                },
                {
                    datetime: '2025-06-06 12:30:28',
                    ip: '172.16.0.***',
                    country: 'Almanya',
                    city: 'Berlin',
                    device: 'Windows',
                    browser: 'Firefox'
                },
                {
                    datetime: '2025-06-06 11:15:33',
                    ip: '192.168.2.***',
                    country: 'Türkiye',
                    city: 'İzmir',
                    device: 'iPad',
                    browser: 'Safari'
                },
                {
                    datetime: '2025-06-06 10:45:07',
                    ip: '10.1.1.***',
                    country: 'İngiltere',
                    city: 'Londra',
                    device: 'Android',
                    browser: 'Chrome'
                }
            ]
        };

        // Sidebar toggle fonksiyonu
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const btn = document.getElementById('mobileMenuBtn');
            
            sidebar.classList.toggle('open');
            
            if (sidebar.classList.contains('open')) {
                btn.innerHTML = '<i class="fas fa-times"></i>';
            } else {
                btn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        }

        // Sidebar dışına tıklandığında kapat
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const btn = document.getElementById('mobileMenuBtn');
            
            if (window.innerWidth <= 1024 && 
                !sidebar.contains(event.target) && 
                !btn.contains(event.target) && 
                sidebar.classList.contains('open')) {
                toggleSidebar();
            }
        });

        // Günlük chart oluştur
        function createDailyChart() {
            const ctx = document.getElementById('dailyChart');
            if (!ctx) return;

            const labels = demoData.dailyScans.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('tr-TR', { 
                    month: 'short', 
                    day: 'numeric' 
                });
            });

            const data = demoData.dailyScans.map(item => item.scans);

            charts.daily = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Günlük Taramalar',
                        data: data,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#667eea',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                color: '#718096'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#718096'
                            }
                        }
                    },
                    elements: {
                        point: {
                            hoverBackgroundColor: '#667eea'
                        }
                    }
                }
            });
        }

        // Pie chart oluştur (genel fonksiyon)
        function createPieChart(canvasId, data, title) {
            const ctx = document.getElementById(canvasId);
            if (!ctx) return;

            charts[canvasId] = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.data,
                        backgroundColor: data.colors,
                        borderWidth: 0,
                        hoverBorderWidth: 2,
                        hoverBorderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                color: '#718096',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#667eea',
                            borderWidth: 1,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.raw / total) * 100).toFixed(1);
                                    return `${context.label}: ${percentage}%`;
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    elements: {
                        arc: {
                            borderWidth: 0
                        }
                    }
                }
            });
        }

        // Tablo doldur
        function populateTable() {
            const tbody = document.getElementById('scansTableBody');
            if (!tbody) return;

            tbody.innerHTML = '';

            demoData.scanRecords.forEach(record => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${record.datetime}</td>
                    <td>${record.ip}</td>
                    <td>${record.country}</td>
                    <td>${record.city}</td>
                    <td>${record.device}</td>
                    <td>${record.browser}</td>
                `;
                tbody.appendChild(row);
            });
        }

        // Loading göster/gizle
        function showLoading() {
            document.getElementById('loadingIndicator').style.display = 'block';
            document.getElementById('analyticsGrid').style.display = 'none';
            document.getElementById('detailedTable').style.display = 'none';
        }

        function hideLoading() {
            document.getElementById('loadingIndicator').style.display = 'none';
            document.getElementById('analyticsGrid').style.display = 'grid';
            document.getElementById('detailedTable').style.display = 'block';
        }

        // Hata göster
        function showError(message = 'Analitik veriler yüklenirken bir hata oluştu.') {
            document.getElementById('errorText').textContent = message;
            document.getElementById('errorMessage').style.display = 'block';
            document.getElementById('analyticsGrid').style.display = 'none';
            document.getElementById('detailedTable').style.display = 'none';
        }

        function hideError() {
            document.getElementById('errorMessage').style.display = 'none';
        }

        // Tekrar yükleme
        function retryLoad() {
            hideError();
            loadAnalytics();
        }

        // Ana analitik yükleme fonksiyonu
        function loadAnalytics() {
            if (isLoading) return;
            
            isLoading = true;
            showLoading();
            
            // Simüle edilmiş yükleme süresi
            setTimeout(() => {
                try {
                    hideLoading();
                    hideError();
                    
                    // Charts oluştur
                    createDailyChart();
                    createPieChart('deviceChart', demoData.deviceData, 'Cihaz Dağılımı');
                    createPieChart('browserChart', demoData.browserData, 'Tarayıcı Dağılımı');
                    createPieChart('countryChart', demoData.countryData, 'Ülke Dağılımı');
                    createPieChart('timeChart', demoData.timeData, 'Saatlik Dağılım');
                    
                    // Tablo doldur
                    populateTable();
                    
                    // Animasyonları ekle
                    document.querySelectorAll('.chart-card, .table-card').forEach((el, index) => {
                        setTimeout(() => {
                            el.classList.add('fade-in');
                        }, index * 100);
                    });
                    
                } catch (error) {
                    console.error('Analytics yükleme hatası:', error);
                    showError('Grafik verileri yüklenirken bir hata oluştu.');
                } finally {
                    isLoading = false;
                }
            }, 1500);
        }

        // Gerçek zamanlı veri güncelleme (demo)
        function updateRealTimeStats() {
            // Rastgele değişiklikler simüle et
            const todayElement = document.getElementById('todayScans');
            const weekElement = document.getElementById('weekScans');
            const monthElement = document.getElementById('monthScans');
            
            if (Math.random() > 0.7) { // %30 şansla güncelle
                const currentToday = parseInt(todayElement.textContent);
                const newToday = currentToday + Math.floor(Math.random() * 3);
                
                todayElement.textContent = newToday;
                
                // Haftalık ve aylık da güncelle
                weekElement.textContent = parseInt(weekElement.textContent) + Math.floor(Math.random() * 2);
                monthElement.textContent = parseInt(monthElement.textContent) + Math.floor(Math.random() * 2);
                
                // Animasyon ekle
                [todayElement, weekElement, monthElement].forEach(el => {
                    el.style.transform = 'scale(1.1)';
                    el.style.transition = 'transform 0.3s ease';
                    setTimeout(() => {
                        el.style.transform = 'scale(1)';
                    }, 300);
                });
            }
        }

        // Chart'ları yok et
        function destroyCharts() {
            Object.values(charts).forEach(chart => {
                if (chart && typeof chart.destroy === 'function') {
                    chart.destroy();
                }
            });
            charts = {};
        }

        // Sayfa yüklendiğinde
        document.addEventListener('DOMContentLoaded', function() {
            // İlk yükleme
            loadAnalytics();
            
            // Gerçek zamanlı güncellemeler (her 30 saniyede)
            setInterval(updateRealTimeStats, 30000);
            
            // Responsive chart güncellemeleri
            window.addEventListener('resize', function() {
                Object.values(charts).forEach(chart => {
                    if (chart && typeof chart.resize === 'function') {
                        chart.resize();
                    }
                });
            });
        });

        // Sayfa kapanırken chart'ları temizle
        window.addEventListener('beforeunload', function() {
            destroyCharts();
        });

        // Error handling
        window.addEventListener('error', function(event) {
            console.error('Global hata:', event.error);
            if (!document.getElementById('errorMessage').style.display || 
                document.getElementById('errorMessage').style.display === 'none') {
                showError('Beklenmeyen bir hata oluştu. Sayfa yenilenecek.');
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            }
        });
    </script>
</body>
</html>