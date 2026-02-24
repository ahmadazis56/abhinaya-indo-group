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
<?php
$isDashboard = ($current_dir == 'admin' && basename($_SERVER['PHP_SELF']) == 'index.php');
$isEvents = ($current_dir == 'events');
$isPortfolio = ($current_dir == 'portfolio');
$isLogos = ($current_dir == 'logos');
$isTeam = ($current_dir == 'team');
?>

<div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity" onclick="toggleSidebar()"></div>

<aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-100 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-[-20px_0_40px_rgba(0,0,0,0.05)] lg:shadow-none lg:static lg:h-screen lg:sticky top-0 flex flex-col">
    <!-- Sidebar Header (Logo) -->
    <div class="h-20 px-6 flex items-center justify-between border-b border-slate-100/50">
        <a href="<?php echo $admin_path; ?>index.php" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 text-white flex items-center justify-center shadow-md shadow-brand-500/20">
                <i class="fas fa-building text-lg"></i>
            </div>
            <div class="leading-tight">
                <div class="font-bold text-slate-900 tracking-tight text-lg">Abhinaya</div>
                <div class="text-[11px] font-medium text-slate-500 uppercase tracking-widest">Admin Panel</div>
            </div>
        </a>
        <button type="button" class="lg:hidden inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:bg-slate-50 hover:text-slate-900 transition-colors" onclick="toggleSidebar()">
            <i class="fas fa-xmark text-lg"></i>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1 custom-scrollbar">
        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4 px-3">Menu Utama</div>

        <a href="<?php echo $admin_path; ?>index.php" class="<?php echo $isDashboard ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'; ?> group flex items-center gap-3 px-3 py-3 rounded-xl font-medium transition-all duration-200">
            <i class="fas fa-gauge-high w-5 text-center <?php echo $isDashboard ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'; ?> transition-colors"></i>
            <span>Dashboard</span>
        </a>

        <a href="<?php echo $admin_path; ?>events/index.php" class="<?php echo $isEvents ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'; ?> group flex items-center gap-3 px-3 py-3 rounded-xl font-medium transition-all duration-200">
            <i class="fas fa-calendar-days w-5 text-center <?php echo $isEvents ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'; ?> transition-colors"></i>
            <span>Events</span>
        </a>

        <a href="<?php echo $admin_path; ?>portfolio/index.php" class="<?php echo $isPortfolio ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'; ?> group flex items-center gap-3 px-3 py-3 rounded-xl font-medium transition-all duration-200">
            <i class="fas fa-briefcase w-5 text-center <?php echo $isPortfolio ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'; ?> transition-colors"></i>
            <span>Portfolio</span>
        </a>

        <a href="<?php echo $admin_path; ?>gallery/index.php" class="<?php echo ($current_dir == 'gallery') ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'; ?> group flex items-center gap-3 px-3 py-3 rounded-xl font-medium transition-all duration-200">
            <i class="fas fa-images w-5 text-center <?php echo ($current_dir == 'gallery') ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'; ?> transition-colors"></i>
            <span>Gallery</span>
        </a>

        <a href="<?php echo $admin_path; ?>logos/index.php" class="<?php echo $isLogos ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'; ?> group flex items-center gap-3 px-3 py-3 rounded-xl font-medium transition-all duration-200">
            <i class="fas fa-handshake w-5 text-center <?php echo $isLogos ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'; ?> transition-colors"></i>
            <span>Logos (Client & Partner)</span>
        </a>

        <a href="<?php echo $admin_path; ?>team/index.php" class="<?php echo $isTeam ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'; ?> group flex items-center gap-3 px-3 py-3 rounded-xl font-medium transition-all duration-200">
            <i class="fas fa-users w-5 text-center <?php echo $isTeam ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'; ?> transition-colors"></i>
            <span>Tim / Leadership</span>
        </a>
    </div>

    <!-- Sidebar Footer -->
    <div class="p-4 mt-auto border-t border-slate-100/80">
        <a href="<?php echo $web_path; ?>index.php" target="_blank" class="group flex items-center gap-3 px-3 py-3 rounded-xl font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all duration-200 mb-1">
            <i class="fas fa-arrow-up-right-from-square w-5 text-center text-slate-400 group-hover:text-brand-500 transition-colors"></i>
            <span>Lihat Website</span>
        </a>
        <a href="<?php echo $admin_path; ?>logout.php" class="group flex items-center gap-3 px-3 py-3 rounded-xl font-medium text-slate-600 hover:bg-rose-50 hover:text-rose-700 transition-all duration-200">
            <i class="fas fa-right-from-bracket w-5 text-center text-slate-400 group-hover:text-rose-500 transition-colors"></i>
            <span>Logout Account</span>
        </a>
    </div>
</aside>
