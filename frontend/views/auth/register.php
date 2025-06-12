<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\auth\register.php
// Config dosyalarını dahil et
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(__DIR__ . '/../../..'));
}
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/dashboard/qr-code.com.tr');
}

$pageTitle = "Kayıt Ol | QR-CODE.COM.TR";
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
                
                <h1>QR Kod Dünyasına Hoş Geldiniz</h1>
                <p>Ücretsiz ve gelişmiş QR kod oluşturucu ile dijital dünyada yerinizi alın.</p>
                
                <div class="features">
                    <div class="feature">
                        <i class="fas fa-bolt"></i>
                        <div>
                            <h3>Hızlı ve Kolay</h3>
                            <p>Saniyeler içinde profesyonel QR kodlar oluşturun</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <i class="fas fa-palette"></i>
                        <div>
                            <h3>Özelleştirilebilir</h3>
                            <p>Renk, boyut ve stil seçenekleri ile kişiselleştirin</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <i class="fas fa-chart-line"></i>
                        <div>
                            <h3>Analitik Takip</h3>
                            <p>QR kodlarınızın performansını izleyin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sağ Taraf - Form Bölümü -->
        <div class="auth-form-section">
            <div class="auth-form-container">
                <div class="auth-header">
                    <h2>Hesap Oluşturun</h2>
                    <p>Bugün QR kod oluşturmaya başlayın</p>
                </div>

                <form id="registerForm" class="auth-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">Ad</label>
                            <input type="text" id="firstName" name="first_name" placeholder="Adınız" required>
                        </div>

                        <div class="form-group">
                            <label for="lastName">Soyad</label>
                            <input type="text" id="lastName" name="last_name" placeholder="Soyadınız" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-posta Adresi</label>
                        <input type="email" id="email" name="email" placeholder="ornek@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefon Numarası</label>
                        <input type="tel" id="phone" name="phone" placeholder="+90 555 123 45 67" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Şifre</label>
                        <div class="password-input">
                            <input type="password" id="password" name="password" placeholder="Güçlü bir şifre oluşturun" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-fill"></div>
                            </div>
                            <span class="strength-text">Şifre gücü</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Şifre Tekrar</label>
                        <div class="password-input">
                            <input type="password" id="confirmPassword" name="confirm_password" placeholder="Şifrenizi tekrar girin" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="terms" name="terms" required>
                            <span class="checkmark"></span>
                            <span class="checkbox-text">
                                <a href="#" target="_blank">Kullanım Koşulları</a> ve 
                                <a href="#" target="_blank">Gizlilik Politikası</a>'nı okudum ve kabul ediyorum
                            </span>
                        </label>
                    </div>

                    <div id="errorMessage" class="alert alert-error" style="display: none;"></div>
                    <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                    <button type="submit" class="btn-submit">
                        <span class="btn-text">
                            <i class="fas fa-user-plus"></i>
                            Hesap Oluştur
                        </span>
                        <span class="btn-spinner" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i>
                            Oluşturuluyor...
                        </span>
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Zaten hesabınız var mı? <a href="<?php echo SITE_URL; ?>/giris">Giriş Yapın</a></p>
                </div>

                <div class="social-login">
                    <div class="divider">
                        <span>veya</span>
                    </div>
                    
                    <div class="social-buttons">
                        <button class="social-btn google">
                            <i class="fab fa-google"></i>
                            Google ile devam et
                        </button>
                        
                        <button class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                            Facebook ile devam et
                        </button>
                    </div>
                </div>
            </div>
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
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: #1a1a1a;
}

.auth-container {
    min-height: 100vh;
    display: flex;
}

.auth-split {
    display: flex;
    width: 100%;
}

/* Sol Taraf - Bilgi Bölümü */
.auth-info {
    flex: 1;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 3rem;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.auth-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>') repeat;
    opacity: 0.3;
}

.auth-info-content {
    position: relative;
    z-index: 1;
    color: white;
    max-width: 500px;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 3rem;
    font-size: 1.5rem;
    font-weight: 700;
}

.logo i {
    font-size: 2rem;
    color: #fff;
}

.auth-info h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.auth-info > p {
    font-size: 1.2rem;
    margin-bottom: 3rem;
    opacity: 0.9;
}

.features {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.feature {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.feature i {
    font-size: 1.5rem;
    margin-top: 0.25rem;
    color: #ffd700;
}

.feature h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.feature p {
    opacity: 0.8;
    font-size: 0.95rem;
}

/* Sağ Taraf - Form Bölümü */
.auth-form-section {
    flex: 1;
    background: white;
    display: flex;
    align-items: center;
    padding: 3rem;
}

.auth-form-container {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.auth-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.auth-header p {
    color: #666;
    font-size: 1rem;
}

.auth-form {
    margin-bottom: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-group input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fff;
}

.form-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.password-input {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #9ca3af;
    cursor: pointer;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #667eea;
}

.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    width: 100%;
    height: 4px;
    background: #e5e7eb;
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.25rem;
}

.strength-fill {
    height: 100%;
    width: 0%;
    background: #ef4444;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-text {
    font-size: 0.8rem;
    color: #6b7280;
}

.checkbox-group {
    margin-bottom: 2rem;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    cursor: pointer;
    font-size: 0.9rem;
    line-height: 1.5;
}

.checkbox-label input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #d1d5db;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    flex-shrink: 0;
    margin-top: 2px;
    background: white;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
    background: #667eea;
    border-color: #667eea;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
    content: "✓";
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.checkbox-text {
    color: #6b7280;
}

.checkbox-text a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.checkbox-text a:hover {
    text-decoration: underline;
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    border: 1px solid;
}

.alert-error {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

.alert-success {
    background: #f0fdf4;
    color: #16a34a;
    border-color: #bbf7d0;
}

.btn-submit {
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.btn-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn-text, .btn-spinner {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.auth-footer {
    text-align: center;
    margin: 2rem 0;
}

.auth-footer p {
    color: #6b7280;
    font-size: 0.95rem;
}

.auth-footer a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.auth-footer a:hover {
    text-decoration: underline;
}

.social-login {
    margin-top: 2rem;
}

.divider {
    position: relative;
    text-align: center;
    margin: 2rem 0;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #e5e7eb;
}

.divider span {
    background: white;
    padding: 0 1rem;
    color: #6b7280;
    font-size: 0.9rem;
}

.social-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.social-btn {
    width: 100%;
    padding: 0.875rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    background: white;
    color: #374151;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.social-btn:hover {
    border-color: #d1d5db;
    background: #f9fafb;
    transform: translateY(-1px);
}

.social-btn.google:hover {
    border-color: #ea4335;
    color: #ea4335;
}

.social-btn.facebook:hover {
    border-color: #1877f2;
    color: #1877f2;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .auth-split {
        flex-direction: column;
    }
    
    .auth-info {
        padding: 2rem;
    }
    
    .auth-info h1 {
        font-size: 2rem;
    }
    
    .features {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1.5rem;
    }
    
    .feature {
        flex: 1;
        min-width: 200px;
    }
}

@media (max-width: 768px) {
    .auth-info {
        padding: 1.5rem;
        text-align: center;
    }
    
    .auth-form-section {
        padding: 1.5rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .auth-info h1 {
        font-size: 1.8rem;
    }
    
    .features {
        gap: 1rem;
    }
    
    .feature {
        min-width: auto;
    }
}

@media (max-width: 480px) {
    .auth-info-content {
        max-width: none;
    }
    
    .logo {
        justify-content: center;
        margin-bottom: 2rem;
    }
    
    .features {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const passwordInput = document.getElementById('password');
    
    passwordInput.addEventListener('input', function() {
        checkPasswordStrength(this.value);
    });
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            submitRegistration();
        }
    });
    
    function checkPasswordStrength(password) {
        const strengthBar = document.querySelector('.strength-fill');
        const strengthText = document.querySelector('.strength-text');
        
        let strength = 0;
        let text = 'Zayıf';
        let color = '#e53e3e';
        
        if (password.length >= 8) strength += 25;
        if (/[a-z]/.test(password)) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 25;
        
        if (strength >= 75) {
            text = 'Güçlü';
            color = '#38a169';
        } else if (strength >= 50) {
            text = 'Orta';
            color = '#d69e2e';
        }
        
        strengthBar.style.width = Math.min(strength, 100) + '%';
        strengthBar.style.backgroundColor = color;
        strengthText.textContent = `Şifre gücü: ${text}`;
    }
    
    function validateForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        if (password !== confirmPassword) {
            showError('Şifreler eşleşmiyor');
            return false;
        }
        
        if (password.length < 8) {
            showError('Şifre en az 8 karakter olmalı');
            return false;
        }
        
        return true;
    }
    
    function submitRegistration() {
        const submitBtn = form.querySelector('[type="submit"]');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnSpinner = submitBtn.querySelector('.btn-spinner');
        
        btnText.style.display = 'none';
        btnSpinner.style.display = 'flex';
        submitBtn.disabled = true;
        
        const formData = new FormData(form);
        
        // Debug logs
        console.log('=== FORM SUBMISSION DEBUG ===');
        console.log('Target URL:', '<?php echo SITE_URL; ?>/api/register.php');
        console.log('Form data:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        
        fetch('<?php echo SITE_URL; ?>/api/register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log('Response received:', response);
            console.log('Response status:', response.status);
            console.log('Response ok:', response.ok);
            
            // Response'u klonla ki hem text hem JSON okuyabilelim
            return response.text().then(text => {
                console.log('Response text:', text);
                
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${text}`);
                }
                
                try {
                    const data = JSON.parse(text);
                    return data;
                } catch (parseError) {
                    console.error('JSON parse error:', parseError);
                    throw new Error('Invalid JSON response: ' + text);
                }
            });
        })
        .then(data => {
            console.log('Parsed JSON:', data);
            
            if (data.success) {
                showSuccess(data.message);
            } else {
                showError(data.message || 'Kayıt sırasında bir hata oluştu');
            }
        })
        .catch(error => {
            console.error('=== FETCH ERROR ===');
            console.error('Error message:', error.message);
            showError('Hata: ' + error.message);
        })
        .finally(() => {
            btnText.style.display = 'flex';
            btnSpinner.style.display = 'none';
            submitBtn.disabled = false;
        });
    }
    
    function showError(message) {
        const errorDiv = document.getElementById('errorMessage');
        const successDiv = document.getElementById('successMessage');
        
        successDiv.style.display = 'none';
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
    }
    
    function showSuccess(message) {
        const errorDiv = document.getElementById('errorMessage');
        const successDiv = document.getElementById('successMessage');
        
        errorDiv.style.display = 'none';
        successDiv.textContent = message;
        successDiv.style.display = 'block';
    }
});

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.nextElementSibling;
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>

