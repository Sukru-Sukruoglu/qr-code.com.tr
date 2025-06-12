<?php
// filepath: c:\xampp\htdocs\dashboard\qr-code.com.tr\frontend\views\auth\logout.php
// Çıkış işlemi - Session kontrolü
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Session'ı temizle
session_unset();
session_destroy();

// Cookie'leri temizle (varsa)
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/');
}

// Base URL
$baseURL = '/dashboard/qr-code.com.tr';

// Redirect parametresi varsa ana sayfaya yönlendir
$redirectTo = $baseURL . '/';
if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
    $allowedRedirects = ['/', '/giris', '/kayit', '/hakkimizda', '/iletisim'];
    $redirect = $_GET['redirect'];
    if (in_array($redirect, $allowedRedirects)) {
        $redirectTo = $baseURL . $redirect;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çıkış Yapılıyor... | QR-CODE.COM.TR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 4rem 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 500px;
            width: 90%;
            animation: slideIn 0.6s ease-out;
        }

        .logout-icon {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .logout-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            font-family: 'Orbitron', monospace;
        }

        .logout-message {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .logout-progress {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #00d4ff, #ffffff, #00d4ff);
            border-radius: 10px;
            animation: progress 3s ease-in-out forwards;
        }

        .logout-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.875rem 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            backdrop-filter: blur(10px);
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.9);
            color: #667eea;
            border-color: rgba(255, 255, 255, 0.9);
        }

        .btn-primary:hover {
            background: white;
            color: #667eea;
        }

        .countdown {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 1rem;
            opacity: 0.8;
        }

        .countdown-number {
            font-size: 1.3rem;
            color: #00d4ff;
            font-family: 'Orbitron', monospace;
        }

        .success-checkmark {
            display: none;
            animation: bounce 1s ease-in-out;
            color: #00d4ff;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
            }
        }

        @keyframes progress {
            from {
                width: 0%;
            }
            to {
                width: 100%;
            }
        }

        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translateY(0);
            }
            40%, 43% {
                transform: translateY(-10px);
            }
            70% {
                transform: translateY(-5px);
            }
            90% {
                transform: translateY(-2px);
            }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .logout-container {
                padding: 3rem 2rem;
                margin: 1rem;
            }

            .logout-title {
                font-size: 1.5rem;
            }

            .logout-message {
                font-size: 1rem;
            }

            .logout-actions {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<div class="logout-container">
    <div class="logout-icon">
        <i class="fas fa-sign-out-alt" id="logoutIcon"></i>
        <i class="fas fa-check success-checkmark" id="successIcon"></i>
    </div>
    
    <h1 class="logout-title">Çıkış Yapılıyor...</h1>
    
    <p class="logout-message">
        Güvenli bir şekilde oturumunuz sonlandırılıyor.<br>
        QR-CODE.COM.TR'yi kullandığınız için teşekkür ederiz! 🙏
    </p>
    
    <div class="logout-progress">
        <div class="progress-bar"></div>
    </div>
    
    <div class="countdown">
        <span class="countdown-number" id="countdownNumber">3</span> saniye sonra yönlendirileceksiniz...
    </div>
    
    <div class="logout-actions">
        <a href="<?php echo $baseURL; ?>/" class="btn btn-primary">
            <i class="fas fa-home"></i>
            Ana Sayfaya Git
        </a>
        <a href="<?php echo $baseURL; ?>/giris" class="btn">
            <i class="fas fa-sign-in-alt"></i>
            Tekrar Giriş Yap
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('✨ Çıkış sayfası yüklendi');
    
    let countdown = 3;
    const countdownElement = document.getElementById('countdownNumber');
    const logoutIcon = document.getElementById('logoutIcon');
    const successIcon = document.getElementById('successIcon');
    
    // Countdown timer
    const timer = setInterval(() => {
        countdown--;
        countdownElement.textContent = countdown;
        
        if (countdown <= 0) {
            clearInterval(timer);
            
            // Success göster
            logoutIcon.style.display = 'none';
            successIcon.style.display = 'block';
            
            // Başlığı değiştir
            document.querySelector('.logout-title').textContent = 'Çıkış Başarılı!';
            document.querySelector('.logout-message').innerHTML = 'Güvenli bir şekilde çıkış yaptınız.<br>İyi günler dileriz! ✨';
            document.querySelector('.countdown').innerHTML = '<span style="color: #00d4ff;">Yönlendiriliyor...</span>';
            
            // Redirect
            setTimeout(() => {
                window.location.href = '<?php echo $redirectTo; ?>';
            }, 1000);
        }
    }, 1000);
    
    // Klavye kısayolları
    document.addEventListener('keydown', function(e) {
        if (e.key === 'h' || e.key === 'H') {
            window.location.href = '<?php echo $baseURL; ?>/';
        } else if (e.key === 'l' || e.key === 'L') {
            window.location.href = '<?php echo $baseURL; ?>/giris';
        } else if (e.key === 'Escape') {
            clearInterval(timer);
            window.location.href = '<?php echo $baseURL; ?>/';
        }
    });
    
    // Progress bar animasyonu bitince success göster
    setTimeout(() => {
        document.querySelector('.progress-bar').style.background = 'linear-gradient(90deg, #00d4ff, #10b981, #00d4ff)';
    }, 2000);
});

// Sayfa kapatılırken session temizle
window.addEventListener('beforeunload', function() {
    // Ek güvenlik için localStorage/sessionStorage temizle
    if (typeof Storage !== "undefined") {
        localStorage.removeItem('qr_user_session');
        sessionStorage.clear();
    }
});
</script>

</body>
</html>