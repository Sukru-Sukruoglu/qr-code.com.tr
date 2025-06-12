<?php
echo "<h2>🔧 API Test</h2>";

echo "<h3>Dosya Kontrolü:</h3>";
$apiFile = 'backend/api/login.php';
echo "Dosya: $apiFile<br>";
echo "Var mı: " . (file_exists($apiFile) ? '✅ EVET' : '❌ HAYIR') . "<br>";
echo "Tam yol: " . realpath($apiFile) . "<br>";

echo "<h3>Klasör Kontrolü:</h3>";
echo "Backend klasörü: " . (is_dir('backend') ? '✅ VAR' : '❌ YOK') . "<br>";
echo "API klasörü: " . (is_dir('backend/api') ? '✅ VAR' : '❌ YOK') . "<br>";

echo "<h3>Dosya Listesi:</h3>";
if (is_dir('backend/api')) {
    $files = scandir('backend/api');
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "📁 $file<br>";
        }
    }
} else {
    echo "❌ backend/api klasörü yok!<br>";
}

echo "<h3>Test API Çağrısı:</h3>";
echo "<button onclick='testAPI()'>API Test Et</button>";
echo "<div id='result'></div>";
?>

<script>
function testAPI() {
    const formData = new FormData();
    formData.append('email', 'admin@qr-code.com.tr');
    formData.append('password', 'admin123');
    
    fetch('/dashboard/qr-code.com.tr/api/login', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('result').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
    })
    .catch(error => {
        document.getElementById('result').innerHTML = '<pre style="color: red;">Error: ' + error + '</pre>';
    });
}
</script>