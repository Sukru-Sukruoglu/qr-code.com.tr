<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\api\create-qr.php
session_start();
require_once '../config/database.php';

// Sadece giriş yapmış kullanıcılar için
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Giriş yapmanız gerekiyor']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Yalnızca POST metodu destekleniyor']);
    exit;
}

try {
    $pdo = Database::getInstance()->getConnection();
    
    $userId = $_SESSION['user_id'];
    $title = trim($_POST['title'] ?? '');
    $type = $_POST['type'] ?? '';
    $content = trim($_POST['content'] ?? '');
    $settings = json_encode($_POST['settings'] ?? []);
    
    // Validation
    if (empty($title)) {
        throw new Exception('Başlık gereklidir');
    }
    
    if (empty($content)) {
        throw new Exception('İçerik gereklidir');
    }
    
    $allowedTypes = ['text', 'url', 'wifi', 'vcard', 'email', 'phone', 'sms', 'location', 'whatsapp'];
    if (!in_array($type, $allowedTypes)) {
        throw new Exception('Geçersiz QR kod türü');
    }
    
    // Benzersiz kısa kod oluştur
    $shortCode = generateShortCode();
    while (codeExists($pdo, $shortCode)) {
        $shortCode = generateShortCode();
    }
    
    // QR kodu veritabanına kaydet
    $stmt = $pdo->prepare("
        INSERT INTO qr_codes (user_id, title, type, content, short_code, settings) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([$userId, $title, $type, $content, $shortCode, $settings]);
    $qrCodeId = $pdo->lastInsertId();
    
    // QR kod URL'ini oluştur
    $qrUrl = "https://qr-code.com.tr/scan/" . $shortCode;
    
    // QR kod görüntüsünü oluştur
    $qrImageUrl = generateQRImage($qrUrl, $_POST['settings'] ?? []);
    
    echo json_encode([
        'success' => true,
        'data' => [
            'id' => $qrCodeId,
            'short_code' => $shortCode,
            'qr_url' => $qrUrl,
            'image_url' => $qrImageUrl,
            'title' => $title,
            'type' => $type,
            'scan_count' => 0
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function generateShortCode($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $shortCode = '';
    for ($i = 0; $i < $length; $i++) {
        $shortCode .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $shortCode;
}

function codeExists($pdo, $shortCode) {
    $stmt = $pdo->prepare("SELECT id FROM qr_codes WHERE short_code = ?");
    $stmt->execute([$shortCode]);
    return $stmt->fetch() !== false;
}

function generateQRImage($url, $settings) {
    // Bu fonksiyonu QR kod kütüphanesi ile implement edeceğiz
    // Şimdilik placeholder döndürelim
    return '/assets/qr-placeholder.png';
}
?>