<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\api\login.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Yalnızca POST metodu destekleniyor']);
    exit;
}

try {
    $pdo = Database::getInstance()->getConnection();
    
    $email = trim(strtolower($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;
    
    // Validation
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Geçerli bir e-posta adresi giriniz');
    }
    
    if (empty($password)) {
        throw new Exception('Şifre alanı zorunludur');
    }
    
    // Kullanıcıyı bul
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if (!$user) {
        throw new Exception('E-posta adresi veya şifre hatalı');
    }
    
    // Şifre kontrolü
    if (!password_verify($password, $user['password'])) {
        throw new Exception('E-posta adresi veya şifre hatalı');
    }
    
    // Hesap aktif mi?
    if (!$user['is_active']) {
        throw new Exception('Hesabınız askıya alınmış. Lütfen destek ekibi ile iletişime geçin.');
    }
    
    // Session oluştur
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['logged_in'] = true;
    $_SESSION['login_time'] = time();
    
    // Last login güncelle
    $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
    $stmt->execute([$user['id']]);
    
    // Remember me cookie (30 gün)
    if ($remember) {
        $token = bin2hex(random_bytes(32));
        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', false, true);
        
        // Token'i veritabanına kaydet (gelecekte remember_tokens tablosu eklenebilir)
        $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
        $stmt->execute([$token, $user['id']]);
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Giriş başarılı! Yönlendiriliyorsunuz...',
        'data' => [
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'last_login' => $user['last_login'],
            'redirect_url' => '/dashboard'
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>