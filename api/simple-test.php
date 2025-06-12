<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\api\simple-test.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'POST gerekli']);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Test başarılı!',
    'received_data' => $_POST
]);
?>