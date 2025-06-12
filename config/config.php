<?php
<?php
/**
 * Veritabanı Konfigürasyon Dosyası
 * QR-CODE.COM.TR Dashboard
 */

// Veritabanı bağlantı bilgileri
define('DB_HOST', 'localhost');
define('DB_NAME', 'qr_code_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// PDO seçenekleri
define('DB_CHARSET', 'utf8mb4');
define('DB_PORT', '3306');

// Bağlantı seçenekleri
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_PERSISTENT => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
]);

// Environment ayarları
define('DB_DEBUG', true);  // Geliştirme ortamı için true
define('DB_TIMEOUT', 30);  // Bağlantı timeout (saniye)

// Tablo isimleri
define('TABLE_USERS', 'users');
define('TABLE_QR_CODES', 'qr_codes');
define('TABLE_QR_SCANS', 'qr_scans');
define('TABLE_ANALYTICS', 'analytics');

// Test bağlantısı fonksiyonu
function testDatabaseConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, DB_OPTIONS);
        
        // Basit test sorgusu
        $stmt = $pdo->query("SELECT 1 as test");
        $result = $stmt->fetch();
        
        return $result['test'] === 1;
        
    } catch (PDOException $e) {
        error_log("Database Test Error: " . $e->getMessage());
        return false;
    }
}

// Log fonksiyonu
function logDatabaseAction($action, $details = '') {
    if (DB_DEBUG) {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] DB Action: $action";
        if ($details) {
            $logMessage .= " - Details: $details";
        }
        error_log($logMessage);
    }
}

?>