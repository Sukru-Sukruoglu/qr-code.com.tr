<?php
pp\htdocs\dashboard\qr-code.com.tr\test-config.php
<?php
/**
 * Config Test Sayfası
 * Bu sayfayı çalıştırarak database bağlantısını test edebilirsiniz
 */

require_once __DIR__ . '/config/database.php';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Database Config Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        pre { background: #f5f5f5; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>🔧 Database Configuration Test</h1>
    
    <h2>📋 Config Values:</h2>
    <pre>
DB_HOST: <?php echo defined('DB_HOST') ? DB_HOST : 'NOT DEFINED'; ?>
DB_NAME: <?php echo defined('DB_NAME') ? DB_NAME : 'NOT DEFINED'; ?>
DB_USER: <?php echo defined('DB_USER') ? DB_USER : 'NOT DEFINED'; ?>
DB_PASS: <?php echo defined('DB_PASS') ? (DB_PASS ? '[SET]' : '[EMPTY]') : 'NOT DEFINED'; ?>
DB_PORT: <?php echo defined('DB_PORT') ? DB_PORT : 'NOT DEFINED (using default 3306)'; ?>
DB_CHARSET: <?php echo defined('DB_CHARSET') ? DB_CHARSET : 'NOT DEFINED'; ?>
    </pre>
    
    <h2>🔌 Connection Test:</h2>
    <?php
    try {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . (defined('DB_PORT') ? DB_PORT : '3306') . 
               ";dbname=" . DB_NAME . ";charset=" . (defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4');
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        ]);
        
        echo '<p class="success">✅ Bağlantı başarılı!</p>';
        
        // Test query
        $stmt = $pdo->query("SELECT VERSION() as mysql_version, NOW() as current_time");
        $result = $stmt->fetch();
        
        echo '<h3>📊 Database Info:</h3>';
        echo '<pre>';
        echo 'MySQL Version: ' . $result['mysql_version'] . "\n";
        echo 'Current Time: ' . $result['current_time'] . "\n";
        echo '</pre>';
        
        // Check tables
        echo '<h3>📋 Available Tables:</h3>';
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (empty($tables)) {
            echo '<p class="info">ℹ️ Henüz tablo yok - Bu normal, demo modda çalışacak</p>';
        } else {
            echo '<ul>';
            foreach ($tables as $table) {
                echo '<li>' . htmlspecialchars($table) . '</li>';
            }
            echo '</ul>';
        }
        
        // Test function
        if (function_exists('testDatabaseConnection')) {
            $testResult = testDatabaseConnection();
            echo '<p class="' . ($testResult ? 'success' : 'error') . '">';
            echo $testResult ? '✅ Test fonksiyonu başarılı' : '❌ Test fonksiyonu başarısız';
            echo '</p>';
        }
        
    } catch (PDOException $e) {
        echo '<p class="error">❌ Bağlantı hatası: ' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<p class="info">ℹ️ Analytics sayfası demo modda çalışacak</p>';
        
        // Öneriler
        echo '<h3>💡 Çözüm Önerileri:</h3>';
        echo '<ul>';
        echo '<li>XAMPP MySQL servisinin çalıştığından emin olun</li>';
        echo '<li>Database adının doğru olduğunu kontrol edin</li>';
        echo '<li>Kullanıcı adı ve şifrenin doğru olduğunu kontrol edin</li>';
        echo '<li>Eğer database yoksa oluşturun: <code>CREATE DATABASE qr_code_db;</code></li>';
        echo '</ul>';
        
    } catch (Exception $e) {
        echo '<p class="error">❌ Genel hata: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    ?>
    
    <hr>
    <p><a href="/dashboard/qr-code.com.tr/frontend/views/analytics/?debug=1">🔍 Analytics Sayfasını Test Et</a></p>
    <p><em>Bu test sayfasını silmek için: <code>test-config.php</code> dosyasını silin</em></p>
</body>
</html>