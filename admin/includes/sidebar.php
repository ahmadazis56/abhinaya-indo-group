<?php
// Get current directory depth
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
$admin_path = '';
$web_path = '';

// Calculate relative paths based on current location
if ($current_dir == 'admin') {
    // We're in admin root
    $admin_path = '';
    $web_path = '../';
} else {
    // We're in a subdirectory (events, logos, gallery)
    $admin_path = '../';
    $web_path = '../../';
}
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>🏢 Abhinaya Admin</h2>
        <p>Management Panel</p>
    </div>
    
    <ul class="sidebar-menu">
        <li>
            <a href="<?php echo $admin_path; ?>index.php" class="<?php echo ($current_dir == 'admin' && basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>
        
        <li>
            <a href="<?php echo $admin_path; ?>events/index.php" class="<?php echo ($current_dir == 'events') ? 'active' : ''; ?>">
                <i class="fas fa-calendar-alt"></i>
                Events
            </a>
        </li>
        
        <li>
            <a href="<?php echo $admin_path; ?>portfolio/index.php" class="<?php echo ($current_dir == 'portfolio') ? 'active' : ''; ?>">
                <i class="fas fa-briefcase"></i>
                Portfolio
            </a>
        </li>
        
        <li>
            <a href="<?php echo $admin_path; ?>logos/index.php" class="<?php echo ($current_dir == 'logos') ? 'active' : ''; ?>">
                <i class="fas fa-image"></i>
                Client & Partner Logos
            </a>
        </li>
        
        <li>
            <a href="<?php echo $admin_path; ?>team/index.php" class="<?php echo ($current_dir == 'team') ? 'active' : ''; ?>">
                <i class="fas fa-users"></i>
                Team Members
            </a>
        </li>
        
        <li style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
            <a href="<?php echo $web_path; ?>index.php" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                Lihat Website
            </a>
        </li>
        
        <li>
            <a href="<?php echo $admin_path; ?>logout.php">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </li>
    </ul>
</aside>
