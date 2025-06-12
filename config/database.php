<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\config\database.php
class Database {
    private static $instance = null;
    private $connection;
    
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'qr_code_db';
    
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch (PDOException $e) {
            throw new Exception("Veritabanı bağlantı hatası: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    // Bağlantıyı klonlamayı engelle
    public function __clone() {
        throw new Exception("Database sınıfı klonlanamaz");
    }
    
    // Serileştirmeyi engelle
    public function __wakeup() {
        throw new Exception("Database sınıfı serileştirilemez");
    }
}

// Global $pdo değişkenini oluştur
try {
    $db = Database::getInstance();
    $pdo = $db->getConnection();
} catch (Exception $e) {
    error_log("Database bağlantı hatası: " . $e->getMessage());
    die("Veritabanı bağlantısı kurulamadı. Lütfen sistem yöneticisine başvurun.");
}
?>