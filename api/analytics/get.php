<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\api\analytics\get.php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Oturum gerekli']);
    exit;
}

require_once __DIR__ . '/../../config/database.php';

try {
    $qr_id = $_GET['qr_id'] ?? null;
    
    if (!$qr_id) {
        echo json_encode(['success' => false, 'error' => 'QR ID gerekli']);
        exit;
    }
    
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // QR kodunun kullanıcıya ait olduğunu kontrol et
    $stmt = $pdo->prepare("SELECT id FROM qr_codes WHERE id = ? AND user_id = ?");
    $stmt->execute([$qr_id, $_SESSION['user_id']]);
    
    if (!$stmt->fetch()) {
        echo json_encode(['success' => false, 'error' => 'Yetkisiz erişim']);
        exit;
    }
    
    // Özet istatistikler
    $summary = getSummaryStats($pdo, $qr_id);
    
    // Günlük tarama verileri (son 30 gün)
    $dailyScans = getDailyScans($pdo, $qr_id);
    
    // Cihaz türü dağılımı
    $deviceTypes = getDeviceTypes($pdo, $qr_id);
    
    // Tarayıcı dağılımı
    $browsers = getBrowsers($pdo, $qr_id);
    
    // Ülke dağılımı
    $countries = getCountries($pdo, $qr_id);
    
    // Son taramalar
    $recentScans = getRecentScans($pdo, $qr_id);
    
    echo json_encode([
        'success' => true,
        'summary' => $summary,
        'dailyScans' => $dailyScans,
        'deviceTypes' => $deviceTypes,
        'browsers' => $browsers,
        'countries' => $countries,
        'recentScans' => $recentScans
    ]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Veri yüklenirken hata oluştu']);
}

function getSummaryStats($pdo, $qr_id) {
    // Bugünkü taramalar
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as today_scans 
        FROM qr_analytics 
        WHERE qr_id = ? AND DATE(scan_time) = CURDATE()
    ");
    $stmt->execute([$qr_id]);
    $today = $stmt->fetch()['today_scans'];
    
    // Bu haftaki taramalar
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as week_scans 
        FROM qr_analytics 
        WHERE qr_id = ? AND scan_time >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");
    $stmt->execute([$qr_id]);
    $week = $stmt->fetch()['week_scans'];
    
    return [
        'today' => $today,
        'week' => $week
    ];
}

function getDailyScans($pdo, $qr_id) {
    $stmt = $pdo->prepare("
        SELECT DATE(scan_time) as scan_date, COUNT(*) as scan_count
        FROM qr_analytics
        WHERE qr_id = ? AND scan_time >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        GROUP BY DATE(scan_time)
        ORDER BY scan_date
    ");
    $stmt->execute([$qr_id]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $labels = [];
    $values = [];
    
    foreach ($results as $row) {
        $labels[] = date('d/m', strtotime($row['scan_date']));
        $values[] = (int)$row['scan_count'];
    }
    
    return ['labels' => $labels, 'values' => $values];
}

function getDeviceTypes($pdo, $qr_id) {
    $stmt = $pdo->prepare("
        SELECT device_type, COUNT(*) as count
        FROM qr_analytics
        WHERE qr_id = ?
        GROUP BY device_type
        ORDER BY count DESC
    ");
    $stmt->execute([$qr_id]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $labels = [];
    $values = [];
    
    foreach ($results as $row) {
        $labels[] = $row['device_type'] ?: 'Bilinmiyor';
        $values[] = (int)$row['count'];
    }
    
    return ['labels' => $labels, 'values' => $values];
}

function getBrowsers($pdo, $qr_id) {
    $stmt = $pdo->prepare("
        SELECT browser, COUNT(*) as count
        FROM qr_analytics
        WHERE qr_id = ?
        GROUP BY browser
        ORDER BY count DESC
        LIMIT 5
    ");
    $stmt->execute([$qr_id]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $labels = [];
    $values = [];
    
    foreach ($results as $row) {
        $labels[] = $row['browser'] ?: 'Bilinmiyor';
        $values[] = (int)$row['count'];
    }
    
    return ['labels' => $labels, 'values' => $values];
}

function getCountries($pdo, $qr_id) {
    $stmt = $pdo->prepare("
        SELECT country, COUNT(*) as count
        FROM qr_analytics
        WHERE qr_id = ? AND country IS NOT NULL
        GROUP BY country
        ORDER BY count DESC
        LIMIT 10
    ");
    $stmt->execute([$qr_id]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $labels = [];
    $values = [];
    
    foreach ($results as $row) {
        $labels[] = $row['country'];
        $values[] = (int)$row['count'];
    }
    
    return ['labels' => $labels, 'values' => $values];
}

function getRecentScans($pdo, $qr_id) {
    $stmt = $pdo->prepare("
        SELECT scan_time, ip_address, country, city, device_type, browser
        FROM qr_analytics
        WHERE qr_id = ?
        ORDER BY scan_time DESC
        LIMIT 50
    ");
    $stmt->execute([$qr_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>