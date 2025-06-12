<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Debug log
error_log("🚀 Login API called - Method: " . $_SERVER['REQUEST_METHOD']);

// Sadece POST isteğine izin ver
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Sadece POST isteği kabul edilir']);
    exit;
}

try {
    // Form verilerini al
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    error_log("🔑 Login attempt - Email: $email");

    // Validasyon
    if (empty($email) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'E-posta ve şifre alanları gereklidir'
        ]);
        exit;
    }

    // E-posta formatı kontrolü
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Geçerli bir e-posta adresi giriniz'
        ]);
        exit;
    }

    // Demo kullanıcılar - VERİTABANI YERİNE HARD-CODED
    $demoUsers = [
        'admin@qr-code.com.tr' => [
            'password' => 'admin123',
            'name' => 'Admin User',
            'id' => 1,
            'role' => 'admin'
        ],
        'user@test.com' => [
            'password' => '123456',
            'name' => 'Test User',
            'id' => 2,
            'role' => 'user'
        ],
        'demo@demo.com' => [
            'password' => 'demo123',
            'name' => 'Demo User',
            'id' => 3,
            'role' => 'user'
        ]
    ];

    // Kullanıcı kontrolü
    if (!isset($demoUsers[$email])) {
        echo json_encode([
            'success' => false,
            'message' => 'E-posta adresi bulunamadı'
        ]);
        exit;
    }

    $user = $demoUsers[$email];

    // Şifre kontrolü
    if ($password !== $user['password']) {
        echo json_encode([
            'success' => false,
            'message' => 'Şifre hatalı'
        ]);
        exit;
    }

    // Session başlat
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['login_time'] = time();

    error_log("✅ Login successful - User ID: " . $user['id']);

    // Remember me cookie (7 gün)
    if ($remember) {
        $cookieValue = base64_encode(json_encode([
            'user_id' => $user['id'],
            'token' => md5($email . time())
        ]));
        setcookie('qr_remember', $cookieValue, time() + (7 * 24 * 60 * 60), '/');
    }

    // Başarılı giriş
    echo json_encode([
        'success' => true,
        'message' => 'Giriş başarılı! Yönlendiriliyorsunuz...',
        'data' => [
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $email,
                'role' => $user['role']
            ],
            'redirect_url' => '/dashboard/qr-code.com.tr/dashboard'
        ]
    ]);

} catch (Exception $e) {
    error_log('❌ Login API Error: ' . $e->getMessage());
    
    echo json_encode([
        'success' => false,
        'message' => 'Giriş işlemi sırasında bir hata oluştu. Lütfen tekrar deneyin.'
    ]);
}
?>