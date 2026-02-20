<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/messages.php';

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<main class="flex-1 lg:ml-72">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="flex items-start justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Admin Dashboard</h1>
                <p class="text-slate-600 mt-1">Kelola Events, Gallery, Team, Portfolio, dan Logos</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white border border-slate-200 rounded-2xl p-5">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl bg-brand-600 text-white flex items-center justify-center">
                        <i class="fas fa-calendar-days"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-900"><?php echo countEvents(); ?></div>
                        <div class="text-sm text-slate-600">Total Events</div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl bg-brand-600 text-white flex items-center justify-center">
                        <i class="fas fa-images"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-900"><?php echo countGallery(); ?></div>
                        <div class="text-sm text-slate-600">Total Gallery</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-6">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Quick Actions</h2>
                    <p class="text-sm text-slate-600 mt-1">Shortcut untuk menambah data</p>
                </div>
                <div class="flex gap-2">
                    <a href="events/add.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 text-white font-semibold hover:bg-brand-700">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Event</span>
                    </a>
                    <a href="gallery/add.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white font-semibold hover:bg-slate-800">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Gallery</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-900">Activity Terbaru</h2>
            </div>
            <div class="space-y-3">
                <?php
                $recent = getRecentActivity();
                foreach ($recent as $activity) {
                    echo '<div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">';
                    echo '<span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-600 text-white">' . htmlspecialchars($activity['type']) . '</span>';
                    echo '<span class="flex-1 text-sm font-medium text-slate-800">' . htmlspecialchars($activity['description']) . '</span>';
                    echo '<span class="text-xs text-slate-500">' . htmlspecialchars($activity['time']) . '</span>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<?php
// Helper functions
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

function getRecentActivity() {
    global $conn;
    $activity = [];
    
    // Recent events
    $result = $conn->query("SELECT 'Event' as type, title as description, created_at as time FROM events ORDER BY created_at DESC LIMIT 3");
    while ($row = $result->fetch_assoc()) {
        $row['time'] = timeAgo($row['time']);
        $activity[] = $row;
    }
    
    // Recent gallery
    $result = $conn->query("SELECT 'Gallery' as type, title as description, created_at as time FROM gallery ORDER BY created_at DESC LIMIT 2");
    while ($row = $result->fetch_assoc()) {
        $row['time'] = timeAgo($row['time']);
        $activity[] = $row;
    }
    
    // Sort by time
    usort($activity, function($a, $b) {
        return strtotime($b['time']) - strtotime($a['time']);
    });
    
    return array_slice($activity, 0, 5);
}

function timeAgo($datetime) {
    $time = strtotime($datetime);
    $now = time();
    $diff = $now - $time;
    
    if ($diff < 60) return 'Baru saja';
    if ($diff < 3600) return floor($diff / 60) . ' menit lalu';
    if ($diff < 86400) return floor($diff / 3600) . ' jam lalu';
    if ($diff < 604800) return floor($diff / 86400) . ' hari lalu';
    return date('d M Y', $time);
}

$conn->close();
?>
