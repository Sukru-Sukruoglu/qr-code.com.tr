<?php
// Session kontrolü - sadece başlatılmamışsa başlat
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Veritabanı config dosyasını dahil et - GELİŞTİRİLMİŞ
$configPaths = [
    __DIR__ . '/../../../config/database.php',
    dirname(__DIR__, 3) . '/config/database.php',
    $_SERVER['DOCUMENT_ROOT'] . '/dashboard/qr-code.com.tr/config/database.php'
];

$configLoaded = false;
foreach ($configPaths as $configPath) {
    if (file_exists($configPath)) {
        try {
            require_once $configPath;
            $configLoaded = true;
            error_log("✅ Config yüklendi: $configPath");
            break;
        } catch (Exception $e) {
            error_log("❌ Config yükleme hatası: " . $e->getMessage());
        }
    }
}

// Config yüklenmediyse varsayılan değerler
if (!$configLoaded) {
    if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
    if (!defined('DB_NAME')) define('DB_NAME', 'qr_code_db');
    if (!defined('DB_USER')) define('DB_USER', 'root');
    if (!defined('DB_PASS')) define('DB_PASS', '');
    if (!defined('DB_CHARSET')) define('DB_CHARSET', 'utf8mb4');
    if (!defined('DB_PORT')) define('DB_PORT', '3306');
    
    error_log("⚠️ Config bulunamadı, varsayılan değerler kullanılıyor");
}

// Giriş kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: /dashboard/qr-code.com.tr/giris");
    exit;
}

$pageTitle = "Profil | QR-CODE.COM.TR";
$baseURL = '/dashboard/qr-code.com.tr';
$userName = $_SESSION['username'] ?? $_SESSION['user_name'] ?? 'Kullanıcı';
$userEmail = $_SESSION['email'] ?? $_SESSION['user_email'] ?? '';
$userRole = $_SESSION['user_role'] ?? 'user';

// Geliştirilmiş veritabanı bağlantısı
$pdo = null;
$connectionStatus = 'disconnected';

function createSecureConnection() {
    try {
        // Bağlantı parametrelerini kontrol et
        $requiredConstants = ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS'];
        foreach ($requiredConstants as $constant) {
            if (!defined($constant)) {
                throw new Exception("Eksik konfigürasyon: $constant");
            }
        }
        
        $dsn = "mysql:host=" . DB_HOST . ";port=" . (defined('DB_PORT') ? DB_PORT : '3306') . 
               ";dbname=" . DB_NAME . ";charset=" . (defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4');
        
        $options = defined('DB_OPTIONS') ? DB_OPTIONS : [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_TIMEOUT => defined('DB_TIMEOUT') ? DB_TIMEOUT : 10
        ];
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        
        // Bağlantı testini yap
        $stmt = $pdo->query("SELECT 1 as connection_test");
        $result = $stmt->fetch();
        
        if ($result['connection_test'] !== 1) {
            throw new Exception("Bağlantı test hatası");
        }
        
        // Log database action if function exists
        if (function_exists('logDatabaseAction')) {
            logDatabaseAction('Connection established', 'Profile page');
        }
        
        return $pdo;
        
    } catch (PDOException $e) {
        error_log("PDO Bağlantı Hatası: " . $e->getMessage());
        throw new Exception("Veritabanı bağlantı hatası: " . $e->getMessage());
    } catch (Exception $e) {
        error_log("Genel Bağlantı Hatası: " . $e->getMessage());
        throw $e;
    }
}

// Database bağlantısını dene
try {
    $pdo = createSecureConnection();
    $connectionStatus = 'connected';
} catch (Exception $e) {
    $connectionStatus = 'demo';
    $pdo = null;
    error_log("Profile sayfası demo modda çalışıyor: " . $e->getMessage());
}

// Kullanıcı verilerini getir
function getUserData($pdo, $userId) {
    if ($pdo) {
        try {
            $tableName = defined('TABLE_USERS') ? TABLE_USERS : 'users';
            $stmt = $pdo->prepare("SELECT * FROM $tableName WHERE id = ?");
            $stmt->execute([$userId]);
            $userData = $stmt->fetch();
            
            if ($userData) {
                // QR kod istatistiklerini getir
                $qrTable = defined('TABLE_QR_CODES') ? TABLE_QR_CODES : 'qr_codes';
                $stmt = $pdo->prepare("SELECT COUNT(*) as qr_count, SUM(total_scans) as total_scans FROM $qrTable WHERE user_id = ?");
                $stmt->execute([$userId]);
                $stats = $stmt->fetch();
                
                $userData['qr_count'] = $stats['qr_count'] ?? 0;
                $userData['total_scans'] = $stats['total_scans'] ?? 0;
                $userData['isReal'] = true;
                
                return $userData;
            }
        } catch (Exception $e) {
            error_log("User data çekme hatası: " . $e->getMessage());
        }
    }
    
    // Demo veriler
    return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'] ?? 'sukru.sukruoglu_fa12',
        'email' => $_SESSION['email'] ?? 'sukru.sukruoglu@gmail.com',
        'first_name' => 'Şükrü',
        'last_name' => 'Şükrüoğlu',
        'phone' => '+90 555 123 45 67',
        'company' => 'QR-CODE.COM.TR',
        'website' => 'https://qr-code.com.tr',
        'bio' => 'QR kod teknolojisi ve dijital pazarlama uzmanı. Modern çözümler geliştiriyorum.',
        'avatar' => null,
        'plan' => 'Free',
        'created_at' => '2024-01-15',
        'last_login' => '2024-06-04 14:30:00',
        'email_verified' => true,
        'two_factor_enabled' => false,
        'notifications_enabled' => true,
        'marketing_emails' => false,
        'qr_count' => 15,
        'total_scans' => 342,
        'isReal' => false
    ];
}

$user = getUserData($pdo, $_SESSION['user_id']);

// Form işleme
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_profile':
                if ($pdo) {
                    try {
                        $tableName = defined('TABLE_USERS') ? TABLE_USERS : 'users';
                        $stmt = $pdo->prepare("UPDATE $tableName SET 
                            first_name = ?, last_name = ?, username = ?, email = ?, 
                            phone = ?, company = ?, website = ?, bio = ? 
                            WHERE id = ?");
                        
                        $result = $stmt->execute([
                            $_POST['first_name'],
                            $_POST['last_name'],
                            $_POST['username'],
                            $_POST['email'],
                            $_POST['phone'],
                            $_POST['company'],
                            $_POST['website'],
                            $_POST['bio'],
                            $_SESSION['user_id']
                        ]);
                        
                        if ($result) {
                            // Session'ı güncelle
                            $_SESSION['username'] = $_POST['username'];
                            $_SESSION['email'] = $_POST['email'];
                            
                            $message = '✅ Profil bilgileriniz başarıyla güncellendi!';
                            $messageType = 'success';
                            
                            // Güncellenmiş verileri yeniden yükle
                            $user = getUserData($pdo, $_SESSION['user_id']);
                        } else {
                            $message = '❌ Profil güncelleme sırasında bir hata oluştu.';
                            $messageType = 'error';
                        }
                        
                    } catch (Exception $e) {
                        error_log("Profile update error: " . $e->getMessage());
                        $message = '❌ Veritabanı hatası: ' . $e->getMessage();
                        $messageType = 'error';
                    }
                } else {
                    $message = '✅ Demo modda - profil güncelleme simüle edildi!';
                    $messageType = 'success';
                }
                break;
                
            case 'update_password':
                if ($pdo) {
                    try {
                        // Mevcut şifreyi kontrol et
                        $tableName = defined('TABLE_USERS') ? TABLE_USERS : 'users';
                        $stmt = $pdo->prepare("SELECT password FROM $tableName WHERE id = ?");
                        $stmt->execute([$_SESSION['user_id']]);
                        $currentHash = $stmt->fetchColumn();
                        
                        if (password_verify($_POST['current_password'], $currentHash)) {
                            if ($_POST['new_password'] === $_POST['confirm_password']) {
                                $newHash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                                $stmt = $pdo->prepare("UPDATE $tableName SET password = ? WHERE id = ?");
                                
                                if ($stmt->execute([$newHash, $_SESSION['user_id']])) {
                                    $message = '✅ Şifreniz başarıyla değiştirildi!';
                                    $messageType = 'success';
                                } else {
                                    $message = '❌ Şifre değiştirme sırasında bir hata oluştu.';
                                    $messageType = 'error';
                                }
                            } else {
                                $message = '❌ Yeni şifreler eşleşmiyor.';
                                $messageType = 'error';
                            }
                        } else {
                            $message = '❌ Mevcut şifre yanlış.';
                            $messageType = 'error';
                        }
                        
                    } catch (Exception $e) {
                        error_log("Password update error: " . $e->getMessage());
                        $message = '❌ Şifre değiştirme hatası: ' . $e->getMessage();
                        $messageType = 'error';
                    }
                } else {
                    $message = '✅ Demo modda - şifre değiştirme simüle edildi!';
                    $messageType = 'success';
                }
                break;
                
            case 'update_settings':
                if ($pdo) {
                    try {
                        $tableName = defined('TABLE_USERS') ? TABLE_USERS : 'users';
                        $stmt = $pdo->prepare("UPDATE $tableName SET 
                            two_factor_enabled = ?, notifications_enabled = ?, marketing_emails = ? 
                            WHERE id = ?");
                        
                        $result = $stmt->execute([
                            isset($_POST['two_factor']) ? 1 : 0,
                            isset($_POST['notifications']) ? 1 : 0,
                            isset($_POST['marketing']) ? 1 : 0,
                            $_SESSION['user_id']
                        ]);
                        
                        if ($result) {
                            $message = '✅ Hesap ayarlarınız güncellendi!';
                            $messageType = 'success';
                            
                            // Güncellenmiş verileri yeniden yükle
                            $user = getUserData($pdo, $_SESSION['user_id']);
                        } else {
                            $message = '❌ Ayarlar güncellenirken bir hata oluştu.';
                            $messageType = 'error';
                        }
                        
                    } catch (Exception $e) {
                        error_log("Settings update error: " . $e->getMessage());
                        $message = '❌ Ayarlar güncelleme hatası: ' . $e->getMessage();
                        $messageType = 'error';
                    }
                } else {
                    $message = '✅ Demo modda - ayarlar güncelleme simüle edildi!';
                    $messageType = 'success';
                }
                break;
        }
    }
}

// Helper fonksiyonları
function formatDate($date) {
    return date('d.m.Y', strtotime($date));
}

function formatDateTime($datetime) {
    return date('d.m.Y H:i', strtotime($datetime));
}

// Debug bilgisi (geliştirme için)
if (defined('DB_DEBUG') && DB_DEBUG && isset($_GET['debug'])) {
    echo "<!-- DEBUG INFO:\n";
    echo "Config Status: " . ($configLoaded ? 'LOADED' : 'FALLBACK') . "\n";
    echo "Connection Status: $connectionStatus\n";
    echo "Database: " . (defined('DB_NAME') ? DB_NAME : 'undefined') . "\n";
    echo "User ID: " . ($_SESSION['user_id'] ?? 'null') . "\n";
    echo "User Source: " . ($user['isReal'] ? 'DATABASE' : 'DEMO') . "\n";
    echo "-->\n";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    
    <!-- Meta Tags -->
    <meta name="description" content="Hesap bilgilerinizi yönetin ve ayarlarınızı düzenleyin.">
    <meta name="keywords" content="profil, hesap, ayarlar, kullanıcı">
    
    <!-- External Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* Modern CSS Variables */
        :root {
            --primary-color: #667eea;
            --primary-dark: #764ba2;
            --secondary-color: #f093fb;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --text-muted: #718096;
            --bg-primary: #ffffff;
            --bg-secondary: #f7fafc;
            --bg-muted: #edf2f7;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.6;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: var(--primary-color);
            color: white;
            border: none;
            width: 3rem;
            height: 3rem;
            border-radius: var(--radius-lg);
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-xl);
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
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
            transition: all 0.3s ease;
        }

        .sidebar-logo:hover {
            transform: scale(1.02);
        }

        .sidebar-logo i {
            font-size: 2rem;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem;
            border-radius: var(--radius-xl);
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

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: var(--radius-xl);
            transition: all 0.3s ease;
            font-weight: 500;
            margin-bottom: 0.5rem;
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
            transition: margin-left 0.3s ease;
        }

        /* Profile Header */
        .profile-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .breadcrumb {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .profile-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .profile-subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        /* Connection Status */
        .connection-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .connection-status.connected {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .connection-status.demo {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        /* Profile Container */
        .profile-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Profile Tabs */
        .profile-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid rgba(102, 126, 234, 0.1);
            overflow-x: auto;
            padding-bottom: 0;
        }

        .tab-btn {
            padding: 1rem 2rem;
            background: none;
            border: none;
            color: var(--text-muted);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            font-size: 1rem;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tab-btn.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .tab-btn:hover {
            color: var(--primary-color);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeInUp 0.5s ease;
        }

        /* Profile Cards */
        .profile-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255,255,255,0.2);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .card-header {
            padding: 2rem 2rem 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-title i {
            color: var(--primary-color);
        }

        .card-body {
            padding: 2rem;
        }

        /* Messages */
        .message {
            padding: 1rem 1.5rem;
            border-radius: var(--radius-xl);
            margin-bottom: 2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideInDown 0.5s ease;
        }

        .message-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border: 2px solid rgba(16, 185, 129, 0.2);
        }

        .message-error {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
            border: 2px solid rgba(239, 68, 68, 0.2);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Profile Info */
        .profile-info {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 2rem;
            align-items: flex-start;
        }

        .profile-avatar-section {
            text-align: center;
        }

        .profile-avatar-large {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 3rem;
            color: white;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
        }

        .upload-btn {
            padding: 0.75rem 1.5rem;
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: var(--radius-xl);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .upload-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .profile-details {
            display: grid;
            gap: 1.5rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: var(--radius-xl);
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateX(5px);
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .detail-content {
            flex: 1;
        }

        .detail-label {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .detail-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Forms */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid rgba(102, 126, 234, 0.1);
            border-radius: var(--radius-xl);
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.7);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border: none;
            border-radius: var(--radius-xl);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--error-color) 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        /* Settings */
        .settings-grid {
            display: grid;
            gap: 1.5rem;
        }

        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .setting-item:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .setting-info h4 {
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .setting-info p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 30px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--primary-color);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(30px);
        }

        /* Plan Badge */
        .plan-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
                padding-top: 4rem;
            }

            .profile-info {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .profile-tabs {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .tab-btn {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .profile-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .profile-tabs {
                border-bottom: none;
                background: rgba(255,255,255,0.9);
                border-radius: var(--radius-xl);
                padding: 0.5rem;
                margin-bottom: 1rem;
            }

            .tab-btn {
                border-radius: var(--radius-lg);
                border-bottom: none;
            }

            .tab-btn.active {
                background: var(--primary-color);
                color: white;
                border-bottom: none;
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

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Loading State */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Footer Styles - DÜZELTME */
        .dashboard-footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-left: 280px;
            margin-top: 4rem;
            opacity: 1; /* opacity 0'dan 1'e değiştirildi */
            transform: translateY(0); /* translateY(30px)'den 0'a değiştirildi */
            transition: all 0.6s ease;
            position: relative; /* position eklendi */
            z-index: 1; /* z-index eklendi */
        }

        .dashboard-footer.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            padding: 3rem 0 2rem;
        }

        .footer-section h3.footer-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: rgba(255,255,255,0.9);
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-logo i {
            font-size: 2rem;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem;
            border-radius: 12px;
        }

        .footer-description {
            color: rgba(255,255,255,0.8);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-3px);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-contact .contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: rgba(255,255,255,0.8);
        }

        .footer-contact .contact-item i {
            width: 20px;
            text-align: center;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(5px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
        }

        .modal-container {
            background: white;
            border-radius: 20px;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: var(--shadow-xl);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            margin: 2rem;
        }

        .modal-overlay.active .modal-container {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .modal-header h2 {
            margin: 0;
            color: var(--text-primary);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: var(--bg-muted);
            color: var(--text-primary);
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            padding: 1rem 2rem 2rem;
            text-align: right;
        }

        /* Help Content Styles */
        .help-content .help-section {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
        }

        .help-content h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .help-tips {
            background: rgba(16, 185, 129, 0.1);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            border-left: 4px solid var(--success-color);
        }

        .help-tips h4 {
            color: var(--success-color);
        }

        .help-tips ul {
            margin-top: 1rem;
            padding-left: 1rem;
        }

        /* Upload Content Styles */
        .upload-content .upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-xl);
            padding: 3rem;
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .upload-area:hover {
            border-color: var(--primary-color);
            background: rgba(102, 126, 234, 0.05);
        }

        .upload-area i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .upload-info {
            background: var(--bg-secondary);
            padding: 1rem;
            border-radius: var(--radius-lg);
        }

        .upload-info p {
            margin: 0.5rem 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Footer Styles - DÜZELTME */
        .dashboard-footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-left: 280px;
            margin-top: 4rem;
            opacity: 1; /* opacity 0'dan 1'e değiştirildi */
            transform: translateY(0); /* translateY(30px)'den 0'a değiştirildi */
            transition: all 0.6s ease;
            position: relative; /* position eklendi */
            z-index: 1; /* z-index eklendi */
        }

        .dashboard-footer.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            padding: 3rem 0 2rem;
        }

        .footer-section h3.footer-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: rgba(255,255,255,0.9);
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-logo i {
            font-size: 2rem;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem;
            border-radius: 12px;
        }

        .footer-description {
            color: rgba(255,255,255,0.8);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-3px);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-contact .contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: rgba(255,255,255,0.8);
        }

        .footer-contact .contact-item i {
            width: 20px;
            text-align: center;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 1.5rem 0;
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-copyright {
            flex: 1;
        }

        .footer-copyright p {
            margin: 0;
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }

        .footer-note {
            font-size: 0.8rem !important;
            color: rgba(255,255,255,0.6) !important;
            margin-top: 0.25rem !important;
        }

        .footer-links-bottom {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .footer-links-bottom a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            white-space: nowrap;
        }

        .footer-links-bottom a:hover {
            color: white;
        }

        /* Responsive Footer - DÜZELTME */
        @media (max-width: 768px) {
            .dashboard-footer {
                margin-left: 0; /* Mobile'da margin-left: 0 */
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }

            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .footer-links-bottom {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 480px) {
            .footer-content {
                padding: 2rem 0 1rem;
            }

            .footer-social {
                justify-content: center;
            }

            .footer-links-bottom {
                flex-direction: column;
                gap: 0.75rem;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
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
                    <a href="<?php echo $baseURL; ?>/profile" class="nav-link active">
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
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="breadcrumb">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                    <i class="fas fa-chevron-right" style="font-size: 0.7rem; margin: 0 0.5rem;"></i>
                    <span>Profil</span>
                </div>
                
                <h1 class="profile-title">
                    <i class="fas fa-user-circle" style="font-size: 2.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                    Profil Yönetimi
                </h1>
                <p class="profile-subtitle">Hesap bilgilerinizi yönetin ve ayarlarınızı düzenleyin</p>
                
                <!-- Connection Status -->
                <div class="connection-status <?php echo $connectionStatus; ?>">
                    <?php if ($connectionStatus === 'connected'): ?>
                        <i class="fas fa-check-circle"></i>
                        <span>Veritabanı Bağlı - Gerçek Veriler</span>
                    <?php else: ?>
                        <i class="fas fa-info-circle"></i>
                        <span>Demo Mod - Örnek Veriler</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="profile-container">
                <!-- Message -->
                <?php if ($message): ?>
                    <div class="message message-<?php echo $messageType; ?>">
                        <i class="fas fa-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <!-- Profile Tabs -->
                <div class="profile-tabs">
                    <button class="tab-btn active" onclick="showTab('overview')">
                        <i class="fas fa-user"></i> Genel Bakış
                    </button>
                    <button class="tab-btn" onclick="showTab('edit')">
                        <i class="fas fa-edit"></i> Profili Düzenle
                    </button>
                    <button class="tab-btn" onclick="showTab('password')">
                        <i class="fas fa-lock"></i> Şifre Değiştir
                    </button>
                    <button class="tab-btn" onclick="showTab('settings')">
                        <i class="fas fa-cog"></i> Hesap Ayarları
                    </button>
                </div>

                <!-- Overview Tab -->
                <div id="overview" class="tab-content active">
                    <!-- Stats Grid -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number"><?php echo number_format($user['qr_count']); ?></div>
                            <div class="stat-label">QR Kod</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-number"><?php echo number_format($user['total_scans']); ?></div>
                            <div class="stat-label">Toplam Tarama</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-number"><?php echo formatDate($user['created_at']); ?></div>
                            <div class="stat-label">Üyelik Tarihi</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="plan-badge">
                                <i class="fas fa-crown"></i>
                                <?php echo htmlspecialchars($user['plan']); ?> Plan
                            </div>
                            <div class="stat-label">Mevcut Plan</div>
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-id-card"></i>
                                Profil Bilgileri
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="profile-info">
                                <div class="profile-avatar-section">
                                    <div class="profile-avatar-large">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <button class="upload-btn" onclick="uploadAvatar()">
                                        <i class="fas fa-camera"></i>
                                        Fotoğraf Değiştir
                                    </button>
                                </div>
                                
                                <div class="profile-details">
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Ad Soyad</div>
                                            <div class="detail-value"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-at"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Kullanıcı Adı</div>
                                            <div class="detail-value"><?php echo htmlspecialchars($user['username']); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">E-posta</div>
                                            <div class="detail-value">
                                                <?php echo htmlspecialchars($user['email']); ?>
                                                <?php if ($user['email_verified']): ?>
                                                    <i class="fas fa-check-circle" style="color: var(--success-color); margin-left: 0.5rem;" title="Doğrulanmış"></i>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Telefon</div>
                                            <div class="detail-value"><?php echo htmlspecialchars($user['phone']); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Şirket</div>
                                            <div class="detail-value"><?php echo htmlspecialchars($user['company']); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Son Giriş</div>
                                            <div class="detail-value"><?php echo formatDateTime($user['last_login']); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile Tab -->
                <div id="edit" class="tab-content">
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-edit"></i>
                                Profili Düzenle
                            </h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="profileForm">
                                <input type="hidden" name="action" value="update_profile">
                                
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Ad</label>
                                        <input type="text" class="form-input" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Soyad</label>
                                        <input type="text" class="form-input" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Kullanıcı Adı</label>
                                        <input type="text" class="form-input" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">E-posta</label>
                                        <input type="email" class="form-input" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Telefon</label>
                                        <input type="tel" class="form-input" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Şirket</label>
                                        <input type="text" class="form-input" name="company" value="<?php echo htmlspecialchars($user['company']); ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Web Site</label>
                                    <input type="url" class="form-input" name="website" value="<?php echo htmlspecialchars($user['website']); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Hakkımda</label>
                                    <textarea class="form-input form-textarea" name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary" id="saveProfileBtn">
                                    <i class="fas fa-save"></i>
                                    <span>Değişiklikleri Kaydet</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Password Tab -->
                <div id="password" class="tab-content">
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-lock"></i>
                                Şifre Değiştir
                            </h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="passwordForm">
                                <input type="hidden" name="action" value="update_password">
                                
                                <div class="form-group">
                                    <label class="form-label">Mevcut Şifre</label>
                                    <input type="password" class="form-input" name="current_password" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Yeni Şifre</label>
                                    <input type="password" class="form-input" name="new_password" id="newPassword" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Yeni Şifre (Tekrar)</label>
                                    <input type="password" class="form-input" name="confirm_password" id="confirmPassword" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary" id="changePasswordBtn">
                                    <i class="fas fa-key"></i>
                                    <span>Şifreyi Değiştir</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div id="settings" class="tab-content">
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-cog"></i>
                                Hesap Ayarları
                            </h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="settingsForm">
                                <input type="hidden" name="action" value="update_settings">
                                
                                <div class="settings-grid">
                                    <div class="setting-item">
                                        <div class="setting-info">
                                            <h4>İki Faktörlü Doğrulama</h4>
                                            <p>Hesabınızı ekstra güvenlik katmanı ile koruyun</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="two_factor" <?php echo $user['two_factor_enabled'] ? 'checked' : ''; ?>>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    
                                    <div class="setting-item">
                                        <div class="setting-info">
                                            <h4>E-posta Bildirimleri</h4>
                                            <p>QR kod tarama ve sistem bildirimleri alın</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="notifications" <?php echo $user['notifications_enabled'] ? 'checked' : ''; ?>>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    
                                    <div class="setting-item">
                                        <div class="setting-info">
                                            <h4>Pazarlama E-postaları</h4>
                                            <p>Özel teklifler ve yenilikler hakkında bilgi alın</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="marketing" <?php echo $user['marketing_emails'] ? 'checked' : ''; ?>>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div style="margin-top: 2rem;">
                                    <button type="submit" class="btn btn-primary" id="saveSettingsBtn">
                                        <i class="fas fa-save"></i>
                                        <span>Ayarları Kaydet</span>
                                    </button>
                                    
                                    <button type="button" class="btn btn-danger" style="margin-left: 1rem;" onclick="deleteAccount()">
                                        <i class="fas fa-trash"></i>
                                        <span>Hesabı Sil</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <i class="fas fa-qrcode"></i>
                        <span>QR-CODE.COM.TR</span>
                    </div>
                    <p class="footer-description">
                        Modern QR kod çözümleri ile dijital dünyanızı kolaylaştırın. 
                        Hızlı, güvenli ve kullanıcı dostu QR kod yönetimi.
                    </p>
                    <div class="footer-social">
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Hızlı Linkler</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo $baseURL; ?>/dashboard"><i class="fas fa-home"></i> Ana Sayfa</a></li>
                        <li><a href="<?php echo $baseURL; ?>/qr-olustur"><i class="fas fa-plus"></i> QR Oluştur</a></li>
                        <li><a href="<?php echo $baseURL; ?>/qr-listesi"><i class="fas fa-list"></i> QR Kodlarım</a></li>
                        <li><a href="<?php echo $baseURL; ?>/analytics"><i class="fas fa-chart-line"></i> Analitikler</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Özellikler</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo $baseURL; ?>/pages/features"><i class="fas fa-star"></i> Özellikler</a></li>
                        <li><a href="<?php echo $baseURL; ?>/pages/how-to-use"><i class="fas fa-question-circle"></i> Nasıl Kullanılır</a></li>
                        <li><a href="<?php echo $baseURL; ?>/pages/about"><i class="fas fa-info-circle"></i> Hakkımızda</a></li>
                        <li><a href="<?php echo $baseURL; ?>/pages/contact"><i class="fas fa-envelope"></i> İletişim</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Hesap</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo $baseURL; ?>/profile"><i class="fas fa-user"></i> Profil</a></li>
                        <li><a href="<?php echo $baseURL; ?>/profile#settings"><i class="fas fa-cog"></i> Ayarlar</a></li>
                        <li><a href="#" onclick="showHelp()"><i class="fas fa-life-ring"></i> Yardım</a></li>
                        <li><a href="<?php echo $baseURL; ?>/cikis"><i class="fas fa-sign-out-alt"></i> Çıkış</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">İletişim</h3>
                    <div class="footer-contact">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@qr-code.com.tr</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+90 (212) 555 0123</span>
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
                    <div class="footer-copyright">
                        <p>&copy; 2024 QR-CODE.COM.TR - Tüm hakları saklıdır.</p>
                        <p class="footer-note">
                            <?php if ($connectionStatus === 'demo'): ?>
                                <i class="fas fa-info-circle"></i>
                                Bu sayfa demo verilerle çalışmaktadır
                            <?php else: ?>
                                <i class="fas fa-shield-alt"></i>
                                Güvenli bağlantı ile korunmaktadır
                            <?php endif; ?>
                        </p>
                    </div>
                    
                    <div class="footer-links-bottom">
                        <a href="#" onclick="showPrivacyPolicy()">Gizlilik Politikası</a>
                        <a href="#" onclick="showTerms()">Kullanım Şartları</a>
                        <a href="#" onclick="showCookiePolicy()">Çerez Politikası</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Global değişkenler
        const baseURL = '<?php echo addslashes($baseURL); ?>';
        const isConnected = <?php echo $pdo ? 'true' : 'false'; ?>;
        const userName = '<?php echo addslashes($userName); ?>';

        // DOM yüklendikten sonra çalışacak fonksiyonlar
        document.addEventListener('DOMContentLoaded', function() {
            console.log('👤 Profil sayfası yüklendi');
            console.log('🔌 Bağlantı durumu:', isConnected ? 'Bağlı' : 'Demo');
            
            initializeProfile();
        });

        // Profile yöneticisi sınıfı
        class ProfileManager {
            constructor() {
                this.activeTab = 'overview';
                this.isSubmitting = false;
                
                this.initEventListeners();
                this.initFormValidation();
                this.initFooterFeatures();
            }

            initEventListeners() {
                // Mobile menu
                const mobileMenuBtn = document.getElementById('mobileMenuBtn');
                const sidebar = document.getElementById('sidebar');
                
                if (mobileMenuBtn) {
                    mobileMenuBtn.addEventListener('click', () => {
                        sidebar.classList.toggle('active');
                    });
                }

                // Form submissions
                const forms = ['profileForm', 'passwordForm', 'settingsForm'];
                forms.forEach(formId => {
                    const form = document.getElementById(formId);
                    if (form) {
                        form.addEventListener('submit', (e) => this.handleFormSubmit(e, formId));
                    }
                });
            }

            initFormValidation() {
                // Şifre doğrulama
                const newPassword = document.getElementById('newPassword');
                const confirmPassword = document.getElementById('confirmPassword');
                
                if (newPassword && confirmPassword) {
                    confirmPassword.addEventListener('input', () => {
                        if (newPassword.value !== confirmPassword.value) {
                            confirmPassword.setCustomValidity('Şifreler eşleşmiyor');
                        } else {
                            confirmPassword.setCustomValidity('');
                        }
                    });
                }
            }

            async handleFormSubmit(event, formId) {
                event.preventDefault();
                
                if (this.isSubmitting) return;
                this.isSubmitting = true;
                
                const form = event.target;
                const formData = new FormData(form);
                const action = formData.get('action');
                
                try {
                    // AJAX isteği gönder
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        // Başarılıysa mesaj göster ve verileri güncelle
                        this.showMessage('success', result.message);
                        
                        if (action === 'update_profile') {
                            // Profil güncellendiyse kullanıcı verilerini güncelle
                            this.updateUserData(result.data);
                        } else if (action === 'update_password') {
                            // Şifre değiştirildiyse çıkış yap ve tekrar giriş yap
                            setTimeout(() => {
                                window.location.href = '<?php echo $baseURL; ?>/cikis';
                            }, 1000);
                        }
                    } else {
                        // Hata mesajını göster
                        this.showMessage('error', result.message);
                    }
                } catch (error) {
                    console.error('Form gönderim hatası:', error);
                    this.showMessage('error', 'Bir hata oluştu, lütfen tekrar deneyin');
                } finally {
                    this.isSubmitting = false;
                }
            }

            showMessage(type, message) {
                const messageContainer = document.createElement('div');
                messageContainer.className = `message message-${type}`;
                messageContainer.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
                
                document.body.appendChild(messageContainer);
                
                // Mesajı 3 saniye sonra kaldır
                setTimeout(() => {
                    messageContainer.remove();
                }, 3000);
            }

            updateUserData(data) {
                // Kullanıcı verilerini güncelle
                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        user[key] = data[key];
                    }
                }
                
                // Arayüzü güncelle
                document.querySelector('.user-name').innerText = userName;
                document.querySelector('.user-email').innerText = userEmail;
            }

            initFooterFeatures() {
                // Footer özelliklerini başlat
                const footer = document.querySelector('.dashboard-footer');
                
                if (footer) {
                    footer.classList.add('visible');
                }
            }
        }

        // Profil yöneticisini başlat
        const profileManager = new ProfileManager();

        // Sekme gösterme fonksiyonu
        function showTab(tabName) {
            const tabs = document.querySelectorAll('.tab-content');
            const buttons = document.querySelectorAll('.tab-btn');
            
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            
            buttons.forEach(button => {
                button.classList.remove('active');
            });
            
            document.getElementById(tabName).classList.add('active');
            document.querySelector(`.tab-btn[onclick="showTab('${tabName}')"]`).classList.add('active');
        }

        // Avatar yükleme fonksiyonu
        function uploadAvatar() {
            // Avatar yükleme işlemleri
            alert('Avatar yükleme işlemi başlatıldı');
        }

        // Hesap silme fonksiyonu
        function deleteAccount() {