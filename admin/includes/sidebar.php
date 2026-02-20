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

<div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/60 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

<aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-200">
    <div class="h-14 px-4 flex items-center justify-between border-b border-slate-200">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-brand-600 to-brand-700 text-white flex items-center justify-center">
                <i class="fas fa-building"></i>
            </div>
            <div class="leading-tight">
                <div class="font-semibold">Abhinaya Admin</div>
                <div class="text-xs text-slate-500">Management Panel</div>
            </div>
        </div>
        <button type="button" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg hover:bg-slate-100" onclick="toggleSidebar()">
            <i class="fas fa-xmark"></i>
        </button>
    </div>

    <nav class="p-3">
        <a href="<?php echo $admin_path; ?>index.php" class="<?php echo $isDashboard ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100'; ?> flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium">
            <i class="fas fa-gauge-high w-5 text-center"></i>
            <span>Dashboard</span>
        </a>

        <a href="<?php echo $admin_path; ?>events/index.php" class="<?php echo $isEvents ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100'; ?> mt-1 flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium">
            <i class="fas fa-calendar-days w-5 text-center"></i>
            <span>Events</span>
        </a>

        <a href="<?php echo $admin_path; ?>portfolio/index.php" class="<?php echo $isPortfolio ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100'; ?> mt-1 flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium">
            <i class="fas fa-briefcase w-5 text-center"></i>
            <span>Portfolio</span>
        </a>

        <a href="<?php echo $admin_path; ?>gallery/index.php" class="<?php echo ($current_dir == 'gallery') ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100'; ?> mt-1 flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium">
            <i class="fas fa-images w-5 text-center"></i>
            <span>Gallery</span>
        </a>

        <a href="<?php echo $admin_path; ?>logos/index.php" class="<?php echo $isLogos ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100'; ?> mt-1 flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium">
            <i class="fas fa-handshake w-5 text-center"></i>
            <span>Logos</span>
        </a>

        <a href="<?php echo $admin_path; ?>team/index.php" class="<?php echo $isTeam ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100'; ?> mt-1 flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium">
            <i class="fas fa-users w-5 text-center"></i>
            <span>Team</span>
        </a>

        <div class="mt-4 pt-4 border-t border-slate-200">
            <a href="<?php echo $web_path; ?>index.php" target="_blank" class="text-slate-700 hover:bg-slate-100 flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium">
                <i class="fas fa-arrow-up-right-from-square w-5 text-center"></i>
                <span>Lihat Website</span>
            </a>
            <a href="<?php echo $admin_path; ?>logout.php" class="mt-1 text-slate-700 hover:bg-rose-50 hover:text-rose-700 flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium">
                <i class="fas fa-right-from-bracket w-5 text-center"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>
</aside>
