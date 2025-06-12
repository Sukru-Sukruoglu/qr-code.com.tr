<?php
// Config dosyalarını dahil et
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(__DIR__ . '/../../..'));
}
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/dashboard/qr-code.com.tr');
}

// Zaten giriş yapmışsa dashboard'a yönlendir
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: /dashboard/qr-code.com.tr/dashboard');
    exit;
}

$pageTitle = "Giriş Yap | QR-CODE.COM.TR";
$pageClass = "auth-page";
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

<div class="auth-container">
    <div class="auth-split">
        <!-- Sol Taraf - Bilgi Bölümü -->
        <div class="auth-info">
            <div class="auth-info-content">
                <div class="logo">
                    <i class="fas fa-qrcode"></i>
                    <span>QR-CODE.COM.TR</span>
                </div>
                
                <h1>Tekrar Hoş Geldiniz</h1>
                <p>QR kod projelerinize devam etmek için giriş yapın.</p>
                
                <div class="features">
                    <div class="feature">
                        <i class="fas fa-chart-bar"></i>
                        <div>
                            <h3>Analitik Dashboard</h3>
                            <p>QR kodlarınızın performansını takip edin</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <i class="fas fa-cloud"></i>
                        <div>
                            <h3>Bulut Depolama</h3>
                            <p>Tüm QR kodlarınız güvenle saklanır</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <i class="fas fa-mobile-alt"></i>
                        <div>
                            <h3>Mobil Uyumlu</h3>
                            <p>Her cihazdan kolayca erişim</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sağ Taraf - Giriş Formu -->
        <div class="auth-form">
            <div class="form-container">
                <div class="form-header">
                    <h2>Giriş Yap</h2>
                    <p>Hesabınıza erişim için bilgilerinizi girin</p>
                </div>

                <!-- Alert Messages -->
                <div id="alert-container" style="display: none;">
                    <div id="alert-message" class="alert"></div>
                </div>

                <form id="loginForm" method="POST">
                    <div class="form-group">
                        <label for="email">E-posta Adresi</label>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" required placeholder="ornek@email.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Şifre</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" required placeholder="Şifrenizi girin">
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="checkmark"></span>
                            Beni Hatırla
                        </label>
                        <a href="/dashboard/qr-code.com.tr/sifremi-unuttum" class="forgot-password">Şifremi Unuttum</a>
                    </div>

                    <button type="submit" class="btn btn-primary" id="loginBtn">
                        <span class="btn-text">Giriş Yap</span>
                        <span class="btn-loader" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Giriş yapılıyor...
                        </span>
                    </button>
                </form>

                <div class="form-footer">
                    <p>Henüz hesabınız yok mu? <a href="/dashboard/qr-code.com.tr/kayit">Kayıt Ol</a></p>
                </div>

                <!-- Demo Kullanıcılar -->
                <div class="demo-users">
                    <h4>🧪 Demo Hesaplar</h4>
                    <div class="demo-accounts">
                        <div class="demo-account">
                            <strong>Admin:</strong> admin@qr-code.com.tr / admin123
                        </div>
                        <div class="demo-account">
                            <strong>User:</strong> user@test.com / 123456
                        </div>
                        <div class="demo-account">
                            <strong>Demo:</strong> demo@demo.com / demo123
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Auth Container */
.auth-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    font-family: 'Inter', sans-serif;
}

.auth-split {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    overflow: hidden;
    max-width: 1200px;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 600px;
}

/* Sol Taraf - Info */
.auth-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-info-content {
    max-width: 400px;
}

.logo {
    display: flex;
    align-items: center;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    gap: 0.5rem;
}

.logo i {
    font-size: 2rem;
}

.auth-info h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.auth-info > p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.features {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.feature {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.feature i {
    font-size: 1.5rem;
    opacity: 0.8;
}

.feature h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.3rem;
}

.feature p {
    font-size: 0.9rem;
    opacity: 0.8;
    margin: 0;
}

/* Sağ Taraf - Form */
.auth-form {
    padding: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-container {
    width: 100%;
    max-width: 400px;
}

.form-header {
    text-align: center;
    margin-bottom: 2rem;
}

.form-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.form-header p {
    color: #64748b;
    margin: 0;
}

/* Form Elementleri */
.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-group i {
    position: absolute;
    left: 1rem;
    color: #9ca3af;
    z-index: 2;
}

.input-group input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.input-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.password-toggle {
    position: absolute;
    right: 1rem;
    background: none;
    border: none;
    color: #9ca3af;
    cursor: pointer;
    padding: 0.5rem;
    z-index: 2;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.checkbox-container {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 0.9rem;
    color: #374151;
}

.checkbox-container input {
    margin-right: 0.5rem;
}

.forgot-password {
    color: #667eea;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
}

.forgot-password:hover {
    text-decoration: underline;
}

/* Button */
.btn {
    width: 100%;
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.form-footer {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

.form-footer a {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
}

.form-footer a:hover {
    text-decoration: underline;
}

/* Alert */
.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    font-weight: 500;
}

.alert.error {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.alert.success {
    background: #f0fdf4;
    color: #16a34a;
    border: 1px solid #bbf7d0;
}

/* Demo Users */
.demo-users {
    margin-top: 2rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.demo-users h4 {
    margin: 0 0 1rem 0;
    color: #475569;
    font-size: 0.9rem;
}

.demo-accounts {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.demo-account {
    font-size: 0.8rem;
    color: #64748b;
    font-family: 'Courier New', monospace;
    background: white;
    padding: 0.5rem;
    border-radius: 6px;
}

/* Responsive */
@media (max-width: 768px) {
    .auth-split {
        grid-template-columns: 1fr;
        max-width: 500px;
    }
    
    .auth-info {
        padding: 2rem;
    }
    
    .auth-info h1 {
        font-size: 2rem;
    }
    
    .auth-form {
        padding: 2rem;
    }
}

@media (max-width: 480px) {
    .auth-container {
        padding: 1rem;
    }
    
    .auth-info, .auth-form {
        padding: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const btnText = loginBtn.querySelector('.btn-text');
    const btnLoader = loginBtn.querySelector('.btn-loader');
    const alertContainer = document.getElementById('alert-container');
    const alertMessage = document.getElementById('alert-message');

    // Form submit
    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Button loading state
        loginBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoader.style.display = 'flex';
        
        // Hide previous alerts
        alertContainer.style.display = 'none';
        
        try {
            const formData = new FormData(loginForm);
            
            // GEÇİCİ ÇÖZÜM: Direct API çağrısı
            const response = await fetch('/dashboard/qr-code.com.tr/backend/api/login.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                showAlert(data.message, 'success');
                setTimeout(() => {
                    window.location.href = '/dashboard/qr-code.com.tr/dashboard';
                }, 1500);
            } else {
                showAlert(data.message, 'error');
                resetButton();
            }
            
        } catch (error) {
            console.error('Error:', error);
            showAlert('Bağlantı hatası. Lütfen tekrar deneyin.', 'error');
            resetButton();
        }
    });
    
    function showAlert(message, type) {
        alertMessage.textContent = message;
        alertMessage.className = 'alert ' + type;
        alertContainer.style.display = 'block';
        alertContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    
    function resetButton() {
        loginBtn.disabled = false;
        btnText.style.display = 'inline';
        btnLoader.style.display = 'none';
    }
});

// Password toggle
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordEye = document.getElementById('password-eye');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordEye.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        passwordEye.className = 'fas fa-eye';
    }
}
</script>

</body>
</html>