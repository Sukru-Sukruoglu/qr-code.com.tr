<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\scan.php
require_once 'config/database.php';

// URL'den short code al
$shortCode = $_GET['code'] ?? '';

if (empty($shortCode)) {
    header('Location: /');
    exit;
}

try {
    $pdo = Database::getInstance()->getConnection();
    
    // QR kodu bul
    $stmt = $pdo->prepare("SELECT * FROM qr_codes WHERE short_code = ?");
    $stmt->execute([$shortCode]);
    $qrCode = $stmt->fetch();
    
    if (!$qrCode) {
        header('Location: /404');
        exit;
    }
    
    // Tarama kaydı oluştur
    recordScan($pdo, $qrCode['id']);
    
    // Scan count'u artır
    $stmt = $pdo->prepare("UPDATE qr_codes SET scan_count = scan_count + 1 WHERE id = ?");
    $stmt->execute([$qrCode['id']]);
    
    // İçerik türüne göre yönlendir
    $content = $qrCode['content'];
    $type = $qrCode['type'];
    
    switch ($type) {
        case 'url':
            // URL kontrolü
            if (!filter_var($content, FILTER_VALIDATE_URL)) {
                $content = 'http://' . $content;
            }
            header('Location: ' . $content);
            break;
            
        case 'email':
            header('Location: mailto:' . $content);
            break;
            
        case 'phone':
            header('Location: tel:' . $content);
            break;
            
        case 'sms':
            header('Location: sms:' . $content);
            break;
            
        case 'whatsapp':
            header('Location: https://wa.me/' . $content);
            break;
            
        default:
            // Text ve diğer türler için önizleme sayfası
            showPreview($qrCode);
            break;
    }
    
} catch (Exception $e) {
    header('Location: /404');
    exit;
}

function recordScan($pdo, $qrCodeId) {
    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $referrer = $_SERVER['HTTP_REFERER'] ?? '';
    
    // Device detection
    $deviceType = detectDeviceType($userAgent);
    $browser = detectBrowser($userAgent);
    $os = detectOS($userAgent);
    
    // Location detection (basit IP geolocation)
    $location = getLocationFromIP($ipAddress);
    
    $stmt = $pdo->prepare("
        INSERT INTO qr_scans (qr_code_id, ip_address, user_agent, referrer, 
                             country, city, device_type, browser, os) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $qrCodeId, 
        $ipAddress, 
        $userAgent, 
        $referrer,
        $location['country'] ?? 'Bilinmiyor',
        $location['city'] ?? 'Bilinmiyor',
        $deviceType,
        $browser,
        $os
    ]);
}

function detectDeviceType($userAgent) {
    if (preg_match('/mobile|android|iphone/i', $userAgent)) {
        return 'mobile';
    } elseif (preg_match('/tablet|ipad/i', $userAgent)) {
        return 'tablet';
    } elseif (preg_match('/desktop|windows|mac|linux/i', $userAgent)) {
        return 'desktop';
    }
    return 'unknown';
}

function detectBrowser($userAgent) {
    if (strpos($userAgent, 'Chrome') !== false) return 'Chrome';
    if (strpos($userAgent, 'Firefox') !== false) return 'Firefox';
    if (strpos($userAgent, 'Safari') !== false) return 'Safari';
    if (strpos($userAgent, 'Edge') !== false) return 'Edge';
    return 'Diğer';
}

function detectOS($userAgent) {
    if (preg_match('/windows/i', $userAgent)) return 'Windows';
    if (preg_match('/mac/i', $userAgent)) return 'macOS';
    if (preg_match('/linux/i', $userAgent)) return 'Linux';
    if (preg_match('/android/i', $userAgent)) return 'Android';
    if (preg_match('/ios|iphone|ipad/i', $userAgent)) return 'iOS';
    return 'Diğer';
}

function getLocationFromIP($ip) {
    // Basit mock location - gerçek projede IP geolocation servisi kullanın
    return [
        'country' => 'Türkiye',
        'city' => 'İstanbul'
    ];
}

function showPreview($qrCode) {
    $title = htmlspecialchars($qrCode['title']);
    $content = htmlspecialchars($qrCode['content']);
    $type = $qrCode['type'];
    
    echo "<!DOCTYPE html>
    <html lang='tr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$title} | QR-CODE.COM.TR</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
            .qr-preview { text-align: center; background: #f5f5f5; padding: 30px; border-radius: 10px; }
            .content { font-size: 18px; margin: 20px 0; word-break: break-all; }
            .footer { color: #666; font-size: 14px; margin-top: 30px; }
        </style>
    </head>
    <body>
        <div class='qr-preview'>
            <h2>{$title}</h2>
            <div class='content'>{$content}</div>
            <div class='footer'>
                <p>Bu QR kod QR-CODE.COM.TR ile oluşturulmuştur</p>
                <p><a href='/'>Kendi QR kodunuzu oluşturun</a></p>
            </div>
        </div>
    </body>
    </html>";
}
?>