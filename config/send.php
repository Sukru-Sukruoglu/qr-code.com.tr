<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\api\contact\send.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Veri doğrulama
    $name = trim($input['name'] ?? '');
    $email = trim($input['email'] ?? '');
    $phone = trim($input['phone'] ?? '');
    $subject = trim($input['subject'] ?? '');
    $message = trim($input['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        throw new Exception('Zorunlu alanlar eksik');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Geçersiz e-posta adresi');
    }
    
    // E-posta gönderme (PHPMailer veya mail() fonksiyonu kullanabilirsiniz)
    $to = 'info@qr-code.com.tr';
    $emailSubject = "İletişim Formu: " . $subject;
    $emailBody = "
    Yeni İletişim Mesajı
    
    Ad Soyad: $name
    E-posta: $email
    Telefon: $phone
    Konu: $subject
    
    Mesaj:
    $message
    
    Gönderilme Tarihi: " . date('d.m.Y H:i:s');
    
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    if (mail($to, $emailSubject, $emailBody, $headers)) {
        echo json_encode([
            'success' => true,
            'message' => 'Mesajınız başarıyla gönderildi!'
        ]);
    } else {
        throw new Exception('E-posta gönderilirken hata oluştu');
    }
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>