<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Debug Test</title>
    <style>
        body { font-family: Arial; padding: 2rem; background: #f5f5f5; }
        .box { background: white; padding: 2rem; margin: 1rem 0; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: green; } .error { color: red; }
        button { padding: 1rem 2rem; margin: 0.5rem; background: #667eea; color: white; border: none; border-radius: 8px; cursor: pointer; }
        pre { background: #f8f9fa; padding: 1rem; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>🔧 Debug Test Panel</h1>
    
    <div class="box">
        <h2>📁 Dosya Kontrolleri</h2>
        <?php
        $files = [
            'backend/api/login.php' => 'API Login Dosyası',
            '.htaccess' => 'Rewrite Rules',
            'index.php' => 'Ana Router'
        ];
        
        foreach ($files as $file => $name) {
            $exists = file_exists($file);
            echo "<p><strong>$name:</strong> <span class='" . ($exists ? 'success' : 'error') . "'>";
            echo $exists ? '✅ VAR' : '❌ YOK';
            echo "</span></p>";
            if ($exists && $file !== '.htaccess') {
                echo "<small>Yol: " . realpath($file) . "</small><br>";
            }
        }
        ?>
    </div>
    
    <div class="box">
        <h2>🌐 API Testleri</h2>
        <button onclick="testDirectAPI()">Direct API Test</button>
        <button onclick="testRoutingAPI()">Routing API Test</button>
        <div id="test-results"></div>
    </div>
    
    <div class="box">
        <h2>📊 Server Bilgileri</h2>
        <pre><?php
        echo "PHP Version: " . PHP_VERSION . "\n";
        echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
        echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
        echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
        echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "\n";
        echo "Mod Rewrite: " . (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules()) ? 'Aktif' : 'Bilinmiyor') . "\n";
        ?></pre>
    </div>

    <script>
    function testDirectAPI() {
        const formData = new FormData();
        formData.append('email', 'admin@qr-code.com.tr');
        formData.append('password', 'admin123');
        
        fetch('/dashboard/qr-code.com.tr/backend/api/login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text().then(text => ({
                status: response.status,
                text: text
            }));
        })
        .then(data => {
            document.getElementById('test-results').innerHTML = 
                '<h3>Direct API Sonucu:</h3><pre>Status: ' + data.status + '\n\n' + data.text + '</pre>';
        })
        .catch(error => {
            document.getElementById('test-results').innerHTML = 
                '<h3>Direct API Hatası:</h3><pre style="color: red;">' + error + '</pre>';
        });
    }

    function testRoutingAPI() {
        const formData = new FormData();
        formData.append('email', 'admin@qr-code.com.tr');
        formData.append('password', 'admin123');
        
        fetch('/dashboard/qr-code.com.tr/api/login', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text().then(text => ({
                status: response.status,
                text: text
            }));
        })
        .then(data => {
            document.getElementById('test-results').innerHTML = 
                '<h3>Routing API Sonucu:</h3><pre>Status: ' + data.status + '\n\n' + data.text + '</pre>';
        })
        .catch(error => {
            document.getElementById('test-results').innerHTML = 
                '<h3>Routing API Hatası:</h3><pre style="color: red;">' + error + '</pre>';
        });
    }
    </script>
</body>
</html>