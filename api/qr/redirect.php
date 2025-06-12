<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\api\qr\redirect.php
require_once __DIR__ . '/../../config/database.php';

header('Content-Type: application/json');

try {
    // QR kod ID'sini al
    $qr_code = $_GET['code'] ?? null;
    
    if (!$qr_code) {
        http_response_code(404);
        echo json_encode(['error' => 'QR kod bulunamadı']);
        exit;
    }
    
    // Veritabanı bağlantısı
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // QR kodu bilgilerini getir
    $stmt = $pdo->prepare("SELECT * FROM qr_codes WHERE code = ? AND status = 'active'");
    $stmt->execute([$qr_code]);
    $qr = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$qr) {
        http_response_code(404);
        echo json_encode(['error' => 'QR kod bulunamadı veya aktif değil']);
        exit;
    }
    
    // Takip etkinse analitik kaydet
    if ($qr['scan_tracking']) {
        recordScan($pdo, $qr['id']);
    }
    
    // Hedef URL'ye yönlendir
    $targetUrl = $qr['content'];
    
    // URL formatını kontrol et
    if (!filter_var($targetUrl, FILTER_VALIDATE_URL)) {
        // Eğer geçerli URL değilse, data tipine göre işle
        switch ($qr['type']) {
            case 'text':
                // Metin QR için özel sayfa
                header('Location: /qr/view/' . $qr_code);
                break;
            case 'wifi':
                // WiFi QR için özel sayfa
                header('Location: /qr/wifi-connect/' . $qr_code);
                break;
            case 'vcard':
                // vCard QR için download
                header('Content-Type: text/vcard');
                header('Content-Disposition: attachment; filename="contact.vcf"');
                echo $qr['content'];
                break;
            default:
                header('Location: /qr/view/' . $qr_code);
        }
    } else {
        // Geçerli URL ise direkt yönlendir
        header('Location: ' . $targetUrl);
    }
    
    exit;
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Sunucu hatası']);
}

function recordScan($pdo, $qr_id) {
    // User agent analizi
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $deviceType = detectDeviceType($userAgent);
    $browser = detectBrowser($userAgent);
    
    // IP adresi
    $ipAddress = getRealIP();
    
    // Lokasyon bilgisi (GeoIP servisi)
    $location = getLocationFromIP($ipAddress);
    
    // Analitik kaydı ekle
    $stmt = $pdo->prepare("
        INSERT INTO qr_analytics 
        (qr_id, ip_address, user_agent, country, city, device_type, browser, referer) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $qr_id,
        $ipAddress,
        $userAgent,
        $location['country'] ?? null,
        $location['city'] ?? null,
        $deviceType,
        $browser,
        $_SERVER['HTTP_REFERER'] ?? null
    ]);
    
    // QR kod toplam tarama sayısını güncelle
    $stmt = $pdo->prepare("
        UPDATE qr_codes 
        SET total_scans = total_scans + 1, last_scan_date = NOW() 
        WHERE id = ?
    ");
    $stmt->execute([$qr_id]);
}

function detectDeviceType($userAgent) {
    if (preg_match('/Mobile|Android|iPhone|iPad/', $userAgent)) {
        if (preg_match('/iPad/', $userAgent)) return 'Tablet';
        return 'Mobile';
    }
    return 'Desktop';
}

function detectBrowser($userAgent) {
    if (preg_match('/Chrome/', $userAgent)) return 'Chrome';
    if (preg_match('/Firefox/', $userAgent)) return 'Firefox';
    if (preg_match('/Safari/', $userAgent)) return 'Safari';
    if (preg_match('/Edge/', $userAgent)) return 'Edge';
    return 'Diğer';
}

function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $_SERVER['REMOTE_ADDR'];
}

function getLocationFromIP($ip) {
    // Ücretsiz GeoIP servisi (örnek)
    try {
        $response = file_get_contents("http://ip-api.com/json/{$ip}");
        $data = json_decode($response, true);
        
        if ($data['status'] === 'success') {
            return [
                'country' => $data['country'],
                'city' => $data['city']
            ];
        }
    } catch (Exception $e) {
        // Hata durumunda sessiz devam et
    }
    
    return ['country' => null, 'city' => null];
}
?>