<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\api\register.php
// Debug için error reporting aç
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

$debug_log = __DIR__ . '/debug.log';
file_put_contents($debug_log, "\n" . date('Y-m-d H:i:s') . " - API started" . "\n", FILE_APPEND);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

session_start();

try {
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Including database\n", FILE_APPEND);
    require_once __DIR__ . '/../config/database.php';
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Database included successfully\n", FILE_APPEND);
} catch (Exception $e) {
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Database error: " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Wrong method\n", FILE_APPEND);
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Yalnızca POST metodu destekleniyor']);
    exit;
}

file_put_contents($debug_log, date('Y-m-d H:i:s') . " - POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);

try {
    $pdo = Database::getInstance()->getConnection();
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Database connection OK\n", FILE_APPEND);
    
    // Form verilerini al ve temizle
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim(strtolower($_POST['email'] ?? ''));
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $terms = isset($_POST['terms']) ? true : false;
    
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Form data parsed: $firstName, $lastName, $email\n", FILE_APPEND);
    
    // Doğrulamalar
    if (empty($firstName) || empty($lastName)) {
        throw new Exception('Ad ve soyad alanları zorunludur');
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Geçerli bir e-posta adresi giriniz');
    }
    
    if (empty($phone)) {
        throw new Exception('Telefon numarası zorunludur');
    }
    
    if (strlen($password) < 8) {
        throw new Exception('Şifre en az 8 karakter olmalıdır');
    }
    
    if ($password !== $confirmPassword) {
        throw new Exception('Şifreler eşleşmiyor');
    }
    
    if (!$terms) {
        throw new Exception('Kullanım koşullarını kabul etmelisiniz');
    }
    
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Validation passed\n", FILE_APPEND);
    
    // E-posta zaten kayıtlı mı kontrol et
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        throw new Exception('Bu e-posta adresi zaten kayıtlı');
    }
    
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Email not exists, proceeding\n", FILE_APPEND);
    
    // Şifreyi hashle
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // E-posta doğrulama kodu oluştur
    $verificationToken = bin2hex(random_bytes(32));
    
    // Username oluştur (email'den)
    $username = explode('@', $email)[0] . '_' . substr(uniqid(), -4);
    
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Generated username: $username\n", FILE_APPEND);
    
    // Kullanıcıyı kaydet - DOĞRU SÜTUN ADLARI
    $stmt = $pdo->prepare("
        INSERT INTO users (username, first_name, last_name, email, phone, password, email_verification_token) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    
    $result = $stmt->execute([
        $username,
        $firstName,
        $lastName, 
        $email,
        $phone,
        $hashedPassword,
        $verificationToken
    ]);
    
    if (!$result) {
        $errorInfo = $stmt->errorInfo();
        file_put_contents($debug_log, date('Y-m-d H:i:s') . " - SQL Error: " . print_r($errorInfo, true) . "\n", FILE_APPEND);
        throw new Exception('SQL Hatası: ' . $errorInfo[2]);
    }
    
    $userId = $pdo->lastInsertId();
    
    if (!$userId) {
        throw new Exception('Kullanıcı ID alınamadı');
    }
    
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - User created with ID: $userId\n", FILE_APPEND);
    
    // E-posta doğrulama maili gönder (şimdilik mock)
    $verificationLink = "http://localhost/dashboard/qr-code.com.tr/email-dogrula?token=" . $verificationToken;
    
    // Başarılı yanıt döndür
    echo json_encode([
        'success' => true,
        'message' => 'Kayıt başarılı! E-posta doğrulama linki gönderildi.',
        'data' => [
            'user_id' => $userId,
            'username' => $username,
            'email' => $email,
            'verification_link' => $verificationLink
        ]
    ]);
    
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Success response sent\n", FILE_APPEND);
    
} catch (PDOException $e) {
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - PDO Exception: " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Veritabanı hatası: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    file_put_contents($debug_log, date('Y-m-d H:i:s') . " - Exception: " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>