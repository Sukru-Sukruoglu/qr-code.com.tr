<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\qr-redirect.php
require_once 'config/database.php';

function handleQRRedirect($shortCode) {
    global $pdo;
    
    try {
        // QR kodunu bul (ID veya title ile)
        if (is_numeric($shortCode)) {
            $stmt = $pdo->prepare("SELECT * FROM qr_codes WHERE id = ? AND is_active = 1");
        } else {
            $stmt = $pdo->prepare("SELECT * FROM qr_codes WHERE title = ? AND is_active = 1 LIMIT 1");
        }
        
        $stmt->execute([$shortCode]);
        $qrCode = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$qrCode) {
            // QR kod bulunamadı - 404 sayfası göster
            http_response_code(404);
            include 'frontend/views/errors/qr-not-found.php';
            exit;
        }
        
        // Tarama kaydını ekle
        if ($qrCode['scan_tracking']) {
            recordQRScan($qrCode['id']);
            updateQRStats($qrCode['id']);
        }
        
        // QR kod türüne göre yönlendir
        redirectToDestination($qrCode);
        
    } catch (Exception $e) {
        // Hata durumunda ana sayfaya yönlendir
        header("Location: /dashboard/qr-code.com.tr/");
        exit;
    }
}

function recordQRScan($qrId) {
    global $pdo;
    
    // Tarama verilerini topla
    $scanData = [
        'qr_id' => $qrId,
        'ip_address' => getRealIpAddr(),
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'country' => getCountryFromIP(getRealIpAddr()),
        'city' => getCityFromIP(getRealIpAddr()),
        'device_type' => getDeviceType($_SERVER['HTTP_USER_AGENT'] ?? ''),
        'browser' => getBrowser($_SERVER['HTTP_USER_AGENT'] ?? ''),
        'referer' => $_SERVER['HTTP_REFERER'] ?? ''
    ];
    
    // qr_analytics tablosuna kaydet
    $stmt = $pdo->prepare("
        INSERT INTO qr_analytics (qr_id, user_id, scan_time, ip_address, user_agent, country, city, device_type, browser, referer) 
        VALUES (?, NULL, NOW(), ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $scanData['qr_id'],
        $scanData['ip_address'],
        $scanData['user_agent'],
        $scanData['country'],
        $scanData['city'],
        $scanData['device_type'],
        $scanData['browser'],
        $scanData['referer']
    ]);
    
    // qr_scans tablosuna da kaydet (eski uyumluluk için)
    $stmt2 = $pdo->prepare("
        INSERT INTO qr_scans (qr_code_id, ip_address, user_agent, location) 
        VALUES (?, ?, ?, ?)
    ");
    
    $stmt2->execute([
        $qrId,
        $scanData['ip_address'],
        $scanData['user_agent'],
        $scanData['city'] . ', ' . $scanData['country']
    ]);
}

function updateQRStats($qrId) {
    global $pdo;
    
    // QR kod istatistiklerini güncelle
    $stmt = $pdo->prepare("
        UPDATE qr_codes 
        SET scan_count = scan_count + 1, 
            total_scans = total_scans + 1,
            last_scan_date = NOW() 
        WHERE id = ?
    ");
    $stmt->execute([$qrId]);
}

function redirectToDestination($qrCode) {
    $data = $qrCode['data'];
    $type = $qrCode['type'];
    
    switch ($type) {
        case 'url':
            // URL yönlendirme
            $url = $data;
            if (!preg_match('/^https?:\/\//', $url)) {
                $url = 'http://' . $url;
            }
            header("Location: " . $url);
            break;
            
        case 'wifi':
            // WiFi bilgilerini göster
            showWiFiInfo($data);
            break;
            
        case 'whatsapp':
            // WhatsApp linkine yönlendir
            $settings = json_decode($qrCode['settings'], true) ?? [];
            $phone = $settings['phone'] ?? '';
            $message = $settings['message'] ?? '';
            $whatsappUrl = "https://wa.me/" . $phone . "?text=" . urlencode($message);
            header("Location: " . $whatsappUrl);
            break;
            
        case 'email':
            // E-posta uygulamasını aç
            $settings = json_decode($qrCode['settings'], true) ?? [];
            $email = $settings['email'] ?? '';
            $subject = $settings['subject'] ?? '';
            $body = $settings['body'] ?? '';
            $mailtoUrl = "mailto:" . $email . "?subject=" . urlencode($subject) . "&body=" . urlencode($body);
            header("Location: " . $mailtoUrl);
            break;
            
        case 'phone':
            // Telefon aramasını başlat
            header("Location: tel:" . $data);
            break;
            
        case 'sms':
            // SMS uygulamasını aç
            $settings = json_decode($qrCode['settings'], true) ?? [];
            $phone = $settings['phone'] ?? '';
            $message = $settings['message'] ?? '';
            $smsUrl = "sms:" . $phone . "?body=" . urlencode($message);
            header("Location: " . $smsUrl);
            break;
            
        case 'vcard':
            // vCard bilgilerini göster
            showVCardInfo($qrCode);
            break;
            
        case 'text':
            // Metin göster
            showText($data);
            break;
            
        default:
            // Varsayılan olarak metni göster
            showText($data);
    }
    exit;
}

// Yardımcı fonksiyonlar
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function getDeviceType($userAgent) {
    if (preg_match('/mobile|android|iphone/i', $userAgent)) {
        return 'Mobile';
    } elseif (preg_match('/tablet|ipad/i', $userAgent)) {
        return 'Tablet';
    } else {
        return 'Desktop';
    }
}

function getBrowser($userAgent) {
    if (strpos($userAgent, 'Chrome') !== false) return 'Chrome';
    if (strpos($userAgent, 'Firefox') !== false) return 'Firefox';
    if (strpos($userAgent, 'Safari') !== false) return 'Safari';
    if (strpos($userAgent, 'Edge') !== false) return 'Edge';
    return 'Other';
}

function getOS($userAgent) {
    if (strpos($userAgent, 'Windows') !== false) return 'Windows';
    if (strpos($userAgent, 'Mac') !== false) return 'macOS';
    if (strpos($userAgent, 'Linux') !== false) return 'Linux';
    if (strpos($userAgent, 'Android') !== false) return 'Android';
    if (strpos($userAgent, 'iOS') !== false) return 'iOS';
    return 'Other';
}

function getCountryFromIP($ip) {
    // Basit geolocation - production'da geoip2 veya API kullanın
    return 'Turkey';
}

function getCityFromIP($ip) {
    // Basit geolocation - production'da geoip2 veya API kullanın
    return 'Istanbul';
}

function showWiFiInfo($data) {
    $settings = json_decode($data, true) ?? [];
    include 'frontend/views/qr/wifi-display.php';
}

function showVCardInfo($qrCode) {
    include 'frontend/views/qr/vcard-display.php';
}

function showText($text) {
    include 'frontend/views/qr/text-display.php';
}

// QR yönlendirmeyi başlat
if (isset($shortCode)) {
    handleQRRedirect($shortCode);
}
?>