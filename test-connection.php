<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\test-connection.php
echo "<h2>Database Bağlantı Testi</h2>";

// Config dosyası var mı?
$configPath = __DIR__ . '/config/database.php';
if (file_exists($configPath)) {
    echo "✅ Config dosyası bulundu: " . $configPath . "<br>";
    
    try {
        require_once $configPath;
        echo "✅ Config dosyası yüklendi<br>";
        
        $db = Database::getInstance();
        echo "✅ Database instance oluşturuldu<br>";
        
        $pdo = $db->getConnection();
        echo "✅ Database bağlantısı başarılı<br>";
        
        // Test sorgusu
        $stmt = $pdo->query("SELECT DATABASE() as db_name");
        $result = $stmt->fetch();
        echo "✅ Aktif veritabanı: " . $result['db_name'] . "<br>";
        
    } catch (Exception $e) {
        echo "❌ Hata: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ Config dosyası bulunamadı: " . $configPath . "<br>";
}
?>