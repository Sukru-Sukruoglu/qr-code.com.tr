<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\errors\404.php
$pageTitle = "Sayfa Bulunamadı | QR-CODE.COM.TR";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="error-container">
    <div class="error-content">
        <div class="error-icon">
            <i class="fas fa-search"></i>
        </div>
        
        <h1>404</h1>
        <h2>Sayfa Bulunamadı</h2>
        <p>Aradığınız sayfa bulunamadı veya taşınmış olabilir.</p>
        
        <div class="error-actions">
            <a href="/" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Ana Sayfaya Dön
            </a>
            
            <a href="/giris" class="btn btn-secondary">
                <i class="fas fa-sign-in-alt"></i>
                Giriş Yap
            </a>
        </div>
        
        <div class="popular-pages">
            <h3>Popüler Sayfalar</h3>
            <ul>
                <li><a href="/qr-olustur">QR Kod Oluştur</a></li>
                <li><a href="/kayit">Kayıt Ol</a></li>
                <li><a href="/giris">Giriş Yap</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.error-container {
    text-align: center;
    padding: 2rem;
    max-width: 600px;
}

.error-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.8;
}

h1 {
    font-size: 6rem;
    font-weight: 700;
    margin-bottom: 1rem;
    opacity: 0.9;
}

h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

p {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-primary {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-primary:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.popular-pages {
    background: rgba(255, 255, 255, 0.1);
    padding: 1.5rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.popular-pages h3 {
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.popular-pages ul {
    list-style: none;
}

.popular-pages li {
    margin-bottom: 0.5rem;
}

.popular-pages a {
    color: white;
    text-decoration: none;
    opacity: 0.9;
    transition: opacity 0.3s ease;
}

.popular-pages a:hover {
    opacity: 1;
    text-decoration: underline;
}

@media (max-width: 768px) {
    h1 {
        font-size: 4rem;
    }
    
    h2 {
        font-size: 1.5rem;
    }
    
    .error-actions {
        flex-direction: column;
    }
}
</style>

</body>
</html>