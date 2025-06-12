<?php
echo "<h2>🔧 Direct API Test</h2>";

// Direct API call test
echo "<h3>Direct API Testi:</h3>";
echo "<button onclick='testDirectAPI()'>Direct API Test</button>";
echo "<div id='direct-result'></div>";

echo "<h3>Index.php Routing Testi:</h3>";
echo "<button onclick='testRoutingAPI()'>Routing API Test</button>";
echo "<div id='routing-result'></div>";
?>

<script>
function testDirectAPI() {
    const formData = new FormData();
    formData.append('email', 'admin@qr-code.com.tr');
    formData.append('password', 'admin123');
    
    // Direkt dosyaya çağrı
    fetch('/dashboard/qr-code.com.tr/backend/api/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.text();
    })
    .then(data => {
        document.getElementById('direct-result').innerHTML = '<pre>' + data + '</pre>';
    })
    .catch(error => {
        document.getElementById('direct-result').innerHTML = '<pre style="color: red;">Direct Error: ' + error + '</pre>';
    });
}

function testRoutingAPI() {
    const formData = new FormData();
    formData.append('email', 'admin@qr-code.com.tr');
    formData.append('password', 'admin123');
    
    // Routing üzerinden çağrı
    fetch('/dashboard/qr-code.com.tr/api/login', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Routing Response status:', response.status);
        return response.text();
    })
    .then(data => {
        document.getElementById('routing-result').innerHTML = '<pre>' + data + '</pre>';
    })
    .catch(error => {
        document.getElementById('routing-result').innerHTML = '<pre style="color: red;">Routing Error: ' + error + '</pre>';
    });
}
</script>