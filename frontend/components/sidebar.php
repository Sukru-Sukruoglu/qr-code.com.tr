<?php
<aside class="dashboard-sidebar">
    <div class="sidebar-header">
        <a href="<?php echo SITE_URL; ?>" class="sidebar-logo">
            <h2>QR-CODE</h2>
        </a>
        <button class="sidebar-close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="sidebar-user">
        <div class="user-avatar">
            <i class="fas fa-user"></i>
        </div>
        <div class="user-info">
            <h4><?php echo $_SESSION['user_name'] ?? 'Kullanıcı'; ?></h4>
            <span><?php echo $_SESSION['user_email'] ?? 'kullanici@mail.com'; ?></span>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>/dashboard" class="nav-link <?php echo $path == '/dashboard' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Panel</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>/dashboard/qr-codes" class="nav-link <?php echo $path == '/dashboard/qr-codes' ? 'active' : ''; ?>">
                    <i class="fas fa-qrcode"></i>
                    <span>QR Kodlarım</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>/dashboard/analytics" class="nav-link <?php echo $path == '/dashboard/analytics' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-bar"></i>
                    <span>İstatistikler</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>/dashboard/billing" class="nav-link <?php echo $path == '/dashboard/billing' ? 'active' : ''; ?>">
                    <i class="fas fa-credit-card"></i>
                    <span>Faturalama</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>/dashboard/account" class="nav-link <?php echo $path == '/dashboard/account' ? 'active' : ''; ?>">
                    <i class="fas fa-user-cog"></i>
                    <span>Hesabım</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <a href="<?php echo SITE_URL; ?>/auth/logout" class="btn btn-outline btn-sm">
            <i class="fas fa-sign-out-alt"></i>
            <span>Çıkış Yap</span>
        </a>
    </div>
</aside>