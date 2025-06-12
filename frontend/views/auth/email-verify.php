<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\auth\email-verify.php
$pageTitle = "E-posta Doğrulama | QR-CODE.COM.TR";
$pageClass = "auth-page";
include ROOT_PATH . '/frontend/components/header.php';

$token = $_GET['token'] ?? '';
$status = '';
$message = '';

if ($token) {
    require_once ROOT_PATH . '/config/database.php';
    
    try {
        $pdo = Database::getInstance()->getConnection();
        
        // Check if token exists and is valid
        $stmt = $pdo->prepare("SELECT id, first_name, email_verified FROM users WHERE email_verification_token = ?");
        $stmt->execute([$token]);
        $user = $stmt->fetch();
        
        if ($user) {
            if ($user['email_verified']) {
                $status = 'already_verified';
                $message = 'E-posta adresiniz zaten doğrulanmış.';
            } else {
                // Verify the email
                $stmt = $pdo->prepare("UPDATE users SET email_verified = 1, email_verification_token = NULL WHERE email_verification_token = ?");
                $result = $stmt->execute([$token]);
                
                if ($result) {
                    $status = 'success';
                    $message = 'E-posta adresiniz başarıyla doğrulandı!';
                } else {
                    $status = 'error';
                    $message = 'Doğrulama sırasında bir hata oluştu.';
                }
            }
        } else {
            $status = 'invalid';
            $message = 'Geçersiz veya süresi dolmuş doğrulama linki.';
        }
    } catch (Exception $e) {
        $status = 'error';
        $message = 'Doğrulama sırasında bir hata oluştu.';
    }
} else {
    $status = 'no_token';
    $message = 'Doğrulama kodu bulunamadı.';
}
?>

<main class="auth-main">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <i class="fas fa-qrcode"></i>
                    <h1>QR-CODE.COM.TR</h1>
                </div>
                <h2>E-posta Doğrulama</h2>
            </div>

            <div class="verification-result">
                <?php if ($status === 'success'): ?>
                    <div class="result-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Doğrulama Başarılı!</h3>
                    <p><?php echo $message; ?></p>
                    <p>Artık tüm QR kod özelliklerini kullanabilirsiniz.</p>
                    
                    <div class="result-actions">
                        <a href="<?php echo SITE_URL; ?>/giris" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Giriş Yap
                        </a>
                        <a href="<?php echo SITE_URL; ?>" class="btn btn-outline">
                            <i class="fas fa-home"></i> Ana Sayfa
                        </a>
                    </div>

                <?php elseif ($status === 'already_verified'): ?>
                    <div class="result-icon info">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3>Zaten Doğrulanmış</h3>
                    <p><?php echo $message; ?></p>
                    
                    <div class="result-actions">
                        <a href="<?php echo SITE_URL; ?>/giris" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Giriş Yap
                        </a>
                    </div>

                <?php else: ?>
                    <div class="result-icon error">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3>Doğrulama Başarısız</h3>
                    <p><?php echo $message; ?></p>
                    
                    <div class="result-actions">
                        <a href="<?php echo SITE_URL; ?>/kayit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Yeniden Kayıt Ol
                        </a>
                        <a href="<?php echo SITE_URL; ?>" class="btn btn-outline">
                            <i class="fas fa-home"></i> Ana Sayfa
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="help-section">
                <h4>Yardıma mı ihtiyacınız var?</h4>
                <p>Doğrulama ile ilgili sorun yaşıyorsanız:</p>
                <ul>
                    <li>Spam/Junk klasörünüzü kontrol edin</li>
                    <li>E-posta adresinizi doğru yazdığınızdan emin olun</li>
                    <li>Birkaç dakika bekleyip tekrar deneyin</li>
                </ul>
                <p>Sorun devam ederse <a href="mailto:destek@qr-code.com.tr">destek@qr-code.com.tr</a> adresinden bizimle iletişime geçin.</p>
            </div>
        </div>
    </div>
</main>

<style>
.auth-main {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    padding: 2rem 0;
}

.auth-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 0 1rem;
}

.auth-card {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.auth-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.auth-logo i {
    color: #667eea;
    font-size: 2rem;
}

.auth-logo h1 {
    color: #2d3748;
    font-size: 1.5rem;
    margin: 0;
}

.verification-result {
    text-align: center;
    margin-bottom: 2rem;
}

.result-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.result-icon i {
    font-size: 2.5rem;
}

.result-icon.success {
    background: #c6f6d5;
    color: #2f855a;
}

.result-icon.error {
    background: #fed7d7;
    color: #c53030;
}

.result-icon.info {
    background: #bee3f8;
    color: #3182ce;
}

.verification-result h3 {
    color: #2d3748;
    margin-bottom: 1rem;
}

.verification-result p {
    color: #4a5568;
    margin-bottom: 1rem;
}

.result-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.help-section {
    background: #f7fafc;
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 2rem;
}

.help-section h4 {
    color: #2d3748;
    margin-bottom: 1rem;
}

.help-section p {
    color: #4a5568;
    margin-bottom: 1rem;
}

.help-section ul {
    color: #4a5568;
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.help-section li {
    margin-bottom: 0.5rem;
}

.help-section a {
    color: #667eea;
    text-decoration: none;
}

.help-section a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .auth-card {
        padding: 2rem;
    }
    
    .result-actions {
        flex-direction: column;
    }
}
</style>

<?php include ROOT_PATH . '/frontend/components/footer.php'; ?>