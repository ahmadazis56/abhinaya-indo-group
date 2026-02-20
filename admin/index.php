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

<div class="main-content">
    <div class="dashboard-header">
        <h1>Dashboard Admin</h1>
        <p>Kelola Events dan Gallery</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📅</div>
            <div class="stat-info">
                <h3><?php echo countEvents(); ?></h3>
                <p>Total Events</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">🖼️</div>
            <div class="stat-info">
                <h3><?php echo countGallery(); ?></h3>
                <p>Total Gallery</p>
            </div>
        </div>
    </div>

    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="action-buttons">
            <a href="events/add.php" class="btn btn-primary">
                <span>➕</span> Tambah Event
            </a>
            <a href="gallery/add.php" class="btn btn-tertiary">
                <span>➕</span> Tambah Gallery
            </a>
        </div>
    </div>

    <div class="recent-activity">
        <h2>Activity Terbaru</h2>
        <div class="activity-list">
            <?php
            $recent = getRecentActivity();
            foreach ($recent as $activity) {
                echo '<div class="activity-item">';
                echo '<span class="activity-type">' . $activity['type'] . '</span>';
                echo '<span class="activity-desc">' . $activity['description'] . '</span>';
                echo '<span class="activity-time">' . $activity['time'] . '</span>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

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
