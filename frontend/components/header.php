<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-qrcode"></i>
                <span>QR-CODE.COM.TR</span>
            </div>
            
            <nav class="nav">
                <a href="<?php echo $baseURL; ?>/" 
                   class="<?php echo ($currentPath == '' || $currentPath == 'frontend/views/home') ? 'active' : ''; ?>">
                    Ana Sayfa
                </a>
                <a href="<?php echo $baseURL; ?>/frontend/views/features" 
                   class="<?php echo (strpos($currentPath, 'features') !== false) ? 'active' : ''; ?>">
                    Özellikler
                </a>
                <a href="<?php echo $baseURL; ?>/frontend/views/how-to-use" 
                   class="<?php echo (strpos($currentPath, 'how-to-use') !== false) ? 'active' : ''; ?>">
                    Nasıl Kullanılır
                </a>
                <a href="<?php echo $baseURL; ?>/frontend/views/about" 
                   class="<?php echo (strpos($currentPath, 'about') !== false) ? 'active' : ''; ?>">
                    Hakkımızda
                </a>
                <a href="<?php echo $baseURL; ?>/frontend/views/contact" 
                   class="<?php echo (strpos($currentPath, 'contact') !== false) ? 'active' : ''; ?>">
                    İletişim
                </a>
                
                <?php if ($isLoggedIn): ?>
                    <a href="<?php echo $baseURL; ?>/dashboard" class="btn btn-primary">Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo $baseURL; ?>/giris" class="btn btn-outline">Giriş Yap</a>
                    <a href="<?php echo $baseURL; ?>/kayit" class="btn btn-primary">Kayıt Ol</a>
                <?php endif; ?>
            </nav>

            <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
</header>