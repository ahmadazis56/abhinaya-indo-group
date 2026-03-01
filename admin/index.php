<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/messages.php';

require_once '../config/database.php';
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Admin Dashboard</h1>
                <p class="text-slate-500 mt-1 text-sm">Kelola Events, Gallery, Team, Portfolio, dan Logos.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="events/add.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
                    <i class="fas fa-plus"></i> New Event
                </a>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Event Metric Card -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-medium mb-1">Total Events</div>
                        <div class="text-3xl font-bold text-slate-900"><?php echo countEvents(); ?></div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl">
                        <i class="fas fa-calendar-days"></i>
                    </div>
                </div>
            </div>

            <!-- Gallery Metric Card -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-slate-500 text-sm font-medium mb-1">Total Gallery</div>
                        <div class="text-3xl font-bold text-slate-900"><?php echo countGallery(); ?></div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                        <i class="fas fa-images"></i>
                    </div>
                </div>
            </div>
            
            <!-- Add more metric cards here if needed in the future -->
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Activity Feed -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="text-base font-semibold text-slate-900">Activity Terbaru</h2>
                        <span class="text-xs font-medium text-brand-600 bg-brand-50 px-2.5 py-1 rounded-full">Live</span>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:w-0.5 before:bg-slate-100">
                            <?php
                            $recent = getRecentActivity();
                            if(empty($recent)) {
                                echo '<p class="text-slate-500 text-sm text-center py-4">Belum ada aktivitas.</p>';
                            } else {
                                foreach ($recent as $index => $activity) {
                                    $iconClass = $activity['type'] == 'Event' ? 'text-brand-500 bg-brand-50' : 'text-emerald-500 bg-emerald-50';
                                    $iconName = $activity['type'] == 'Event' ? 'fa-calendar-days' : 'fa-image';
                                    
                                    echo '<div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group select-none">';
                                    echo '    <!-- Icon -->';
                                    echo '    <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-sm '. $iconClass .'">';
                                    echo '        <i class="fas '. $iconName .' text-sm"></i>';
                                    echo '    </div>';
                                    
                                    echo '    <!-- Content -->';
                                    echo '    <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-4 rounded-xl border border-slate-100 shadow-sm">';
                                    echo '        <div class="flex items-center gap-2 mb-1">';
                                    echo '            <span class="text-xs font-bold text-slate-400">'. htmlspecialchars($activity['type']) .'</span>';
                                    echo '            <span class="text-[10px] font-medium text-slate-400 px-2 py-0.5 rounded-full bg-slate-100">'. htmlspecialchars($activity['time']) .'</span>';
                                    echo '        </div>';
                                    echo '        <div class="text-sm font-medium text-slate-800 line-clamp-2">'. htmlspecialchars($activity['description']) .'</div>';
                                    echo '    </div>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions Area -->
            <div class="space-y-6">
                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
                    <h3 class="text-base font-semibold text-slate-900 mb-4">Quick Links</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="gallery/add.php" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-100 hover:border-brand-200 hover:bg-brand-50 hover:text-brand-700 transition-colors text-slate-600 group">
                            <i class="fas fa-image text-2xl mb-2 text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                            <span class="text-xs font-semibold">New Gallery</span>
                        </a>
                        <a href="portfolio/add.php" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-100 hover:border-brand-200 hover:bg-brand-50 hover:text-brand-700 transition-colors text-slate-600 group">
                            <i class="fas fa-briefcase text-2xl mb-2 text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                            <span class="text-xs font-semibold">New Project</span>
                        </a>
                        <a href="logos/add.php" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-100 hover:border-brand-200 hover:bg-brand-50 hover:text-brand-700 transition-colors text-slate-600 group">
                            <i class="fas fa-handshake text-2xl mb-2 text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                            <span class="text-xs font-semibold">New Logo</span>
                        </a>
                        <a href="team/add.php" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-100 hover:border-brand-200 hover:bg-brand-50 hover:text-brand-700 transition-colors text-slate-600 group">
                            <i class="fas fa-user-plus text-2xl mb-2 text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                            <span class="text-xs font-semibold">New Member</span>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<?php
// Helper functions for dashboard (using $conn from config/database.php)
function countEvents() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as count FROM events");
    return $result ? $result->fetch_assoc()['count'] : 0;
}

function countGallery() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as count FROM gallery");
    return $result ? $result->fetch_assoc()['count'] : 0;
}
?>
